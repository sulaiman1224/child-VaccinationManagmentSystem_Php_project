<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM vaccines WHERE id ='$id'";
    $result =mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $id = $row["id"];
    $vaccines_name = $row["vaccines_name"];
    $availability=$row["availability"];
}

if (isset($_POST['update'])) {
    $vaccines_name = $_POST['vaccines_name'];
    $availability = $_POST['availability'];
   

   
    
//   empty
    if (empty($vaccines_name) || empty($availability)) {
        $_SESSION['message'] = [
            'text' => 'vaccine Name fields are required!',
            'icon' => 'error'
        ];
        header('location: admin_vaccine_list.php?id='. $id);
        exit();
    }

    // Prepare the SQL statement
    $sql = "UPDATE vaccines SET vaccines_name='$vaccines_name', upcoming_date = 'upcoming_date', availability='$availability' WHERE id = '$id'";
    $result=mysqli_query($connect, $sql);
    if ($result) {
    $_SESSION['message'] = [
            'text' => 'Vaccine updated successfully!',
            'icon' =>'success'
        ];
        header('location: admin_vaccine_list.php');
        exit();
        
    } else {
        $_SESSION['message'] = [
            'text' => 'Error updating vaccine: '. mysqli_error($connect),
            'icon' => 'error'
        ];
    }





}

$sql = "SELECT *  FROM admin";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$admin_name = $row["name"];
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update vaccine</title>
    <link rel="stylesheet" href="assets/css/admin.cs">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
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
    <!-- submit -->
    <link rel="stylesheet" href="assets/css/submit_form.css" />
    <link rel="stylesheet" href="assets/css/fresh-bootstrap-table.css">

    <style>
        .select_option {
            color: green;

            border: none;

            background-color: transparent;

            padding: 2px;

            font-size: 16px;

            border-radius: 4px;

            box-shadow: none;


        }

        .update_button {
            background-color: transparent;
            color: white;

            border: none;
            padding: 5px;
            border-radius: 4px 5px 0px 0px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .update_button:hover {
            background-color: #00c6ff;
        }
        .profile_label{
            color: black;
        }
    </style>
</head>

<body>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    <div class="admin_main">
    <div class="sidebar">
            <ul>
                <li><a href="admin_home.php" class="logo">Home</a></li>
                <li><a href="admin_child.php" class="nav_links">children</a></li>
                <li><a href="admin_appointment_requests.php" class="nav_links"> appointment requests</a></li>
                <li><a href="admin_booking.php" class="nav_links"> booking</a></li>
                <li><a href="admin_vaccination_report.php" class="nav_links">vaccination report</a></li>
                <li><a href="admin_reminder.php" class="nav_links">Reminder</a></li>
                <li><a href="admin_hospital_list.php" class="nav_links"> hospital list</a></li>
                <li class="active" ><a  class="active" href="admin_vaccine_list.php" class="nav_links">vaccine list</a></li>
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
            <div>
                <div class="container">
                    <h1 class="form-title">update vaccine</h1>
                    <form method="post">
                    <div class="main-user-info">
                            <div class="user-input-box">
                                <label for="name" class="profile_label">Vaccine name</label>
                                <input class="profile" type="text" id="name" name="vaccines_name" placeholder="Vaccine name" value="<?php echo $vaccines_name  ?>">

                            </div>
                            <div class="user-input-box">
                                <label for="availability" class="profile_label">availability</label>
                                <select name="availability" class="option" style="width:62%; margin:auto;">
                                    <option value="availability/Upcoming" selected disabled>availability/Upcoming</option>
                                    <option value="available" <?php echo ($availability == 'available') ? 'selected' : ''; ?>>available</option>
                                    <option value="not available" <?php echo ($availability == 'not available') ? 'selected' : ''; ?>>not available</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-submit-btn">
                            <input type="submit" class="submit_btn" name="update" value="update">
                        </div>
                    </form>
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