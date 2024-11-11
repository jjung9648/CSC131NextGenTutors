<?php
require_once __DIR__ . '/../includes/functions.php';

$studentId = 1;

$studentData = getStudentData($studentId);
var_dump($studentData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome to My Website</h1>
    <h2>Student Information</h2>
    <?php if ($studentData['student']): ?>
        <p>Name: <?php echo htmlspecialchars($studentData['student']['name']); ?></p>
    <?php else: ?>
        <p>No student data found.</p>
    <?php endif; ?>
    <h2>Subjects</h2>
    <ul>
        <?php foreach ($studentData['subjects'] as $subject): ?>
            <li><?php echo htmlspecialchars($subject['subject']); ?> - Grade: <?php echo $subject['grade']; ?> - Tutor: <?php echo htmlspecialchars($subject['tutor']); ?> - Status: <?php echo htmlspecialchars($subject['status']); ?></li>
        <?php endforeach; ?>
    </ul>
    <h2>Overall Grade</h2>
    <p><?php echo round($studentData['overall_grade'], 2); ?></p>
</body>
</html>