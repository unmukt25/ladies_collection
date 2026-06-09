<?= $this->extend('admin/master_layout/admin_master') ?>

<?= $this->section('content') ?>

<main class="dashboard-content">
  <div class="container-fluid px-3 px-lg-4 py-4">


    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>


    <div class="card mb-4">
      <div class="card-header">
        Profile Information
      </div>

      <div class="card-body">

        <form action="<?= base_url('admin/users/update-profile') ?>" method="post">

          <?= csrf_field() ?>

          <div class="mb-3">
            <label class="form-label">
              Username
            </label>

            <input type="text" name="user_name" class="form-control" value="<?= esc($user['user_name']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">
              Email
            </label>

            <input type="email" class="form-control" value="<?= esc($user['email']) ?>" readonly>
          </div>

          <button type="submit" class="btn btn-primary">
            Update Profile
          </button>

        </form>

      </div>
    </div>



    <div class="card">
      <div class="card-header">
        Change Password
      </div>

      <div class="card-body">

        <form action="<?= base_url('admin/users/change-password') ?>" method="post">

          <?= csrf_field() ?>

          <div class="mb-3">
            <label class="form-label">
              Current Password
            </label>

            <input type="password" name="current_password" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">
              New Password
            </label>

            <input type="password" name="new_password" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">
              Confirm Password
            </label>

            <input type="password" name="confirm_password" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-warning">
            Change Password
          </button>

        </form>

      </div>
    </div>


  </div>
</main>
<?= $this->endSection() ?>