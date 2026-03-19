<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h2>Welcome, <?= esc($user['fullname'] ?? 'Student') ?></h2>
        <p>Here's an overview of your academic records and information.</p>
    </div>
    <a href="<?= base_url('profile/edit') ?>" class="clean-btn-gold"><i class="bi bi-pencil-fill"></i> Edit Profile</a>
</div>

<!-- Info Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-indigo-50 text-indigo-600"><i class="bi bi-person-badge-fill"></i></div>
            <div class="stat-label">Student ID</div>
            <div class="stat-value" style="font-size:1.3rem;margin-top:0.4rem;"><?= esc($user['student_id'] ?? '—') ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-emerald-50 text-emerald-600"><i class="bi bi-book-fill"></i></div>
            <div class="stat-label">Course / Program</div>
            <div class="stat-value" style="font-size:1.1rem;margin-top:0.4rem;"><?= esc($user['course'] ?? '—') ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-amber-50 text-amber-600"><i class="bi bi-calendar3"></i></div>
            <div class="stat-label">Year & Section</div>
            <div class="stat-value" style="font-size:1.1rem;margin-top:0.4rem;">
                <?= $user['year_level'] ? 'Year ' . esc($user['year_level']) : '—' ?>
                <?= $user['section'] ? ' — ' . esc($user['section']) : '' ?>
            </div>
        </div>
    </div>
</div>

<!-- Contact Details -->
<div class="clean-card">
    <div class="clean-card-header">
        <h6><i class="bi bi-person-lines-fill"></i> Contact Details</h6>
        <a href="<?= base_url('profile') ?>" class="clean-btn-secondary" style="padding:0.4rem 1rem;font-size:0.8rem;">
            <i class="bi bi-eye"></i> View Full Profile
        </a>
    </div>
    <table class="clean-table">
        <tbody>
            <tr>
                <td style="width:220px;color:var(--text-secondary);font-weight:600;font-size:0.82rem;">Username</td>
                <td style="font-weight:700;color:var(--navy-900);"><?= esc($user['username'] ?? '—') ?></td>
            </tr>
            <tr>
                <td style="color:var(--text-secondary);font-weight:600;font-size:0.82rem;">Phone Number</td>
                <td style="font-weight:700;color:var(--navy-900);"><?= esc($user['phone'] ?? '—') ?></td>
            </tr>
            <tr>
                <td style="color:var(--text-secondary);font-weight:600;font-size:0.82rem;">Home Address</td>
                <td style="font-weight:700;color:var(--navy-900);"><?= esc($user['address'] ?? '—') ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
