<?= $this->extend('admin/master_layout/admin_master') ?>

<?= $this->section('content') ?>
<main class="dashboard-content">
  <div class="container-fluid px-3 px-lg-4 py-4">
    
    <div class="page-heading">
      <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-credit-card" aria-hidden="true"></i></span>
        <div>
          <p class="eyebrow mb-1">Billing</p>
          <h1 class="h3 mb-1">Subscription Manager</h1>
          <p class="text-muted mb-0">Submit manual payment verifications and track your workspace ledger history.</p>
        </div>
      </div>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-3 mt-1">
      <div class="col-12 col-xl-5">
        
        <article class="metric-card mb-3 <?= (!empty($subscription) && $subscription['status'] === 'active' && strtotime($subscription['ends_at']) > time()) ? 'metric-success' : 'metric-danger' ?>">
          <div class="metric-top">
            <span class="metric-label">Account Status</span>
            <span class="metric-icon">
              <i class="bi <?= (!empty($subscription) && $subscription['status'] === 'active' && strtotime($subscription['ends_at']) > time()) ? 'bi-shield-check' : 'bi-shield-exclamation' ?>" aria-hidden="true"></i>
            </span>
          </div>
          <div class="metric-value mt-2">
            <?php if (!empty($subscription) && $subscription['status'] === 'active' && strtotime($subscription['ends_at']) > time()): ?>
              Active Premium
            <?php else: ?>
              Expired / Inactive
            <?php endif; ?>
          </div>
          <div class="metric-meta">
            <?php if (!empty($subscription) && $subscription['status'] === 'active' && strtotime($subscription['ends_at']) > time()): ?>
              <span>Valid access until: <strong><?= date('d M Y', strtotime($subscription['ends_at'])) ?></strong></span>
            <?php else: ?>
              <span class="text-danger">Please submit a payment to restore listing capabilities.</span>
            <?php endif; ?>
          </div>
        </article>

        <div class="panel">
          <div class="panel-header border-bottom pb-3 mb-3">
            <div>
              <h2 class="h5 mb-1 section-title"><i class="bi bi-qr-code-scan" aria-hidden="true"></i><span>Renew via UPI Payment</span></h2>
              <p class="text-muted mb-0">Transfer amount manually and verify subscription.</p>
            </div>
            <span class="badge bg-primary text-white font-weight-bold px-2 py-1">₹500.00 / mo</span>
          </div>

          <div class="p-3 bg-light border rounded text-center mb-4">
            <small class="text-muted text-uppercase fw-semibold d-block mb-1 small">Step 1: Send funds to Virtual Private Address (VPA)</small>
            <span class="h5 font-weight-bold text-monospace text-primary">yourshopvpa@paytm</span>
            <div class="mt-2 text-muted small"><i class="bi bi-wallet2 me-1"></i> Supports GPay, PhonePe, Paytm, & BHIM UPI</div>
          </div>

          <form action="/admin/subscription/submit" method="POST">
            <?= csrf_field() ?>
            <div class="mb-4">
              <label for="transaction_id" class="form-label fw-semibold text-dark">Step 2: Enter Transaction Details</label>
              <p class="text-muted small mt-0 mb-2">Paste the 12-digit UPI Ref No, UTR Code, or Transaction Key from your payment receipt:</p>
              <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-key text-muted"></i></span>
                <input type="text" 
                       name="transaction_id" 
                       id="transaction_id" 
                       class="form-control text-monospace text-uppercase" 
                       placeholder="e.g. 3145XXXXXXXX" 
                       required 
                       autocomplete="off">
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 shadow-sm">
              <i class="bi bi-send me-2"></i> Submit Verification Code
            </button>
          </form>
        </div>
      </div>

      <div class="col-12 col-xl-7">
        <div class="panel h-100">
          <div class="panel-header">
            <div>
              <h2 class="h5 mb-1 section-title"><i class="bi bi-clock-history" aria-hidden="true"></i><span>Transaction Logs</span></h2>
              <p class="text-muted mb-0">Historical records of verified submissions on this storefront.</p>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th scope="col">Date / Time</th>
                  <th scope="col">Transaction ID / Ref</th>
                  <th scope="col">Amount</th>
                  <th scope="col" class="text-end">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($payments)): ?>
                  <?php foreach ($payments as $p): ?>
                    <tr>
                      <td>
                        <div class="fw-semibold mb-0"><?= date('d M Y', strtotime($p['payment_date'])) ?></div>
                        <div class="text-muted small"><?= date('h:i A', strtotime($p['payment_date'])) ?></div>
                      </td>
                      <td>
                        <code class="text-dark font-weight-bold small text-monospace"><?= esc($p['gateway_payment_id']) ?></code>
                      </td>
                      <td class="fw-semibold text-dark">
                        ₹<?= number_format($p['amount'], 2) ?>
                      </td>
                      <td class="text-end">
                        <?php if ($p['status'] === 'success'): ?>
                          <span class="badge text-bg-success px-2.5 py-1.5 shadow-sm">Approved</span>
                        <?php elseif ($p['status'] === 'failed' || $p['status'] === 'pending'): ?>
                          <span class="badge text-bg-warning text-dark px-2.5 py-1.5 shadow-sm">Awaiting Review</span>
                        <?php else: ?>
                          <span class="badge text-bg-secondary px-2.5 py-1.5 shadow-sm"><?= strtoupper(esc($p['status'])) ?></span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="4" class="text-center py-5 text-muted">
                      <i class="bi bi-folder2-open d-block mb-2 display-6 text-muted opacity-50"></i>
                      No manual ledger submissions logged for this account workspace.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?= $this->endSection() ?>