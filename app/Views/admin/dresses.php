<?= $this->extend('admin/master_layout/admin_master') ?>

<?= $this->section('content') ?>

<main class="dashboard-content">
<div class="container-fluid px-3 px-lg-4 py-4">

    <div class="panel">

        <div class="panel-header">

            <div>
                <h2 class="h4 mb-1">Dresses</h2>
                <p class="text-muted mb-0">
                    Manage all dresses
                </p>
            </div>

            <a href="<?= base_url('admin/dresses/add') ?>"
               class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Add Dress
            </a>

        </div>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Rating</th>
                        <th>Reviews</th>
                        <th>Badge</th>
                        <th>Added</th>
                        <th width="140">Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach($dresses as $dress): ?>

                    <tr>

                        <td>

                            <img
                                src="<?= base_url('uploads/dresses/'.$dress['img']) ?>"
                                width="50"
                                height="50"
                                class="rounded border dress-thumb"
                                style="cursor:pointer;object-fit:cover;"
                                data-bs-toggle="modal"
                                data-bs-target="#imageModal"
                                data-image="<?= base_url('uploads/dresses/'.$dress['img']) ?>"
                            >

                        </td>

                        <td><?= esc($dress['product_name']) ?></td>

                        <td><?= esc($dress['cat']) ?></td>

                        <td>
                            ₹<?= number_format($dress['price']) ?>
                        </td>

                        <td><?= $dress['rating'] ?></td>

                        <td><?= $dress['reviews'] ?></td>

                        <td><?= $dress['badge'] ?: '-' ?></td>

                        <td>
                            <?= date('d M Y', strtotime($dress['created_at'])) ?>
                        </td>

                        <td>

                            <a href="<?= base_url('admin/dresses/edit/'.$dress['id']) ?>"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <a href="<?= base_url('admin/dresses/delete/'.$dress['id']) ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Delete this dress?')">
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <div class="p-3">

            <?= $pager->links() ?>

        </div>

    </div>

</div>
</main>

<!-- Image Modal -->

<div class="modal fade" id="imageModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-body text-center">

                <img id="modalImage"
                     src=""
                     class="img-fluid rounded">

            </div>

        </div>

    </div>

</div>

<script>

document.querySelectorAll('.dress-thumb')
.forEach(img => {

    img.addEventListener('click', function(){

        document
        .getElementById('modalImage')
        .src = this.dataset.image;

    });

});

</script>

<?= $this->endSection() ?>