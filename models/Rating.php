<?php

class Rating
{

    var $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    private function exec($query)
    {
        return $this->conn->query($query);
    }


    function getRatingByHospitalAndUser($hospitalId, $userId)
    {
        $query = "SELECT * FROM rating WHERE hospital_id = '$hospitalId' AND user_id = '$userId'";
        return $this->exec($query);
    }

    function getUserRating($userId)
    {
        $query = "SELECT * FROM rating WHERE user_id = '$userId'";
        return $this->exec($query);
    }
}
