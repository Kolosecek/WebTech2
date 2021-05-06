<?php

if(isset($_REQUEST['drawing'])) {
    $upload_dir = '../drawings2/';
    $img = $_POST['drawing'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . "image_name.png";
    $success = file_put_contents($file, $data);
    echo"hello";
}
