<?php
    include 'includes/conf.php';
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
    unset($_SESSION[SESSION_VAR]['user']);
    header('Location: '.SITE_URL."/login.php");exit;
