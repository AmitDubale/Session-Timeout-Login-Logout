<?php
require_once('module/start_session.php');
unset($_SESSION['LOGGED_WEB_USER']);
unset($_SESSION['LOGGED_WEB_EMAIL']);
session_destroy();
//echo "<script>alert('User Logout Successfully');</script>";
echo'<script>window.location="index.php";</script>';
?>