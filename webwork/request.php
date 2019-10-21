<!DOCTYPE html>
<html>
<body>

<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
  <input type="submit">     <!-- compare it to the tut you did, it had one submit 'button' for alles-->
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") { //I get-ed it because i want to see the username and the email, ill post the pwd and other secret shit
    // collect value of input field
    $name = htmlspecialchars($_REQUEST['fname']); //$_REQUEST gets the info inputed into the name form,
    if (empty($name)) {                           //I'll use this to collect sign up info and save it onto my db
        echo "Name is empty";                     //use htmlspecialchars !! like prepared statements things
    } else {
        echo $name;
    }
}
?>

</body>
</html>