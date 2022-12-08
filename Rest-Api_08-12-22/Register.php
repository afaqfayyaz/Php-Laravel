<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'Config.php';
//$data = json_decode(file_get_contents("php://input"),true);

//echo "hello world";

$returnData = [];

$age=$_POST['age'];
$name = $_POST['name'];
$email = $_POST['email'];

// Get image from postman
$fileName = $_FILES["image"]["name"];
$tempName = $_FILES["image"]["tmp_name"];
$folder = "./image/" . $fileName;
$image = $fileName;
move_uploaded_file($tempName, $folder);

$password = password_hash($_POST['password'],PASSWORD_BCRYPT);


if ($_SERVER["REQUEST_METHOD"] != "POST") 
{

    $returnData = ('Please Enter the Correct Request Method!');
}

elseif (!isset($name) || !isset($email) || !isset($password) 
|| empty(trim($name)) || empty(trim($email))|| empty(trim($password)))
    {
        $returnData = ('Please Fill in all Required Fields!');
    }

else{
    $sql = "INSERT INTO users (age,name,email,image,password) VALUES ('$age','$name','$email','$image','$password')";
    $result=mysqli_query($con, $sql);
    if($result)
    {
        $returnData = ('User Register Succesfully.');
    }
    else
    {
        $returnData = ('This Email is Already Exits.');
    }
    }
echo json_encode($returnData);
?>
    
