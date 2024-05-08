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
        $query = "SELECT * FROM rating WHERE hospital_id = '$hospitalId' AND user_id = '$userId' LIMIT 1";
        return $this->exec($query);
    }

    function getUserRating($userId)
    {
        $query = "SELECT * FROM rating WHERE user_id = '$userId'";
        return $this->exec($query);
    }

    function calculateAverageRating($hospitalId)
    {
        $query = "SELECT AVG(rating_value) AS average_rating, COUNT(*) AS num_ratings FROM rating WHERE hospital_id = '$hospitalId'";
        $result = $this->exec($query);
        while ($row = $result->fetch_assoc()) {
            $average_rating = $row['average_rating'];
            $num_ratings = $row['num_ratings'];
        }

        $queryUpdateRating = "UPDATE hospital SET rating = '$average_rating', num_ratings = '$num_ratings' WHERE hospital_id = '$hospitalId'";
        $this->exec($queryUpdateRating);
    }
}
