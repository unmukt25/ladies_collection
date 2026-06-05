<?= $this->extend('admin/master_layout/admin_master') ?>

<?= $this->section('content') ?>


<main class="dashboard-content">
  <div class="container-fluid px-3 px-lg-4 py-4">


    <section class="row g-3 mt-1" aria-label="Dashboard metrics">
      <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-primary">
          <div class="metric-top">
            <span class="metric-label">Total Dresses</span>
            <span class="metric-icon"><i class="bi bi-stack" aria-hidden="true"></i></span>
          </div>
          <div class="metric-value"><?= $stats['total_dresses'] ?></div>
          <!-- <div class="metric-meta">
            <span class="text-success">+12.5%</span>
            <span>from last month</span>
          </div> -->
        </article>
      </div>

      <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-success">
          <div class="metric-top">
            <span class="metric-label">Category</span>
            <span class="metric-icon"><i class="bi bi-bag-check" aria-hidden="true"></i></span>
          </div>
          <div class="metric-value"><?= $stats['total_categories'] ?></div>
          <!-- <div class="metric-meta">
            <span class="text-success">+8.2%</span>
            <span>new orders</span>
          </div> -->
        </article>
      </div>

      <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-warning">
          <div class="metric-top">
            <span class="metric-label">Dresses Added Last 7 Days</span>
            <span class="metric-icon"><i class="bi bi-life-preserver" aria-hidden="true"></i></span>
          </div>
          <div class="metric-value"><?= $stats['recent_dresses'] ?></div>
          <!-- <div class="metric-meta">
            <span class="text-success">+5.1%</span>
            <span>active users</span>
          </div> -->
        </article>
      </div>

      <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-danger">
          <div class="metric-top">
            <span class="metric-label">Total Visitors</span>
            <span class="metric-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
          </div>
          <div class="metric-value"><?= $stats['total_visitors'] ?></div>
          <!-- <div class="metric-meta">
            <span class="text-danger">3 urgent</span>
            <span>need review</span>
          </div> -->
        </article>
      </div>
    </section>
    <br/>


    <!-- Row 1 -->
    <div class="row g-3">

      <!-- Category Card -->
      <div class="col-md-6">
        <div class="panel h-100">
          <div class="panel-header">
            <h2 class="h5 mb-0">Category Wise Dresses</h2>
          </div>

          <div class="p-3">
            <?php foreach ($categories as $cat): ?>
              <div class="d-flex justify-content-between border-bottom py-2">
                <span><?= esc($cat['cat']) ?></span>
                <strong><?= $cat['total'] ?></strong>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Missing Info Card -->
      <div class="col-md-6">
        <div class="panel h-100">

          <div class="panel-header">
            <h2 class="h5 mb-0">Missing Information</h2>
          </div>

          <div class="p-3">

            <div class="d-flex justify-content-between py-2 border-bottom">
              <span>Missing Style</span>
              <span class="badge bg-danger"><?= $missing['style'] ?></span>
            </div>

            <div class="d-flex justify-content-between py-2 border-bottom">
              <span>Missing Colors</span>
              <span class="badge bg-danger"><?= $missing['colors'] ?></span>
            </div>

            <div class="d-flex justify-content-between py-2 border-bottom">
              <span>Missing Sizes</span>
              <span class="badge bg-danger"><?= $missing['sizes'] ?></span>
            </div>

            <div class="d-flex justify-content-between py-2 border-bottom">
              <span>Missing Images</span>
              <span class="badge bg-danger"><?= $missing['images'] ?></span>
            </div>

            <div class="d-flex justify-content-between py-2 border-bottom">
              <span>Missing Badge</span>
              <span class="badge bg-warning"><?= $missing['badge'] ?></span>
            </div>

            <div class="d-flex justify-content-between py-2">
              <span>Missing Old Price</span>
              <span class="badge bg-secondary"><?= $missing['old_price'] ?></span>
            </div>

          </div>

        </div>
      </div>

    </div>

    <!-- Row 2 -->
    <div class="row mt-3">

      <div class="col-12">

        <div class="panel">

          <div class="panel-header">
            <h2 class="h5 mb-0">Recently Added Dresses</h2>
          </div>

          <div class="table-responsive">

            <table class="table align-middle mb-0">

              <thead>
                <tr>
                  <th>ID</th>
                  <th>Dress Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Added</th>
                </tr>
              </thead>

              <tbody>

                <?php foreach ($latest as $dress): ?>
                  <tr>
                    <td><?= $dress['id'] ?></td>
                    <td><?= esc($dress['product_name']) ?></td>
                    <td><?= esc($dress['cat']) ?></td>
                    <td>₹<?= number_format($dress['price']) ?></td>
                    <td><?= date('d M Y', strtotime($dress['created_at'])) ?></td>
                  </tr>
                <?php endforeach; ?>

              </tbody>

            </table>

          </div>

        </div>

      </div>

    </div>

  </div>
</main>
<?= $this->endSection() ?>