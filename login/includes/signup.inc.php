<?php //the signup script that comms with the database
require_once "setupFunc.php";

//$name = $email = $pwd = $pwdRep = "";
$nameErr = $mailErr = $uidErr = $pwdErr = $pwdDiff = $namingErr = "";

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

    if (empty($name) || empty($email) || empty($pwd) || empty($pwdRep)) {
        $nameErr = "No field should be left empty";
        //header("Location: http://localhost:8080/camagru/login/signup.php?nameErr={$nameErr}");
        //return;
    }

    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $namingErr = "Only letters and white space allowed";
        //header("Location: http://localhost:8080/camagru/login/signup.php?nameErr={$nameErr}");
        //return;
    }

    if ($pwd !== $pwdRep) {
        $pwdDiff = "Password didn't match";
        //header("Location: http://localhost:8080/camagru/login/signup.php?pwdErr={$pwdDiff}");
        //return;
    } else {
        $uppercase      = preg_match("/^[A-Z]*$/", $pwd);
        $lowercase      = preg_match("/^[a-z]*$/", $pwd);
        $number         = preg_match("/^[0-9]*$/", $pwd);
        $specialChars   = preg_match("/^[!@#$%^&*()-_,.?]*$/", $pwd);

        if(/*!$uppercase || !$number || !$lowercase || !$specialChars || */strlen($pwd) < 8) {
            $pwdErr = "'Password should be at least 8 characters";
            //header("Location: http://localhost:8080/camagru/login/signup.php?pwdErr={$pwdErr}");
            //return;
        }
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mailErr = "Invalid email format";
        //header("Location: http://localhost:8080/camagru/login/signup.php?mailErr={$mailErr}");
        //return;
    }

    $email = strtolower($email);
    if (!empty($name) && !empty($email)) {
    try{
        $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru","root","000000");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully." . "\n";
        
        $sql = $conn->prepare("SELECT * FROM CamUsers WHERE Username=:username OR email=:email");
        // $sql->exec(array(':username' => $name, ':email' => $email));
        
        $sql->bindParam(":username", $name);
        $sql->bindParam(":email", $email);
        $sql->execute();

        // $res = $sql->setFetchMode(PDO::FETCH_ASSOC);
    
        // $ret = $sql->fetchAll();
        
        // for ($i = 0; $i < sizeof($ret); $i++) {
        //     foreach ($ret[$i] as $k => $v) {
        //         echo "{$k}: {$v}<br/>";
        //     }
        // }

        $ret = $sql->fetchAll();

        if (sizeof($ret) > 0) {
            $nameErr = "Username or email already exists";
            //header("Location: http://localhost:8080/camagru/login/signup.php?nameErr={$nameErr}");
            //return;
        }
    } catch(PDOException $e){
        echo "\n";
        echo $e->$message . "\n";
        echo "Error: Oops! Couldn't check user account";
    }
    $conn = null;
}
    
    if (!empty($nameErr) || !empty($mailErr) || !empty($pwdErr) || !empty($pwdDiff)) {
        header("Location: http://localhost:8080/camagru/login/signup.php?nameErr={$nameErr}&mailErr={$mailErr}&pwdErr={$pwdErr}&pwdDiff={$pwdDiff}&namingErr={$namingErr}");
        return;
    }

    $url = $_SERVER['HTTP_HOST']. str_replace("includes/signup.inc.php", "", $_SERVER['REQUEST_URI']);
    signupFunc($name, $email, $pwd);
}