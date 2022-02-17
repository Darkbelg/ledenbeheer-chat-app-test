<?php
require_once ('./header.php');
require_once('./db.php');
require_once ('./Controller/ChatSessions.php');
require_once ('./Database/ChatSessionsDOA.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $chatSession = new Controller\ChatSessions($conn);
    exit (json_encode($chatSession->index()));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /*
       POST /chatsessions.php store
    */
    if (empty($_POST['firstname'])) {
        exit (json_encode(["error" => "firstname is required"]));
    }
    if (empty($_POST['lastname'])) {
        exit (json_encode(["error" => "lastname is required"]));
    }
    if (empty($_POST['email'])) {
        exit (json_encode(["error" => "email is required"]));
    }

    $chatSession = new Controller\ChatSessions($conn);
    exit (json_encode($chatSession->store($_POST['firstname'], $_POST['lastname'], $_POST['email'])));
}