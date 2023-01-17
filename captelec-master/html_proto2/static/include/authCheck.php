<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['log'])) {
    header('location:'.$rootURL.'auth.php');
} else {
    $connected = true;
}