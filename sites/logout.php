<?php

session_start();
unset($_SESSION['user']);
unset($_SESSION['admin']);
session_destroy();
header("Location: http://localhost/sites/index.php");
exit();