<?php
session_start();
require_once("config.php");
$logged_in_hospital =  $_SESSION['hospital_id'];
if (!isset($_SESSION['hospital_id'])) {
    header("Location: hospital_login.php");
    exit();
}

$sql = "SELECT 
                    
                     hospitals.id,
                     add_hospital.name
                 FROM 
                     hospitals
                 JOIN 
                     add_hospital
                     ON 
                     hospitals.add_hospital_id =add_hospital.id
                     where
                     hospitals.id = '$logged_in_hospital'";

$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hospital_id = $row['id'];
    $hospital_name = $row['name'];
    $_SESSION['hospital_id'] = $hospital_id;
    $_SESSION['hospital_name'] = $hospital_name;
    $login_hospital_name = $_SESSION['hospital_name'];
} else {
    echo "Error: Unable to fetch hospital details. Please try again later.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- color.css -->

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- bootstrap -->
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/colors.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <!-- color.css -->


    <style>

    </style>
</head>


<body>

    <!-- navbar start -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo"> <img src="assets/images/logo.png" style="width: 100px;height:100px" alt=""></label>
        <ul>
            <li><a class="active" href="hospital_home.php">Home</a></li>
            <li><a href="hospital_appionments.php">Appointments</a></li>
            <li><a href="hospital_vaccine_report.php">vaccination report</a></li>
            <div class="dropdown">
                <button class="dropdown_toggle user_name" type="button">
                    <?php echo   $_SESSION['hospital_name'] ?>
                </button>
                <div class="dropdown_btn user_name">
                    <a href="hospital_logout.php" class="logout">Logout</a>
                </div>
            </div>
            </li>
        </ul>


    </nav>

    <!-- navbar end -->
    <!-- header -->
    <header class="header bg-blue">
        <div class="banner_image">
            <img class="hospital_image" src="assets/images/hospital_banner.jpg">
        </div>
    </header>
    <!-- end of header -->
    <!-- main -->
    <main>
        <div class="container">

            <div class="main-card">
                <div class="cards" style="justify-content: space-evenly;">
                    <div class="card">
                        <div class="content">
                            <div class="img">
                                <img src="assets/images/appointments.jpg" alt="" />
                            </div>
                            <div class="details">
                                <div class="name"><a href="hospital_appionments.php" class="button instagram"><span
                                            class="gradient"></span>appionments</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content">
                            <div class="img">
                                <img src="assets/images/vaccine_report.jpg" alt="" />
                            </div>
                            <div class="details">
                                <div class="name"><a href="hospital_vaccine_report.php" class="button instagram"><span
                                            class="gradient"></span>vaccine report</a></div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>
        </div>
    </main>
    <!-- include footer -->
    <?php require_once("footer.php"); ?>
    <!-- end of footer -->
    <script src="assets/js/dropdown_parent.js"></script>
    <!-- using sweet alert -->
    <?php if (isset($_SESSION['message'])): ?>
        <script>
            Swal.fire({
                title: 'Notification',
                text: '<?php echo $_SESSION['message']['text'], $_SESSION['hospital_name']; ?>',
                icon: '<?php echo $_SESSION['message']['icon']; ?>'
            });
        </script>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>




</body>

</html>