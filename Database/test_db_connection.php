<?php
require_once '../Backend/config/db.php';
require_once '../Backend/includes/functions.php'; // Ensure this path is correct

$tutorId = 1; // Replace with the actual tutor ID
$data = getTutorHoursData($tutorId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Hours</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Tutor Hours</h2>
    <?php if ($data['tutor']): ?>
        <h3><?php echo htmlspecialchars($data['tutor']['name']); ?></h3>
        
        <h4>Hours per Week:</h4>
        <canvas id="hoursChart" width="400" height="200"></canvas>
        <script>
            const ctx = document.getElementById('hoursChart').getContext('2d');
            const labels = <?php echo json_encode(array_column($data['hours'], 'week_start')); ?>;
            const hours = <?php echo json_encode(array_column($data['hours'], 'hours')); ?>;
            const hoursChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Hours',
                        data: hours,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    <?php else: ?>
        <p>No data found for the specified tutor.</p>
    <?php endif; ?>
</body>
</html>