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
    <title>bookings</title>
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
                <li class="active"><a  class="active"href="admin_booking.php" class="nav_links"> booking</a></li>
                <li><a href="admin_vaccination_report.php" class="nav_links">vaccination report</a></li>
                <li><a href="admin_reminder.php" class="nav_links">Reminder</a></li>
                <li><a href="admin_hospital_list.php" class="nav_links"> hospital list</a></li>
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
            <div class="container">

                <div class="tablename">Book appointment</div>
                <div class="wrapper">
                    <!--   Creative Tim Branding   -->

                    <div class="fresh-table full-color-orange ">
                        
                <table id="fresh-table" class="table">
                    <thead>

                         <th data-field="id">ID</th> 
                        <th data-field="child_name" data-sortable="true">Child Name</th>
                        <th data-field="age" data-sortable="true">Age</th>
                        <th data-field="gender" data-sortable="true">gender</th>
                        <th data-field="vaccine" data-sortable="true">vaccine name</th>
                        <th data-field="date_of_appionment" data-sortable="true">date of appionment</th>
                        <th data-field="doctor_name" data-sortable="true">Doctor name</th>
                        <th data-field="hospital_name" data-sortable="true">hospital name</th>
                        <th data-field="hospital_location" data-sortable="true">hospital location</th>
                        <th data-field="mobile_number" data-sortable="true">mobile number</th>
                        <th data-field="status" data-sortable="true">status</th>
                        <th data-field="update" data-sortable="true">update</th>
                    
                    </thead>
                    <tbody>

                        <?php
                        // Fetch data from database using
                        $sql = " SELECT
                          appointments.id AS appointment_id,
                          appointments.status AS appointment_status,
                          requests.appointment_date,
                          requests.status AS requests_status,
                          requests.doctor_name,
                          parents.mobile_number,
                          add_hospital.name AS hospital_name,
                          add_hospital.hospital_location AS hospital_location,
                          vaccines.vaccines_name,
                          children.child_name,
                          children.age,
                          children.gender
                        FROM 
                            appointments
                        JOIN requests ON appointments.request_id = requests.id
                        JOIN parents ON requests.parent_id = parents.id
                        JOIN hospitals ON requests.hospital_id = hospitals.id
                        JOIN add_hospital ON hospitals.add_hospital_id = add_hospital.id
                        JOIN children ON requests.child_id = children.id
                        JOIN vaccines ON requests.vaccine_id = vaccines.id";

                        $result = mysqli_query($connect, $sql);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($connect));
                        }

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $id = $row['appointment_id'];
                                $child_name = $row['child_name'];
                                $age = $row['age'];
                                $gender = $row['gender'];
                                $status = $row['appointment_status'];
                                $vaccine = $row['vaccines_name'];
                                $mobile_number = $row['mobile_number'];
                                $appointment_date = $row['appointment_date'];
                                $doctor_name = $row['doctor_name'];
                                $requests_status= $row['requests_status'];
                                $hospital_name = $row['hospital_name'];
                                $hospital_location = $row['hospital_location'];
                                if($requests_status=='approved'){
                        ?>
                                <tr>
                                    
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $child_name; ?></td>
                                    <td><?php echo $age; ?></td>
                                    <td><?php echo $gender; ?></td>
                                    <td><?php echo $vaccine; ?></td>
                                    <td><?php echo $appointment_date; ?></td>
                                    <td><?php echo $doctor_name; ?></td>
                                    <td><?php echo $hospital_name; ?></td>
                                    <td><?php echo $hospital_location; ?></td>  
                                    <td><?php echo $mobile_number; ?></td>
                                    <td style="color:  #0dab44dc;"><?php echo $status; ?></td>
                                    <td> <a href="admin_update_booking_status.php?id=<?php echo $id; ?>"> <i class="fas fa-edit"></i> </a></td>
                                 
                                </tr>
                        <?php
                        }
                            }
                        } else {
                            echo "<tr><td colspan='9'>No records found</td></tr>";
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

