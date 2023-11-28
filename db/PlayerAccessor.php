<?php
require_once dirname(__DIR__, 1) . '/entity/Player.php';

class PlayerAccessor
{
    private $getAllStatementString = "select * from player";
    private $getAllStatement = null;

    /**
     * Creates a new instance of the accessor with the supplied database connection.
     * 
     * @param PDO $conn - a database connection
     */
    public function __construct($conn)
    {
        if (is_null($conn)) {
            throw new Exception("no connection");
        }

        $this->getAllStatement = $conn->prepare($this->getAllStatementString);
        if (is_null($this->getAllStatement)) {
            throw new Exception("bad statement: '" . $this->getAllStatementString . "'");
        }
    }

    /**
     * Gets all menu item categories.
     * 
     * @return array MenuItemCategory objects, possibly empty
     */
    public function getAllPlayers()
    {
        $result = [];

        try {
            $this->getAllStatement->execute();
            $dbresults = $this->getAllStatement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($dbresults as $r) {
                $playerID = $r['playerID'];
                $teamID = $r['teamID'];
                $firstName = $r['firstName'];
                $lastName = $r['lastName'];
                $hometown = $r['hometown'];
                $provinceCode = $r['provinceCode'];

                $obj = new Player($playerID,$teamID,$firstName,$lastName,$hometown,$provinceCode);
                array_push($result, $obj);
            }
        } catch (Exception $e) {
            $result = [];
        } finally {
            if (!is_null($this->getAllStatement)) {
                $this->getAllStatement->closeCursor();
            }
        }

        return $result;
    }
}
// end class MenuItemCategoryAccessor
