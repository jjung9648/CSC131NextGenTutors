<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'db.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (!isset($_SESSION['student_id'])) 
{
    header("Location: Login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

try 
{
    $db = Database::getInstance()->getConnection();

    $query = "
        SELECT DISTINCT courseName
        FROM session
        WHERE studentID = :student_id AND starttime > NOW()
        ORDER BY courseName ASC
        LIMIT 8
    ";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
    $stmt->execute();

    $courses = $stmt->fetchAll(PDO::FETCH_COLUMN);

} 
catch (PDOException $e) 
{
    die("Database error: " . $e->getMessage());
}

$HtmlFile = __DIR__ . '/studentdash.html';

if (file_exists($HtmlFile)) 
{
    $html = file_get_contents($HtmlFile);

    for ($i = 0; $i < 8; $i++) 
    {
        $placeholder = "get course from php(" . ($i + 1) . ")";
        $boxId = "#box" . ($i + 1);

        if (!empty($courses) && isset($courses[$i]) && $courses[$i] !== NULL) 
        {
            $html = str_replace($placeholder, htmlspecialchars($courses[$i]), $html);
        } 
        else 
        {
            $style = "<style>{$boxId} { opacity: 0; pointer-events: none; }</style>";
            $html = str_replace('</head>', $style . '</head>', $html);
        }
    }

    echo $html;
} 
else 
{
    echo "studentdash.html file not found.";
}

?>