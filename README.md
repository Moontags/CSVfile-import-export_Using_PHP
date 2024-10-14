# CSV Import and Export Handler with PHP

## Overview

This project is a PHP-based system that handles CSV file import and export operations. Users can add, view, and delete data from a CSV file.

## Features

- Add new data entries to CSV.
- View CSV data in a table format.
- Delete individual rows from CSV.
- Export CSV file for download.

## Project Screenshots

Here are some screenshots of the project in action:

### 1. Start selection
![Add New Entry](image/step1.png)

### 2. Add New Entry
![View CSV Data](image/step2.png)

### 3. View CSV Data and Delete an Entry
![Delete an Entry](image/step3.png)

### 4. Export CSV Data
![Export CSV Data](image/step4.png)

## Video Demo

Watch a video demo of the project in action:

[Watch the video demo](https://youtu.be/yZtQudOa9tM)

## How to Use

1. **Add New Entry:** Navigate to `add.php` and fill out the form.
2. **View CSV Data:** Visit `import.php` to view the current CSV data.
3. **Delete a Row:** Click the delete button next to any row in the table.
4. **Export CSV:** Download the CSV file by visiting `export.php`.

## Code Example

Here is a basic example of how the CSV data import functionality is implemented in PHP:

```php
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
