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

// profile information

$sql = "SELECT * FROM parents WHERE id = $logged_in_parent";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0) {
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>

    <link rel="stylesheet" href="assets/css/submit_form.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <!-- color.css -->
    <link rel="stylesheet" href="assets/css/colors.css">
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     
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
      <li><a  href="parent_views_child.php">Views Child</a></li>
      <li><a href="parent_booking.php">book Appointment</a></li>
      <li><a href="parent_appointment.php">Appointments</a></li>
      <li><a href="parent_vaccination_report.php">vaccination reports</a></li>
      <li><a href="parent_reminder.php">Reminder</a></li>
      <li><a class="active" href="parent_profile.php">Profile</a></li>
      <li>
        <div class="dropdown">
          <button class="dropdown_toggle user_name" type="button">
            <?php echo $login_parent; ?>
          </button>
          <div class="dropdown_btn user_name">
            <a href="parent_logout.php" class="logout">Logout</a>
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
                        <label for="name" class="profile_label">Name</label>
                        <p class="profile" id="name"><?php echo $parent_name ?></p>
                    </div>
                    <div class="user-input-box">
                        <label for="email" class="profile_label">email</label>
                        <p class="profile" id="email"><?php echo $email ?></p>
                    </div>
                    <div class="user-input-box">
                        <label for="password" class="profile_label">password</label>
                        <p class="profile" name="password"><?php echo $password ?></p>
                    </div>
                    <div class="user-input-box">
                        <label for="mobile_number" class="profile_label">mobile number</label>
                        <p class="profile" id="mobile_number" name="mobile_number"><?php echo $mobile_number ?></p>
                    </div>
                    <div class="user-input-box">
                        <label for="gender" class="profile_label">gender</label>
                        <p class="profile" id="gender" name="gender"><?php echo $gender ?></p>
                    </div>
                </div>

                <div class="form-submit-btn">
                    <a  class="update_btn " href="parent_update_profile.php?id=<?php echo $parent_id; ?>">update profile </>
                </div>
            </form>
        </div>
    </main>
<!-- footer include -->
 <?php include 'footer.php';?>
 <script src="assets/js/dropdown_parent.js"></script>

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

