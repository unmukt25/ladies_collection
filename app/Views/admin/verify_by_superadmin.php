<?= $this->extend('admin/master_layout/admin_master') ?>

<?= $this->section('content') ?>

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Verify UPI Payment</h1>
                <p class="text-muted small mb-0">Review pending subscription activation request.</p>
            </div>
            <a href="<?= base_url('admin/subscriptions') ?>" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Transaction Breakdown</h6>
                        <span class="badge bg-<?= $user['subscription_status'] === 'pending' ? 'warning text-dark' : ($user['subscription_status'] === 'active' ? 'success' : 'danger') ?>">
                            <?= strtoupper($user['subscription_status'] ?? 'UNKNOWN') ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="bg-light" style="width: 30%;">User Name</th>
                                        <td><?= esc($user['user_name']) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="bg-light">Email Address</th>
                                        <td><?= esc($user['email']) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="bg-light">Proposed Start Date</th>
                                        <td><?= $user['subscription_starts_at'] ? date('M d, Y h:i A', strtotime($user['subscription_starts_at'])) : 'Immediate' ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="bg-light">Proposed Expiry Date</th>
                                        <td><?= $user['subscription_ends_at'] ? date('M d, Y h:i A', strtotime($user['subscription_ends_at'])) : 'N/A' ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-info small mt-3 mb-0" role="alert">
                            <i class="fas fa-info-circle me-1"></i> Please verify the transaction reference against your UPI business merchant account / bank statement before clicking <strong>Approve</strong>.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Superadmin Actions</h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <p class="text-muted small">Choose whether to approve this user's platform access based on manual transaction vetting.</p>
                            <hr>
                        </div>

                        <form action="<?= base_url('admin/subscriptions/update-status/' . $user['id']) ?>" method="POST">
                            <?= csrf_field() ?>
                            
                            <input type="hidden" name="status_action" id="status_action" value="">

                            <div class="d-grid gap-2">
                                <button type="submit" onclick="setAction('active')" class="btn btn-success btn-lg mb-2" <?= $user['subscription_status'] === 'active' ? 'disabled' : '' ?>>
                                    <i class="fas fa-check-circle me-2"></i> Approve Payment
                                </button>
                                
                                <button type="submit" onclick="setAction('expired')" class="btn btn-outline-danger" <?= $user['subscription_status'] === 'expired' ? 'disabled' : '' ?>>
                                    <i class="fas fa-times-circle me-2"></i> Reject / Expire
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    /**
     * Simple utility to assign the status value right before form submission
     */
    function setAction(status) {
        document.getElementById('status_action').value = status;
    }
</script>

<?= $this->endSection() ?>