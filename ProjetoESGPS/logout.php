<?php
session_start();
unset($_SESSION['UserInfo']);
header('Location: index.php');