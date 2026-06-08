<?= $this->extend('admin/master_layout/admin_master') ?>

<?= $this->section('content') ?>

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        <div class="page-heading">
            <div>
                <h1 class="h3 mb-1">Add Dress</h1>
                <p class="text-muted mb-0">
                    Create a new dress product.
                </p>
            </div>
        </div>

        <div class="panel">

            <div class="panel-header">
                <h2 class="h5 mb-0">Dress Information</h2>
            </div>

            <div class="p-4">

                <form action="<?= base_url('admin/dresses/store') ?>" method="post" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row g-3">

                        <!-- Product Name -->

                        <div class="col-md-6">
                            <label class="form-label">
                                Product Name
                            </label>

                            <input type="text" name="product_name" class="form-control" required>
                        </div>

                        <!-- Category -->

                        <div class="col-md-3">
                            <label class="form-label">
                                Category
                            </label>

                            <select name="cat" class="form-select" required>

                                <option value="">
                                    Select
                                </option>

                                <option value="Casual">
                                    Casual
                                </option>

                                <option value="Evening">
                                    Evening
                                </option>

                                <option value="Bridal">
                                    Bridal
                                </option>

                                <option value="Party">
                                    Party
                                </option>

                                <option value="Office">
                                    Office
                                </option>

                            </select>
                        </div>

                        <!-- Badge -->

                        <div class="col-md-3">
                            <label class="form-label">
                                Badge
                            </label>

                            <select name="badge" class="form-select">

                                <option value="">
                                    None
                                </option>

                                <option value="New">
                                    New
                                </option>

                                <option value="Sale">
                                    Sale
                                </option>

                            </select>
                        </div>

                        <div class="col-md-3">

                            <!-- Our Price -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Our Price
                                </label>

                                <input type="number" name="price" class="form-control" required>
                            </div>

                            <!-- MRP -->
                            <div>
                                <label class="form-label">
                                    MRP
                                </label>

                                <input type="number" name="old_price" class="form-control">
                            </div>

                        </div>


                        <!-- Styles -->

                        <div class="col-md-5">
                            <label class="form-label">
                                Styles
                            </label>

                            <select multiple name="style[]" class="form-select">

                                <option>Solid</option>
                                <option>Printed</option>
                                <option>Floral</option>
                                <option>Embroidered</option>

                            </select>

                            <small class="text-muted">
                                Hold Ctrl to select multiple
                            </small>
                        </div>

                        <!-- Sizes -->

                        <div class="col-md-4">
                            <label class="form-label">
                                Sizes
                            </label>

                            <select multiple name="sizes[]" class="form-select">

                                <option>XS (Extra Small)</option>
                                <option>S (Small)</option>
                                <option>M (Medium)</option>
                                <option>L (Large)</option>
                                <option>XL (Extra Large)</option>
                                <option>XXL (2X Large)</option>
                                <option>XXXL (3X Large)</option>
                                <option>XXXXL (4X Large)</option>

                            </select>
                        </div>

                        <!-- Colors -->

                        <!-- Colors -->

                        <div class="col-md-12">

                            <label class="form-label d-block">
                                Colors
                            </label>

                            <!-- Color Balls -->

                            <div class="d-flex gap-2 mb-2 flex-wrap">

                                <span class="color-ball" data-color="#000000" style="background:#000000"></span>

                                <span class="color-ball" data-color="#FFFFFF"
                                    style="background:#FFFFFF;border:1px solid #ccc"></span>

                                <span class="color-ball" data-color="#FF0000" style="background:#FF0000"></span>

                                <span class="color-ball" data-color="#0000FF" style="background:#0000FF"></span>

                                <span class="color-ball" data-color="#008000" style="background:#008000"></span>

                                <span class="color-ball" data-color="#FFFF00" style="background:#FFFF00"></span>

                                <span class="color-ball" data-color="#FFA500" style="background:#FFA500"></span>

                                <span class="color-ball" data-color="#800080" style="background:#800080"></span>

                            </div>

                            <input type="text" id="colors" name="colors" class="form-control"
                                placeholder="Click Colors above">
                            <a href="javascript:void(0)" onclick="clearColor()">clear all color</a>
                        </div>

                        <!-- Image URL -->

                        <div class="col-md-12">
                            <label class="form-label">
                                Image URL
                            </label>

                            <input type="file" name="img" class="form-control" accept="image/*" required>
                        </div>

                        <!-- Buttons -->

                        <div class="col-12">

                            <button type="submit" class="btn btn-primary">

                                Save Dress

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
        box-shadow: 0 0 5px rgba(0, 0, 0, .4);
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