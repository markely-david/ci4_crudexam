<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h2><?= esc($student['name']) ?></h2>
        <p>Student profile details and academic information.</p>
    </div>
    <a href="<?= base_url('/students') ?>" class="clean-btn-secondary"><i class="bi bi-arrow-left"></i> Back to Students</a>
</div>

<div class="row g-4">
    <!-- Avatar -->
    <div class="col-lg-4">
        <div class="clean-card">
            <div style="height:6px;background:linear-gradient(90deg,var(--navy-700),var(--gold-400));"></div>
            <div class="p-4 text-center">
                <?php if (!empty($student['profile_image'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($student['profile_image'])) ?>"
                         style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:4px solid var(--gold-200);box-shadow:0 4px 20px rgba(232,185,35,0.2);margin-bottom:1rem;">
                <?php else: ?>
                    <div style="width:110px;height:110px;border-radius:50%;background:linear-gradient(135deg,var(--navy-700),var(--navy-900));color:var(--gold-300);display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:900;margin:0 auto 1rem;border:4px solid var(--gold-200);">
                        <?= strtoupper(substr($student['name'], 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <h5 style="font-size:1.15rem;font-weight:800;color:var(--navy-900);margin-bottom:0.25rem;"><?= esc($student['name']) ?></h5>
                <p style="font-size:0.85rem;color:var(--text-secondary);margin-bottom:1rem;"><?= esc($student['email']) ?></p>
                <span class="badge-gold"><?= esc($student['role_label'] ?? 'Student') ?></span>
                <hr style="border-color:var(--border-light);margin:1.25rem 0;">
                <div class="text-start" style="font-size:0.85rem;">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color:var(--text-secondary);font-weight:600;">Enrolled</span>
                        <span style="font-weight:700;color:var(--navy-900);"><?= date('M d, Y', strtotime($student['created_at'])) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span style="color:var(--text-secondary);font-weight:600;">Status</span>
                        <span style="font-weight:700;color:var(--success);"><i class="bi bi-circle-fill me-1" style="font-size:0.45rem;vertical-align:middle;"></i>Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details -->
    <div class="col-lg-8 d-flex flex-column gap-4">
        <div class="clean-card">
            <div class="clean-card-header">
                <h6><i class="bi bi-mortarboard-fill"></i> Academic Information</h6>
            </div>
            <table class="clean-table">
                <tbody>
                    <?php
                    $fields = [
                        ['Student ID',     $student['student_id'] ?? null],
                        ['Course',         $student['course'] ?? null],
                        ['Year Level',     $student['year_level'] ? 'Year ' . $student['year_level'] : null],
                        ['Section',        $student['section'] ?? null],
                    ];
                    foreach ($fields as [$label, $val]): ?>
                    <tr>
                        <td style="width:38%;color:var(--text-secondary);font-weight:600;font-size:0.82rem;"><?= $label ?></td>
                        <td style="font-weight:700;color:var(--navy-900);"><?= $val ? esc($val) : '<span style="color:var(--text-muted);font-weight:400;">Not set</span>' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="clean-card">
            <div class="clean-card-header">
                <h6><i class="bi bi-person-lines-fill"></i> Contact Details</h6>
            </div>
            <table class="clean-table">
                <tbody>
                    <?php
                    $contacts = [
                        ['Username / Email', $student['email']],
                        ['Phone',            $student['phone'] ?? null],
                        ['Address',          $student['address'] ?? null],
                    ];
                    foreach ($contacts as [$label, $val]): ?>
                    <tr>
                        <td style="width:38%;color:var(--text-secondary);font-weight:600;font-size:0.82rem;"><?= $label ?></td>
                        <td style="font-weight:700;color:var(--navy-900);"><?= $val ? esc($val) : '<span style="color:var(--text-muted);font-weight:400;">Not set</span>' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
