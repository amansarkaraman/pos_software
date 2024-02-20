<?php
include('../config/function.php');

if(isset($_POST['saveAdmin'])){

    $name=validate($_POST['name']);
    $email=validate($_POST['email']);
    $password=validate($_POST['password']);
    $mobile_number=validate($_POST['mobile_number']);
    $is_ban=isset($_POST['is_ban']) == true ? 1:0;

    if($name != '' && $email != '' && $password !=''){

    }else{
        
    }
}
?>