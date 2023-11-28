<?php

class Team implements JsonSerializable
{
    private $teamID;
    private $teamName;

    public function __construct($teamID, $teamName)
    {
        //if ($price <= 0) {
        //    throw new Exception("price must be positive");
        //}
        // check other stuff when time permits
        $this->teamID = $teamID;
        $this->teamName = $teamName;
    }

    public function getTeamID()
    {
        return $this->teamID;
    }

    public function getTeamName()
    {
        return $this->teamName;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
// end class MenuItem