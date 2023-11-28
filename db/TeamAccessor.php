<?php
require_once dirname(__DIR__, 1) . '/entity/Team.php';
require_once dirname(__DIR__, 1) . '/utils/ChromePhp.php';

class TeamAccessor
{
    private $getAllStatementString = "select * from TEAM";
    //private $getByIDStatementString = "select * from MENUITEM where itemID = :itemID";
    //private $deleteStatementString = "delete from MENUITEM where itemID = :itemID";
    //private $insertStatementString = "insert INTO MENUITEM values (:itemID, :itemCategoryID, :description, :price, :vegetarian)";
    //private $updateStatementString = "update MENUITEM set itemCategoryID = :itemCategoryID, description = :description, price = :price, vegetarian = :vegetarian where itemID = :itemID";

    private $getAllStatement = null;
    //private $getByIDStatement = null;
    //private $deleteStatement = null;
    //private $insertStatement = null;
    //private $updateStatement = null;

    /**
     * Creates a new instance of the accessor with the supplied database connection.
     * 
     * @param PDO $conn - a database connection
     */
    public function __construct($conn)
    {
        ChromePhp::log("team Item accessor executing");

        if (is_null($conn)) {
            throw new Exception("no connection");
        }

        $this->getAllStatement = $conn->prepare($this->getAllStatementString);
        if (is_null($this->getAllStatement)) {
            throw new Exception("bad statement: '" . $this->getAllStatementString . "'");
        }
    }

    /**
     * Gets all of the teams.
     * 
     * @return Team[] array of TeamItem objects
     */
    public function getAllTeams()
    {
        $results = [];

        try {
            $this->getAllStatement->execute();
            $dbresults = $this->getAllStatement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($dbresults as $r) {
                $teamID = $r['teamID'];
                $teamName = $r['teamName'];
                
                $obj = new Team($teamID, $teamName);
                array_push($results, $obj);
            }
        } catch (Exception $e) {
            ChromePhp::log($e->getMessage());
            $results = [];
        } finally {
            if (!is_null($this->getAllStatement)) {
                $this->getAllStatement->closeCursor();
            }
        }

        return $results;
    }

}
// end class TeamAccessor
