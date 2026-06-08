<?= $this->extend('admin/master_layout/admin_master') ?>

<?= $this->section('content') ?>

<?php
$selectedStyles = json_decode($dress['style'] ?? '[]', true);
$selectedSizes  = json_decode($dress['sizes'] ?? '[]', true);
$selectedColors = json_decode($dress['colors'] ?? '[]', true);
?>

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        <div class="page-heading">
            <div>
                <h1 class="h3 mb-1">Edit Dress</h1>
                <p class="text-muted mb-0">
                    Update existing dress product.
                </p>
            </div>
        </div>

        <div class="panel">

            <div class="panel-header">
                <h2 class="h5 mb-0">Dress Information</h2>
            </div>

            <div class="p-4">

                <form action="<?= base_url('admin/dresses/update/' . $dress['id']) ?>"
                      method="post"
                      enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row g-3">

                        <!-- Product Name -->
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text"
                                   name="product_name"
                                   class="form-control"
                                   value="<?= esc($dress['product_name']) ?>"
                                   required>
                        </div>

                        <!-- Category -->
                        <div class="col-md-3">
                            <label class="form-label">Category</label>

                            <select name="cat" class="form-select" required>
                                <option value="">Select</option>

                                <?php
                                $cats = ['Casual','Evening','Bridal','Party','Office'];
                                foreach ($cats as $c):
                                ?>
                                    <option value="<?= $c ?>"
                                        <?= $dress['cat'] == $c ? 'selected' : '' ?>>
                                        <?= $c ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>

                        <!-- Badge -->
                        <div class="col-md-3">
                            <label class="form-label">Badge</label>

                            <select name="badge" class="form-select">
                                <option value="">None</option>
                                <option value="New"  <?= $dress['badge']=='New' ? 'selected' : '' ?>>New</option>
                                <option value="Sale" <?= $dress['badge']=='Sale' ? 'selected' : '' ?>>Sale</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="col-md-3">
                            <label class="form-label">Our Price</label>
                            <input type="number"
                                   name="price"
                                   class="form-control"
                                   value="<?= esc($dress['price']) ?>"
                                   required>

                            <label class="form-label mt-2">MRP</label>
                            <input type="number"
                                   name="old_price"
                                   class="form-control"
                                   value="<?= esc($dress['old_price']) ?>">
                        </div>

                        <!-- Styles -->
                        <div class="col-md-5">
                            <label class="form-label">Styles</label>

                            <select multiple name="style[]" class="form-select">
                                <?php
                                $styles = ['Solid','Printed','Floral','Embroidered'];
                                foreach ($styles as $s):
                                ?>
                                    <option value="<?= $s ?>"
                                        <?= in_array($s, $selectedStyles) ? 'selected' : '' ?>>
                                        <?= $s ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <small class="text-muted">Hold Ctrl to select multiple</small>
                        </div>

                        <!-- Sizes -->
                        <div class="col-md-4">
                            <label class="form-label">Sizes</label>

                            <select multiple name="sizes[]" class="form-select">
                                <?php
                                $sizes = ['XS','S','M','L','XL','XXL','XXXL','XXXXL'];
                                foreach ($sizes as $sz):
                                ?>
                                    <option value="<?= $sz ?>"
                                        <?= in_array($sz, $selectedSizes) ? 'selected' : '' ?>>
                                        <?= $sz ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Colors -->
                        <div class="col-md-12">

                            <label class="form-label d-block">Colors</label>

                            <div class="d-flex gap-2 mb-2 flex-wrap">

                                <?php
                                $colorOptions = [
                                    "#000000","#FFFFFF","#FF0000","#0000FF",
                                    "#008000","#FFFF00","#FFA500","#800080"
                                ];
                                ?>

                                <?php foreach ($colorOptions as $c): ?>
                                    <span class="color-ball"
                                          data-color="<?= $c ?>"
                                          style="background:<?= $c ?>;<?= $c=='#FFFFFF'?'border:1px solid #ccc':'' ?>">
                                    </span>
                                <?php endforeach; ?>

                            </div>

                            <input type="text"
                                   id="colors"
                                   name="colors"
                                   class="form-control"
                                   value="<?= implode(',', $selectedColors ?? []) ?>">

                            <a href="javascript:void(0)" onclick="clearColor()">clear all color</a>
                        </div>

                        <!-- Image -->
                        <div class="col-md-12">
                            <label class="form-label">Image</label>

                            <?php if (!empty($dress['img'])): ?>
                                <div class="mb-2">
                                    <img src="<?= base_url('uploads/dresses/' . $dress['img']) ?>"
                                         width="120"
                                         class="border rounded">
                                </div>
                            <?php endif; ?>

                            <input type="file"
                                   name="img"
                                   class="form-control"
                                   accept="image/*">
                        </div>

                        <!-- Buttons -->
                        <div class="col-12">

                            <button type="submit" class="btn btn-primary">
                                Update Dress
                            </button>

                            <a href="<?= base_url('admin/dresses') ?>" class="btn btn-light">
                                Cancel
                            </a>

                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>
</main>

<!-- SAME COLOR SCRIPT (UNCHANGED) -->
<style>
.color-ball {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    cursor: pointer;
    display: inline-block;
    transition: .2s;
}
.color-ball:hover {
    transform: scale(1.15);
    box-shadow: 0 0 5px rgba(0,0,0,.4);
}
</style>

<script>
document.querySelectorAll('.color-ball').forEach(ball => {
    ball.addEventListener('click', function () {

        let colorCode = this.dataset.color;
        let colorInput = document.getElementById('colors');

        let current = colorInput.value.trim();

        if (current === '') {
            colorInput.value = colorCode;
            return;
        }

        let colors = current.split(',').map(c => c.trim());

        if (!colors.includes(colorCode)) {
            colorInput.value += ',' + colorCode;
        }
    });
});

function clearColor() {
    document.getElementById("colors").value = "";
}
</script>

<?= $this->endSection() ?>