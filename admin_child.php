<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php");
    exit();
}
$sql = "SELECT *  FROM admin";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row["id"];
$admin_name = $row["name"];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>children detail</title>
    <link rel="stylesheet" href="assets/css/admin.cs">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- SweetAlert2 CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> -->


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Bootstrap Table JS -->
    <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/colors.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/fresh-bootstrap-table.css">

    <style>

    </style>
</head>

<body>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    <div class="admin_main">
    <div class="sidebar">
            <ul>
                <li><a href="admin_home.php" class="logo">Home</a></li>
                <li class="active" ><a  class="active" href="admin_child.php" class="nav_links">children</a></li>
                <li><a href="admin_appointment_requests.php" class="nav_links"> appointment requests</a></li>
                <li><a href="admin_booking.php" class="nav_links"> booking</a></li>
                <li><a href="admin_vaccination_report.php" class="nav_links">vaccination report</a></li>
                <li><a href="admin_reminder.php" class="nav_links">Reminder</a></li>
                <li><a href="admin_hospital_list.php" class="nav_links"> hospital list</a></li>
                <li><a href="admin_vaccine_list.php" class="nav_links">vaccine list</a></li>
                <li><a href="admin_approve_hospital.php" class="nav_links"> approve</a></li>
                <li><a href="admin_feedback.php" class="nav_links">feedback</a></li>
                <li><a href="admin_profile.php" class="nav_links">profile</a></li>
                <li><a href="admin_logout.php" class="nav_links">logout</a></li>
            </ul>

        </div>
        <div class="main_content">
            <div class="header_admin">
                <span class="toggle-btn"><i class="fas fa-bars"></i></span>
                <span class="login"><?php echo $admin_name;   ?></span> 
            </div>
            <div class="container">

                <div class="tablename">View Child Details</div>
                <div class="wrapper">
                    <!--   Creative Tim Branding   -->

                    <div class="fresh-table full-color-orange ">
                        <table id="fresh-table" class="table">
                            <thead>
                                <th data-field="id">ID</th>
                                <th data-field="email" data-sortable="true">email</th>
                                <th data-field="name" data-sortable="true">Name</th>
                                <th data-field="age" data-sortable="true">Age</th>
                                <th data-field="gender" data-sortable="true">Gender</th>
                                <th data-field="dob" data-sortable="true">Date of Birth</th>
                                <th data-field="blood_group" data-sortable="true">Blood Group</th>
                                <th data-field="weight" data-sortable="true">Weight (kg)</th>
                                <th data-field="height" data-sortable="true">Height (cm)</th>
                                
                            </thead>
                            <tbody>
                                <?php
                                // child profiles details
                                $sql ="select
                                    children.id, 
                                    parents.email, 
                                    children.child_name, 
                                    children.age, 
                                    children.date_of_birth, 
                                    children.gender, 
                                    children.weight_kg, 
                                    children.height_cm, 
                                    children.blood_group
                                    from
                                    children
                                    join
                                    parents
                                    on
                                    children.parent_id=parents.id;";
                                $result = mysqli_query($connect, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $email = $row['email'];
                                    $name = $row['child_name'];
                                    $age = $row['age'];
                                    $dob = $row['date_of_birth'];
                                    $gender = $row['gender'];
                                    $weight = $row['weight_kg'];
                                    $height = $row['height_cm'];
                                    $blood_group = $row['blood_group'];
                                ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $age; ?></td>
                                        <td><?php echo $gender; ?></td>
                                        <td><?php echo $dob; ?></td>
                                        <td><?php echo $blood_group; ?></td>
                                        <td><?php echo $weight; ?></td>
                                        <td><?php echo $height; ?></td>
                                       
                                     
                                    </tr>
                                <?php

                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.toggle-btn').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main_content');
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('shifted');
        });
    </script>
    <script src="assets/js/table.js"></script>
</body>

</html>