<?php
session_start();

require 'dbcon.php';

//Input validation
function validate($inputData){
    global $conn;
    $validateData=mysqli_real_escape_string($conn,$inputData);
    return trim($validateData);
}
//redirect page with message
// redirect(path,message)
function redirect($url,$status){
    $_SESSION['status']=$status;
    header('Location: '.$url);
    exit(0);
}

// This funvtion is responsible for give alert messages
function alertMessage(){
    if(isset($_SESSION['status'])){

        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5>'.$_SESSION['status'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

        unset($_SESSION['status']);
    }
}

// Crud Functions Starts
function insert($tableName,$data){
    global $conn;
    $table = validate($tableName);
    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',',$columns);
    $finalValues = "'".implode("', '",$values)."'";

    $query="insert into $table ($finalColumn) VALUES ($finalValues)";
    $result=mysqli_query($conn,$query);
    return $result;
}

function update($tableName,$id,$data){
    global $conn;
    $table = validate($tableName);
    $id=validate($id);
    
    $updateDataString="";

    foreach($data as $columns => $values){
        $updateDataString .= $columns.'='."'$values',";
    }

    $finalUpdateData = substr(trim($updateDataString),0,-1);
    $query="UPDATE $table set $finalUpdateData where id='$id'";
    $result = mysqli_query($conn,$query);
    return $result;
}

function getAllData($tableName,$status = NULL){
    global $conn;
    $table=validate($tableName);
    $status=validate($status);
    if( $status == 'status'){
        $query="SELECT * from $table where status='0'";
    }
    else{
        $query = "SELECT * from $table";
    }
    return mysqli_query($conn,$query);

}

function getAllDataById($tableName,$id){
    global $conn;
    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * from $table where id='$id' LIMIT 1";
    $result = mysqli_query($conn,$query);
    if($result){
        if(mysqli_num_rows($result)==1){
            $row=mysqli_fetch_assoc($result);
            $response=[
            'status' => 202,
            'data' => $row,
            'message' => 'Data found',
        ];
        return $response;
        }else{
            $response=[
            'status' => 404,
            'message' => 'No Data found',
        ];
        return $response;
        }
    }
    else{
        $response=[
            'status' => 500,
            'message' => 'Data Cound not found',
        ];
        return $response;
    }
}

function delete($tableName,$id){
    global $conn;
    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table where id='$id' LIMIT 1";
    $result = mysqli_query($conn,$query);
    return $result; 
}
// Crud Function Ends
?>