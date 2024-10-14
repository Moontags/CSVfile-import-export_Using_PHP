<?php

$filename = 'data_export.csv';

if (!file_exists($filename)) {
    die("File not found.");
}

if (isset($_POST['row_index'])) {
    $rowIndex = (int)$_POST['row_index'];

    $data = [];
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, ",")) !== false) {
            $data[] = $row;
        }
        fclose($handle);
    }

    if (isset($data[$rowIndex])) {
        unset($data[$rowIndex]);
        $data = array_values($data); 

        $file = fopen($filename, 'w');
        if ($file !== false) {
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }
    }

    header('Location: import.php');
    exit;
} else {
    die("Invalid request.");
}
?>
