<?php
require_once '../Backend/config/db.php';
require_once '../Backend/includes/functions.php'; // Ensure this path is correct

$tutorId = 1; // Replace with the actual tutor ID
$data = getTutorData($tutorId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Performance</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Tutor Performance</h2>
    <?php if ($data['tutor']): ?>
        <h3><?php echo htmlspecialchars($data['tutor']['name']); ?></h3>
        <h4>Overall Grade: <?php echo round($data['overall_grade'], 2); ?></h4>
        
        <h4>Assignments:</h4>
        <table border="1">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['assignments'] as $assignment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($assignment['title']); ?></td>
                        <td><?php echo $assignment['grade']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Performance Graph:</h4>
        <canvas id="performanceChart" width="400" height="200"></canvas>
        <script>
            const ctx = document.getElementById('performanceChart').getContext('2d');
            const labels = <?php echo json_encode(array_column($data['assignments'], 'title')); ?>;
            const grades = <?php echo json_encode(array_column($data['assignments'], 'grade')); ?>;
            const performanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Grades',
                        data: grades,
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