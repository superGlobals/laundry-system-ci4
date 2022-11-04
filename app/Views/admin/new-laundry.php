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
            <h4 class="page-title">Laundry Package Category</h4>
        </div>
    </div>
</div>

<div class="row mt-3 d-flex justify-content-center">
    <?php if(count($laundry) > 0): ?>
        <?php foreach($laundry as $row): ?>
            <div class="col-md-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <img src="<?= base_url() ?>/uploads/<?= $row->laundry_service_image ?>" width="200" height="200" alt="">
                        <div>
                            <h4><?= esc(ucwords($row->laundry_service_name)) ?></h4>
                            <span>Service Fee: <?= esc($row->laundry_service_price) ?></span>
                            
                        </div>
                        <div class="text-center mt-3">
                            <a href="<?= base_url() ?>/laundry/laundry-transaction/<?= $row->id ?>" class="btn btn-primary">Select</a>
                        </div>

                    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        <?php endforeach; ?>    
    <?php else: ?>
        <h2 class="text-center">Please add Laundry Service</h2>

    <?php endif; ?>
</div>


<?= $this->endSection() ?>