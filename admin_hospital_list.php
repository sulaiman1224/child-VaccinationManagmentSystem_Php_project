<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $hospital_location = $_POST['hospital_location'];

    if (empty($hospital_location)) {
        $_SESSION['message'] = [
            'text' => 'All fields are required!',
            'icon' => 'warning'
        ];
        header('location: admin_hospital_list.php');
        exit();
    }



    $sql = "SELECT * FROM add_hospital WHERE name='$name'  AND hospital_location = '$hospital_location' ";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {

        $_SESSION['message'] = [
            'text' => 'Hospital already exists!',
            'icon' => 'error'
        ];
        header('location: admin_hospital_list.php');
        exit();
    }
    // empty fields validation
    elseif (empty($hospital_location)) {
        $_SESSION['message'] = [
            'text' => 'Hospital location is required!',
            'icon' => 'warning'
        ];
        header('location: admin_hospital_list.php');
        exit();
    } else {
        // Insert the hospital
        $sql = "INSERT INTO add_hospital (name,hospital_location) VALUES ('$name','$hospital_location')";
        if (mysqli_query($connect, $sql)) {

            $_SESSION['message'] = [
                'text' => 'Hospital added successfully!',
                'icon' => 'success'
            ];
            header('location: admin_hospital_list.php');
            exit();
        } else {
            // Failed insertion
            $_SESSION['message'] = [
                'text' => 'Failed to add hospital!',
                'icon' => 'error'
            ];
            header('location: admin_hospital_list.php');
            exit();
        }
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
    <title>Hospital list</title>
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
    <link rel="stylesheet" href="assets/css/admin.css">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/colors.css">
    <!-- submit -->
    <link rel="stylesheet" href="assets/css/submit_form.css" />
    <link rel="stylesheet" href="assets/css/fresh-bootstrap-table.css">
    <link rel="stylesheet" href="assets/css/admin.css">

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
                <li class="active"><a class="active" href="admin_hospital_list.php" class="nav_links"> hospital list</a></li>
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
            <div>
                <div class="container">
                    <h1 class="form-title">Add hospital</h1>
                    <form method="post">
                        <div class="main-user-info">
                        <div class="user-input-box">
                                <label for="name" class="profile_label">hospital name</label>
                                <input class="profile" type="text" id="name" name="name" placeholder="hospital Name">
                               
                            </div>
                            <div class="user-input-box">
                                <label for="hospital_location" class="profile_label">hospital/location</label>
                                <input class="profile" type="text" id="hospital_location" name="hospital_location" placeholder="hospital/location">
                            </div>
                        </div>
                        <div class="form-submit-btn">
                            <input type="submit" class="submit_btn" name="add" value="Add">
                        </div>
                    </form>
                </div>
            </div>
            <div class="containerf">

                <div class="wrapper">
                    <!--   Creative Tim Branding   -->

                    <div class="fresh-table full-color-orange ">
                        <!--
             Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
             Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
             -->

                        <table id="fresh-table" class="table">
                            <thead>
                                <th data-field="id">ID</th>
                                <th data-field="name" data-sortable="true">name</th>
                                <th data-field="hospital_location" data-sortable="true">hospital/location</th>
                                <th data-field="update" data-sortable="true">update</th>
                                <th data-field="delete" data-sortable="true">delete</th>
                            </thead>
                            <tbody>
                                <?php
                                // fetch data
                                $sql = "SELECT * FROM add_hospital";
                                $result = mysqli_query($connect, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row["id"];
                                    $name = $row["name"];
                                    $hospital_location = $row["hospital_location"];
                                ?>
                                    <tr>
                                        <td><?php echo $id  ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $hospital_location  ?></td>
                                        <!-- updatebtn -->
                                        <td> <a href="admin_update_hospital.php?id=<?php echo $id; ?>"> <i class="fas fa-edit"></i> </a></td>
                                        <td> <a href="admin_delete_hospital.php?id=<?php echo $id; ?>"> <i class="fas fa-trash"></i> </a></td>


                                        <!-- deletebtn -->


                                    </tr>


                                <?php
                                }



                                ?>

                            </tbody>
                        </table>
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