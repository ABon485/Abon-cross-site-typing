<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("Data stolen from user:");
    error_log("username: " . $_POST['username']);
    error_log("message:  " . $_POST['message']);
}

?>
