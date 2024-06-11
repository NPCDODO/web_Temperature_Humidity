<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Temperature/Humidity</title>
<style>
    body {
        background-color: #f0f2f5;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    #top-bar {
    display: flex;
    justify-content: space-between; /* จัดเรียงทางขวาและทางซ้าย */
    align-items: center; /* จัดให้ข้อความอยู่กึ่งกลางตามแนวตั้ง */
    background-color: #000;
    color: #fff;
    padding: 10px 20px; /* เพิ่ม padding ทางขวาซ้าย */
}

#top-bar h1, #top-bar h2 {
    margin: 0;
    color: #fff;
}

#top-bar h1 {
    flex: 1; /* ทำให้ h1 ยืดความกว้างเต็มพื้นที่ที่เหลือ */
    text-align: left;
}

#top-bar h2 {
    text-align: right;
    margin-left: 20px; /* เพิ่มระยะห่างระหว่าง "Latest Data" และ "ALL Data" */
}

    #data-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin: 4%;
    }
    .device-container { /*แก้Widget*/
        background-color: 08BEBB;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        width: 250px;
        margin: 10px;
        transition: transform 0.3s;
    }
    .device-container:hover {
        transform: translateY(-5px);
    }
    h2 {
        margin-top: 0;
        text-align: center;
        font-size: 1.2em;
        color: #333;
    }
    .data-item {
        font-size: 1.2em;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #ccc;
        vertical-align: middle;
        margin-right: 5px;
    }
    .data-item div {
        margin: 5px 0;
        color: #555;

    }
    .temperature {
        color: #333;
    }
    .high-temp {
        color: red;
    }
   #chart-container {
        width: 90%;
        margin: 0 auto; /* จัดตำแหน่งกราฟให้อยู่ตรงกลาง */
        margin-top: 40px;
    }
    #myChart {
    width: 100%;
    height: 600px; /* ปรับความสูงตามความต้องการ */
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 20px;
}

</style>
</head>
<body>
    <div id='top-bar'>
        <h1>Temperature/Humidity</h1>
        <h2><a href="index.php"  style="color: white;">Latest Data</a></h2>
        <h2><a href="alldata.php"  style="color: white;">ALL Data</a></h2>
    </div>

<div id='data-container'>
<?php
include 'db_connect.php';

$sql = "SELECT * FROM dataset ORDER BY time ASC";
$result = $con->query($sql);

$dataGrouped = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $device_id = $row['device_id'];
        if (!isset($dataGrouped[$device_id])) {
            $dataGrouped[$device_id] = [];
        }
        $dataGrouped[$device_id][] = $row;
    }
}

foreach ($dataGrouped as $device_id => $deviceData) {
    echo "<div class='device-container'>";
    echo "<h2>Sensor: $device_id</h2>";

    // Get the latest data for this sensor
    $latestData = end($deviceData);
    
    // Ensure that latestData is not false (in case $deviceData is empty)
    if ($latestData !== false) {
        $time = date('Y-m-d H:i:s', strtotime($latestData['time']));
        $temperature = null;
        $humidity = null;

        // Find the latest temperature and humidity data for this sensor
        foreach ($deviceData as $data) {
            if ($data['key'] == 'Temperature') {
                $temperature = $data['data'];
            } elseif ($data['key'] == 'Humidity') {
                $humidity = $data['data'];
            }
        }

        // Display the data if it exists
        $tempClass = ($temperature > 30) ? 'high-temp' : '';
        echo "<div class='data-item'>";
        echo "<div style='padding-left: 5px;'><strong><img src='img/Time.png'> Time:</strong> $time</div>";
        if ($temperature !== null) {
           echo "<div class='temperature $tempClass' style='font-size: 20px;'><img src='img/Temperature.png' style='margin-right: 5px;'><strong>Temperature:</strong> $temperature °C</div>";
        }
        if ($humidity !== null) {
          echo "<div style='font-size: 20px;'><img src='img/Humidity.png' style='margin-right: 5px;'><strong>Humidity:</strong> $humidity %</div>";
        }
        echo "</div>";
    } else {
        echo "<div class='data-item'>No data available</div>";
    }

    echo "</div>";
}
echo "</div>";

// Reset result pointer
$result->data_seek(0);

// Chart Data
$timeLabels = [];
$temperatureData = [[], [], [], [], []];
$humidityData = [[], [], [], [], []];

while($row = $result->fetch_assoc()) {
    // Time Labels
    $time = date("H:i:s", strtotime($row['time']));
    $timeLabels[] = $time;

    // Temperature and Humidity Data
    if ($row['key'] == 'Temperature') {
        $index = intval(substr($row['device_id'], -1)) - 1;
        $temperatureData[$index][] = $row['data'];
    } elseif ($row['key'] == 'Humidity') {
        $index = intval(substr($row['device_id'], -1)) - 1;
        $humidityData[$index][] = $row['data'];
    }
}

$con->close();

// Limit the number of data points displayed on the chart
$limit = 10; // Change this value to display more or fewer data points

$timeLabels = array_slice($timeLabels, -$limit);
for ($i = 0; $i < count($temperatureData); $i++) {
    $temperatureData[$i] = array_slice($temperatureData[$i], -$limit);
    $humidityData[$i] = array_slice($humidityData[$i], -$limit);
}
?>
</div>

<div id="chart-container">
    <canvas id="myChart"></canvas>
</div>

<script>
// JavaScript เพื่อเปลี่ยนสีของข้อความ Temperature เมื่อมีค่ามากกว่า 30°C
document.addEventListener('DOMContentLoaded', function() {
    var temperatureLabels = document.querySelectorAll('.temperature');

    temperatureLabels.forEach(function(label) {
        var temperatureText = label.textContent;
        var temperature = parseFloat(temperatureText.split(' ')[1]);

        if (temperature > 30) {
            label.style.color = 'red';
        }
    });
});

// JavaScript เพื่อโหลดหน้าเว็บใหม่ทุก 60 วินาที
setInterval(function() {
    location.reload();
}, 60000); // 60000 มิลลิวินาที = 60 วินาที

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($timeLabels); ?>,
        datasets: [
            {
                label: 'Temperature 1',
                data: <?php echo json_encode($temperatureData[0]); ?>,
                fill: false,
                borderColor: 'rgb(255, 99, 132)'
            },
            {
                label: 'Humidity 1',
                data: <?php echo json_encode($humidityData[0]); ?>,
                fill: false,
                borderColor: 'rgb(54, 162, 235)'
            },
            {
                label: 'Temperature 2',
                data: <?php echo json_encode($temperatureData[1]); ?>,
                fill: false,
                borderColor: 'rgb(255, 159, 64)'
            },
            {
                label: 'Humidity 2',
                data: <?php echo json_encode($humidityData[1]); ?>,
                fill: false,
                borderColor: 'rgb(75, 192, 192)'
            },
            {
                label: 'Temperature 3',
                data: <?php echo json_encode($temperatureData[2]); ?>,
                fill: false,
                borderColor: 'rgb(255, 205, 86)'
            },
            {
                label: 'Humidity 3',
                data: <?php echo json_encode($humidityData[2]); ?>,
                fill: false,
                borderColor: 'rgb(153, 102, 255)'
            },
            {
                label: 'Temperature 4',
                data: <?php echo json_encode($temperatureData[3]); ?>,
                fill: false,
                borderColor: 'rgb(201, 170, 207)'
            },
            {
                label: 'Humidity 4',
                data: <?php echo json_encode($humidityData[3]); ?>,
                fill: false,
                borderColor: 'rgb(255, 99, 132, 0.6)'
            },
            {
                label: 'Temperature 5',
                data: <?php echo json_encode($temperatureData[4]); ?>,
                fill: false,
                borderColor: 'rgb(54, 162, 235, 0.6)'
            },
            {
                label: 'Humidity 5',
                data: <?php echo json_encode($humidityData[4]); ?>,
                fill: false,
                borderColor: 'rgb(75, 192, 192, 0.6)'
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>
