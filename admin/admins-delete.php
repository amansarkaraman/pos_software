<?php

require '../config/function.php';

$peramID=checkparam('id');
if(is_numeric($peramID)){
    $adminID=validate($peramID);

    $isAdmin=getAllDataById('admins',$adminID);   

    if($isAdmin['status'] == 200)
    {
        $adminDelete=delete('admins',$adminID);
        if($adminDelete){
            redirect('admin.php',"Admin Delete Successfully");
        }else{
            redirect('admin.php',"Some thing went wrong");
        }
    }else{
        redirect('admins-edit.php','No Data Found');
    }
}else{
    redirect('admins-edit.php',"Something went wrong");
}

?>