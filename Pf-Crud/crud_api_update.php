<?php
header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: POST');
include ('dbcon.php');

$data = json_decode(file_get_contents("php://input"),true);

$id = $data['id'];
$name = $data['name'];
$email = $data['email'];
$course = $data['course'];
$grade = $data['grade'];

$sql = "UPDATE students SET student_name='$name', student_email='$email', course_id='$course', grade_id='$grade' WHERE student_id='$id' ";
if(mysqli_query($con, $sql)){
    echo json_encode(array('message' => 'Record Enter Succesfully . ' ,'status'=> true));
}
else{
    echo json_encode(array('message' => 'No resord Found. ' ,'status'=>false));
}
?>
