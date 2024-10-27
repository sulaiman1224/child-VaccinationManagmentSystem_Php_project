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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>appointmnets</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Open Graph data -->
    <meta property="og:title" content="Fresh Bootstrap Table by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://wenzhixin.github.io/fresh-bootstrap-table/full-screen-table.html" />
    <meta property="og:image"
        content="http://s3.amazonaws.com/creativetim_bucket/products/31/original/opt_fbt_thumbnail.jpg" />
    <meta property="og:description"
        content="Probably the most beautiful and complex bootstrap table you've ever seen on the internet, this bootstrap table is one of the essential plugins you will need." />
    <meta property="og:site_name" content="Creative Tim" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--   Fonts and icons   -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.js"></script>
    <!-- link sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="assets/css/colors.css">

    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/colors.css">
    <!-- navabar -->
    <link rel="stylesheet" href="assets/css/navbar.css">
    <!-- footer -->
    <link rel="stylesheet" href="assets/css/footer.css">

    

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
      <li><a href="parent_views_child.php">Views Child</a></li>
      <li><a href="parent_booking.php">book Appointment</a></li>
      <li><a class="active" href="parent_appointment.php">Appointments</a></li>
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

    <main>
        <div class="tablename">appionments</div>
        <div class="wrapper">
            <!--   Creative Tim Branding   -->

            <div class="fresh-table full-color-orange ">

                <table id="fresh-table" class="table">
                    <thead>

                        <!-- <th data-field="id">ID</th> -->
                        <th data-field="child_name" data-sortable="true">Child Name</th>
                        <th data-field="age" data-sortable="true">Age</th>
                        <th data-field="gender" data-sortable="true">gender</th>
                        <th data-field="vaccine" data-sortable="true">vaccine name</th>
                        <th data-field="availability" data-sortable="true">vaccine availability</th>
                        <th data-field="date_of_appionment" data-sortable="true">date of appionment</th>
                        <th data-field="doctor_name" data-sortable="true">Doctor name</th>
                        <th data-field="hospital_name" data-sortable="true">hospital name</th>
                        <th data-field="hospital_location" data-sortable="true">hospital location</th>
                        <th data-field="mobile_number" data-sortable="true">mobile number</th>
                        <th data-field="status" data-sortable="true">status</th>
                    </thead>
                    <tbody>

                        <?php
                        // Fetch data from database using
                        $sql = "
                                    select
                                    requests.id,
                                    requests.status,
                                    requests.appointment_date,
                                    requests.doctor_name,
                                    parents.mobile_number,
                                    add_hospital.name as hospital_name,
                                    add_hospital.hospital_location,
                                    vaccines.vaccines_name,
                                    vaccines.availability,
                                    children.child_name,
                                    children.age,
                                    children.gender

                                    from 
                                    requests
                                    join
                                    hospitals
                                    on
                                    requests.hospital_id=hospitals.id
                                    join
                                    add_hospital
                                    on
                                    hospitals.add_hospital_id=add_hospital.id
                                    JOIN 
                                    vaccines 
                                    ON 
                                    requests.vaccine_id = vaccines.id
                                    JOIN 
                                    children 
                                    ON 
                                    requests.child_id = children.id 
                                    join
                                    parents
                                    on
                                    requests.parent_id =parents.id
                                    where
                                    requests.parent_id = '$logged_in_parent'
                                    ";

                        $result = mysqli_query($connect, $sql);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($connect));
                        }

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $child_name = htmlspecialchars($row['child_name']);
                                $age = htmlspecialchars($row['age']);
                                $gender = htmlspecialchars($row['gender']);
                                $status = htmlspecialchars($row['status']);
                                $vaccine = htmlspecialchars($row['vaccines_name']);
                                $availability = htmlspecialchars($row['availability']);
                                $mobile_number = htmlspecialchars($row['mobile_number']);
                                $appointment_date = htmlspecialchars($row['appointment_date']);
                                $doctor_name = htmlspecialchars($row['doctor_name']);
                                $hospital_name = htmlspecialchars($row['hospital_name']);
                                $hospital_location = htmlspecialchars($row['hospital_location']);
                        ?>
                                <tr>
                                    <td><?php echo $child_name; ?></td>
                                    <td><?php echo $age; ?></td>
                                    <td><?php echo $gender; ?></td>
                                    <td><?php echo $vaccine; ?></td>
                                    <td><?php echo $availability; ?></td>
                                    <td><?php echo $appointment_date; ?></td>
                                    <td><?php echo $doctor_name; ?></td>
                                    <td><?php echo $hospital_name; ?></td>
                                    <td><?php echo $hospital_location; ?></td>
                                    <td><?php echo $mobile_number; ?></td>
                                    <td style="color:green"><?php echo $status; ?></td>

                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='9'>No records found</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- footer include once  -->
     <?php include('footer.php')?>
    <!-- end of footer include once  -->
     <script src="assets/js/dropdown_parent.js"></script>

    <script>
        var $table = $('#fresh-table')

        window.operateEvents = {
            'click .like': function(e, value, row, index) {
                alert('You click like icon, row: ' + JSON.stringify(row))
                console.log(value, row, index)
            },
            'click .edit': function(e, value, row, index) {
                alert('You click edit icon, row: ' + JSON.stringify(row))
                console.log(value, row, index)
            },
            'click .remove': function(e, value, row, index) {
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: [row.id]
                })
            }
        }

        function operateFormatter(value, row, index) {
            return [
                '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                '<i class="fa fa-heart"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                '<i class="fa fa-edit"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-remove"></i>',
                '</a>'
            ].join('')
        }

        $(function() {
            $table.bootstrapTable({
                classes: 'table table-hover table-striped',
                toolbar: '.toolbar',

                search: true,
                showRefresh: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                striped: true,
                sortable: true,
                height: $(window).height(),
                pageSize: 25,
                pageList: [25, 50, 100],

                formatShowingRows: function(pageFrom, pageTo, totalRows) {
                    return ''
                },
                formatRecordsPerPage: function(pageNumber) {
                    return pageNumber + ' rows visible'
                }
            })

            $(window).resize(function() {
                $table.bootstrapTable('resetView', {
                    height: $(window).height()
                })
            })
        })

        $('#sharrreTitle').sharrre({
            share: {
                twitter: true,
                facebook: true
            },
            template: '',
            enableHover: false,
            enableTracking: true,
            render: function(api, options) {
                $("#sharrreTitle").html('Thank you for ' + options.total + ' shares!')
            },
            enableTracking: true,
            url: location.href
        })

        $('#twitter').sharrre({
            share: {
                twitter: true
            },
            enableHover: false,
            enableTracking: true,
            buttons: {
                twitter: {
                    via: 'CreativeTim'
                }
            },
            click: function(api, options) {
                api.simulateClick()
                api.openPopup('twitter')
            },
            template: '<i class="fa fa-twitter"></i> {total}',
            url: location.href
        })

        $('#facebook').sharrre({
            share: {
                facebook: true
            },
            enableHover: false,
            enableTracking: true,
            click: function(api, options) {
                api.simulateClick()
                api.openPopup('facebook')
            },
            template: '<i class="fa fa-facebook-square"></i> {total}',
            url: location.href
        })
    </script>

    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga')

        ga('create', 'UA-46172202-1', 'auto')
        ga('send', 'pageview')
    </script>

    <!-- sweet alert -->
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

