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
            <h4 class="page-title">Customer Management</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('admin/add_customer') ?>" class="btn btn-primary float-end">New Customer</a>
            </div>
            <div class="card-body">
                
                <div class="tab-content">
                    <div class="tab-pane show active" id="buttons-table-preview">
                    <table id="alternative-page-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Profile</th>
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Contact</th>
                                    <th>Date Added</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($customers as $customer): ?>
                                    <tr>
                                        <td><img src="<?= base_url() ?>/uploads/<?= $customer->profile ?>" class="rounded-circle" width="50" height="50"></td>
                                        <td><?= esc($customer->customer_id) ?></td>
                                        <td><?= esc(ucfirst($customer->firstname)) ?> <?= esc(ucfirst($customer->middlename)) ?> <?= esc(ucfirst($customer->lastname)) ?></td>
                                        <td><?= esc(ucfirst($customer->gender)) ?></td>
                                        <td><?= esc($customer->contact) ?></td>
                                        <td><?= esc(get_date($customer->date_added)) ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>/customer/editCustomer/<?= $customer->id ?>" class="btn btn-success btn-sm">Edit</a>
                                            <button type="button" class="confirm_del btn btn-danger btn-sm" value="<?= $customer->id ?>">Delete</button>
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
                text: "Customer info will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $.ajax({
                            url: "<?=base_url()?>/customer/deleteCustomer/"+id,
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