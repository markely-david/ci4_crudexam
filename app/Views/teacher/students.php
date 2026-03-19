<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h2>Student Management</h2>
        <p>View and manage all enrolled students.</p>
    </div>
    <span class="badge-navy" style="font-size:0.82rem;padding:0.5rem 1rem;">
        <i class="bi bi-people-fill me-1"></i><?= count($students) ?> Students
    </span>
</div>

<div class="clean-card">
    <div class="clean-card-header">
        <h6><i class="bi bi-table"></i> All Enrolled Students</h6>
        <input type="text" id="searchInput" class="clean-input" placeholder="Search student..." style="width:220px;padding:0.45rem 0.9rem;font-size:0.85rem;">
    </div>
    <div class="table-responsive">
        <table class="clean-table" id="studentTable">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Course</th>
                    <th>Year & Section</th>
                    <th>Username</th>
                    <th class="text-center pe-4">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($students)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-5" style="color:var(--text-muted);">
                            <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:0.5rem;"></i>No students found.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($students as $i => $s): ?>
                    <tr>
                        <td class="text-muted" style="font-size:0.82rem;"><?= $i + 1 ?></td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <?php if (!empty($s['profile_image'])): ?>
                                    <img src="<?= base_url('uploads/profiles/' . esc($s['profile_image'])) ?>"
                                         style="width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid var(--gold-200);" alt="">
                                <?php else: ?>
                                    <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--navy-700),var(--navy-900));color:var(--gold-300);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.82rem;flex-shrink:0;">
                                        <?= strtoupper(substr($s['name'] ?? 'U', 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                                <span style="font-weight:700;color:var(--navy-900);"><?= esc($s['name']) ?></span>
                            </div>
                        </td>
                        <td style="font-size:0.85rem;color:var(--text-secondary);font-family:monospace;"><?= esc($s['student_id'] ?? '—') ?></td>
                        <td>
                            <?php if ($s['course']): ?>
                                <span class="badge-navy"><?= esc($s['course']) ?></span>
                            <?php else: ?>
                                <span style="color:var(--text-muted);">—</span>
                            <?php endif; ?>
                        </td>
                        <td style="font-size:0.85rem;">
                            <?= $s['year_level'] ? 'Year ' . esc($s['year_level']) : '' ?>
                            <?= $s['section'] ? ' — ' . esc($s['section']) : '' ?>
                            <?= (!$s['year_level'] && !$s['section']) ? '—' : '' ?>
                        </td>
                        <td style="font-size:0.85rem;color:var(--text-secondary);"><?= esc($s['email']) ?></td>
                        <td class="text-center pe-4">
                            <a href="<?= base_url('/students/show/' . $s['id']) ?>" class="clean-btn-secondary" style="padding:0.35rem 0.85rem;font-size:0.8rem;">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#studentTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
<?= $this->endSection() ?>
