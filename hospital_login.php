<?php
session_start();
require_once("config.php");

if (isset($_SESSION['hospital_id'])) {
    header("Location: hospital_home.php");
    exit();
}
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $_SESSION['message'] = [
            'text' => 'All fields are required!',
            'icon' => 'warning'
        ];
        header("Location: hospital_login.php");
        exit();
    }


    $sql = "SELECT * FROM hospitals WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];
        if ($status == 'approved') {
            $_SESSION['hospital_id'] = $row['id'];
            $_SESSION['hospital_name'] = $row['add_hospital_id']; 

            $_SESSION['email'] =$row['email'];
   
            $_SESSION['message'] = [
                'text' => 'Login successful! Welcome ' ,
                'icon' => 'success'
            ];
            header("Location: hospital_home.php");
            exit();
        }
        elseif($status=='rejected'){
          
            $_SESSION['message'] = [
                'text' => 'Your account has been rejected',
                'icon'=> 'info'
               
            ];
            header("Location: hospital_login.php");
            exit();
        } else {
            $_SESSION['message'] = [
                'text' => 'Your account is not approved yet!',
                'icon' => 'error'
            ];
            header("Location: hospital_login.php");
            exit();
        }
    } else {
        $_SESSION['message'] = [
            'text' => 'Invalid email or password!',
            'icon' => 'error'
        ];
        header("Location: hospital_login.php");
        exit();
    }
} 
 
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
     <!-- bootstrap -->
     <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <!-- link sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <!-- bootstrap -->
     <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
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
                            <a class="nav-link" id="home-tab" href="parents_register.php" role="tab"
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
                            <h3 class="register-heading">Hospital login</h3>
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
                                    <span>Don't have an account?<a href="hospital_register.php"> Create one</a></span>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="submit" class="btnRegister" value="login" name="login" />
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