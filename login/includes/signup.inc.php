<?php //the signup script that comms with the database
//require "../signup.php";

$name = $email = $pwd = $pwdRep = $uid = "";
$nameErr = $mailErr = $uidErr = $pwdErr = $pwdDiff = "";
$uppercase = preg_match("/^[A-Z]*$/", $pwd);
$lowercase = preg_match("/^[a-z]*$/", $pwd);
$number    = preg_match("/^[0-9]*$/", $pwd);
$specialChars = preg_match("/^[!@#$%^&*()-_,.?]*$/", $pwd);

function test($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if (isset($_POST['signup-submit']) && $_SERVER["REQUEST_METHOD"] == "POST") { //checks to see if sign up page was accessed using the sign up button,

    if (empty($_POST["name"]) || !preg_match("/^[a-zA-Z ]*$/", test($_POST["name"])) || empty($_POST["email"]) || !filter_var(test($_POST["email"]) , FILTER_VALIDATE_EMAIL) ||
    empty($_POST['uid']) || !preg_match("/^[a-z@A-Z ]*$/", test($_POST['uid'])) || empty($_POST["pwd"]) || empty($_POST["pwd-repeat"]) || $_POST["pwd"] !== $_POST["pwd-repeat"] ||
    !$uppercase || !$lowercase || !$number || !$specialChars || strlen($pwd) < 8) {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        //header("Location: http://localhost/camagru/login/signup.php?error=emptyfields&name="); //this function returns the user to the sign up page while displaying an error in the address bar
    } else {
        $name = test($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    
    if (empty($_POST["email"])) {
        //header("Location: ../signup.php?error=invalidmail&name=".$name."&email=");
        $mailErr = "Email is required";
        //header("Location: http://localhost/camagru/login/signup.php?error=empty_Email&name=".$name); //this function returns the user to the sign up page while displaying an error in the address bar
    } else {
        $email = test($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mailErr = "Invalid email format";
        }

    }

    if (empty($_POST['uid'])) {
        $uidErr = "username cannot be empty";
    } else {
        $uid = test($_POST['uid']);
        if (!preg_match("/^[a-z@A-Z ]*$/",$name)) {
            $uidErr = "Username must have '@'";
        }
    }

    if (empty($_POST["pwd"]) || empty($_POST["pwd-repeat"])) {
        $pwdErr = "Password cant be empty";
    } else if ($_POST["pwd"] !== $_POST["pwd-repeat"]) {
       // header("Location: ../signup.php?error=invalid&uid=".$name."&mail=".$email);
        $pwdDiff = "Password didn't match";
    } else {
        $pwd = $_POST["pwd"];
        $pwdRep = $_POST["pwd-repeat"];

        if(!$uppercase || !$number || !$lowercase || !$specialChars || strlen($pwd) < 8) {
            $pwdErr = "'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
        }
    }
    } else {
        
    }
}