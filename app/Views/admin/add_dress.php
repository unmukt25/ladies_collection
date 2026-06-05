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

                <form
                    action="<?= base_url('admin/dresses/store') ?>"
                    method="post">

                    <?= csrf_field() ?>

                    <div class="row g-3">

                        <!-- Product Name -->

                        <div class="col-md-6">
                            <label class="form-label">
                                Product Name
                            </label>

                            <input
                                type="text"
                                name="product_name"
                                class="form-control"
                                required>
                        </div>

                        <!-- Category -->

                        <div class="col-md-3">
                            <label class="form-label">
                                Category
                            </label>

                            <select
                                name="cat"
                                class="form-select"
                                required>

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

                            <select
                                name="badge"
                                class="form-select">

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

                        <!-- Price -->

                        <div class="col-md-3">
                            <label class="form-label">
                                Price
                            </label>

                            <input
                                type="number"
                                name="price"
                                class="form-control"
                                required>
                        </div>

                        <!-- Old Price -->

                        <div class="col-md-3">
                            <label class="form-label">
                                Old Price
                            </label>

                            <input
                                type="number"
                                name="old_price"
                                class="form-control">
                        </div>

                        <!-- Rating -->

                        <div class="col-md-3">
                            <label class="form-label">
                                Rating
                            </label>

                            <input
                                type="number"
                                step="0.1"
                                min="0"
                                max="5"
                                name="rating"
                                class="form-control"
                                value="4.5">
                        </div>

                        <!-- Reviews -->

                        <div class="col-md-3">
                            <label class="form-label">
                                Reviews
                            </label>

                            <input
                                type="number"
                                name="reviews"
                                class="form-control"
                                value="0">
                        </div>

                        <!-- Styles -->

                        <div class="col-md-6">
                            <label class="form-label">
                                Styles
                            </label>

                            <select
                                multiple
                                name="style[]"
                                class="form-select">

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

                        <div class="col-md-6">
                            <label class="form-label">
                                Sizes
                            </label>

                            <select
                                multiple
                                name="sizes[]"
                                class="form-select">

                                <option>XS</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                                <option>XXL</option>

                            </select>
                        </div>

                        <!-- Colors -->

                        <div class="col-md-12">
                            <label class="form-label">
                                Colors
                            </label>

                            <input
                                type="text"
                                name="colors"
                                class="form-control"
                                placeholder="#ffffff,#000000,#ff0000">
                        </div>

                        <!-- Image URL -->

                        <div class="col-md-12">
                            <label class="form-label">
                                Image URL
                            </label>

                            <input
                                type="text"
                                name="img"
                                class="form-control"
                                placeholder="https://...">
                        </div>

                        <!-- Buttons -->

                        <div class="col-12">

                            <button
                                type="submit"
                                class="btn btn-primary">

                                Save Dress

                            </button>

                            <a
                                href="<?= base_url('admin/dresses') ?>"
                                class="btn btn-light">

                                Cancel

                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
</main>

<?= $this->endSection() ?>