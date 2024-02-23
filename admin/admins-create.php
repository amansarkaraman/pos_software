<?php include('includes/header.php') ?>
<div class="container-fluid px-4">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">
               Add Admin
                <a href="admin.php" class="btn btn-primary float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage() ?>
            <form action="code.php" method="post">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="">Name *</label>
                        <input type="text" name="name" class="form-control" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="">Email *</label>
                        <input type="email" name="email" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="">Password *</label>
                        <input type="password" name="password" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="">Phone Number *</label>
                        <input type="number" name="phone" required class="form-control" />
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="">Is Ban</label>
                        <input type="checkbox" name="is_ban" style="height:20px;width:20px;" />
                    </div>
                    <div class="col-md-12 mb-2 text-end">
                        <button type="submit" name="saveAdmin" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>