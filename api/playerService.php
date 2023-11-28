<?php
require_once dirname(__DIR__, 1) . '/db/ConnectionManager.php';
require_once dirname(__DIR__, 1) . '/db/PlayerAccessor.php';
require_once dirname(__DIR__, 1) . '/entity/Player.php';
require_once dirname(__DIR__, 1) . '/utils/Constants.php';
require_once dirname(__DIR__, 1) . '/utils/ChromePhp.php';

/*
 * Important Note:
 * 
 * $_GET will contain the item ID, even if the caller uses POST in the AJAX call. 
 * Why? Because the router (.htaccess) converts the URL from 
 *     menuService/items/N
 * to
 *     menuService.php?itemid=N
 * The syntax "?key=value" is interpreted as a GET parameter and is therefore
 * stored in the $_GET array.
 */

$method = $_SERVER['REQUEST_METHOD'];

try {
    $cm = new ConnectionManager(Constants::$MYSQL_CONNECTION_STRING, Constants::$MYSQL_USERNAME, Constants::$MYSQL_PASSWORD);
    $mia = new PlayerAccessor($cm->getConnection());

    if ($method === "GET") {
        doGet($mia);
    } else if ($method === "POST") {
        doPost($mia);
    } else if ($method === "DELETE") {
        doDelete($mia);
    } else if ($method === "PUT") {
        doPut($mia);
    } else {
        sendResponse(405, null, "method not allowed");
    }
} catch (Exception $e) {
    sendResponse(500, null, "ERROR " . $e->getMessage());
} finally {
    if (!is_null($cm)) {
        $cm->closeConnection();
    }
}

function doGet($mia)
{
    // individual
    if (isset($_GET['itemid'])) {
        sendResponse(405, null, "individual GETs not allowed");
    }
    // collection
    else {
        try {
            $results = $mia->getAllPlayers();
            if (count($results) > 0) {
                $results = json_encode($results, JSON_NUMERIC_CHECK);
                sendResponse(200, $results, null);
            } else {
                sendResponse(404, null, "could not retrieve items");
            }
        } catch (Exception $e) {
            sendResponse(500, null, "ERROR " . $e->getMessage());
        }
    }
}

function doDelete($mia)
{
    if (isset($_GET['itemid'])) {
        $itemID = $_GET['itemid'];
        // Only the ID of the item matters for a delete,
        // but the accessor expects an object, 
        // so we need a dummy object.
        $menuItemObj = new MenuItem($itemID, "dummyCat", "dummyDesc", 8, 0);

        // delete the object from DB
        $success = $mia->deleteItem($menuItemObj);
        if ($success) {
            sendResponse(200, $success, null);
        } else {
            sendResponse(404, null, "could not delete item - it does not exist");
        }
    } else {
        // Bulk deletes not implemented.
        sendResponse(405, null, "bulk DELETEs not allowed");
    }
}

// aka CREATE
function doPost($mia)
{
    if (isset($_GET['itemid'])) {
        // The details of the item to insert will be in the request body.
        $body = file_get_contents('php://input');
        $contents = json_decode($body, true);

        try {
            // create a MenuItem object
            $menuItemObj = new MenuItem($contents['itemID'], $contents['itemCategoryID'], $contents['description'], $contents['price'], $contents['vegetarian']);

            // add the object to DB
            $success = $mia->insertItem($menuItemObj);
            if ($success) {
                sendResponse(201, $success, null);
            } else {
                sendResponse(409, null, "could not insert item - it already exists");
            }
        } catch (Exception $e) {
            sendResponse(400, null, $e->getMessage());
        }
    } else {
        // Bulk inserts not implemented.
        sendResponse(405, null, "bulk INSERTs not allowed");
    }
}

// aka UPDATE
function doPut($mia)
{
    if (isset($_GET['itemid'])) {
        // The details of the item to update will be in the request body.
        $body = file_get_contents('php://input');
        $contents = json_decode($body, true);

        try {
            // create a MenuItem object
            $menuItemObj = new MenuItem($contents['itemID'], $contents['itemCategoryID'], $contents['description'], $contents['price'], $contents['vegetarian']);

            // update the object in the  DB
            $success = $mia->updateItem($menuItemObj);
            if ($success) {
                sendResponse(200, $success, null);
            } else {
                sendResponse(404, null, "could not update item - it does not exist");
            }
        } catch (Exception $e) {
            sendResponse(400, null, $e->getMessage());
        }
    } else {
        // Bulk updates not implemented.
        sendResponse(405, null, "bulk UPDATEs not allowed");
    }
}

function sendResponse($statusCode, $data, $error)
{
    header("Content-Type: application/json");
    http_response_code($statusCode);
    $resp = ['data' => $data, 'error' => $error];
    echo json_encode($resp, JSON_NUMERIC_CHECK);
}
