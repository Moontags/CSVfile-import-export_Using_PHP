<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $quantity = $_POST['quantity'];

    $filename = 'data_export.csv';

    if (!file_exists($filename)) {
 
        $file = fopen($filename, 'w');
        if ($file === false) {
            die("Tiedoston luonti epäonnistui.");
        }
        fputcsv($file, ['Name', 'Email', 'Quantity']);
    } else {
      
        $file = fopen($filename, 'a');
        if ($file === false) {
            die("Tiedoston avaaminen epäonnistui.");
        }
    }

    fputcsv($file, [$name, $email, $quantity]);

 
    fclose($file);

    header('Location: add.php?success=1');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Add New Entry</title>
    <style>
        
        .container {
            text-align: center;
            padding: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin: 10px 0 5px;
        }

        input[type="text"], input[type="email"], input[type="number"] {
            padding: 10px;
            width: 300px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            width: 200px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Entry to CSV</h1>
        <?php if (isset($_GET['success'])): ?>
            <p>New data created successfully!</p>
            <form action="import.php" method="get">
                <button type="submit">View Imported Data</button>
            </form>
        <?php endif; ?>
        <form action="add.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <button type="submit">Add Entry</button>
        </form>
    </div>
</body>
</html>
