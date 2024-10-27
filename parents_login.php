<?php
session_start();
require_once("config.php");
if (isset($_SESSION['parent_id'])) {
    header("Location: parent_home.php");
    exit();
}
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM parents WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connect, $sql);

    // // Check empty fields
    if (empty($email) || empty($password)) {
        $_SESSION['message'] = [
            'text' => 'All fields are required!',
            'icon' => 'warning'
        ];
        header("Location: parents_login.php");
        exit();
    } elseif (mysqli_num_rows($result) > 0) {
        $parent = mysqli_fetch_assoc($result);
        // Successful login
        $_SESSION['parent_id'] = $parent['id']; // Store parent ID
        $_SESSION['parent_name'] = $parent['parent_name'];
        $_SESSION['message'] = [
            'text' => 'Login successful! Welcome ',
            'icon' => 'success'
        ];
        header("Location: parent_home.php"); // Redirect to parent home
        exit();
    } else {
        // Login failed
        $_SESSION['message'] = [
            'text' => 'Invalid email or password!',
            'icon' => 'error'
        ];
    }

    // Redirect back to login page if not successful
    header("Location:   parents_login.php");
    exit();
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
    <!-- colors.css -->
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
            <li><a class="active" href="parents_register.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
    <section>

        <div class="container-fluid register">
            <div class="row">
                <div class="col-md-4 register-left">
                    <img src="assets/images/left_img_register_form.png" alt="Image" style="filter: grayscale(100%) brightness(0%);" />
                    <h3>Child Vaccination Management System</h3>
                </div>

                <div class="col-md-8 register-right">
                    <ul class="nav nav-tabs nav-justified"  role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" href="parents_register.php" role="tab"
                                aria-selected="false">Parent</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" href="hospital_register.php" role="tab"
                                aria-controls="profile" aria-selected="false">Hospital</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="profile-tab" href="admin_login.php" role="tab"
                                aria-controls="profile" aria-selected="true">Admin</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">Parent Login</h3>

                            <form method="post" class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email *" name="email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *" name="password" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span>Don't have an account?<a href="index.php"> Create one</a></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="submit" class="btnRegister" value="Login" name="login" />
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php
    // using sweet alert

    if (isset($_SESSION['message'])): ?>
        <script>
            Swal.fire({
                title: 'Notification',
                text: '<?php echo $_SESSION['message']['text'] ?>',
                icon: '<?php echo $_SESSION['message']['icon']; ?>'
            });
        </script>
    <?php unset($_SESSION['message']);
    endif; ?>
</body>

</html>