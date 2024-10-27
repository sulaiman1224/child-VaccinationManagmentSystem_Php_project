<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['parent_id'])) {
  header("Location: parents_login.php");
  exit();
}

// login user
$logged_in_parent = $_SESSION['parent_id'];
$sql = "SELECT * FROM parents WHERE id='$logged_in_parent'";
$result = mysqli_query($connect, $sql);
$parent = mysqli_fetch_assoc($result);
$login_parent = $parent['parent_name'];

?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Child info</title>

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

  <!-- taable css -->
  <link rel="stylesheet" href="assets/css/fresh-bootstrap-table.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/navbar.css">
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
  <!-- Main Content -->
  <main>
    <div class="tablename">View Child Details</div>
    <div class="wrapper">
      <!--   Creative Tim Branding   -->

      <div class="fresh-table full-color-orange">

        <table id="fresh-table" class="table">
          <thead>
            <th data-field="id">ID</th>
            <th data-field="parent_name" data-sortable="true">Parent Name</th>
            <th data-field="child_name" data-sortable="true">Child Name</th>
            <th data-field="age" data-sortable="true">Age</th>
            <th data-field="gender" data-sortable="true">Gender</th>
            <th data-field="dob" data-sortable="true">Date of Birth</th>
            <th data-field="blood_group" data-sortable="true">Blood Group</th>
            <th data-field="weight" data-sortable="true">Weight (kg)</th>
            <th data-field="height" data-sortable="true">Height (cm)</th>
            <th data-field="update" data-sortable="true">Update</th>
          </thead>
          <tbody>
            <?php
            // Query to select only children belonging to the logged-in parent
            $sql = "SELECT 
                                    children.id, 
                                    parents.parent_name, 
                                    children.child_name, 
                                    children.age, 
                                    children.date_of_birth, 
                                    children.gender, 
                                    children.weight_kg, 
                                    children.height_cm, 
                                    children.blood_group
                                FROM 
                                    children
                                JOIN 
                                    parents 
                                ON 
                                    children.parent_id = parents.id
                                WHERE 
                                    parents.id = $logged_in_parent";

            $result = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              $child_id = $row['id'];
              $parent_name = $row['parent_name'];
              $child_name = $row['child_name'];
              $age = $row['age'];
              $dob = $row['date_of_birth'];
              $gender = $row['gender'];
              $weight_kg = $row['weight_kg'];
              $height_cm = $row['height_cm'];

              $blood_group = $row['blood_group'];
            ?>
              <tr>
                <td><?php echo $child_id; ?></td>
                <td><?php echo $parent_name; ?></td>
                <td><?php echo $child_name; ?></td>
                <td><?php echo $age; ?></td>
                <td><?php echo $gender; ?></td>
                <td><?php echo $dob; ?></td>
                <td><?php echo $blood_group; ?></td>
                <td><?php echo $weight_kg; ?></td>
                <td><?php echo $height_cm; ?></td>

                <td> <a href="parent_child_detail_update.php?id=<?php echo $child_id; ?>"> <i class="fas fa-edit"></i> </a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- footer include_once -->
  <?php include_once 'footer.php'; ?>
  <!-- end of footer -->
  <script src="assets/js/dropdown_parent.js"></script>

  <!-- Sweet Alert Notification -->
  <?php if (isset($_SESSION['message'])): ?>
    <script>
      Swal.fire({
        title: 'Notification',
        text: '<?php echo $_SESSION['message']['text']; ?>',
        icon: '<?php echo $_SESSION['message']['icon']; ?>'
      });
    </script>
    <?php unset($_SESSION['message']); ?>
  <?php endif; ?>
  <script src="assets/js/table.js"></script>

</body>

</html>