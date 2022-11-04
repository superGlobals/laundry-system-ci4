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
            
            
            <h4 class="page-title">Laundry Transaction Page</h4>
        </div>
    </div>
</div>


<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg">
            <div class="card-body">

                <div class="text-center mb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="<?= base_url() ?>/uploads/<?= $laundry->laundry_service_image ?>" class="rounded-circle" alt="" height="80" width="80"></span>
                    </a>
                </div>

                <form class="ps-3 pe-3" action="<?=base_url()?>/laundry-transaction/storeLaundryTransaction/<?= $laundry->id ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" value="<?= $laundry->id ?>" name="laundry_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="laundry_service_name" class="form-label">Laundry Service Name</label>
                            <input class="form-control" type="text" readonly value="<?= esc(ucwords($laundry->laundry_service_name)) ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="laundry_service_price" class="form-label">Laundry Service Price</label>
                            <input class="form-control" type="number" id="price" onkeyup="total_bill();" readonly value="<?= esc($laundry->laundry_service_price) ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="laundry_service_name" class="form-label">Customer Name</label>
                            <input class="form-control" type="text" name="customer" value="<?= set_value('customer') ?>" placeholder="Customer Name here..">
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'customer') : '' ?></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="laundry_service_price" class="form-label">Customer Laundry Weight</label>
                            <input class="form-control" type="number" id="weight" onkeyup="total_bill();" value="<?= set_value('laundry_weight') ?>" name="laundry_weight" placeholder="Customer Laundry Weight here..">
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'laundry_weight') : '' ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="laundry_service_name" class="form-label">Customer Total Bill</label>
                            <input class="form-control" type="text" name="total_bill" id="total" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="laundry_service_price" class="form-label">Customer Payment Type</label>
                            <select class="form-select" name="payment_type">
                                <option value="">--Select Payment--</option>
                                <option value="cash">Cash</option>
                                <option value="gcash">Gcash</option>
                            </select>
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'payment_type') : '' ?></span>
                        </div>
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Proceed Laundry</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>
 



<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

    <script>
        function total_bill()
        {
            const price = document.getElementById('price').value;
            const weight = document.getElementById('weight').value;
            const total = price * weight;
            document.getElementById('total').value = total; 
        }
    </script>

<?= $this->endSection() ?>