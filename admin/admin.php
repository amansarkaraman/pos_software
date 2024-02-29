<?php include('includes/header.php') ?>
<div class="container-fluid px-4">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">
                Admin/Staff
                <a href="admins-create.php" class="btn btn-primary float-end">Add Admin</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage() ?>
            <div class="table-responsive">
                <table class="table table-striped table-border">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admin_infos=getAllData('admins');
                        if(mysqli_num_rows($admin_infos)>0){
                        ?>
                        <?php foreach($admin_infos as $adminitems) : ?>
                        <tr>
                            <td><?php echo $adminitems['id'] ?></td>
                            <td><?php echo $adminitems['name'] ?></td>
                            <td><?php echo $adminitems['email'] ?></td>
                            <td>
                                <a href="admins-edit.php?id=<?= $adminitems['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <a onclick="confirmDeltion(<?php $adminitems['id'] ?>)" href="admins-delete.php?id=<?= $adminitems['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <?php
                        }
                        else{
                        ?>
                        <tr>
                            <td>No record Found</td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
<?php include('includes/footer.php') ?>

<script>
    function confirmDeltion($adminID){
        if (confirm("Are you sure you want to delete this admin?")) {
            window.location.href = "admins-delete.php?id=" + adminID;
        }else{
            false;
        }
    }
</script>













