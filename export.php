<?php
// CSV-tiedoston nimi
$filename = "data_export.csv";

// Tarkistetaan, että tiedosto on olemassa ja luettavissa
if (!file_exists($filename) || !is_readable($filename)) {
    die("File not found or is not readable.");
}

// Headerit tiedoston latausta varten
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="' . $filename . '"');

// Avataan CSV-tiedosto lukemista varten
$file = fopen($filename, 'r');

// Avataan tulostusvirta selaimeen CSV-muodossa
$output = fopen('php://output', 'w');

// Luetaan tiedoston sisältö rivi riviltä ja tulostetaan selaimelle CSV-muodossa
while (($row = fgetcsv($file, 1000, ",")) !== false) {
    fputcsv($output, $row);
}

// Suljetaan tiedosto
fclose($file);
fclose($output);
exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Export CSV</title>
    <style>
        .button-container {
            margin: 20px 0;
        }

        .button-container form {
            margin-bottom: 10px;
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
        <h1>CSV Export Completed</h1>
        
        <!-- Button navigation -->
        <div class="button-container">
            <form action="import.php" method="get">
                <button type="submit">View CSV Data</button>
            </form>
            <form action="add.php" method="get">
                <button type="submit">Add New Entry</button>
            </form>
        </div>
    </div>
</body>
</html>
