<?php
require_once ('./header.php');
require_once('./db.php');
require_once ('./Controller/ChatSessions.php');
require_once ('./Database/ChatSessionsDOA.php');

/*
   POST /chatsessions.php store
*/
if (!isset($_POST['firstname'])) {
    exit (json_encode(["error" => "firstname is required"]));
}
if (!isset($_POST['lastname'])) {
    exit (json_encode(["error" => "lastname is required"]));
}
if (!isset($_POST['email'])) {
    exit (json_encode(["error" => "email is required"]));
}

$chatSession = new Controller\ChatSessions($conn);
exit (json_encode($chatSession->create($_POST['firstname'],$_POST['lastname'],$_POST['email'])));
