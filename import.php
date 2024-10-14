<?php

$filename = 'data_export.csv';

if (!file_exists($filename) || !is_readable($filename)) {
    die("File not found or is not readable.");
}


$data = [];
if (($handle = fopen($filename, 'r')) !== false) {
    while (($row = fgetcsv($handle, 1000, ",")) !== false) {
        $data[] = $row; 
    }
    fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Import CSV Data</title>
    <style>
        .button-container {
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
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
            width: 150px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .container {
            text-align: center;
            padding: 20px;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            padding: 10px;
            border: 1px solid #ccc;
        }

        td:first-child {
            width: 300px;
        }

        .delete-btn {
            background-color: #DC3545;
            border: none;
            padding: 5px 10px;
            color: white;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CSV File Data</h1>
        <?php if (!empty($data)): ?>
            <table border="1">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($data as $index => $row): ?>
                    <tr>
                        <?php foreach ($row as $cell): ?>
                            <td><?php echo htmlspecialchars($cell); ?></td>
                        <?php endforeach; ?>
                        
                        <?php if ($index > 0): ?>
                            <td>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="row_index" value="<?php echo $index; ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No data found in the CSV file.</p>
        <?php endif; ?>

        <div class="button-container">
            <form action="export.php" method="get">
                <button type="submit">Export CSV</button>
            </form>
            <form action="add.php" method="get">
                <button type="submit">Add New Entry</button>
            </form>
        </div>
    </div>
</body>
</html>
