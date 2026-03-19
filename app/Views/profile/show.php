<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h2>My Profile</h2>
        <p>View your personal and academic information.</p>
    </div>
    <a href="<?= base_url('profile/edit') ?>" class="clean-btn-gold"><i class="bi bi-pencil-fill"></i> Edit Profile</a>
</div>

<div class="row g-4">
    <!-- Avatar Card -->
    <div class="col-lg-4">
        <div class="clean-card">
            <!-- Gold top bar -->
            <div style="height:6px;background:linear-gradient(90deg,var(--navy-700),var(--gold-400));"></div>
            <div class="p-4 text-center">
                <?php if (!empty($user['profile_image'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>"
                         style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:4px solid var(--gold-200);box-shadow:0 4px 20px rgba(232,185,35,0.2);margin-bottom:1rem;">
                <?php else: ?>
                    <div style="width:110px;height:110px;border-radius:50%;background:linear-gradient(135deg,var(--navy-700),var(--navy-900));color:var(--gold-300);display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:900;margin:0 auto 1rem;border:4px solid var(--gold-200);box-shadow:0 4px 20px rgba(232,185,35,0.2);">
                        <?= strtoupper(substr($user['fullname'], 0, 1)) ?>
                    </div>
                <?php endif; ?>

                <h5 style="font-size:1.2rem;font-weight:800;color:var(--navy-900);margin-bottom:0.2rem;"><?= esc($user['fullname']) ?></h5>
                <p style="font-size:0.85rem;color:var(--text-secondary);margin-bottom:1rem;">@<?= esc($user['username']) ?></p>

                <span class="badge-gold"><?= esc(session('user')['role'] ?? 'Student') ?></span>

                <hr style="border-color:var(--border-light);margin:1.25rem 0;">

                <div class="d-flex justify-content-between" style="font-size:0.85rem;margin-bottom:0.6rem;">
                    <span style="color:var(--text-secondary);font-weight:600;">Joined</span>
                    <span style="font-weight:700;color:var(--navy-800);"><?= isset($user['created_at']) ? date('M Y', strtotime($user['created_at'])) : 'N/A' ?></span>
                </div>
                <div class="d-flex justify-content-between" style="font-size:0.85rem;">
                    <span style="color:var(--text-secondary);font-weight:600;">Status</span>
                    <span style="font-weight:700;color:var(--success);"><i class="bi bi-circle-fill me-1" style="font-size:0.45rem;vertical-align:middle;"></i>Active</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Tables -->
    <div class="col-lg-8 d-flex flex-column gap-4">
        <div class="clean-card">
            <div class="clean-card-header">
                <h6><i class="bi bi-mortarboard-fill"></i> Academic Information</h6>
            </div>
            <table class="clean-table">
                <tbody>
                    <tr>
                        <td style="width:38%;color:var(--text-secondary);font-weight:600;font-size:0.82rem;">Student ID</td>
                        <td style="font-weight:700;color:var(--navy-900);"><?= esc($user['student_id'] ?? 'Not Set') ?></td>
                    </tr>
                    <tr>
                        <td style="color:var(--text-secondary);font-weight:600;font-size:0.82rem;">Course / Program</td>
                        <td style="font-weight:700;color:var(--navy-900);"><?= esc($user['course'] ?? 'Not Set') ?></td>
                    </tr>
                    <tr>
                        <td style="color:var(--text-secondary);font-weight:600;font-size:0.82rem;">Year Level</td>
                        <td style="font-weight:700;color:var(--navy-900);"><?= esc($user['year_level'] ?? 'Not Set') ?></td>
                    </tr>
                    <tr>
                        <td style="color:var(--text-secondary);font-weight:600;font-size:0.82rem;">Section</td>
                        <td style="font-weight:700;color:var(--navy-900);"><?= esc($user['section'] ?? 'Not Set') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clean-card">
            <div class="clean-card-header">
                <h6><i class="bi bi-person-lines-fill"></i> Contact Details</h6>
            </div>
            <table class="clean-table">
                <tbody>
                    <tr>
                        <td style="width:38%;color:var(--text-secondary);font-weight:600;font-size:0.82rem;">Username</td>
                        <td style="font-weight:700;color:var(--navy-900);"><?= esc($user['username'] ?? 'Not Set') ?></td>
                    </tr>
                    <tr>
                        <td style="color:var(--text-secondary);font-weight:600;font-size:0.82rem;">Phone Number</td>
                        <td style="font-weight:700;color:var(--navy-900);"><?= esc($user['phone'] ?? 'Not Set') ?></td>
                    </tr>
                    <tr>
                        <td style="color:var(--text-secondary);font-weight:600;font-size:0.82rem;">Home Address</td>
                        <td style="font-weight:700;color:var(--navy-900);"><?= nl2br(esc($user['address'] ?? 'Not Set')) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
