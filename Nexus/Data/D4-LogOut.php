<?php
session_start();
session_destroy();
header("Location: ../F1-Home.php");
exit();
?>