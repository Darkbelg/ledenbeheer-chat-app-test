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

    public function store($chat_session_id,$message)
    {
        $chatMessagesDOA = new ChatMessagesDOA($this->databaseConnection);
        return $chatMessagesDOA->store($chat_session_id,$message);
    }

    public function index($chat_session_id = null)
    {
        $chatMessagesDOA = new ChatMessagesDOA($this->databaseConnection);
        return $chatMessagesDOA->getAll($chat_session_id);
    }
}