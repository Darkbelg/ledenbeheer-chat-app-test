<?php
require_once('./header.php');
require_once('./db.php');

if (!isset($_GET['q'])) {
    die('No specific API passed');
}

// This is an example to list all chat moderators
if ($_GET['q'] === 'moderators') {
    require_once('./moderators.php');
}

if ($_GET['q'] === 'chatsessions') {
    require_once('./chatsessions.php');
}

if ($_GET['q'] === 'chatmessages') {
    require_once('./chatmessages.php');
}