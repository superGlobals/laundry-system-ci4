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
            <h4 class="page-title">Add Customer Page</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('admin/customer-management') ?>" class="btn btn-primary float-end">Back</a>
                <img src="<?= base_url() ?>/uploads/user_male.jpg" class="rounded-circle" width="50" height="50">
            </div>
            <div class="card-body">
                
            <form action="<?= base_url('customer/storeCustomer') ?>" method="POST" enctype="multipart/form-data">
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
                        <label for="position" class="form-label">Gender</label>
                        <select name="gender" id="" class="form-select">
                        <option value="<?= set_value('gender') ?>"><?= isset($_POST['gender']) ? set_value('gender') : '--Select Gender--'; ?> </option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'gender') : '' ?></span>
                    </div>

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

                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control" placeholder="Email here...">
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
                        <label for="example-fileinput" class="form-label">Upload customer profile (optional)</label>
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