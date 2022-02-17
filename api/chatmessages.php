<?php
require_once ('./header.php');
require_once('./db.php');
require_once ('./Controller/ChatMessages.php');
require_once ('./Database/ChatMessagesDOA.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $chatMessages = new Controller\ChatMessages($conn);

    if (!empty($_GET['chatsessionid'])){
        exit (json_encode($chatMessages->index($_GET['chatsessionid'])));
    };

    exit (json_encode($chatMessages->index()));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /*
       POST /chatmessages.php store
    */
    if (empty($_POST['message'])) {
        exit (json_encode(["error" => "message is required"]));
    }

    if (empty($_POST['chatsessionid'])) {
        exit (json_encode(["error" => "chat session id is required"]));
    }

    $chatMessage = new Controller\ChatMessages($conn);
    exit (json_encode($chatMessage->store($_POST['chatsessionid'], $_POST['message'])));
}