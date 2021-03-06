<?php
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");
        $account = new Account($con);
    include("includes/handlers/register.inc.php");
    include("includes/handlers/login.inc.php");

    function getInputValue($name){
        if (isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>
<html>

<head>
    <title>Welcome To Spotify!</title>
    <link rel="stylesheet" type="text/css" href="Assets/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="Assets/js/register.js"></script>
</head>

<body>
    <?php
    if (isset($_POST['RegisterButton'])) {
        echo    '<script>
                    $(document).ready(function(){
                        $("#LoginForm").hide();
                        $("#RegisterForm").show();
                    });
                </script>';
    }
    else {
        echo    '<script>
                    $(document).ready(function(){
                        $("#LoginForm").show();
                        $("#RegisterForm").hide();
                    });
                </script>';
    }
    ?>

    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form action="register.php" method="POST" id="LoginForm">

                    <h2>Login To Your Account</h2>
                    <p>
                        <?php echo $account -> getError(Constants :: $loginFailed); ?>
                        <label for="LoginUsername">Username</label>
                        <input type="text" id="LoginUsername" name="LoginUsername" placeholder="e.g. Muhammad Bilal"
                        value="<?php getInputValue('LoginUsername') ?>"    required>
                    </p>

                    <p>
                        <label for="LoginPassword">Password</label>
                        <input type="password" id="LoginPassword" name="LoginPassword" placeholder="Your Passsword"
                            required>
                    </p>

                    <button type="submit" name="LoginButton">LOG IN</button>
                    <div class="hasAccountText">
                        <span id="hideLogin">Don't Have An Account Yet? <a href="#">SIGNUP</a> Here.</span>
                    </div>

                </form>

                <form action="register.php" method="POST" id="RegisterForm">

                    <h2>Create Your free Account</h2>
                    <p>
                        <?php echo $account -> getError(Constants :: $UserNameCharacters); ?>
                        <?php echo $account -> getError(Constants :: $UserNameTaken); ?>
                        <label for="Username">Username</label>
                        <input type="text" id="Username" name="Username" value="<?php getInputValue('Username') ?>"
                            placeholder="e.g. Muhammad Bilal" required>
                    </p>
                    <p>
                        <?php echo $account -> getError(Constants :: $FirstNameCharacters); ?>
                        <label for="FirstName">First Name</label>
                        <input type="text" id="FirstName" name="FirstName" value="<?php getInputValue('FirstName') ?>"
                            placeholder="e.g. Muhammad" required>
                    </p>
                    <p>
                        <?php echo $account -> getError(Constants :: $LastNameCharacters); ?>
                        <label for="LastName">Last Name</label>
                        <input type="text" id="LastName" name="LastName" value="<?php getInputValue('LastName') ?>"
                            placeholder="e.g. Bilal" required>
                    </p>
                    <p>
                        <?php echo $account -> getError(Constants :: $EmailsDoNotMatch); ?>
                        <?php echo $account -> getError(Constants :: $EmailInvalid); ?>
                        <?php echo $account -> getError(Constants :: $EmailTaken); ?>
                        <label for="Email">Email</label>
                        <input type="email" id="Email" name="Email" value="<?php getInputValue('Email') ?>"
                            placeholder="e.g. bilal@gmaail.com" required>
                    </p>
                    <p>
                        <label for="Email2">Confirm Email</label>
                        <input type="email" id="Email2" name="Email2" value="<?php getInputValue('Email2') ?>"
                            placeholder="e.g. bilal@gmaail.com" required>
                    </p>

                    <p>
                        <?php echo $account -> getError(Constants :: $passwordsDoNotMatch); ?>
                        <?php echo $account -> getError(Constants :: $passwordNotAlphanumeric); ?>
                        <?php echo $account -> getError(Constants :: $passwordCharacters); ?>
                        <label for="Password">Password</label>
                        <input type="password" id="Password" name="Password" placeholder="Your Passsword" required>
                        <!-- form Password In TextBox value="<?php getInputValue('Password') ?>" -->
                    </p>
                    <p>
                        <label for="Password2">Confirm Password</label>
                        <input type="password" id="Password2" name="Password2" placeholder="Confirm Passsword" required>
                        <!-- for Password In TextBox value="<?php getInputValue('Password2') ?>" -->
                    </p>

                    <button type="submit" name="RegisterButton">SIGN UP</button>
                    <div class="hasAccountText">
                        <span id="hideRegister">Already Have An Account? <a href="#">LOGIN</a> Here</span>
                    </div>


                </form>

            </div>

            <div id="loginText">
                <h1>Get Great Music, Right Now</h1>
                <h2>Listen to loads of Songs for Free</h2>
                <ul>
                    <li>Discover Music You'll Fall In LOVE With</li>
                    <li>Creat Your own Playlists</li>
                    <li>Follow Artists to keep Upto Date</li>
                </ul>
            </div>

        </div>
    </div>
</body>

</html>