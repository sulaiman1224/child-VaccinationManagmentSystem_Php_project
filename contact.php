<?php
require_once('config.php');
session_start();

if (isset($_POST['send'])) {
    // Collect and sanitize input data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $parent_hospital = $_POST['parent_hospital'];
    $message = $_POST['message'];

    // Validate form fields
    if (empty($name) || empty($email) || empty($parent_hospital) || empty($message) || empty($mobile_number)) {
        $_SESSION['message'] = [
            'text' => 'All fields are required!',
            'icon' => 'warning'
        ];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = [
            'text' => 'Invalid email format!',
            'icon' => 'warning'
        ];
    } elseif (!preg_match("/^[0-9]{11}$/", $mobile_number)) {
        $_SESSION['message'] = [
            'text' => 'Invalid mobile number!',
            'icon' => 'warning'
        ];
    }  else {
        // Insert data into database
        $sql = "INSERT INTO feedback (name, email, mobile_number, parent_hospital, message) 
                VALUES ('$name', '$email', '$mobile_number', '$parent_hospital', '$message')";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            $_SESSION['message'] = [
                'text' => 'Message sent successfully!',
                'icon' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'text' => 'Failed to submit form!',
                'icon' => 'error'
            ];
        }
    }

    header('Location: contact.php');
    exit();
}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Contact Form</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/register_login.css">
    <link rel="stylesheet" href="assets/css/colors.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">Child VMS</label>
        <ul>
            <li><a href="parents_register.php">Home</a></li>
            <li><a class="active" href="contact.php">Contact</a></li>
        </ul>
    </nav>
    <section>
        <div class="container contact-form" style="font-family: 'IBM Plex Sans', sans-serif;">
            <div class="contact-image">
                <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact" />
            </div>
            <form method="post" action="">
                <h3>Drop Us a Message</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name *"  />
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your Email *"  />
                        </div>
                        <div class="form-group">
                            <select name="parent_hospital" class="form-control" >
                                <option value="" selected disabled>Select Parent/Hospital</option>
                                <option value="parent">Parent</option>
                                <option value="hospital">Hospital</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="mobile_number" class="form-control" placeholder="Your Phone Number *" />
                        </div>
                        <div class="form-group">
                        <input type="submit" name="send" class="btnContact" value="Send Message" />
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="message" class="form-control form-control_message" placeholder="Your Message *" style="width: 100%; height: 150px;" ></textarea>
                        </div>
                    </div>
                  
                </div>
            </form>
        </div>
    </section>

    <!-- SweetAlert code -->
    <?php if (isset($_SESSION['message'])): ?>
        <script>
            Swal.fire({
                title: 'Notification',
                text: '<?php echo $_SESSION['message']['text']; ?>',
                icon: '<?php echo $_SESSION['message']['icon']; ?>'
            });
        </script>
    <?php unset($_SESSION['message']); endif; ?>
</body>
</html>
