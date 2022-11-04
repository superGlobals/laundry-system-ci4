<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
 <!-- Start Content-->
 <div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                
            </div>
            <h4 class="page-title">Add User Page</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('admin/user-management') ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url('user/storeUser') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" name="firstname" value="<?= set_value('firstname') ?>" class="form-control" placeholder="First Name here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'firstname') : '' ?></span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="middlename" class="form-label">Middle Name</label>
                        <input type="text" name="middlename" value="<?= set_value('middlename') ?>" class="form-control" placeholder="Optional">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" name="lastname" value="<?= set_value('lastname') ?>" class="form-control" placeholder="Last Name here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'lastname') : '' ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Contact Number</label>
                        <input type="number" name="contact" value="<?= set_value('contact') ?>" class="form-control" placeholder="Contact here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'contact') : '' ?></span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="role" class="form-label">Address</label>
                        <input type="text" name="address" value="<?= set_value('address') ?>" class="form-control" placeholder="Address">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'address') : '' ?></span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="position" class="form-label">Position</label>
                        <select name="position" id="" class="form-select">
                        <option value="<?= set_value('position') ?>"><?= isset($_POST['position']) ? set_value('position') : '--Select Postion--'; ?> </option>
                            <option value="admin">Admin</option>
                            <option value="employee">Employee</option>
                        </select>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'position') : '' ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'email') : '' ?></span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="password" class="form-label">Show/Hide Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" name="password" value="<?= set_value('password') ?>" class="form-control" placeholder="Enter your password">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'password') : '' ?></span>
                    </div>

                    <div class="col-md-4 mb3">
                        <label for="example-fileinput" class="form-label">Upload user profile (optional)</label>
                        <input type="file" id="example-fileinput" name="profile" class="form-control">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>