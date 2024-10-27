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
$parent_name = $parent['parent_name'];

if (isset($_POST['add_child'])) {

  $child_name = $_POST['child_name'];
  $age = $_POST['age'];
  $date_of_birth = $_POST['date_of_birth'];
  $gender = isset($_POST['gender']) ? $_POST['gender'] : null;  // Check if set
  $weight_kg = $_POST['weight_kg'];
  $height_cm = $_POST['height_cm'];
  $blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : null;  // Check if set
  $parent_id = $_POST['parent_id'];

  // Validate empty fields
  if (
    empty($child_name) || empty($age) || empty($date_of_birth) || empty($gender) ||
    empty($weight_kg) || empty($height_cm)|| empty($blood_group)
  ) {
    $_SESSION['message'] = [
      'text' => 'All fields are required.',
      'icon' => 'warning'
    ];
    header('Location: parent_add_child.php');
    exit();
  }

  // Validate child_name
  elseif (!preg_match("/^[a-zA-Z\s]+$/", $child_name)) {
    $_SESSION['message'] = [
      'text' => 'Child name should only contain letters and spaces.',
      'icon' => 'warning'
    ];
    header('Location: parent_add_child.php');
    exit();
  }

  // Validate age (Minimum Age 0 and Maximum Age 18)
  elseif ($age < 0 || $age > 18) {
    $_SESSION['message'] = [
      'text' => 'Invalid age. Age should be between 0 and 18.',
      'icon' => 'warning'
    ];
    header('Location: parent_add_child.php');
    exit();
  } elseif (!preg_match("/^\d+$/", $age)) {
    $_SESSION['message'] = [
      'text' => 'Age should be a number.',
      'icon' => 'warning'
    ];
    header('Location: parent_add_child.php');
    exit();
  }

  // Validate date of birth (between 2 months and 18 years)
  elseif (date('Y-m-d', strtotime('-2 months')) > $date_of_birth || date('Y-m-d', strtotime('+18 years')) < $date_of_birth) {
    $_SESSION['message'] = [
      'text' => 'Invalid date of birth. Age should be between 2 months and 18 years.',
      'icon' => 'warning'
    ];
    header('Location: parent_add_child.php');
    exit();
  } {
    // If all validations pass, data inserted into the database
    $sql = "INSERT INTO children (child_name, parent_id, age, date_of_birth, gender, 
    weight_kg, height_cm, blood_group) 
    VALUES 
    ('$child_name', '$parent_id', '$age', '$date_of_birth', '$gender', '$weight_kg',
     '$height_cm', '$blood_group')";

    $result = mysqli_query($connect, $sql);

    if ($result) {
      $_SESSION['message'] = [
        'text' => 'Child added successfully.',
        'icon' => 'success'
      ];
      header('Location: parent_views_child.php');
      exit();
    } else {
      $_SESSION['message'] = [
        'text' => 'Error adding child: ' . mysqli_error($connect),
        'icon' => 'error'
      ];
      header('Location: parent_add_child.php');
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Child</title>

  <!-- Font Awesome -->
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- bootstrap -->
  <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
  <!-- jQuery, Popper.js, and Bootstrap JS -->
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
  <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
  <!-- custom css -->
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/colors.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/submit_form.css" />
  <link rel="stylesheet" href="assets/css/navbar.css" />
  <link rel="stylesheet" href="assets/css/footer.css" />

  <!-- SweetAlert2 -->
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
      <li><a  href="parent_home.php">Home</a></li>
      <li><a class="active" href="parent_add_child.php">Add Child</a></li>
      <li><a href="parent_views_child.php">Views Child</a></li>
      <li><a href="parent_booking.php">book Appointment</a></li>
      <li><a href="parent_appointment.php">Appointments</a></li>
      <li><a href="parent_vaccination_report.php">vaccination reports</a></li>
      <li><a href="parent_reminder.php">Reminder</a></li>
      <li><a href="parent_profile.php">Profile</a></li>
      <li>
        <div class="dropdown">
          <button class="dropdown_toggle user_name" type="button">
            <?php echo $parent_name; ?>
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
      <h1 class="form-title">Child Info</h1>
      <form method="post">
        <input class type="hidden" name="parent_id" value="<?php echo $_SESSION['parent_id'] ?>">
        <div class="main-user-info">
          <div class="user-input-box">
            <label for="child_name">Child Name</label>
            <input type="text" id="child_name" name="child_name" placeholder="Child Name" />
          </div>
          <div class="user-input-box">
            <label for="age">Age</label>
            <input type="number" id="age" name="age" placeholder="Age" />
          </div>
          <div class="user-input-box">
            <label for="weight_kg">weight kg</label>
            <input type="number" id="weight_kg" name="weight_kg" placeholder="Weight kg" />
          </div>
          <div class="user-input-box">

            <label for="height_cm">height cm</label>
            <input type="number" id="height_cm" name="height_cm" placeholder="height cm" />
          </div>
          <div class="user-input-box">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth" />
          </div>
          <div class="user-input-box">
            <label for="blood_group">blood group</label>
            <select name="blood_group" class="option">
              <option value="blood_group" selected disabled>Blood Group</option>
              <option value="A+ve">A+ve</option>
              <option value="B+ve">B+ve</option>
              <option value="O+ve">O+ve</option>
              <option value="AB+ve">AB+ve</option>
              <option value="A-ve">A-ve</option>
              <option value="B-ve">B-ve</option>
              <option value="O-ve">O-ve</option>
              <option value="AB-ve">AB-ve</option>

            </select>
          </div>
          <div class="user-input-box">
            <label for="gender">Gender</label>
            <select name="gender" class="option">
              <option value="gender" selected disabled>Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>

        </div>

        <div class="form-submit-btn">
          <input type="submit" value="Submit" name="add_child">
        </div>
      </form>
    </div>
  </main>
  <script src="assets/js/dropdown_parent.js"></script>
  <!-- footer start -->
   <?php include_once('footer.php'); ?>

  <?php
  if (isset($_SESSION['message'])): ?>
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

