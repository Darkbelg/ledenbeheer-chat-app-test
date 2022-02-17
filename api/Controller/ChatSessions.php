<?php

namespace Controller;

use Database\ChatSessionsDOA;

class ChatSessions
{
    private $databseConnection;

    public function __construct($databaseConnection)
    {
        $this->databseConnection = $databaseConnection;
    }

    public function store($firstname,$lastname,$email)
    {
        //First look if there already is a session.
        $chatSessionDOA = new ChatSessionsDOA($this->databseConnection);
        $session = $chatSessionDOA->get($firstname,$lastname,$email);
        if (is_null($session)) {
            $chatSessionDOA->store($firstname,$lastname,$email);
            $session = $chatSessionDOA->get($firstname,$lastname,$email);
        }
        return $session;
    }

    public function index()
    {
        $chatSessionDOA = new ChatSessionsDOA($this->databseConnection);
        return $chatSessionDOA->getAll();
    }
}