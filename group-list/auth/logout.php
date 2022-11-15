<?php
session_start();
unset($_SESSION['user']);
header('Location: /files/group-list/auth/login.php');
