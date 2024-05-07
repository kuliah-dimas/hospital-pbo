<?php

class Hospital
{

    var $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getDetailHospital($hospitalId)
    {
        $query = "SELECT * FROM hospital WHERE hospital_id = $hospitalId";
        $result = $this->conn->query($query);
        return $result;
    }

    function getAllHospital($conn)
    {
        $query = "SELECT * FROM hospital;";
        $results = $this->conn->query($query);
        return $results;
    }

    function getRatingHospital($hospitalId)
    {
        $query = "SELECT r.rating_value, r.comment, r.created_at, u.full_name
        FROM rating r
        JOIN user u ON r.user_id = u.user_id
        WHERE r.hospital_id = '$hospitalId'
        ORDER BY r.created_at ASC";
        $result = $this->conn->query($query);
        return $result;
    }

    function getDoctorHospital($hospitalId)
    {
        $query = "
            SELECT
                d.doctor_id as doctor_id,
                d.name AS doctor_name,
                d.specialization as specialization,
                d.phone as phone,
                h.hospital_id,
                h.name AS hospital_name
            FROM
                doctor d
                INNER JOIN doctor_hospital dh ON d.doctor_id = dh.doctor_id
                INNER JOIN hospital h ON dh.hospital_id = h.hospital_id
            WHERE
            h.hospital_id = '$hospitalId';
            ";

        $results = $this->conn->query($query);
        return $results;
    }
}
