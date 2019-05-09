<?php
session_start();

if (isset($_GET['tragop'])) {$_SESSION['tragop'] = $_GET['tragop'];}
?>