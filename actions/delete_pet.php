<?php

header("Content-Type: application/json");
include "../config/database.php";

$pet_id = $_POST['pet_id'] ?? '';

if($pet_id == ''){
    echo json_encode([
        "success"=>false,
        "message"=>"No pet selected."
    ]);
    exit;
}

$sql = "DELETE FROM pets WHERE pet_id=?";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"i",$pet_id);

if(mysqli_stmt_execute($stmt)){

    echo json_encode([
        "success"=>true,
        "message"=>"Animal deleted successfully."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>"Unable to delete animal."
    ]);

}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>