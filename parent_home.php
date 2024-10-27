<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['parent_id'])) {
  header("Location: parents_login.php");
  exit();
}
// require_once 

$logged_in_parent = $_SESSION['parent_id'];
$sql = "SELECT * FROM parents WHERE id='$logged_in_parent'";
$result = mysqli_query($connect, $sql);
$parent = mysqli_fetch_assoc($result);
$login_parent = $parent['parent_name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>parent Home</title>

  <!-- color.css -->

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- bootstrap -->
  <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
  <!-- jQuery, Popper.js, and Bootstrap JS -->
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
  <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
<!-- booostrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- custom css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <!-- color.css -->
  <link rel="stylesheet" href="assets/css/colors.css">
  <link rel="stylesheet" href="assets/css/navbar.css">
 


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
      <li><a class="active" href="parent_home.php">Home</a></li>
      <li><a href="parent_add_child.php">Add Child</a></li>
      <li><a href="parent_views_child.php">Views Child</a></li>
      <li><a href="parent_booking.php">book Appointment</a></li>
      <li><a href="parent_appointment.php">Appointments</a></li>
      <li><a href="parent_vaccination_report.php">vaccination reports</a></li>
      <li><a href="parent_reminder.php">Reminder</a></li>
      <li><a href="parent_profile.php">Profile</a></li>
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

      <div class="main-card">
        <div class="cards">
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="assets/images/addChild.jpg" alt="" />
              </div>
              <div class="details">
                <div class="name"><a href="parent_add_child.php?parent" class="button instagram"><span
                      class="gradient"></span>Add
                    Child</a></div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="assets/images/viewsAddChild.jpg" alt="" />
              </div>
              <div class="details">
                <div class="name"><a href="parent_views_child.php" class="button instagram"><span
                      class="gradient"></span>View Child</a></div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="content">
              <div class="img">
                <img src="assets/images/booking_appointment.jpg" alt="" />
              </div>
              <div class="details">
                <div class="name"><a href="parent_booking.php" class="button instagram"><span
                      class="gradient"></span>booking</a></div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="assets/images/bookedAppinment.jpg" alt="" />
              </div>
              <div class="details">
                <div class="name"><a href="parent_appointment.php" class="button instagram"><span
                      class="gradient"></span>Appointment</a></div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="assets/images/vaccine_report.jpg" alt="" />
              </div>
              <div class="details">
                <div class="name"><a href="parent_vaccination_report.php" class="button instagram"><span
                      class="gradient"></span>vaccination reports</a></div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="assets/images/Reminder.jpg" alt="" />
              </div>
              <div class="details">
                <div class="name"><a href="parent_reminder.php" class="button instagram"><span
                      class="gradient"></span>Reminder</a></div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="assets/images/profile_detial.jpg" alt="" />
              </div>
              <div class="details">
                <div class="name"><a href="parent_profile.php" class="button instagram"><span
                      class="gradient"></span>Profile</a></div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>
    </div>
  </main>
  <!-- footer -->
<script src="assets/js/dropdown_parent.js"></script>
  <?php include_once('footer.php'); ?>

  <!-- using sweet alert -->
  <?php
  if (isset($_SESSION['message'])): ?>
    <script>
      Swal.fire({
        title: 'Notification',
        text: '<?php echo $_SESSION['message']['text'], $_SESSION['parent_name']; ?>',
        icon: '<?php echo $_SESSION['message']['icon']; ?>'
      });
    </script>
  <?php unset($_SESSION['message']);
  endif; ?>
  <!-- <script>
    $(document).ready(function() {
      $('.dropdown_toggle').click(function() {
        var $dropdown = $(this).next('.dropdown_btn');
        $('.dropdown_btn').not($dropdown).hide(); // Hide other dropdowns
        $dropdown.toggle(); // Toggle the clicked dropdown
      });

      $(document).click(function(e) {
        if (!$(e.target).closest('.dropdown').length) {
          $('.dropdown_btn').hide(); // Hide dropdowns when clicking outside
        }
      });
    });
  </script> -->


</body>

</html>