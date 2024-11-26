<?php
require_once './Backend/config/db.php';

//$test = new sessionLogging();
//$test->sessionDuration(1, '02:01:00', '03:01:00');

class sessionLogging{

    function getSession() {
        
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM sessions";
        $stmt = $conn->prepare($query);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function sessionDuration($sessionnumber){

        $conn = Database::getInstance()->getConnection();
        $query = "SELECT end_time, start_time FROM sessions WHERE sessionnumber = '$sessionnumber'";
        $stmt = $conn->prepare($query);
        $stmt -> execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $end = strtotime($row['end_time']);
        $start = strtotime($row['start_time']);
        
        $duration = abs($end-$start);           //Gets difference between times
        $duration = date('H:i:s', $duration);   //Turns into date
        
    }
}
