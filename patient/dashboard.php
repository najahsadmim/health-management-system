<?php

session_start();


// Make sure the user is logged in

if (!isset($_SESSION["UserID"])) {

    header("Location: login.html");

    exit();

}


// Only Patients can access this page

if ($_SESSION["UserType"] != "Patient") {

    header("Location: login.html");

    exit();

}


$fullname = $_SESSION["FullName"];

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Patient Dashboard | HealthCare Central</title>


    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }


        body {
            background: #f6fbfa;
            color: #102a2a;
        }


        /* NAVBAR */

        .navbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5eeee;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 40px;
        }


        .logo {
            display: flex;
            align-items: center;
            gap: 10px;

            font-size: 20px;
            font-weight: bold;
            color: #102a2a;
        }


        .logo-icon {
            width: 32px;
            height: 32px;

            background: #079b91;
            color: white;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
        }


        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }


        .welcome {
            color: #5e7171;
            font-size: 14px;
        }


        .logout {
            background: #079b91;
            color: white;

            padding: 10px 18px;

            border-radius: 8px;

            text-decoration: none;

            font-size: 13px;
            font-weight: bold;
        }


        .logout:hover {
            background: #05877f;
        }


        /* MAIN */

        .container {
            width: 92%;
            max-width: 1200px;

            margin: 45px auto;
        }


        .welcome-section {
            margin-bottom: 35px;
        }


        .welcome-section h1 {
            font-size: 34px;
            margin-bottom: 10px;
        }


        .welcome-section p {
            color: #718080;
            font-size: 15px;
        }


        /* SEARCH */

        .search-box {
            background: #e8faf7;

            padding: 30px;

            border-radius: 20px;

            margin-bottom: 35px;
        }


        .search-box h2 {
            margin-bottom: 8px;
            font-size: 22px;
        }


        .search-box p {
            color: #718080;
            margin-bottom: 20px;
            font-size: 14px;
        }


        .search-row {
            display: flex;
            gap: 10px;
        }


        .search-row input {
            flex: 1;

            padding: 15px;

            border: 1px solid #d8e5e3;

            border-radius: 9px;

            font-size: 14px;

            outline: none;
        }


        .search-row button {
            padding: 15px 25px;

            border: none;

            background: #079b91;

            color: white;

            border-radius: 9px;

            font-weight: bold;

            cursor: pointer;
        }


        /* CARDS */

        .section-title {
            font-size: 24px;
            margin-bottom: 20px;
        }


        .cards {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;
        }


        .card {
            background: white;

            border: 1px solid #e1eaea;

            border-radius: 18px;

            padding: 25px;

            min-height: 200px;

            box-shadow:
                0 5px 20px
                rgba(18, 70, 67, 0.05);
        }


        .card-icon {
            width: 48px;
            height: 48px;

            background: #e4f7f4;

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 23px;

            margin-bottom: 18px;
        }


        .card h3 {
            margin-bottom: 10px;

            font-size: 19px;
        }


        .card p {
            color: #718080;

            font-size: 14px;

            line-height: 1.6;

            margin-bottom: 18px;
        }


        .card-button {
            display: inline-block;

            width: 100%;

            text-align: center;

            padding: 11px;

            border: 1px solid #dbe8e6;

            border-radius: 8px;

            text-decoration: none;

            color: #102a2a;

            font-size: 13px;

            font-weight: bold;
        }


        .card-button:hover {
            background: #e8faf7;
        }


        /* RESPONSIVE */

        @media (max-width: 800px) {

            .cards {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 0 20px;
            }

            .container {
                width: 90%;
            }

            .search-row {
                flex-direction: column;
            }

        }

    </style>

</head>


<body>


<!-- NAVBAR -->

<nav class="navbar">


    <div class="logo">

        <div class="logo-icon">
            ♥
        </div>

        HealthCare
        <span style="color:#079b91;">
            Central
        </span>

    </div>


    <div class="nav-right">

        <div class="welcome">

            Welcome,
            <?php echo htmlspecialchars($fullname); ?>

        </div>


        <a
         href="../logout.php"
          class="logout">

          Sign out

     </a>

    </div>


</nav>



<!-- MAIN CONTENT -->

<div class="container">


    <div class="welcome-section">

        <h1>
            Your health, one platform.
        </h1>

        <p>
            Find doctors, medicines, caregivers and
            ambulance services from one place.
        </p>

    </div>



    <!-- SEARCH -->

    <div class="search-box">

        <h2>
            What are you looking for?
        </h2>

        <p>
            Search for a disease, symptom or health service.
        </p>


        <div class="search-row">

            <input
                type="text"
                placeholder="e.g. headache, diabetes, cardiologist...">


            <button>
                Search
            </button>

        </div>

    </div>



    <!-- SERVICES -->

    <h2 class="section-title">
        Healthcare Services
    </h2>


    <div class="cards">


        <!-- DOCTORS -->

        <div class="card">

            <div class="card-icon">
                ♡
            </div>

            <h3>
                Find a Doctor
            </h3>

            <p>
                Search doctors by specialty,
                location and availability.
            </p>

            <a
                href="#"
                class="card-button">

                Browse Doctors →

            </a>

        </div>



        <!-- MEDICINE -->

        <div class="card">

            <div class="card-icon">
                +
            </div>

            <h3>
                Find Medicine
            </h3>

            <p>
                Search medicines and compare
                prices from different sellers.
            </p>

            <a
                href="#"
                class="card-button">

                Search Medicine →

            </a>

        </div>



        <!-- AMBULANCE -->

        <div class="card">

            <div class="card-icon">
                🚑
            </div>

            <h3>
                Ambulance
            </h3>

            <p>
                Find available ambulance services
                near your location.
            </p>

            <a
                href="#"
                class="card-button">

                Find Ambulance →

            </a>

        </div>



        <!-- CAREGIVER -->

        <div class="card">

            <div class="card-icon">
                +
            </div>

            <h3>
                Caregiver & Nurse
            </h3>

            <p>
                Find caregivers and nurses
                based on your requirements.
            </p>

            <a
                href="#"
                class="card-button">

                Find Caregiver →

            </a>

        </div>



        <!-- APPOINTMENTS -->

        <div class="card">

            <div class="card-icon">
                ✓
            </div>

            <h3>
                My Appointments
            </h3>

            <p>
                View and manage your
                upcoming doctor appointments.
            </p>

            <a
                href="#"
                class="card-button">

                View Appointments →

            </a>

        </div>



        <!-- PROFILE -->

        <div class="card">

            <div class="card-icon">
                ●
            </div>

            <h3>
                My Profile
            </h3>

            <p>
                View and manage your
                personal account information.
            </p>

            <a
                href="#"
                class="card-button">

                View Profile →

            </a>

        </div>


    </div>


</div>


</body>

</html>