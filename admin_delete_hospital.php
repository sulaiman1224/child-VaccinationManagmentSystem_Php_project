<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php");
    exit();
}
$id = $_GET['id'];

// Check for related records
$check_sql = "SELECT COUNT(*) as count FROM hospitals WHERE add_hospital_id = '$id'";
$check_result = mysqli_query($connect, $check_sql);
$row = mysqli_fetch_assoc($check_result);

if ($row['count'] > 0) {

    $_SESSION['message'] = [
        'text' => 'Cannot delete this hospital because it is registered .',
        'icon' => 'error'
    ];

} else {
 
    $sql = "DELETE FROM add_hospital WHERE id = '$id'";
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
}


header('Location: admin_hospital_list.php');
exit();
?>