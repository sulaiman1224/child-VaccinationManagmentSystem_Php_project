<?php
session_start();
session_unset();
session_destroy();
header("Location: parents_login.php");
exit();
?>
