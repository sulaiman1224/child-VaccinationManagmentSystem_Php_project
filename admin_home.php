<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php");
    exit();
}
// select from
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
    <title>Home</title>
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
    <link rel="stylesheet" href="assets/css/fresh-bootstrap-table.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/colors.css">
    <link rel="stylesheet" href="assets/css/admin.css">


    <style>

    </style>
</head>

<body>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    <div class="admin_main">
        <div class="sidebar">
            <ul>
                <li class="active"><a class="active" href="admin_home.php" class="logo">Home</a></li>
                <li><a href="admin_child.php" class="nav_links">children</a></li>
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
                <div class="wrapper">
                    <div class="container">

                        <div class="main-card">
                            <div class="cards">
                                <div class="card">
                                    <div class="content">
                                        <div class="img">
                                            <img src="assets/images/addChild.jpg" alt="" />
                                        </div>
                                        <div class="details">
                                            <div class="name"><a  href="admin_child.php" class="button instagram btn_hover"><span
                                                        class="gradient"></span>Children</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="content">
                                        <div class="img">
                                            <img src="assets/images/request.jpg" alt="" />
                                        </div>
                                        <div class="details">
                                            <div class="name"><a href="admin_appointment_requests.php" class="button instagram btn_hover"><span
                                                        class="gradient"></span>Requests</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="content">
                                        <div class="img">
                                            <img src="assets/images/booking_appointment.jpg" alt="" />
                                        </div>
                                        <div class="details">
                                            <div class="name"><a  href="admin_booking.php" class="button instagram btn_hover"><span
                                                        class="gradient"></span>booking</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="content">
                                        <div class="img">
                                            <img src="assets/images/vaccine_report.jpg" alt="" />
                                        </div>
                                        <div class="details">
                                            <div class="name"><a href="admin_vaccination_report.php" class="button instagram btn_hover"><span
                                                        class="gradient"></span>Reports</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="content">
                                        <div class="img">
                                            <img src="assets/images/reminder.png" alt="" />
                                        </div>
                                        <div class="details">
                                            <div class="name"><a href="admin_reminder.php" class="button instagram btn_hover"><span
                                                        class="gradient"></span>Reminder</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="content">
                                        <div class="img">
                                            <img src="assets/images/hospital list.jpg" alt="" />
                                        </div>
                                        <div class="details">
                                            <div class="name"><a  href="admin_hospital_list.php" class="button instagram btn_hover"><span
                                                        class="gradient"></span>Hospital list</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="content">
                                        <div class="img">
                                            <img src="assets/images/vaccine list.png" alt="" />
                                        </div>
                                        <div class="details">
                                            <div class="name"><a  href="admin_vaccine_list.php" class="button instagram btn_hover"><span
                                                        class="gradient"></span>vaccine list</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="content">
                                        <div class="img">
                                            <img src="assets/images/approve.png" alt="" />
                                        </div>
                                        <div class="details">
                                            <div class="name"><a  href="admin_approve_hospital.php" class="button instagram btn_hover"><span
                                                        class="gradient"></span>Approve</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="content">
                                        <div class="img">
                                            <img src="assets/images/feedback.jpg" alt="" />
                                        </div>
                                        <div class="details">
                                            <div class="name"><a href="admin_feedback.php" class="button instagram btn_hover"><span
                                                        class="gradient"></span>Feedback</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="content">
                                        <div class="img">
                                            <img src="assets/images/profile_detial.jpg" alt="" />
                                        </div>
                                        <div class="details">
                                            <div class="name"><a href="admin_profile.php" class="button instagram btn_hover"><span
                                                        class="gradient"></span>Profile</a></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

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
    <?php if (isset($_SESSION['message'])): ?>
        <script>
            Swal.fire({
                title: 'Notification',
                text: '<?php echo $_SESSION['message']['text']; ?>',
                icon: '<?php echo $_SESSION['message']['icon']; ?>'
            });
        </script>
    <?php unset($_SESSION['message']);
    endif; ?>
</body>

</html>