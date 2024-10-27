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

if (isset($_POST['request_appionment'])) {
    $parent_id = $_POST["parent_id"];
    $child_id = $_POST['child_name'];
    $vaccine_id = $_POST['vaccines_name'] ?? null;
    $hospital_id = $_POST['hospital_location'] ?? null;
    $appointment_date = $_POST['appionment_date'];
    $doctor_name = $_POST['doctor_name'] ?? '';
    $status = "pending";

    if (empty($child_id) || empty($vaccine_id) || empty($hospital_id) || empty($appointment_date)) {
        $_SESSION['message'] = [
            'text' => 'Please fill all the required fields!',
            'icon' => 'error'
        ];
        header('Location: parent_booking.php');
        exit();
    } else {
        $sql = "INSERT INTO requests (parent_id, child_id, vaccine_id, hospital_id, appointment_date, doctor_name, status) VALUES ('$parent_id', '$child_id', '$vaccine_id', '$hospital_id', '$appointment_date', '$doctor_name','$status')";

        $result = mysqli_query($connect, $sql);
        if ($result) {
            $_SESSION['message'] = [
                'text' => 'Appointment booked successfully!',
                'icon' => 'success'
            ];
            header('Location: parent_appointment.php');
            exit();
        } else {
            $_SESSION['message'] = [
                'text' => 'Failed to book appointment!',
                'icon' => 'error'
            ];
            header('Location: parent_booking.php');
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
    <title>booking</title>

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/submit_form.css" />
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <link rel="stylesheet" href="assets/css/footer.css" />
    <link rel="stylesheet" href="assets/css/colors.css">
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
      <li><a class="active" href="parent_booking.php">book Appointment</a></li>
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
        <!-- form -->
        <div class="container">
            <h1 class="form-title">Book Appointment</h1>
            <form method="post">
                <input class type="hidden" name="parent_id" value="<?php echo $_SESSION['parent_id'] ?>">
                <div class="main-user-info">
                    <div class="user-input-box">
                        <label for="child_name">Child Name</label>
                        <select name="child_name" id="child_name" class="option">
                            <option value="chose_child" selected disabled>Choose Child</option>
                            <?php

                            // Fetching child names from the database
                            $sql = "SELECT id, child_name
                            FROM children
                            WHERE parent_id = $logged_in_parent";

                            $result = mysqli_query($connect, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $child_id = $row['id'];
                                    $child_name = $row['child_name'];
                            ?>
                                    <option value="<?php echo $child_id ?> "><?php echo $child_name ?></option>

                                <?php
                                }
                            } else {
                                ?>
                                <option value='' disabled>No children found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <!-- vaccines get dynamicly -->
                    <div class="user-input-box">
                        <label for="select" class="label">Vaccines</label>
                        <select name="vaccines_name" class="option">
                            <option value="" selected disabled>Vaccines</option>
                            <?php
                            $sql = "SELECT id, vaccines_name, availability FROM vaccines";
                            $result = mysqli_query($connect, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {

                                    $vaccine_id = $row['id'];
                                    $vaccines_name = $row['vaccines_name'];
                                    $availability = $row['availability'];
                            ?>
                                    <option value="<?php echo $vaccine_id; ?>">
                                        <?php echo $vaccines_name . "-" . $availability; ?>
                                    </option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value='' disabled>No vaccines found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="user-input-box">
                        <label for="select" class="label">Hospital/Location</label>
                        <select name="hospital_location" class="option">
                        <option value="" selected disabled>Hospital/Location</option>
                        <?php
                        $sql = "SELECT
                         hospitals.id,
                         hospitals.add_hospital_id,
                         add_hospital.name,
                         hospitals.status
                         FROM
                             hospitals
                         JOIN
                             add_hospital
                         ON
                             hospitals.add_hospital_id = add_hospital.id;";
                            $result = mysqli_query($connect, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $hospital_id = $row['id'];
                                    $hospital_location = $row['name'];
                                    $status = $row['status'];
                                    if ($status == 'approved') {
                            ?>
                                        <option value="<?php echo $hospital_id; ?>">
                                            <?php echo $hospital_location; ?>
                                        </option>
                                <?php
                                    }
                                }
                            } else {
                                ?>
                                <option value='' disabled>No hospital/location found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="user-input-box">

                        <label for="doctor_name">Doctor Name (optional)</label>
                        <input type="text" id="doctor_name" name="doctor_name" placeholder="Doctor Name (optional)" />
                    </div>

                    <div class="user-input-box">
                        <label for="appionment_date">Date of Appointment</label>
                        <input type="datetime-local" id="appionment_date" name="appionment_date"
                            placeholder="Date of Appointment" />
                    </div>

                </div>

                <div class="form-submit-btn">
                    <input type="submit" value="Submit" name="request_appionment">
                </div>
            </form>
        </div>
    </main>

  <!-- footer include_once -->
    <?php include_once "footer.php";?>
    <script src="assets/js/dropdown_parent.js"></script>

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

