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

                <form class="ps-3 pe-3" action="<?= base_url('/supply/storeSupply') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="supply_name" class="form-label">Supply Name</label>
                        <input class="form-control" type="text" name="supply_name" required placeholder="Supply Name here..">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'supply_name') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="supply_qty" class="form-label">Supply Quantity</label>
                        <input class="form-control" type="number" name="supply_qty" required placeholder="Supply Qty here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'supply_qty') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="supply_image" class="form-label">Supply Image (Optional)</label>
                        <input class="form-control" type="file" name="supply_image">
                    </div>


                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Add Supply</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->