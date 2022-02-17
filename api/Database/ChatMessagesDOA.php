<?php

namespace Database;

class ChatMessagesDOA
{
    private $databaseConnection;

    public function __construct($databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function create($chat_session_id,$message)
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
}