<?php
header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
include ('dbcon.php');

$data = json_decode(file_get_contents("php://input"),true);
$student_id = $data['id'];
$sql = "SELECT * FROM students where student_id={$student_id}";

$result=mysqli_query($con, $sql) or die ("SQL QUERY FAILED.");

if(mysqli_num_rows($result)>0){
    $output=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($output);
}
else{
    echo json_encode(array('message' => 'No resord Found. ' ,'status'));
}
?>
