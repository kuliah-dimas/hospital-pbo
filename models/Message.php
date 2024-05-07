<?php

class Message
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

    function insertMessage($name, $email, $message)
    {
        $query = "INSERT INTO message VALUES ($name, $email, $message)";
        return $this->exec($query);
    }

    function getAllMessage()
    {
        $query = "SELECT * FROM message";
        return $this->exec($query);
    }

    function deleteMessage($messageId)
    {
        $query = "DELETE FROM message WHERE message_id = '$messageId'";
        return $this->exec($query);
    }
}
