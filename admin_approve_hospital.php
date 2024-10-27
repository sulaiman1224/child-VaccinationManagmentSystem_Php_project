<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT *  FROM admin";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row["id"];
$admin_name = $row["name"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Hospital</title>
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




    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/colors.css">
    <link rel="stylesheet" href="assets/css/fresh-bootstrap-table.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <li><a href="admin_hospital_list.php" class="nav_links"> hospital list</a></li>
                <li><a href="admin_vaccine_list.php" class="nav_links">vaccine list</a></li>
                <li class="active" ><a  class="active" href="admin_approve_hospital.php" class="nav_links"> approve</a></li>
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
            <div class="container">

                <div class="tablename">approve hospital</div>
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
                                <th data-field="hospital_name" data-sortable="true">Hospital Name</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="mobile_number" data-sortable="true">mobile number</th>
                                <th data-field="pincode" data-sortable="true">pincode</th>
                                <th data-field="address" data-sortable="true">address</th>
                                <th data-field="hospital_location" data-sortable="true">hospital location</th>
                                <th data-field="status" data-sortable="true" style="color:green">status</th>
                                <th data-field="delete" data-sortable="true">update status</th>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT 
                    
                     hospitals.id,
                     add_hospital.hospital_location,
                     add_hospital.name,
                     hospitals.email,
                     hospitals.mobile_number,
                     hospitals.pincode,
                     hospitals.address,
                    hospitals.status
                 FROM 
                     hospitals
                 JOIN 
                     add_hospital
                     ON 
                     hospitals.add_hospital_id =add_hospital.id";
                                $result = mysqli_query($connect, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $hospital_name=$row['name'];
                                     $email = $row['email'];
                                     $mobile_number=$row['mobile_number'];
                                     $pincode=$row['pincode'];
                                     $address=$row['address'];
                                     $hospital_location=$row['hospital_location'];
                                     $status=$row['status']; 
                                ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $hospital_name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $mobile_number; ?></td>
                                        <td><?php echo $pincode; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td><?php echo $hospital_location; ?></td>
                                        <td style="color:  #0dab44dc;"><?php echo $status; ?></td>
                                        <td> <a href="admin_update_approve_status.php?id=<?php echo $id; ?>"> <i class="fas fa-edit"></i> </a></td>
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