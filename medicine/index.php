<?php

$medicines = [
    [
        "id" => 1,
        "name" => "Napa",
        "generic" => "Paracetamol",
        "strength" => "500 mg"
    ],
    [
        "id" => 2,
        "name" => "Napa Extra",
        "generic" => "Paracetamol + Caffeine",
        "strength" => "500 mg + 65 mg"
    ],
    [
        "id" => 3,
        "name" => "Ace",
        "generic" => "Paracetamol",
        "strength" => "500 mg"
    ],
    [
        "id" => 4,
        "name" => "Seclo",
        "generic" => "Omeprazole",
        "strength" => "20 mg"
    ],
    [
        "id" => 5,
        "name" => "Napa Extend",
        "generic" => "Paracetamol",
        "strength" => "665 mg"
    ],
    [
        "id" => 6,
        "name" => "Losectil",
        "generic" => "Omeprazole",
        "strength" => "20 mg"
    ]
];

/*above list can be removed and replaced with database tables later*/

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$results = [];

if ($search !== '') {

    foreach ($medicines as $medicine) {

        $searchTerm = strtolower($search);

        if (
            strpos(strtolower($medicine['name']), $searchTerm) !== false ||
            strpos(strtolower($medicine['generic']), $searchTerm) !== false ||
            strpos(strtolower($medicine['strength']), $searchTerm) !== false
        ) {
            $results[] = $medicine;
        }
    }

} else {

    $results = $medicines;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Medicine Search</title>

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

        .medicine-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .medicine-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px #ddd;
        }

        .medicine-card h2 {
            margin-top: 0;
            margin-bottom: 18px;
            color: #009f8b;
        }

        .medicine-detail {
            margin: 10px 0;
            color: #555;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .compare-button {
            display: inline-block;
            margin-top: 15px;
            padding: 11px 18px;
            background: #009f8b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        .compare-button:hover {
            background: #008272;
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
        Search Medicines
    </h1>

    <p class="subtitle">
        Search for medicines by name, generic name, or strength.
    </p>

    <div class="search-box">

        <form method="GET" action="index.php" class="search-form">

            <input
                type="text"
                name="search"
                class="search-input"
                placeholder="Search medicine, generic name or strength..."
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
            Available Medicines
        </h2>

    <?php } ?>

    <?php if (count($results) > 0) { ?>

        <div class="medicine-grid">

            <?php foreach ($results as $medicine) { ?>

                <div class="medicine-card">

                    <h2>
                        <?php echo htmlspecialchars($medicine['name']); ?>
                    </h2>

                    <p class="medicine-detail">

                        <span class="label">
                            Generic Name:
                        </span>

                        <?php echo htmlspecialchars($medicine['generic']); ?>

                    </p>

                    <p class="medicine-detail">

                        <span class="label">
                            Strength:
                        </span>

                        <?php echo htmlspecialchars($medicine['strength']); ?>

                    </p>

                    <a
                        href="#"
                        class="compare-button"
                    >
                        Compare Prices
                    </a>

                </div>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="no-results">

            <h3>
                No medicines found
            </h3>

            <p>
                Try searching for a different medicine name,
                generic name, or strength.
            </p>

        </div>

    <?php } ?>

</div>

</body>

</html>