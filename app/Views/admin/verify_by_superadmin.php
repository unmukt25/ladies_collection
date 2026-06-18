<?= $this->extend('admin/master_layout/admin_master') ?>

<?= $this->section('content') ?>

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pending UPI Payment Verification</h1>
            <p class="text-muted small">Review and approve incoming registration platform payments manually.</p>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-1"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-1"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">Awaiting Verification Queue (<?= count($pending_payments) ?> Requests)</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">ID</th>
                                <th scope="col">User Detail</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Gateway Reference ID</th>
                                <th scope="col">Payment Date</th>
                                <th scope="col" class="pe-4 text-end">Verification Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pending_payments)) : ?>
                                <?php foreach ($pending_payments as $row) : ?>
                                    <tr>
                                        <td class="ps-4 fw-bold">#<?= esc($row['id']) ?></td>
                                        <td>
                                            <div class="fw-bold text-dark"><?= esc($row['user_name']) ?></div>
                                            <div class="text-muted small"><?= esc($row['email']) ?></div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 fs-6">
                                                <?= esc($row['currency']) ?> <?= number_format($row['amount'], 2) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <code class="text-dark fw-bold bg-light p-1 rounded"><?= esc($row['gateway_payment_id']) ?></code>
                                        </td>
                                        <td class="text-muted small">
                                            <?= date('M d, Y', strtotime($row['payment_date'])) ?><br>
                                            <?= date('h:i A', strtotime($row['payment_date'])) ?>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <form action="<?= base_url('admin/subscription/process-action/' . $row['id']) ?>" method="POST" class="d-inline-block">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="status_action" id="action_<?= $row['id'] ?>" value="">
                                                
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="submit" onclick="document.getElementById('action_<?= $row['id'] ?>').value='active';" class="btn btn-success" title="Approve Payment">
                                                        <i class="fas fa-check me-1"></i> Approve
                                                    </button>
                                                    <button type="submit" onclick="document.getElementById('action_<?= $row['id'] ?>').value='failed';" class="btn btn-outline-danger" title="Reject Payment">
                                                        <i class="fas fa-times me-1"></i> Reject
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 text-gray-300"></i>
                                        <p class="mb-0 fw-bold">Excellent! All caught up.</p>
                                        <span class="small text-muted">There are no pending UPI transactions requiring manual review right now.</span>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>

<?= $this->endSection() ?>