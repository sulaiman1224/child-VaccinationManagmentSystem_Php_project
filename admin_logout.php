<?php
session_start();
session_unset();
session_destroy();
$_SESSION['message'] = [
    'text' => 'You have been logged out successfully!',
    'icon' => 'info'
];
header("Location: admin_login.php");
exit();
?>
