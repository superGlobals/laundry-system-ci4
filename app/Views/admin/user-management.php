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
            <h4 class="page-title">User Management</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('admin/add_user') ?>" class="btn btn-primary float-end">New User</a>
            </div>
            <div class="card-body">
                
                <div class="tab-content">
                    <div class="tab-pane show active" id="buttons-table-preview">
                    <table id="alternative-page-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>User Profile</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Contact</th>
                                    <th>Date Added</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <td><img src="<?= base_url() ?>/uploads/<?= $user->profile ?>" class="rounded-circle" width="50" height="50"></td>
                                        <td><?= esc($user->user_id) ?></td>
                                        <td><?= esc(ucfirst($user->firstname)) ?> <?= esc(ucfirst($user->middlename)) ?> <?= esc(ucfirst($user->lastname)) ?></td>
                                        <td><?= esc(ucfirst($user->position)) ?></td>
                                        <td><?= esc($user->contact) ?></td>
                                        <td><?= esc(get_date($user->date_added)) ?></td>
                                        <td>
                                            <a href="/user/editUser/<?= $user->id ?>" class="btn btn-success btn-sm">Edit</a>
                                            <button type="button" class="confirm_del btn btn-danger btn-sm" value="<?= $user->id ?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>    
                            </tbody>
                        

                        </table>                                           
                    </div> <!-- end preview-->

                </div> <!-- end tab-content-->
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

    <script>
        $(document).ready(function () {
            $('.confirm_del').click(function (e) { 
                e.preventDefault();
                
                var id = $(this).val(); //"this" means it will get the value of .confirm_del_btn once the user click that btn

                Swal.fire({
                title: 'Are you sure?',
                text: "User info will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $.ajax({
                            url: "/user/deleteUser/"+id,
                            success: function (response) {
                                Swal.fire({
                                    title: response.status,
                                    text: response.status_text,
                                    icon: response.status_icon,
                                    timer: 2000,
                                }).then((success) => {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                })

            });
        });
    </script>


<?= $this->endSection() ?>