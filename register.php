<?php

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // All public registrations are Patient accounts
    $usertype = "Patient";


    // Check if email already exists

    $check = "SELECT UserID FROM user WHERE Email = ?";

    $stmt = mysqli_prepare($conn, $check);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    if (mysqli_num_rows($result) > 0) {

        echo "Email already exists.";

        exit();

    }

    mysqli_stmt_close($stmt);


    // HASH THE PASSWORD

    $hashed_password = password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    // Insert patient

    $sql = "INSERT INTO user
            (FullName, Email, Password, Phone, Address, UserType)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssssss",
        $fullname,
        $email,
        $hashed_password,
        $phone,
        $address,
        $usertype
    );


    if (mysqli_stmt_execute($stmt)) {

        echo "<h2>Account Created Successfully!</h2>";

        echo "<p>Your patient account has been created.</p>";

        echo "<a href='login.html'>Go to Login</a>";

    } else {

        echo "Error: " . mysqli_error($conn);

    }


    mysqli_stmt_close($stmt);

} else {

    echo "Invalid request.";

}

?>
