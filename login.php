<?php
session_start();
include("config/db.php");

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password=$_POST['password'];
    $role=$_POST['role'];
    
    if($role=="attendee"){
        $query="SELECT * FROM users WHERE full_name='$username' AND role='user'";
        $result=mysqli_query($conn,$query);
        if($result && mysqli_num_rows($result)>0){
            $user_data=mysqli_fetch_assoc($result);

            if(password_verify($password,$user_data['password'])){
                $_SESSION['user_id']=$user_data['user_id'];
                $_SESSION['username']=$user_data['full_name'];
                $_SESSION['role']=$user_data['role'];

                if(isset($_POST['remember'])){
                    setcookie("username",$username,time()+86400,"/");
                }
                header("Location:index.php");
                exit();
            }else {
                echo "<script>alert('Invalid username or  Password!');</script>";
            }
        }else {
            echo "<script>alert('User not found. Please register first.');</script>";
        }
    }



    // ADMIN LOGIN
    else if($role=="admin"){
        if($username == "Bateman" && $password == "Pat007123@#"){
            $_SESSION['username'] = $username;
            $_SESSION['user_id']=1;
            if(isset($_POST['remember'])){
             setcookie("username", $username,time()+86400,"/");
            }
            // header("Location:index.php");
            exit();
        }else{
            echo "<script>alert('Invalid username or Password')</script>";
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="form-card">
        <div class="form-header">Login To Your Account</div>

        <form action="" method="POST">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="username" class="form-control" placeholder="John Doe" required>
            </div>

            <!-- <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="john@example.com"
                    required>
            </div> -->

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••"
                    required>
            </div>

            <div class="form-group">
                <label for="role">Sign in as</label>
                <select id="role" name="role" class="form-control">
                    <option value="attendee" selected>Attendee</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="remember-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" name="login" class="submit-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                Login
            </button>
        </form>

        <div class="register-section">
            Not registered yet?
            <a href="register.php" class="create-account-btn">Create Account</a>
        </div>
    </div>



    <script src="js/login.js"></script>
</body>

</html>