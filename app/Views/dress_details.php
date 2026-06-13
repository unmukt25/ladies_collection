<?= $this->extend('main_layouts/frontend_index') ?>

<?= $this->section('content') ?>

<?php

$styles = json_decode($dress['style'], true) ?? [];
$sizes  = json_decode($dress['sizes'], true) ?? [];
$colors = json_decode($dress['colors'], true) ?? [];

?>

<main id="main-content">
    <div class="container py-5">
        <div class="row g-4">

            <!-- Image -->

            <div class="col-md-5">

                <?php if (!empty($dress['img'])): ?>

                    <img
                        src="<?= base_url('uploads/dresses/' . $dress['img']) ?>"
                        class="img-fluid rounded shadow"
                        alt="<?= esc($dress['product_name']) ?>">

                <?php endif; ?>

            </div>

            <!-- Details -->

            <div class="col-md-7">

                <h1 class="mb-3">
                    <?= esc($dress['product_name']) ?>
                </h1>

                <div class="mb-2">
                    <strong>Category:</strong>
                    <?= esc($dress['cat']) ?>
                </div>

                <?php if (!empty($dress['badge'])): ?>
                    <div class="mb-3">
                        <span class="badge bg-danger">
                            <?= esc($dress['badge']) ?>
                        </span>
                    </div>
                <?php endif; ?>

                <h3 class="text-success">
                    ₹<?= number_format($dress['price']) ?>
                </h3>

                <?php if (!empty($dress['old_price'])): ?>
                    <div class="text-muted">
                        <del>₹<?= number_format($dress['old_price']) ?></del>
                    </div>
                <?php endif; ?>

                <hr>

                <!-- Styles -->

                <h5>Styles</h5>

                <?php foreach ($styles as $style): ?>

                    <span class="badge bg-secondary me-1">
                        <?= esc($style) ?>
                    </span>

                <?php endforeach; ?>

                <hr>

                <!-- Sizes -->

                <h5>Available Sizes</h5>

                <?php foreach ($sizes as $size): ?>

                    <span class="badge bg-light text-dark border me-1">
                        <?= esc($size) ?>
                    </span>

                <?php endforeach; ?>

                <hr>

                <!-- Colors -->

                <h5>Colors</h5>

                <div class="d-flex gap-2 flex-wrap">

                    <?php foreach ($colors as $color): ?>

                        <span
                            style="
                                width:25px;
                                height:25px;
                                border-radius:50%;
                                display:inline-block;
                                background:<?= esc($color) ?>;
                                border:1px solid #ccc;
                            ">
                        </span>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

    </div>

</main>

<script>
    let DRESSES=[];
</script>

<?= $this->endSection() ?>