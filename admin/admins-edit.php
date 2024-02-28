<?php include('includes/header.php') ?>
<div class="container-fluid px-4">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">
               Add Admin
                <a href="admin.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage() ?>
            <form action="code.php" method="post">
            <?php
            if(isset($_GET['id']))
            {
                if($_GET['id'] != '')
                {
                    $adminId=$_GET['id'];
                }
                else
                {
                    echo'<h5>No url is set</h5>';
                    return false;
                }
            }
            else
            {
                echo '<h5>No ID Found</h5>';
                return false;
            }


            $adminData=getAllDataById('admins',$adminId);
            // var_dump($adminData['data']);
            if($adminData)
            {
                if($adminData['status']==200)
                {
                ?> 
                    <div class="row">
                        <input  type="hidden" value="<?= $adminData['data']['id'] ?>" name="adminsID" id="id" class="form-control" required>
                        <div class="col-md-12 mb-2">
                            <label for="">Name *</label>
                            <input type="text" value="<?= $adminData['data']['name'] ?>" name="name" class="form-control" required />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="">Email *</label>
                            <input type="email" value="<?= $adminData['data']['email'] ?>" name="email" required class="form-control" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="">Password *</label>
                            <input type="password"  name="password"  class="form-control" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="">Phone Number *</label>
                            <input type="number" value="<?= $adminData['data']['phone'] ?>" name="phone" required class="form-control" />
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="">Is Ban</label>
                            <input type="checkbox" name="is_ban" style="height:20px;width:20px;" />
                        </div>
                        <div class="col-md-12 mb-2 text-end">
                            <button type="submit" name="updateAdmin" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                 <?php
                }
                else{
                    echo'<h5>'.$adminData["message"].'</h5>';
                    }                
            }
            else{
                echo '<h5>Something Went wrong</h5>';
                return false;

            }
            ?>
            </form>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>