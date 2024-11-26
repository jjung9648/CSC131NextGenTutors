<?php

require_once __DIR__ . '/../includes/schedfunc.php';

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not authenticated
    header('Location: /Frontend/landing-page.html');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sessionname = $_POST['sessionname'];
    $tutor_id = $_POST['tutor_id'];
    $student_id = $_POST['student_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $dateSet = $_POST['dateSet'];
    $action = $_POST['action'];

    $scheduling = new SessionScheduling;

    if($action == 'create') {
       $scheduling->createSession($sessionname, $tutor_id, $student_id, $start_time, $end_time, $dateSet);
    } 
    else if($action == 'delete') {
        $scheduling->deleteSession($tutor_id, $student_id, $sessionnumber);
    }

}


?>

<form method="POST" action="">
    <h2>Create</h2>
        <input type="text" name="sessionname" placeholder="Session Name" required>
        <input type="number" name="tutor_id" placeholder="Tutor ID" required>
        <input type="number" name="student_id" placeholder="Student ID" required>
        <input type="text" name="start_time" placeholder="Start Time" required>
        <input type="text" name="end_time" placeholder="End Time" required>
        <input type="date" name="dateSet" placeholder="Set the Date" required>
        <input type="hidden" name="action" value="create">
    <button type="submit">Create</button>
</form>

<form method="POST" action="">
    <h2>Delete</h2>
        <input type="text" name="sessionname" placeholder="Session Name" required>
        <input type="number" name="tutor_id" placeholder="Tutor ID" required>
        <input type="number" name="student_id" placeholder="Student ID" required>
        <input type="hidden" name="action" value="delete">
    <button type="submit">Delete</button>
</form>
