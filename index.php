<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>CSV Data Handler</title>
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
            width: 200px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .container {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CSV Data Handler</h1>

        <div class="button-container">
          
            <form action="add.php" method="get">
                <button type="submit">Add New Entry</button>
            </form>

            <form action="export.php" method="get">
                <button type="submit">Export CSV</button>
            </form>

            <form action="import.php" method="get">
                <button type="submit">View CSV Data</button>
            </form>
            </form>
        </div>
    </div>
</body>
</html>
