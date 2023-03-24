<?php
header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: DELETE');
include ('dbcon.php');

$data = json_decode(file_get_contents("php://input"),true);
$student_id = $data['id'];
$sql = "DELETE FROM students WHERE student_id='$student_id' ";

if(mysqli_query($con, $sql)){
    echo json_encode(array('message' => 'Record Deleted Succesfully . ' ,'status'=> true));
}
else{
    echo json_encode(array('message' => 'Error. ' ,'status'=>false));
}
?>
