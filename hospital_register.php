<?php
session_start();
require_once("config.php");

if (isset($_POST["register"])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile_number = $_POST['mobile_number'];
    $pincode = $_POST['pincode'];
    $address = $_POST['address'];
    $add_hospital_id = $_POST['add_hospital_id'];

    $sql = "SELECT  * FROM hospitals WHERE email = '$email' AND add_hospital_id = '$add_hospital_id'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = [
            'text' => 'hospital already registered!',
            'icon' => 'error'
        ];
    }

    // Check if any field is empty

    elseif (empty($email) || empty($password) || empty($mobile_number) || empty($pincode) || empty($address) || empty($add_hospital_id)) {
        $_SESSION['message'] = [
            'text' => 'All fields are required!',
            'icon' => 'warning'
        ];
    }

    // email validation
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = [
            'text' => 'Invalid email format!',
            'icon' => 'warning'
        ];
    }

    // password validation

    elseif (strlen($password) < 8) {
        $_SESSION['message'] = [
            'text' => 'Password must be at least 8 characters long!',
            'icon' => 'warning'
        ];
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $_SESSION['message'] = [
            'text' => 'Password must contain at least one uppercase letter!',
            'icon' => 'warning'
        ];
    } elseif (!preg_match('/[a-z]/', $password)) {
        $_SESSION['message'] = [
            'text' => 'Password must contain at least one lowercase letter!',
            'icon' => 'warning'
        ];
    } elseif (!preg_match('/[@$!%*#?&]/', $password)) {
        $_SESSION['message'] = [
            'text' => 'Password must contain at least one special character!',
            'icon' => 'warning'
        ];
    }

    // mobile number validation 

    elseif (strlen($mobile_number) < 10 || strlen($mobile_number) > 15) {
        $_SESSION['message'] = [
            'text' => 'Mobile number should be between 10 and 15 digits!',
            'icon' => 'warning'
        ];
    } elseif (!preg_match('/^[0-9]+$/', $mobile_number)) {
        $_SESSION['message'] = [
            'text' => 'Mobile number should contain only digits!',
            'icon' => 'warning'
        ];
    }
    // pincode validation

    elseif (!preg_match('/^[0-9]{7}$/', $pincode)) {
        $_SESSION['message'] = [
            'text' => 'Invalid pincode!',
            'icon' => 'warning'
        ];
    }

    // address validation 

    elseif (strlen($address) < 5 || strlen($address) > 255) {
        $_SESSION['message'] = [
            'text' => 'Address must be between 5 and 255 characters long!',
            'icon' => 'warning'
        ];
    } elseif (!preg_match('/^[a-zA-Z0-9\s,-]+$/', $address)) {
        $_SESSION['message'] = [
            'text' => 'Invalid address format!',
            'icon' => 'warning'
        ];
    } else {
        $sql = "INSERT INTO hospitals (email, password, mobile_number, pincode, address, add_hospital_id) VALUES ('$email', '$password', '$mobile_number', '$pincode', '$address', '$add_hospital_id')";

        if (mysqli_query($connect, $sql)) {
            $_SESSION['message'] = [
                'text' => 'Registration successful!',
                'icon' => 'success'
            ];
            header("Location: hospital_login.php"); // Redirect to 
            exit(); // Stop further execution

        } else {
            $_SESSION['message'] = [
                'text' => 'Registration failed!',
                'icon' => 'error'
            ];
        }
    }

    // Redirect registration page if not successful
    header("Location: hospital_register.php");
    exit();
}



?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>hospital register</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/colors.css">
    <!-- link sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo"> <img src="assets/images/logo.png" style="width: 100px;height:100px" alt=""></label>
        <ul>
            <li><a class="active" href="parents_register.html">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
    <section>

        <div class="container-fluid register">
            <div class="row">
                <div class="col-md-4 register-left">
                <img src="assets/images/left_img_register_form.png" alt="Image" style="filter: grayscale(100%) brightness(0%);" />
                    <h3>Child vaccination managment system</h3>
                </div>
                <div class="col-md-8 register-right">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab" href="index.php" role="tab"
                                aria-selected="true">Parent</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" href="hospital_register.php" role="tab"
                                aria-controls="profile" aria-selected="false">Hospital</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" href="admin_login.php" role="tab"
                                aria-controls="profile" aria-selected="false">Admin</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">Hospital register</h3>
                            <form action="" method="post" class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email *" name="email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *"
                                            name="password" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Mobile Number *"
                                            name="mobile_number" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Pincode *"
                                            name="pincode" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="address *"
                                            name="address" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="add_hospital_id">
                                            <option value="" class="hidden" selected disabled>Hospital location</option>
                                            <?php
                                            $sql="  SELECT id, name FROM  add_hospital";
                                             $result=mysqli_query($connect,$sql);
                                             while($row=mysqli_fetch_assoc($result)){
                                             $add_hospital_id=$row['id'];
                                             $name=$row['name'];
                                             ?>
                                            <option value="<?php echo $add_hospital_id ?>"><?php echo $name  ?></option>

                                             <?php


                                             }
                                            ?>
                                        </select>
                        
                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span>Already have an account?<a href="hospital_login.php"> login</a></span>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="submit" class="btnRegister" value="Register" name="register" />
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- using sweetalert2 -->
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