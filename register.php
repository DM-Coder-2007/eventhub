<?php
include("config/db.php");
if(isset($_POST['register'])){
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role=mysqli_real_escape_string($conn,$_POST['role']);
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
   
    $query="INSERT INTO users(full_name,email,password,role) VALUES('$name','$email','$password','$role')";


    if(mysqli_query($conn, $query)){
        // header("Location:login.php");
        exit();
    }
    else{
        echo "<script>alert('Registration Failed:". mysqli_error($conn). "')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <div class="register-card">
        <div class="form-header">Create Your Account</div>

        <form action="" method="POST" onsubmit="validate(event)">

            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="John Doe" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="john@example.com"
                    required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••"
                    required>
            </div>

            <div class="form-group">
                <label for="role">Registration Type</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="user" selected>Attendee</option>
                </select>
            </div>

            <button type="submit" name="register" class="register-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
                Create Account
            </button>
        </form>

        <div class="form-footer">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>



    <!-- <script src="js/register.js"></script> -->
</body>

</html>