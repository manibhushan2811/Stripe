<?php 
   session_start();
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
        <?php 
             
             include("config.php");
             if(isset($_POST['submit'])){
               $email = mysqli_real_escape_string($con,$_POST['email']);
               $password = mysqli_real_escape_string($con,$_POST['password']);

               $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
               $row = mysqli_fetch_assoc($result);

               if(is_array($row) && !empty($row)){
                   $_SESSION['valid'] = $row['Email'];
                   $_SESSION['username'] = $row['Username'];
                   $_SESSION['id'] = $row['Id'];
               }else{
                   echo "<div class='message'>
                     <p>Wrong Username or Password</p>
                      </div> <br>";
                  echo "<a href='index.php'><button class='btn'>Go Back</button>";
        
               }
               if(isset($_SESSION['valid'])){
                if(isset($_POST['remember'])){
                    setcookie('emailcookie', $email,time()+86400);
                    setcookie('passwordcookie', $password,time()+86400);
                    header("Location: home.php");
                }
                else{ 
                    header("Location: home.php");
                }
               }
             }else{

           
           ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value = "<?php if(isset($_COOKIE['emailcookie'])){echo $_COOKIE['emailcookie'];} ?>"  autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value = "<?php if(isset($_COOKIE['passwordcookie'])){echo $_COOKIE['passwordcookie'];} ?>" autocomplete="off" required>
                </div>
                <div class="f">
                    
                    <input type="checkbox" name="remember" id="remember" autocomplete="off"> Remember Me
                </div>
                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    New to MyApp? <a style="text-decoration:none" href="register.php">Sign Up</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>