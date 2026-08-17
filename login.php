```php
<?php

session_start();

include "config.php";


// Check whether the form was submitted

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: login.html");
    exit();

}


// Get login information

$email = $_POST["email"];
$password = $_POST["password"];


// Find the user by email

$sql = "SELECT UserID, FullName, Email, Password, Phone, Address, UserType
        FROM user
        WHERE Email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


// Check if account exists

if (mysqli_num_rows($result) == 0) {

    mysqli_stmt_close($stmt);

    ?>

    <!DOCTYPE html>
    <html>

    <head>

        <title>Login Failed | HealthCare Central</title>

        <style>

            * {
                box-sizing: border-box;
                font-family: Arial, Helvetica, sans-serif;
            }

            body {
                margin: 0;
                background: #e8faf7;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .box {
                width: 420px;
                background: white;
                padding: 45px;
                border-radius: 20px;
                text-align: center;
                box-shadow: 0 15px 45px rgba(18, 70, 67, 0.10);
            }

            .icon {
                width: 65px;
                height: 65px;
                margin: 0 auto 20px;
                border-radius: 50%;
                background: #fff1f1;
                color: #d9534f;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 30px;
            }

            h2 {
                color: #102a2a;
                margin-bottom: 10px;
            }

            p {
                color: #718080;
                font-size: 14px;
                line-height: 1.6;
            }

            .button {
                display: inline-block;
                margin-top: 20px;
                padding: 13px 25px;
                background: #079b91;
                color: white;
                text-decoration: none;
                border-radius: 9px;
                font-weight: bold;
                font-size: 14px;
            }

            .button:hover {
                background: #05877f;
            }

        </style>

    </head>


    <body>

        <div class="box">

            <div class="icon">!</div>

            <h2>Login Failed</h2>

            <p>
                No account was found with this email address.
            </p>

            <a href="login.html" class="button">
                Try Again
            </a>

        </div>

    </body>

    </html>

    <?php

    exit();

}


// Get user information

$user = mysqli_fetch_assoc($result);


// Check password

if (!password_verify($password, $user["Password"])) {

    mysqli_stmt_close($stmt);

    ?>

    <!DOCTYPE html>
    <html>

    <head>

        <title>Login Failed | HealthCare Central</title>

        <style>

            * {
                box-sizing: border-box;
                font-family: Arial, Helvetica, sans-serif;
            }

            body {
                margin: 0;
                background: #e8faf7;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .box {
                width: 420px;
                background: white;
                padding: 45px;
                border-radius: 20px;
                text-align: center;
                box-shadow: 0 15px 45px rgba(18, 70, 67, 0.10);
            }

            .icon {
                width: 65px;
                height: 65px;
                margin: 0 auto 20px;
                border-radius: 50%;
                background: #fff1f1;
                color: #d9534f;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 30px;
            }

            h2 {
                color: #102a2a;
                margin-bottom: 10px;
            }

            p {
                color: #718080;
                font-size: 14px;
                line-height: 1.6;
            }

            .button {
                display: inline-block;
                margin-top: 20px;
                padding: 13px 25px;
                background: #079b91;
                color: white;
                text-decoration: none;
                border-radius: 9px;
                font-weight: bold;
                font-size: 14px;
            }

            .button:hover {
                background: #05877f;
            }

        </style>

    </head>


    <body>

        <div class="box">

            <div class="icon">!</div>

            <h2>Incorrect Password</h2>

            <p>
                The password you entered is incorrect.
            </p>

            <a href="login.html" class="button">
                Try Again
            </a>

        </div>

    </body>

    </html>

    <?php

    exit();

}


// Login successful


$_SESSION["UserID"] = $user["UserID"];

$_SESSION["FullName"] = $user["FullName"];

$_SESSION["Email"] = $user["Email"];

$_SESSION["UserType"] = $user["UserType"];


// Close database statement

mysqli_stmt_close($stmt);


// Send user to the correct dashboard

if ($user["UserType"] == "Admin") {

    header("Location: admin_dashboard.php");

    exit();

}


if ($user["UserType"] == "Patient") {

    header("Location: patient/dashboard.php");

    exit();

}


// If UserType is something unexpected

echo "Invalid user type.";

?>
```
