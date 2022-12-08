
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include ('config.php');
include('Jwt.php');
include('fetchjwt.php');

//$data = json_decode(file_get_contents("php://input"),true);
$returnData=[];
$key=35202;

$id=$_POST['id'];
$age=$_POST['age'];
$name = $_POST['name'];
$email = $_POST['email'];

//Update Image
$fileName = $_FILES["image"]["name"];
$tempName = $_FILES["image"]["tmp_name"];
$folder = "./image/" . $fileName;
$image = $fileName;

$password = password_hash($_POST['password'],PASSWORD_BCRYPT);

// Fuction to check same image from directory.
function checkImage($fileName){
    $mydir = './image'; 
    $myfiles = array_diff(scandir($mydir), array('.', '..')); 
    foreach($myfiles as $value){
        if($value == $fileName){
            return true;
        }
    }
}

// check for the existance of file. 
if(checkImage($fileName))
{
    $returnData = ('Image Already Exist!');
}

else
{
    // Access JWT fron Postman Header
    $jwt=getBearerToken();
    
    //Verifying JWT Token 
    if(JWT::decode($jwt,$key,['HS256'])){
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
            
            $sql = "UPDATE users SET age='$age', name='$name', email='$email', image='$image', password='$password' WHERE id='$id' ";
            $result=mysqli_query($con, $sql);
            move_uploaded_file($tempName, $folder);
            if($result)
            {
                $returnData = ( 'Record Update Succesfully!.');
            }
        
            else
            {
                $returnData = ( 'Record Not Update.');
            }
            }
    
    }
    
    else{
        $returnData = ( 'Issue in token! Kindly login In again.');
    }
}

echo json_encode($returnData);
?>