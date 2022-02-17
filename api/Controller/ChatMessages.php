<?php

namespace Controller;

use Database\ChatMessagesDOA;

class ChatMessages
{
    private $databaseConnection;

    public function __construct($databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function create($chat_session_id,$message)
    {
        $chatMessagesDOA = new ChatMessagesDOA($this->databaseConnection);
        return $chatMessagesDOA->create($chat_session_id,$message);
    }
}