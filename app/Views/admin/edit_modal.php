<!-- Signup modal content -->
<div id="editSupply<?= $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">                                             
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="<?= base_url() ?>/uploads/<?= $supply->supply_image ?>" class="rounded-circle" alt="" height="80" width="80"></span>
                    </a>
                </div>

                <form class="ps-3 pe-3" action="<?=base_url()?>/supply/updateSupply/<?= $supply->id ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT" />
                    <div class="mb-3">
                        <label for="supply_name" class="form-label">Supply Name</label>
                        <input class="form-control" type="text" name="supply_name" required value="<?= esc($supply->supply_name) ?>">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'supply_name') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="supply_qty" class="form-label">Supply Quantity</label>
                        <input class="form-control" type="number" name="supply_qty" required value="<?= esc($supply->supply_qty) ?>">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'supply_qty') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="supply_image" class="form-label">Supply Image (Optional)</label>
                        <input class="form-control" type="file" name="supply_image">
                    </div>


                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Update Supply</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->