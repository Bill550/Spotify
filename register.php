<?php
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");
        $account = new Account();
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
</head>

<body>
    <div id="inputContainer">
        <form action="register.php" method="POST" id="LoginForm">

            <h2>Login To Your Account</h2>
            <p>
                <label for="LoginUsername">Username</label>
                <input type="text" id="LoginUsername" name="LoginUsername" placeholder="e.g. Muhammad Bilal" required>
            </p>

            <p>
                <label for="LoginPassword">Password</label>
                <input type="password" id="LoginPassword" name="LoginPassword" placeholder="Your Passsword" required>
            </p>

            <button type="submit" name="LoginButton">LOG IN</button>

        </form>

        <form action="register.php" method="POST" id="RegisterForm">

            <h2>Create Your free Account</h2>
            <p>
                <?php echo $account -> getError(Constants :: $UserNameCharacters); ?>
                <label for="Username">Username</label>
                <input type="text" id="Username" name="Username" value="<?php getInputValue('Username') ?>" placeholder="e.g. Muhammad Bilal" required>
            </p>
            <p>
                <?php echo $account -> getError(Constants :: $FirstNameCharacters); ?>
                <label for="FirstName">First Name</label>
                <input type="text" id="FirstName" name="FirstName" value="<?php getInputValue('FirstName') ?>" placeholder="e.g. Muhammad" required>
            </p>
            <p>
                <?php echo $account -> getError(Constants :: $LastNameCharacters); ?>
                <label for="LastName">Last Name</label>
                <input type="text" id="LastName" name="LastName" value="<?php getInputValue('LastName') ?>" placeholder="e.g. Bilal" required>
            </p>
            <p>
                <?php echo $account -> getError(Constants :: $EmailsDoNotMatch); ?>
                <?php echo $account -> getError(Constants :: $EmailInvalid); ?>
                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email" value="<?php getInputValue('Email') ?>" placeholder="e.g. bilal@gmaail.com" required>
            </p>
            <p>
                <label for="Email2">Confirm Email</label>
                <input type="email" id="Email2" name="Email2" value="<?php getInputValue('Email2') ?>" placeholder="e.g. bilal@gmaail.com" required>
            </p>

            <p>
                <?php echo $account -> getError(Constants :: $passwordsDoNotMatch); ?>
                <?php echo $account -> getError(Constants :: $passwordNotAlphanumeric); ?>
                <?php echo $account -> getError(Constants :: $passwordCharacters); ?>
                <label for="Password">Password</label>
                <input type="password" id="Password" name="Password" value="<?php getInputValue('Password') ?>" placeholder="Your Passsword" required>
            </p>
            <p>
                <label for="Password2">Confirm Password</label>
                <input type="password" id="Password2" name="Password2" value="<?php getInputValue('Password2') ?>" placeholder="Confirm Passsword" required>
            </p>

            <button type="submit" name="RegisterButton">SIGN UP</button>

        </form>

    </div>
</body>

</html>