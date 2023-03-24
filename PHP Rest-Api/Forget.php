
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include ('config.php');

$data = json_decode(file_get_contents("php://input"),true);
$returnData =[];

$email = $data['email'];
$newPassword= password_hash( $data['newPassword'], PASSWORD_BCRYPT);


if(!isset($email) || empty(trim($email)))
{
    $returnData = ( 'Please Fill in all Required Fields!.');
}

else
{
    //Email is a unique id.
    $sql = "SELECT * FROM users where email='$email' ";
    $result = mysqli_query($con, $sql);
    $res=mysqli_fetch_assoc($result);

    if($email==$res['email'])
    {
        $sql = "UPDATE users SET password='$newPassword' WHERE email= '$email' ";
        $result = mysqli_query($con, $sql);

        $returnData = ( 'Password changed succesfully!.');
    }
    // Already check for existing email because email is unique.
    else
    {
        $returnData = ( 'Please enter the correct email!.');
    }


}

echo json_encode($returnData);
?>