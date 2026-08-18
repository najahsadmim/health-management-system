<?php

$doctorID = isset($_GET['doctor_id']) && is_numeric($_GET['doctor_id'])
    ? (int) $_GET['doctor_id']
    : 0;

if ($doctorID <= 0) {
    die("Invalid doctor.");
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $doctorID = isset($_POST['doctor_id']) && is_numeric($_POST['doctor_id'])
        ? (int) $_POST['doctor_id']
        : 0;

    $appointmentDate = trim($_POST['appointment_date'] ?? '');
    $appointmentTime = trim($_POST['appointment_time'] ?? '');
    $appointmentType = trim($_POST['appointment_type'] ?? '');

    if ($appointmentDate === '') {
        $errors[] = "Please select an appointment date.";
    }

    if ($appointmentTime === '') {
        $errors[] = "Please select an appointment time.";
    }

    if ($appointmentType === '') {
        $errors[] = "Please select an appointment type.";
    }

    if (empty($errors)) {

        /*
        Database insertion will be added here
        after the appointment table is created.

        */

        $bookingComplete = true;

    }

} else {

    $bookingComplete = false;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book Appointment</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3fffc;
            color: #333;
        }

        .navbar {
            background: white;
            padding: 18px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px #ddd;
        }

        .logo {
            color: #009f8b;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-link {
            color: #555;
            text-decoration: none;
            font-size: 15px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 50px 25px;
        }

        .appointment-card {
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 5px 18px #ddd;
        }

        h1 {
            color: #009f8b;
            margin-top: 0;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }

        .doctor-info {
            background: #e8faf6;
            padding: 18px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .doctor-info strong {
            color: #009f8b;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 9px;
            font-size: 15px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #009f8b;
        }

        .type-options {
            display: flex;
            gap: 15px;
        }

        .type-option {
            flex: 1;
        }

        .type-option input {
            display: none;
        }

        .type-option label {
            padding: 13px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 9px;
            cursor: pointer;
            font-weight: normal;
        }

        .type-option input:checked + label {
            background: #e4faf6;
            border-color: #009f8b;
            color: #008272;
            font-weight: bold;
        }

        .errors {
            background: #fff1f1;
            color: #c0392b;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .errors ul {
            margin: 0;
            padding-left: 20px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .button {
            flex: 1;
            padding: 13px;
            border-radius: 9px;
            text-decoration: none;
            text-align: center;
            font-size: 15px;
            cursor: pointer;
        }

        .back-button {
            background: #eee;
            color: #444;
        }

        .submit-button {
            background: #009f8b;
            color: white;
            border: none;
        }

        .submit-button:hover {
            background: #008272;
        }

        .success {
            text-align: center;
        }

        .success-icon {
            font-size: 55px;
            margin-bottom: 15px;
        }

        .success h1 {
            margin-bottom: 12px;
        }

        .success p {
            color: #666;
            line-height: 1.6;
        }

        .booking-details {
            background: #f3fffc;
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
            text-align: left;
        }

        .booking-details p {
            margin: 10px 0;
        }

        @media (max-width: 600px) {

            .navbar {
                padding: 15px 20px;
            }

            .container {
                padding: 30px 15px;
            }

            .appointment-card {
                padding: 25px;
            }

            .type-options {
                flex-direction: column;
                gap: 10px;
            }

            .button-group {
                flex-direction: column;
            }

        }

    </style>

</head>

<body>

<div class="navbar">

    <div class="logo">
        HealthCare Central
    </div>

    <a href="../patient/dashboard.php" class="nav-link">
        Dashboard
    </a>

</div>


<div class="container">

    <div class="appointment-card">

        <?php if ($bookingComplete) { ?>

            <div class="success">

                <div class="success-icon">
                    ✓
                </div>

                <h1>
                    Appointment Request Submitted
                </h1>

                <p>
                    Your appointment details have been received.
                    The appointment will be saved to the system once
                    the database connection is completed.
                </p>

                <div class="booking-details">

                    <p>
                        <strong>Doctor ID:</strong>
                        <?php echo htmlspecialchars($doctorID); ?>
                    </p>

                    <p>
                        <strong>Date:</strong>
                        <?php echo htmlspecialchars($appointmentDate); ?>
                    </p>

                    <p>
                        <strong>Time:</strong>
                        <?php echo htmlspecialchars($appointmentTime); ?>
                    </p>

                    <p>
                        <strong>Appointment Type:</strong>
                        <?php echo htmlspecialchars($appointmentType); ?>
                    </p>

                </div>

                <a
                    href="../doctor_search/index.php"
                    class="button submit-button"
                >
                    Back to Doctor Search
                </a>

            </div>

        <?php } else { ?>

            <h1>
                Book an Appointment
            </h1>

            <p class="subtitle">
                Select your preferred date, time, and appointment type.
            </p>


            <div class="doctor-info">

                <strong>
                    Selected Doctor
                </strong>

                <br>

                Doctor ID:
                <?php echo htmlspecialchars($doctorID); ?>

            </div>


            <?php if (!empty($errors)) { ?>

                <div class="errors">

                    <ul>

                        <?php foreach ($errors as $error) { ?>

                            <li>
                                <?php echo htmlspecialchars($error); ?>
                            </li>

                        <?php } ?>

                    </ul>

                </div>

            <?php } ?>


            <form method="POST" action="book.php?doctor_id=<?php echo $doctorID; ?>">

                <input
                    type="hidden"
                    name="doctor_id"
                    value="<?php echo $doctorID; ?>"
                >


                <div class="form-group">

                    <label for="appointment_date">
                        Appointment Date
                    </label>

                    <input
                        type="date"
                        id="appointment_date"
                        name="appointment_date"
                        min="<?php echo date('Y-m-d'); ?>"
                        value="<?php echo htmlspecialchars($_POST['appointment_date'] ?? ''); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="appointment_time">
                        Preferred Time
                    </label>

                    <input
                        type="time"
                        id="appointment_time"
                        name="appointment_time"
                        value="<?php echo htmlspecialchars($_POST['appointment_time'] ?? ''); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Appointment Type
                    </label>

                    <div class="type-options">

                        <div class="type-option">

                            <input
                                type="radio"
                                id="online"
                                name="appointment_type"
                                value="Online"
                                required
                            >

                            <label for="online">
                                Online
                            </label>

                        </div>


                        <div class="type-option">

                            <input
                                type="radio"
                                id="offline"
                                name="appointment_type"
                                value="Offline"
                                required
                            >

                            <label for="offline">
                                Offline
                            </label>

                        </div>

                    </div>

                </div>


                <div class="button-group">

                    <a
                        href="../doctor_search/profile.php?id=<?php echo $doctorID; ?>"
                        class="button back-button"
                    >
                        Back
                    </a>

                    <button
                        type="submit"
                        class="button submit-button"
                    >
                        Confirm Appointment
                    </button>

                </div>

            </form>

        <?php } ?>

    </div>

</div>

</body>

</html>