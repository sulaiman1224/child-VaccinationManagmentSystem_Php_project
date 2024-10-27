<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['parent_id'])) {
  header("Location: parents_login.php");
  exit();
}

$logged_in_parent = $_SESSION['parent_id'];
 $sql = "SELECT * FROM parents WHERE id='$logged_in_parent'";
 $result = mysqli_query($connect, $sql);
 $parent = mysqli_fetch_assoc($result);
 $login_parent = $parent['parent_name'];

// Fetch profile information
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM parents WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $parent_id = $row["id"];
        $parent_name = $row['parent_name'];
        $email = $row['email'];
        $password = $row['password'];
        $mobile_number = $row['mobile_number'];
        $gender = $row['gender'];
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}

// Update profile
if (isset($_POST['update'])) {
    $parent_name = $_POST['parent_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile_number = $_POST['mobile_number'];
    $gender = $_POST['gender'];

    
    if (isset($parent_id)) {
        $sql = "UPDATE parents SET parent_name='$parent_name', email='$email', password='$password', mobile_number='$mobile_number', gender='$gender' WHERE id=$parent_id";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            $_SESSION['message'] = ['text' => 'Profile updated successfully!', 'icon' =>'success'];
            header('location: parent_profile.php');
            exit();
        } else {
            $_SESSION['message'] = ['text' => 'Error updating profile!', 'icon' => 'error'];
            echo "Error updating record: " . mysqli_error($connect);
            header('location: parent_update_profile.php');
            exit();
        }
    } else {
        echo "Parent ID not set.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <link rel="stylesheet" href="assets/css/submit_form.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/colors.css">
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
            <li><a href="parent_home.php">Home</a></li>
            <li><a href="parent_add_child.php">Add Child</a></li>
            <li><a href="parent_views_child.php">Views Child</a></li>
            <li><a href="parent_reminder.php">Reminder</a></li>
            <li><a href="parent_booking.php">book Appointment</a></li>
            <li><a href="parent_appointment.php">Appointments</a></li>
            <li><a class="active" href="parent_profile.php">Profile</a></li>
            <li>
                <div class="dropdown">
                    <button class="btn btn-sm dropdown-toggle user_name" type="button" id="smallDropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $login_parent ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-1" aria-labelledby="smallDropdownMenuButton">
                    <a href="parent_logout.php" class="dropdown-item small">Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <!-- navbar end -->
    <!-- header -->
    <header class="header bg-blue">
        <div class="banner_image">
            <img class="image" src="assets/images/Vaccination-Schedule-bannerBg.png">
        </div>
    </header>
    <!-- end of header -->
    <!-- main -->
    <main>
        <div class="container">
            <h1 class="form-title">Profile</h1>
            <form method="post">
                <div class="main-user-info">
                    <div class="user-input-box">
                        <label for="parent_name" class="profile_label">Name</label>
                        <input class="profile" type="text" id="parent_name" name="parent_name" value="<?php echo htmlspecialchars($parent_name); ?>">
                    </div>
                    <div class="user-input-box">
                        <label for="email" class="profile_label">Email</label>
                        <input class="profile" type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <div class="user-input-box">
                        <label for="password" class="profile_label">Password</label>
                        <input class="profile" type="text" name="password" value="<?php echo htmlspecialchars($password); ?>">
                    </div>
                    <div class="user-input-box">
                        <label for="mobile_number" class="profile_label">Mobile Number</label>
                        <input class="profile" type="number" id="mobile_number" name="mobile_number" value="<?php echo htmlspecialchars($mobile_number); ?>">
                    </div>
                    <div class="user-input-box">
                        <label for="gender" class="profile_label">Gender</label>
                        <input class="profile" id="gender" name="gender" value="<?php echo htmlspecialchars($gender); ?>">
                    </div>
                </div>
                <div class="form-submit-btn">
                    <input type="submit" class="submit_btn" name="update" value="Update">
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="footer">
            <div class="row">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
            </div>
            <div class="row">
                <ul>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Career</a></li>
                </ul>
            </div>
            <div class="row">
                INFERNO Copyright © 2021 Inferno - All rights reserved || Designed By: Mahesh
            </div>
        </div>
    </footer>
</body>
</html>

