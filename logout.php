<?php
    session_start();
    $_SESSION = [];
    $_POST = [];
    session_destroy();
    header('Location: index.php');
?>