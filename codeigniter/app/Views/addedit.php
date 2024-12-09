<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="text-center mb-4"><?= isset($item) ? 'Edit Item' : 'Add Item' ?></h2>
                <form method="post" action="<?= base_url('inventory/addedit/' . (isset($item) ? '/' . $item['specification'] : '')) ?>">
                    <div class="mb-3">
                        <label for="specification" class="form-label">Specification</label>
                        <input type="text" class="form-control" id="specification" name="specification" value="<?= isset($item) ? esc($item['specification']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="screw" <?= isset($item) && $item['type'] == 'screw' ? 'selected' : '' ?>>Screw</option>
                            <option value="pipe" <?= isset($item) && $item['type'] == 'pipe' ? 'selected' : '' ?>>Pipe</option>
                            <option value="iron core" <?= isset($item) && $item['type'] == 'iron core' ? 'selected' : '' ?>>Iron Core</option>
                            <option value="copper wire" <?= isset($item) && $item['type'] == 'copper wire' ? 'selected' : '' ?>>Copper Wire</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><?= isset($item) ? 'Update Item' : 'Add Item' ?></button>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>