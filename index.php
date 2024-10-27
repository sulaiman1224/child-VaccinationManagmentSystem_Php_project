<?php
session_start(); 
require_once("config.php");

if (isset($_POST["register"])) {
   
    $parent_name = $_POST["parent_name"];
    $email =$_POST["email"];
    $password = $_POST["password"];
    $mobile_number = $_POST["mobile_number"];
    $gender = $_POST["gender"];

    // Check if the email already exists
    $sql = "SELECT * FROM parents WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = ['text' => 'Email already exists!', 'icon' => 'error'];
    } else {
        // Check if any field is empty
        if (empty($parent_name) || empty($email) || empty($password) || empty($mobile_number) || empty($gender)) {
            $_SESSION['message'] =[
                'text' => 'All fields are required!', 
                'icon' => 'warning'
            ];
        }
        //  
        elseif (!preg_match('/^[a-zA-Z\s]+$/', $parent_name)) {
            $_SESSION['message'] = [
            'text' => 'Invalid name!', 
            'icon' => 'warning'
        ];
        }
       
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = [
            'text' => 'Invalid email address!',
             'icon' => 'warning'
        ];
        }

        elseif (strlen($password) < 8) {
            $_SESSION['message'] = [
            'text' => 'Password must be at least 8 characters long.',
             'icon' => 'warning'
            ];
        }
        elseif (!preg_match('/[A-Z]/', $password)) {
            $_SESSION['message'] = [
            'text' => 'Password must contain at least one uppercase letter.',
            'icon' => 'warning'
        ];
        }
        elseif (!preg_match('/[a-z]/', $password)) {

            $_SESSION['message'] = [
            'text' => 'Password must contain at least one lowercase letter.', 
            'icon' => 'warning'
        ];
        }
        elseif (!preg_match('/[@$!%*#?&]/', $password)) {
            $_SESSION['message'] = [
                'text' => 'Password must contain at least one special character!',
                'icon' => 'warning'
            ];
        }
        
        elseif (strlen($mobile_number) < 10 || strlen($mobile_number) > 15) {
            $_SESSION['message'] = [
                'text' => 'Mobile number should be between 10 and 15 digits!', 
                'icon' => 'warning'
            ];
        }
        elseif (!preg_match('/^[0-9]+$/', $mobile_number)) {
            $_SESSION['message'] = [
                'text' => 'Mobile number should contain only digits!', 
                'icon' => 'warning'
            ];
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = [
                'text' => 'Invalid email address!',
             'icon' => 'warning'
            ];
        }
      
        elseif ($gender != 'male' && $gender != 'female' && $gender != 'other') {
            $_SESSION['message'] = [
                'text' => 'Invalid gender!', 
                'icon' => 'warning'
        ];
        }
        // If all checks pass, insert data
        else {
            // Insert the data into the database
            $sql = "INSERT INTO parents (parent_name, email, password, mobile_number, gender) VALUES ('$parent_name', '$email', '$password', '$mobile_number', '$gender')";
            $result = mysqli_query($connect, $sql);
            if ($result) {
                $_SESSION['message'] = [
                    'text' => 'Registration successful!', 
                    'icon' => 'success'
                ];
                header("Location: parents_login.php");
                exit(); 
            } else {
                $_SESSION['message'] = [
                    'text' => 'Error in registration!', 
                    'icon' => 'error'
                ];
            }
        }
    }

    // redirect
    header("Location: parents_register.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>parent register</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register_login.css">
    <link rel="stylesheet" href="assets/css/dailogbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- link sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/colors.css">
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo"> <img src="assets/images/logo.png" style="width: 100px;height:100px" alt=""></label>
        <ul>
            <li><a class="active" href="parents_register.php">Home</a></li>
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
                            <a class="nav-link active" id="home-tab" href="index.php" role="tab"
                                aria-selected="true">Parent</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" href="hospital_register.php" role="tab"
                                aria-controls="profile" aria-selected="false">Hospital</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" href="admin_login.php" role="tab"
                                aria-controls="profile" aria-selected="false">Admin</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">parents register</h3>
                                <!-- form -->

                            <form method="post" class="row register-form">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Parent_Name *"
                                            name="parent_name" />
                                    </div>
                                </div>
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
                                        <div class="maxl">
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="male" checked>
                                                <span name="gender"> male </span>
                                            </label>
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="female">
                                                <span name="gender">female </span>
                                            </label>
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="other">
                                                <span name="gender">other</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span>Already have an account?<a href="parents_login.php"> login</a></span>
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

