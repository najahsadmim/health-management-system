<?php

include "../config.php";

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {

    $searchTerm = "%" . $search . "%";

    $sql = "
        SELECT *
        FROM Doctor
        WHERE FullName LIKE ?
           OR Specialization LIKE ?
           OR Location LIKE ?
        ORDER BY FullName ASC
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sss",
        $searchTerm,
        $searchTerm,
        $searchTerm
    );

    $stmt->execute();

    $result = $stmt->get_result();

} else {

    $sql = "
        SELECT *
        FROM Doctor
        ORDER BY FullName ASC
    ";

    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Find Doctors</title>

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
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 25px;
        }

        h1 {
            color: #009f8b;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }

        .search-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px #ddd;
            margin-bottom: 35px;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-input {
            flex: 1;
            padding: 13px 16px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
        }

        .search-input:focus {
            border-color: #009f8b;
        }

        .search-button {
            background: #009f8b;
            color: white;
            border: none;
            padding: 13px 25px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
        }

        .search-button:hover {
            background: #008272;
        }

        .profile-button {
            display: inline-block;
            margin-top: 15px;
            padding: 11px 18px;
            background: #009f8b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        .profile-button:hover {
            background: #008272;
        }

        .clear-button {
            display: inline-block;
            margin-top: 12px;
            color: #009f8b;
            text-decoration: none;
            font-size: 14px;
        }

        .results-heading {
            margin-bottom: 20px;
            color: #333;
        }

        .doctor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px #ddd;
        }

        .card h2 {
            margin-top: 0;
            color: #009f8b;
        }

        .card p {
            margin: 10px 0;
            color: #555;
            line-height: 1.5;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .no-results {
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 5px 15px #ddd;
            color: #666;
        }

        @media (max-width: 600px) {

            .navbar {
                padding: 15px 20px;
            }

            .container {
                padding: 30px 15px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-button {
                width: 100%;
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

    <h1>
        Find a Doctor
    </h1>

    <p class="subtitle">
        Search for doctors by name, specialization, or location.
    </p>

    <div class="search-box">

        <form method="GET" action="index.php" class="search-form">

            <input
                type="text"
                name="search"
                class="search-input"
                placeholder="Search doctor, specialization or location..."
                value="<?php echo htmlspecialchars($search); ?>"
            >

            <button
                type="submit"
                class="search-button"
            >
                Search
            </button>

        </form>

        <?php if ($search !== '') { ?>

            <a href="index.php" class="clear-button">
                Clear Search
            </a>

        <?php } ?>

    </div>

    <?php if ($search !== '') { ?>

        <h2 class="results-heading">
            Search results for:
            "<?php echo htmlspecialchars($search); ?>"
        </h2>

    <?php } else { ?>

        <h2 class="results-heading">
            Available Doctors
        </h2>

    <?php } ?>

    <?php if ($result && $result->num_rows > 0) { ?>

        <div class="doctor-grid">

            <?php while ($doctor = $result->fetch_assoc()) { ?>

                <div class="card">

                    <h2>
                        Dr.
                        <?php echo htmlspecialchars($doctor['FullName']); ?>
                    </h2>

                    <p>
                        <span class="label">
                            Specialization:
                        </span>

                        <?php echo htmlspecialchars($doctor['Specialization']); ?>
                    </p>

                    <p>
                        <span class="label">
                            Qualification:
                        </span>

                        <?php echo htmlspecialchars($doctor['Qualification']); ?>
                    </p>

                    <p>
                        <span class="label">
                            Experience:
                        </span>

                        <?php echo htmlspecialchars($doctor['Experience']); ?>
                        years
                    </p>

                    <p>
                        <span class="label">
                            Location:
                        </span>

                        <?php echo htmlspecialchars($doctor['Location']); ?>
                    </p>

                    <p>
                        <span class="label">
                            Consultation Fee:
                        </span>

                        ৳<?php echo htmlspecialchars($doctor['ConsultationFee']); ?>
                    </p>

                    <p>
                        <span class="label">
                            Available Time:
                        </span>

                        <?php echo htmlspecialchars($doctor['AvailableTime']); ?>
                    </p>

                    <a
                        href="profile.php?id=<?php echo $doctor['DoctorID']; ?>"
                        class="profile-button"
                    >
                        View Profile
                    </a>

                </div>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="no-results">

            <h3>No doctors found</h3>

            <p>
                Try searching for a different doctor name,
                specialization, or location.
            </p>

        </div>

    <?php } ?>

</div>

</body>

</html>