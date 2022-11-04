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
            <h4 class="page-title">Laundry Services Category</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#new-supply">New Laundry Service</button>
            </div>
            <div class="card-body">
                
                <div class="tab-content">
                    <div class="tab-pane show active" id="buttons-table-preview">
                    <table id="alternative-page-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Services Image</th>
                                    <th>Services Name</th>
                                    <th>Services Price</th>
                                    <th>Services Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($laundry_services as $laundry_service): $id = $laundry_service->id ?>
                                    <tr>
                                        <td><img src="<?= base_url() ?>/uploads/<?= $laundry_service->laundry_service_image ?>" class="rounded-circle" width="50" height="50"></td>
                                        <td><?= esc(ucwords($laundry_service->laundry_service_name)) ?></td>
                                        <td><?= esc($laundry_service->laundry_service_price) ?></td>
                                        <td><?= esc(ucwords(str_replace("_"," ", $laundry_service->laundry_service_status))) ?></td>
                                        <td>
                                            <a href="#editSupply<?= $id ?>" class="btn btn-success btn-sm" data-bs-toggle="modal">Edit</a>
                                            <button type="button" class="confirm_del btn btn-danger btn-sm" value="<?= $id ?>">Delete</button>
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

<!-- Signup modal content -->
<div id="new-supply" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">                                             
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="<?= base_url('uploads/no_image.jpg') ?>" class="rounded-circle" alt="" height="80" width="80"></span>
                    </a>
                </div>

                <form class="ps-3 pe-3" action="<?= base_url('/laundry-service/storeLaundryService') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="laundry_service_name" class="form-label">Laundry Service Name</label>
                        <input class="form-control" type="text" name="laundry_service_name" required placeholder="Service Name here..">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'laundry_service_name') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="laundry_service_price" class="form-label">Laundry Service Price</label>
                        <input class="form-control" type="number" name="laundry_service_price" required placeholder="Service Price here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'laundry_service_price') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="laundry_service_status" class="form-label">Laundry Service Status</label>
                        <select name="laundry_service_status" id="" class="form-select">
                            <option value="available">Avalilable</option>
                            <option value="not_available">Not Avalilable</option>
                        </select>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'supply_qty') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="laundry_service_image" class="form-label">Laundry Service Image (Optional)</label>
                        <input class="form-control" type="file" name="laundry_service_image">
                    </div>


                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Add Laundry Service</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

    <script>
        $(document).ready(function () {
            $('.confirm_del').click(function (e) { 
                e.preventDefault();
                
                var id = $(this).val(); //"this" means it will get the value of .confirm_del_btn once the user click that btn

                Swal.fire({
                title: 'Are you sure?',
                text: "Supply info will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $.ajax({
                            url: "/laundry-service/deleteLaundryService/"+id,
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