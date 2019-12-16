<?php
    session_start();
    include 'includes/setupFunc.php';

    

    if (isset($_POST['update-submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        
        function test($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

        $pwdErr = $pwdDiff = $pwdStrength = $pwdSuccess = $failure = "";
        $newpwd = test($_POST['newpwd']);
        $pwd = test($_POST['pwd']);
        $user = $_SESSION['id'];
        $id = get_UserID($user);
        $pwdRep = test($_POST['pwd-repeat']);
        $uppercase = preg_match('@[A-Z]@', $newpwd);
        $lowercase = preg_match('@[a-z]@', $newpwd);
        $number = preg_match('@[0-9]@', $newpwd);
        $specialChars = preg_match('@[^\w]@', $newpwd);
        
        if (empty($pwd)) {
            $pwdErr = "password cannot be empty";
            header("Location: http://localhost:8080/camagru/login/profile.php?pwdErr={$pwdErr}");
            return;
        } else if (!empty($pwd)){
            try{
                $hash = hash("md5", $pwd);
                $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru","root","000000");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $conn->prepare("SELECT * FROM camUsers WHERE pwd=:pwd");
                $sql->bindParam(":pwd", $hash);
                $sql->execute();

                $ret = $sql->fetchAll();
                if (sizeof($ret) == 0) {
                    $pwdErr = "Password error. No match";
                    header("Location: http://localhost:8080/camagru/login/profile.php?pwdErr={$pwdErr}");
                    return;
                }
            } catch(PDOException $e) {
                $failure = $e->getMessage();
                header("Location: http://localhost:8080/camagru/login/profile.php?pwdErr={$failure}");
                return;
            }
        }

        if (empty($newpwd) || empty($pwdRep)) {
            $pwdDiff = "password cannot be empty";
        }

        if ($pwdRep != $newpwd){
            $pwdDiff = "passwords didnt match";
        }

        if(!$uppercase || !$number || !$lowercase || !$specialChars || strlen($pwd) < 8) {
            $pwdStrength = "'Password should be at least 8 characters/more complex";
        }
        
        if (!empty($pwdDiff) || !empty($pwdErr) || !empty($pwdStrength)) {
            header("Location: http://localhost:8080/camagru/login/profile.php?pwdErr={$pwdErr}&pwdDiff={$pwdDiff}&pwdStrength={$pwdStrength}");
            return;
        }
        UpdateProfile ($user, $newpwd);
    }
?>