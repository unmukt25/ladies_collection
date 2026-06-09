<?= $this->extend('admin/master_layout/admin_master') ?>

<?= $this->section('content') ?>

<main class="dashboard-content">
  <div class="container-fluid px-3 px-lg-4 py-4">

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <div class="card border-0 shadow-sm">
          <div class="card-body text-center py-5">

            <div class="mb-4">
              <i class="fas fa-layer-group fa-4x text-primary"></i>
            </div>

            <h2 class="fw-bold mb-3">
              Category Management
            </h2>

            <p class="text-muted fs-5 mb-4">
              This section is currently under development and will
              be available in a future update.
            </p>

            <div class="alert alert-info d-inline-block">
              <strong>Coming Soon!</strong><br>
              Features planned for this section:
              <ul class="text-start mb-0 mt-2">
                <li>Create Categories</li>
                <li>Edit Categories</li>
                <li>Delete Categories</li>
                <li>Category-wise Product Management</li>
                <li>Category Display Settings</li>
              </ul>
            </div>

            <div class="mt-4">
              <span class="badge bg-warning text-dark px-3 py-2">
                Version 2.0 Feature
              </span>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>
</main>

<?= $this->endSection() ?>