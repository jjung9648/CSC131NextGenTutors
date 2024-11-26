<?php
require_once __DIR__ . '/../config/db.php';

class SessionScheduling {
    function getSession() {

        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM sessions";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getTutors() {

        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM tutors";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getStudents() {

        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM students";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function createSession($sessionname, $tutor_id, $student_id, $student_name, $tutor_name, $start_time, $end_time, $dateSet) {

        $start= date('H:i:s', strtotime($start_time));
        $end= date('H:i:s', strtotime($end_time));
        $date= date('Y-m-d', strtotime($dateSet));
        $safe = 1;

        $conn = Database::getInstance()->getConnection();
        $query = "SELECT start_time, end_time FROM sessions WHERE tutor_id = '$tutor_id' AND date = '$dateSet'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        while(($row = $stmt->fetch(PDO::FETCH_ASSOC)) && ($safe == 1)) {
            if(($row['start_time'] <= $end) && ($row['end_time'] >= $start)) {
                echo "There is a conflicting scheduled session... Try again.";
                $safe = 0;
                return;
            }
        }

        if($safe == 1) {
            echo "Success.. Creating session...";
            $query = "INSERT INTO sessions (sessionname, tutor_id, student_id, student_name, tutor_name, start_time, end_time, date) VALUES ('$sessionname', '$tutor_id', '$student_id', '$student_name', '$tutor_name', '$start', '$end', '$date')";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            echo "This is your session number: ";
            echo $conn->lastInsertId('sessionnumber');
            return;
        }
    }

    function deleteSession($tutor_id, $student_id, $sessionnumber) {
   
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM sessions WHERE tutor_id = '$tutor_id' AND student_id = '$student_id' AND sessionnumber = '$sessionnumber'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $query = "DELETE FROM sessions WHERE tutor_id = '$tutor_id' AND student_id = '$student_id' AND sessionnumber = '$sessionnumber'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            echo "Session cancelled.";
            return;
        }
        else {
            echo "No session found.." ;
            return;
        }
    }
}
?>
