<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is an example of meta description">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title></title>
    </head>
    <body>


        <header>
            <nav>
                <a href="#">
                    <img src="img/this.jpg" alt="Logo" title="Logo">
                    <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Portfolio</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact us</a></li>
                    </ul>
                </a>
            </nav>
            <div>
                <form action="includes/login.inc.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username/email...">
                    <input type="password" name="pwd" placeholder="Password..">
                    <button type="submit" name="login-submit">Login</button>
               </form>
               <a href="signup.php">Sign Up</a>
               <form action="includes/logout.inc.php" method="post">
                    
                    <button type="submit" name="logout-submit">logout</button>
               </form>
            </div>
        </header>
</html>