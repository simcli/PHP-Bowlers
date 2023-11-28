<?php
require_once dirname(__DIR__, 1) . '/db/ConnectionManager.php';
require_once dirname(__DIR__, 1) . '/db/TeamAccessor.php';
require_once dirname(__DIR__, 1) . '/entity/Team.php';
require_once dirname(__DIR__, 1) . '/utils/Constants.php';
require_once dirname(__DIR__, 1) . '/utils/ChromePhp.php';

$method = $_SERVER['REQUEST_METHOD'];

try {
    ChromePhp::log("team Service executing");
    //database connection object
    $cm = new ConnectionManager(Constants::$MYSQL_CONNECTION_STRING, Constants::$MYSQL_USERNAME, Constants::$MYSQL_PASSWORD);
    //team accesor object
    $tia = new TeamAccessor($cm->getConnection());
    if ($method === "GET") {
        doGet($tia);
    }
} catch (Exception $e) {
    sendResponse(500, null, "ERROR " . $e->getMessage());
} finally {
    if (!is_null($cm)) {
        $cm->closeConnection();
    }
}

function doGet($tia)
{
    // url = "bowling/teams" ==> get all categories
    // url = "menuService/categories" ==> get all categories
    if (!isset($_GET['teamid'])) {
        ChromePhp::log('Attempting to get all teams');
        try {
            $results = $tia->getAllTeams();
            $results = json_encode($results, JSON_NUMERIC_CHECK);
            //ChromePhp::log($results);
            sendResponse(200, $results, null);
        } catch (Exception $e) {
            sendResponse(500, null, "ERROR " . $e->getMessage());
        }
    }
    // url = "bowling/teams/XXX" where XXX is a teamID ==> get just the team with the matching ID
    else {
        ChromePhp::log($_GET['teamid']);
    }
}

function sendResponse($statusCode, $data, $error)
{
    header("Content-Type: application/json");
    http_response_code($statusCode);
    $resp = ['data' => $data, 'error' => $error];
    echo json_encode($resp, JSON_NUMERIC_CHECK);
}
