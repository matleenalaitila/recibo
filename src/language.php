<?php
/**
 * Author: Matleena Laitila
 * 
 */
session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'fi';
}
else if (isset($_GET['language']) && $_GET['language'] === 'en') {
    $_SESSION['language'] = 'en';
}
else {
    $_SESSION['language'] = 'fi';
}

require_once("languages/" . $_SESSION['language'] . ".php");