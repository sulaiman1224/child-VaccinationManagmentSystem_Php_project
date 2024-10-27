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

// Fetch the child details 
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM children WHERE id = $id";
  $result = mysqli_query($connect, $query);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $child_id = $row['id'];
    $child_name = $row['child_name'];
    $age = $row['age'];
    $date_of_birth = $row['date_of_birth'];
    $gender = $row['gender'];
    $weight_kg = $row['weight_kg'];
    $height_cm = $row['height_cm'];

    $blood_group = $row['blood_group'];
  } else {
    header('Location: parent_views_child.php');
    exit();
  }
}

// If form is submitted to update
if (isset($_POST['update_child'])) {
  $child_name = $_POST['child_name'];
  $age = $_POST['age'];
  $date_of_birth = $_POST['date_of_birth'];
  $gender = $_POST['gender'];
  $weight_kg = $_POST['weight_kg'];
  $height_cm = $_POST['height_cm'];

  $blood_group = $_POST['blood_group'];

  // Validate inputs
  if (
    empty($child_name) || empty($age) || empty($date_of_birth) || empty($gender) ||
    empty($weight_kg) || empty($height_cm) || empty($blood_group)
  ) {
    $_SESSION['message'] = [
      'text' => 'All fields are required.',
      'icon' => 'warning'
    ];
    header('Location: parent_child_detail_update.php?id=' . $id);
    exit();
  } elseif (!preg_match("/^[a-zA-Z\s]+$/", $child_name)) {
    $_SESSION['message'] = [
      'text' => 'Child name should only contain letters and spaces.',
      'icon' => 'warning'
    ];
    header('Location: parent_child_detail_update.php?id=' . $id);
    exit();
  } elseif ($age < 0 || $age > 14 || !preg_match("/^\d+$/", $age)) {
    $_SESSION['message'] = [
      'text' => 'Invalid age. Age should be a number between 0 and 14.',
      'icon' => 'warning'
    ];
    header('Location: parent_child_detail_update.php?id=' . $id);
    exit();
  } elseif (date('Y-m-d', strtotime('-2 months')) > $date_of_birth || date('Y-m-d', strtotime('+18 years')) < $date_of_birth) {
    $_SESSION['message'] = [
      'text' => 'Invalid date of birth. Age should be between 2 months and 18 years.',
      'icon' => 'warning'
    ];
    header('Location: parent_child_detail_update.php?id=' . $id);
    exit();
  } else {
    // Update child details in the database
    $sql = "UPDATE children SET child_name='$child_name', age='$age', date_of_birth='$date_of_birth', gender='$gender', weight_kg='$weight_kg', height_cm='$height_cm', blood_group='$blood_group' WHERE id=$id";
    $result = mysqli_query($connect, $sql);
    if ($result) {
      $_SESSION['message'] = [
        'text' => 'Child information updated successfully!',
        'icon' => 'success'
      ];
      header('Location: parent_views_child.php');
      exit();
    } else {
      $_SESSION['message'] = [
        'text' => 'Failed to update child information.',
        'icon' => 'error'
      ];
      header('Location: parent_child_detail_update.php?id=' . $id);
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
  <title>update Child Info</title>

  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/form.css" />
  <link rel="stylesheet" href="assets/css/navbar.css" />
  <link rel="stylesheet" href="assets/css/footer.css" />
  <link rel="stylesheet" href="assets/css/colors.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>
<!-- link sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
      <li><a class="active" href="parent_views_child.php">Views Child</a></li>
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
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
      <div class="wrapper wrapper--w680">
        <div class="card card-4">
          <div class="card-body">
            <h2 class="title">update Child Info</h2>
            <form method="POST">

              <div class="row row-space">
                <div class="col-2">
                  <div class="input-group">
                  <label for="name" class="lable_update">name</label>
                    <input class="input--style-4" id="name" type="text" name="child_name" placeholder="Child name" value="<?php echo   $child_name; ?>">
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group">
                  <label for="age" class="lable_update">age</label>
                    <input class="input--style-4" type="number" id="age" name="age" placeholder="Age" value="<?php echo $age; ?>">
                  </div>
                </div>
              </div>
              <div class="row row-space">
                <div class="col-2">
                  <div class="input-group">
                  <label for="weight_kg" class="lable_update">Weight kg</label>
                    <input class="input--style-4" type="text" id="weight_kg" name="weight_kg" placeholder="Weight kg" value="<?php echo   $weight_kg; ?>">
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group">
                  <label for="height_cm" class="lable_update">height cm</label>
                    <input class="input--style-4" type="text" id="height_cm" name="height_cm" placeholder="Height Cm" value="<?php echo   $height_cm; ?>">
                  </div>
                </div>
              </div>
              <div class="row row-space">
                          <div class="col-2">
                <div class="input-group">
                <label for="date" class="lable_update">Date of birth</label>
                  <input type="date" class="input--style-4" name="date_of_birth" id="date" placeholder="Date of Birth" value="<?php echo date('Y-m-d', strtotime($date_of_birth)); ?>">
                </div>
              </div>
                <div class="col-2">
                  <div class="input-group">
                    <div class="box">
                    <label for="gender" class="lable_update">gender</label>
                      <select name="gender" class="input--style-4" id="gender">
                        <option value="gender" selected disabled>Gender</option>
                        <option value="male" <?php echo ($gender == 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo ($gender == 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value="other" <?php echo ($gender == 'other') ? 'selected' : ''; ?>>Other</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group">
                    <div class="box">
                    <label for="blood_group" class="lable_update">blood group</label>
                      <select name="blood_group" class="input--style-4" id="blood_group">
                      
                        <option value="blood_group" selected disabled>Blood Group</option>
                        <option value="A+ve" <?php echo ($blood_group == 'A+ve') ? 'selected' : ''; ?>>A+ve</option>
                        <option value="B+ve" <?php echo ($blood_group == 'B+ve') ? 'selected' : ''; ?>>B+ve</option>
                        <option value="O+ve" <?php echo ($blood_group == 'O+ve') ? 'selected' : ''; ?>>O+ve</option>
                        <option value="AB+ve" <?php echo ($blood_group == 'AB+ve') ? 'selected' : ''; ?>>AB+ve</option>
                        <option value="A-ve" <?php echo ($blood_group == 'A-ve') ? 'selected' : ''; ?>>A-ve</option>
                        <option value="B-ve" <?php echo ($blood_group == 'B-ve') ? 'selected' : ''; ?>>B-ve</option>
                        <option value="O-ve" <?php echo ($blood_group == 'O-ve') ? 'selected' : ''; ?>>O-ve</option>
                        <option value="AB-ve" <?php echo ($blood_group == 'AB-ve') ? 'selected' : ''; ?>>AB-ve</option>
                      </select>
                    </div>

                  </div>
                </div>

              </div>
              <div class="col-2" style="margin:auto">
                <div class="input-group form-submit-btn">
                  <input type="submit" value="Update" name="update_child" >
                </div>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    </div>
  </main>

  <?php include_once('footer.php');  ?>
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