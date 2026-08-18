<?php

$medicines = [
    1 => [
        "name" => "Napa",
        "generic" => "Paracetamol",
        "strength" => "500 mg"
    ],
    2 => [
        "name" => "Napa Extra",
        "generic" => "Paracetamol + Caffeine",
        "strength" => "500 mg + 65 mg"
    ],
    3 => [
        "name" => "Ace",
        "generic" => "Paracetamol",
        "strength" => "500 mg"
    ],
    4 => [
        "name" => "Seclo",
        "generic" => "Omeprazole",
        "strength" => "20 mg"
    ],
    5 => [
        "name" => "Napa Extend",
        "generic" => "Paracetamol",
        "strength" => "665 mg"
    ],
    6 => [
        "name" => "Losectil",
        "generic" => "Omeprazole",
        "strength" => "20 mg"
    ]
];

$sellers = [
    1 => [
        [
            "name" => "Arogga",
            "price" => 18,
            "link" => "https://www.arogga.com/"
        ],
        [
            "name" => "ePharma",
            "price" => 20,
            "link" => "https://epharma.com.bd/"
        ],
        [
            "name" => "MedEasy",
            "price" => 22,
            "link" => "https://medeasy.health/"
        ],
        [
            "name" => "Osudpotro",
            "price" => 19,
            "link" => "https://osudpotro.com/"
        ]
    ],

    2 => [
        [
            "name" => "Arogga",
            "price" => 35,
            "link" => "https://www.arogga.com/"
        ],
        [
            "name" => "ePharma",
            "price" => 37,
            "link" => "https://epharma.com.bd/"
        ],
        [
            "name" => "MedEasy",
            "price" => 39,
            "link" => "https://medeasy.health/"
        ]
    ],

    3 => [
        [
            "name" => "Arogga",
            "price" => 12,
            "link" => "https://www.arogga.com/"
        ],
        [
            "name" => "ePharma",
            "price" => 14,
            "link" => "https://epharma.com.bd/"
        ],
        [
            "name" => "Osudpotro",
            "price" => 13,
            "link" => "https://osudpotro.com/"
        ]
    ],

    4 => [
        [
            "name" => "Arogga",
            "price" => 45,
            "link" => "https://www.arogga.com/"
        ],
        [
            "name" => "ePharma",
            "price" => 47,
            "link" => "https://epharma.com.bd/"
        ],
        [
            "name" => "MedEasy",
            "price" => 50,
            "link" => "https://medeasy.health/"
        ]
    ],

    5 => [
        [
            "name" => "Arogga",
            "price" => 25,
            "link" => "https://www.arogga.com/"
        ],
        [
            "name" => "ePharma",
            "price" => 27,
            "link" => "https://epharma.com.bd/"
        ],
        [
            "name" => "MedEasy",
            "price" => 29,
            "link" => "https://medeasy.health/"
        ]
    ],

    6 => [
        [
            "name" => "Arogga",
            "price" => 42,
            "link" => "https://www.arogga.com/"
        ],
        [
            "name" => "ePharma",
            "price" => 44,
            "link" => "https://epharma.com.bd/"
        ],
        [
            "name" => "Osudpotro",
            "price" => 43,
            "link" => "https://osudpotro.com/"
        ]
    ]
];

/* will be put into database later; remove when done */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid medicine.");
}

$medicineID = (int) $_GET['id'];

if (!isset($medicines[$medicineID])) {
    die("Medicine not found.");
}

$medicine = $medicines[$medicineID];

$medicineSellers = $sellers[$medicineID] ?? [];

usort($medicineSellers, function ($a, $b) {
    return $a['price'] <=> $b['price'];
});

$lowestPrice = null;

if (count($medicineSellers) > 0) {
    $lowestPrice = $medicineSellers[0]['price'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Medicine Prices</title>

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
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 25px;
        }

        .medicine-header {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px #ddd;
            margin-bottom: 30px;
        }

        .medicine-header h1 {
            margin: 0 0 10px;
            color: #009f8b;
        }

        .medicine-info {
            color: #666;
            margin: 7px 0;
        }

        .comparison-heading {
            margin-bottom: 20px;
        }

        .lowest-price {
            background: #e4faf6;
            border: 1px solid #b9eee4;
            padding: 18px 22px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .lowest-price strong {
            color: #009f8b;
        }

        .seller-list {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px #ddd;
            overflow: hidden;
        }

        .seller-row {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            align-items: center;
            gap: 20px;
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
        }

        .seller-row:last-child {
            border-bottom: none;
        }

        .seller-header {
            background: #f7fffd;
            font-weight: bold;
            color: #333;
        }

        .seller-name {
            font-weight: bold;
            color: #333;
        }

        .price {
            color: #009f8b;
            font-weight: bold;
        }

        .buy-button {
            display: inline-block;
            padding: 10px 18px;
            background: #009f8b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
        }

        .buy-button:hover {
            background: #008272;
        }

        .cheapest {
            background: #f3fffc;
        }

        .cheapest-badge {
            display: inline-block;
            margin-left: 8px;
            padding: 4px 8px;
            background: #d7f6ef;
            color: #008272;
            border-radius: 5px;
            font-size: 11px;
        }

        .back-button {
            display: inline-block;
            margin-top: 25px;
            padding: 11px 20px;
            background: #eee;
            color: #444;
            text-decoration: none;
            border-radius: 8px;
        }

        .no-sellers {
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

            .seller-row {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .seller-header {
                display: none;
            }

            .buy-button {
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

    <div class="medicine-header">

        <h1>
            <?php echo htmlspecialchars($medicine['name']); ?>
        </h1>

        <p class="medicine-info">
            <strong>Generic Name:</strong>
            <?php echo htmlspecialchars($medicine['generic']); ?>
        </p>

        <p class="medicine-info">
            <strong>Strength:</strong>
            <?php echo htmlspecialchars($medicine['strength']); ?>
        </p>

    </div>


    <h2 class="comparison-heading">
        Compare Prices & Sellers
    </h2>


    <?php if ($lowestPrice !== null) { ?>

        <div class="lowest-price">

            <strong>
                Lowest Price:
            </strong>

            ৳<?php echo htmlspecialchars($lowestPrice); ?>

        </div>


        <div class="seller-list">

            <div class="seller-row seller-header">

                <div>
                    Seller
                </div>

                <div>
                    Price
                </div>

                <div>
                    Purchase
                </div>

            </div>


            <?php foreach ($medicineSellers as $index => $seller) { ?>

                <div
                    class="seller-row <?php echo $index === 0 ? 'cheapest' : ''; ?>"
                >

                    <div class="seller-name">

                        <?php echo htmlspecialchars($seller['name']); ?>

                        <?php if ($index === 0) { ?>

                            <span class="cheapest-badge">
                                Lowest Price
                            </span>

                        <?php } ?>

                    </div>


                    <div class="price">

                        ৳<?php echo htmlspecialchars($seller['price']); ?>

                    </div>


                    <div>

                        <a
                            href="<?php echo htmlspecialchars($seller['link']); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="buy-button"
                        >
                            Buy Online
                        </a>

                    </div>

                </div>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="no-sellers">

            <h3>
                No sellers available
            </h3>

            <p>
                There are currently no purchase options for this medicine.
            </p>

        </div>

    <?php } ?>


    <a
        href="index.php"
        class="back-button"
    >
        Back to Medicine Search
    </a>

</div>

</body>

</html>