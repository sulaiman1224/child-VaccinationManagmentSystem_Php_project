<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php");
    exit();
}
$id = $_GET['id'];



    $sql = "DELETE FROM feedback WHERE id = '$id'";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        $_SESSION['message'] = [
            'text' => 'Data deleted successfully',
            'icon' => 'success'
        ];
    } else {
        $_SESSION['message'] = [
            'text' => 'Failed to delete data',
            'icon' => 'error'
        ];
    }



header('Location: admin_feedback.php');
exit();
?>
