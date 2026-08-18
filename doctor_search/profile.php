<?php

include "../config.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid doctor ID.");
}

$doctorID = (int) $_GET['id'];

$sql = "
    SELECT *
    FROM Doctor
    WHERE DoctorID = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctorID);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Doctor not found.");
}

$doctor = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Doctor Profile</title>

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
            max-width: 900px;
            margin: 0 auto;
            padding: 50px 25px;
        }

        .profile-card {
            background: white;
            border-radius: 18px;
            padding: 40px;
            box-shadow: 0 5px 18px #ddd;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .doctor-icon {
            width: 90px;
            height: 90px;
            background: #e4faf6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
        }

        .profile-header h1 {
            margin: 0 0 8px;
            color: #009f8b;
        }

        .specialization {
            color: #666;
            font-size: 17px;
        }

        .details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .detail {
            background: #f7fffd;
            padding: 18px;
            border-radius: 10px;
        }

        .label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 6px;
        }

        .value {
            color: #666;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 35px;
        }

        .button {
            text-decoration: none;
            padding: 13px 22px;
            border-radius: 10px;
            font-size: 15px;
            cursor: pointer;
        }

        .back-button {
            background: #eee;
            color: #444;
        }

        .appointment-button {
            background: #009f8b;
            color: white;
        }

        .appointment-button:hover {
            background: #008272;
        }

        @media (max-width: 600px) {

            .navbar {
                padding: 15px 20px;
            }

            .container {
                padding: 30px 15px;
            }

            .profile-card {
                padding: 25px;
            }

            .details {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
            }

            .button {
                text-align: center;
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

    <div class="profile-card">

        <div class="profile-header">

            <div class="doctor-icon">
                👨‍⚕️
            </div>

            <h1>
                Dr. <?php echo htmlspecialchars($doctor['FullName']); ?>
            </h1>

            <div class="specialization">
                <?php echo htmlspecialchars($doctor['Specialization']); ?>
            </div>

        </div>


        <div class="details">

            <div class="detail">

                <span class="label">
                    Registration Number
                </span>

                <span class="value">
                    <?php echo htmlspecialchars($doctor['RegistrationNo']); ?>
                </span>

            </div>


            <div class="detail">

                <span class="label">
                    Qualification
                </span>

                <span class="value">
                    <?php echo htmlspecialchars($doctor['Qualification']); ?>
                </span>

            </div>


            <div class="detail">

                <span class="label">
                    Experience
                </span>

                <span class="value">
                    <?php echo htmlspecialchars($doctor['Experience']); ?>
                    years
                </span>

            </div>


            <div class="detail">

                <span class="label">
                    Location
                </span>

                <span class="value">
                    <?php echo htmlspecialchars($doctor['Location']); ?>
                </span>

            </div>


            <div class="detail">

                <span class="label">
                    Consultation Fee
                </span>

                <span class="value">
                    ৳<?php echo htmlspecialchars($doctor['ConsultationFee']); ?>
                </span>

            </div>


            <div class="detail">

                <span class="label">
                    Available Time
                </span>

                <span class="value">
                    <?php echo htmlspecialchars($doctor['AvailableTime']); ?>
                </span>

            </div>

        </div>


        <div class="actions">

            <a
                href="index.php"
                class="button back-button"
            >
                Back to Doctors
            </a>

            <a
                href="../appointment/book.php?doctor_id=<?php echo $doctor['DoctorID']; ?>"
                class="button appointment-button"
            >
                Book Appointment
            </a>

        </div>

    </div>

</div>

</body>

</html>