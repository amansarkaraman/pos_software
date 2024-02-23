<?php
include('../config/function.php');

if(isset($_POST['saveAdmin'])){
    global $conn;

    $name=validate($_POST['name']);
    $email=validate($_POST['email']);
    $password=validate($_POST['password']);
    $phone=validate($_POST['phone']);
    $is_ban=isset($_POST['is_ban']) == true ? 1:0;

    if($name != '' && $email != '' && $password !='')
    {
        $emailCheck=mysqli_query($conn,"SELECT * FROM admins where email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect('admins-create.php',"This email is already using");
            }
        }
        //This is using to Bycript password
        $bycrypt_password=password_hash($password,PASSWORD_BCRYPT);
        // Bycripting password finished
        $data=[
        'name' => $name,
        'email' => $email,
        'password' => $bycrypt_password,
        'phone'	=> $phone,
        'is_ban' => $is_ban,
    ];
    $result=insert('admins',$data);
    if($result){
        redirect('admin.php','Admins Created Successfully');
    }else{
        redirect('admins-create','Something went Wrong');
    }
    }
    else{
        redirect('admins-create','Please fill the required feilds');
    }
}
?>