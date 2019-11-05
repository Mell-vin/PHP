<?php //the signup script that comms with the database
session_start();
require_once "setupFunc.php";

//$name = $email = $pwd = $pwdRep = "";
//$nameErr = $mailErr = $uidErr = $pwdErr = $pwdDiff = "";

$_SESSION['error'] = null;

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['pwd-repeat'])){
    $name = test($_POST['name']);
    $email = test($_POST['email']);
    $pwd = test($_POST['pwd']);
    $pwdRep = test($_POST['pwd-repeat']);
}
function test($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


if (isset($_POST['signup-submit']) && $_SERVER["REQUEST_METHOD"] == "POST") { //checks to see if sign up page was accessed using the sign up button,
     
    echo $name;

    if (empty($name) || empty($email) || empty($pwd) || empty($pwdRep)) {
        $_SESSION['error'] = "No field should be left empty";
        header("Location: http://localhost/camagru/login/signup.php");
        return;
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $_SESSION['error'] = "Only letters and white space allowed";
        header("Location: http://localhost/camagru/login/signup.php");
        return;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
        header("Location: http://localhost/camagru/login/signup.php");
        return;
    }
    else {
        $email = strtolower($email);
            try{
                echo "checking acc...";
                $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql = $conn->prepare("SELECT id FROM CamUsers WHERE Username=:username OR email=:email");
                $sql->execute(array(':username' => $name, ':email' => $email));

                if ($res = $sql->fetch()){
                    $_SESSION['error'] = "Username or email already exists";
                    header("Location: http://localhost/camagru/login/signup.php");
                    return;
                }
            }catch(PDOException $e){
                echo "Error: Oops! Couldn't check user account";
            }
            $conn = null;
        }
    if ($pwd !== $pwdRep) {
        $_SESSION['error'] = "Password didn't match";
        header("Location: http://localhost/camagru/login/signup.php");
        return;
    } else {
        $uppercase      = preg_match("/^[A-Z]*$/", $pwd);
        $lowercase      = preg_match("/^[a-z]*$/", $pwd);
        $number         = preg_match("/^[0-9]*$/", $pwd);
        $specialChars   = preg_match("/^[!@#$%^&*()-_,.?]*$/", $pwd);

        if(/*!$uppercase || !$number || !$lowercase || !$specialChars || */strlen($pwd) < 8) {
            $_SESSION['error'] = "'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
            header("Location: http://localhost/camagru/login/signup.php");
            return;
        }
    }
    signupFunc($name, $email, $pwd);
}