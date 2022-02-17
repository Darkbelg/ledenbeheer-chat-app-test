<?php

namespace Database;

class ChatMessagesDOA
{
    private $databaseConnection;

    public function __construct($databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function store($chat_session_id,$message)
    {
        try {
            $created_at = (new \DateTime("now"))->format("Y-m-d H:i:s");
            $stmt = $this->databaseConnection->prepare( "INSERT INTO chat_message (created_at,chat_session_id,message) VALUES (?,?,?)");
            $stmt->bind_param("sss",$created_at,$chat_session_id,$message);
            return $stmt->execute();
        } catch (\Exception $e){
            throw new \Exception("Failed to insert message");
        }
    }

    public function getAll($chat_session_id = null)
    {
        if (is_null($chat_session_id)) {
            $results = $this->databaseConnection->query( "SELECT * from chat_message");
            return $results->fetch_all(MYSQLI_ASSOC);
        }
        $stmt = $this->databaseConnection->prepare( "SELECT * from chat_message where chat_session_id = ?");
        $stmt->bind_param("s",$chat_session_id);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }
}