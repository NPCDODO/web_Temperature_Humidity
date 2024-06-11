<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Temperature/Humidity</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        #top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
        }
        #top-bar h1, #top-bar h2 {
            margin: 0;
        }
        #top-bar h1 {
            flex: 1;
            text-align: left;
        }
        #top-bar h2 {
            text-align: right;
            margin-left: 20px;
        }
        #top-bar h2 a {
            color: white;
            text-decoration: none; 
        }
        .container {
            margin-top: 50px;
            padding: 0 20px;
        }
        .container h2 {
            margin-bottom: 20px;
            color: #333; 
            font-size: 1.5em;
        }
        .table-container {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .table th, .table td {
            padding: 8px; /* ปรับขนาดเซลล์ */
            border-bottom: 1px solid #ddd; 
            font-size: 14px; /* ปรับขนาดฟอนต์ */
        }
        .table th {
            background-color: #f2f2f2; 
            text-align: left;
            font-weight: bold;
            color: #333; 
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9; 
        }
        .table tr:hover {
            background-color: #f2f2f2; 
        }
    </style>
</head>
<body>
    <div id='top-bar'>
        <h1>Temperature/Humidity</h1>
        <h2><a href="index.php">Latest Data</a></h2>
        <h2><a href="alldata.php">ALL Data</a></h2>
    </div>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include 'db_connect.php';

    $sql = "SELECT * FROM dataset";
    $result = $con->query($sql);
    ?>
    <div class="container">
        <h2>Data ALL</h2>
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Time</th>
                        <th>Device ID</th>
                        <th>Key</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['time']}</td>
                                    <td>{$row['device_id']}</td>
                                    <td>{$row['key']}</td>
                                    <td>{$row['data']}</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
