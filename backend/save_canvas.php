<?php
require_once "classes/Database.php";
require_once "classes/Odpoved_student.php";
//TODO: save picture to db

$qID = $_REQUEST["qID"];
$tID = $_REQUEST["tID"];
$conn = (new Database())->getConnection();
$find = $conn->prepare("SELECT * FROM odpoved_student WHERE question_id=? AND test_id=?");
$find->execute([$qID,$tID]);
$found = $find->fetchAll(PDO::FETCH_CLASS, "Odpoved_student");
if (!file_exists("images/".$tID)){
    mkdir("images/".$tID, 0777);
}
define('UPLOAD_DIR', 'images/'.$tID.'/');

// unlink("test.txt");)
$img = $_POST['imgBase64'];  
$img = str_replace('data:image/png;base64,', '', $img);  
$img = str_replace(' ', '+', $img);  
$data = base64_decode($img);
$file = UPLOAD_DIR . uniqid() . '.png';
$success = file_put_contents($file, $data);
if($found){
    $update = $conn->prepare("UPDATE odpoved_student SET img_path=? WHERE test_id=? AND question_id=?");
    $update->execute([$file,$tID,$qID]);
    $old_img = $found[0]->getImgPath();
    unlink($old_img);
}
else{
    $insert = $conn->prepare("INSERT INTO odpoved_student (question_id,test_id,odpoved,img_path,text1,text2,correct) VALUES (?,?,?,?,?,?,?)");
    $insert->execute([$qID,$tID,null,$file,null,null,0]);
}
echo $file;
