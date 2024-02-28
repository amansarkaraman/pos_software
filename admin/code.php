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


if(isset($_POST['updateAdmin'])){
    // 1st we need to get all the input feilds from form
    global $conn;
    $adminsID=validate($_POST['adminsID']);
    // Now we need to fetch all the data by ID
    $adminsData=getAllDataById('admins',$adminsID);
    if($adminsData['status'] != 200){
        redirect('admins-edit.php?id='.$adminsID,"Something went wrong");
    }
    $name=validate($_POST['name']);
    $email=validate($_POST['email']);
    $password=validate($_POST['password']);
    $phone=validate($_POST['phone']);
    $is_ban=isset($_POST['is_ban']) == true ? 1:0;

    if($password != ''){
        $hashedPassword=password_hash($password,PASSWORD_BCRYPT);
    }
    else{
        $hashedPassword=$adminsData['data']['password'];
    }

    if($name != '' && $email != ''){
        //This is the update funtion
        // Here all the updation of Data happens
         $data=[
        'name' => $name,
        'email' => $email,
        'password' => $hashedPassword,
        'phone'	=> $phone,
        'is_ban' => $is_ban,
    ];
    $result=update('admins',$adminsID,$data);
    if($result){
        redirect('admins-edit.php?id='.$adminsID,'Admin '.$adminsData['data']['name'].' Updated Successfully');
    }else{
        redirect('aadmins-edit.php?id='.$adminsID,'Something went Wrong');
    }
    }
    else{
    redirect('admins-create.php',"Something went wrong or Please fill the required feild");
     }


}



?>