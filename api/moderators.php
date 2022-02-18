<?php
$result = $conn->query('SELECT * FROM chat_moderator');
if ($result) {
    $moderators = [];
    while ($data = $result->fetch_assoc()) {
        $moderators[] = $data;
    }
    exit(json_encode($moderators));
} else {
    print_r(mysqli_error($conn));
}