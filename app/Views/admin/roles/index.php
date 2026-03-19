<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h2>Role Management</h2>
        <p>Configure access levels and permissions for each role.</p>
    </div>
    <a href="<?= base_url('/admin/roles/create') ?>" class="clean-btn-gold"><i class="bi bi-plus-circle-fill"></i> Create New Role</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success d-flex align-items-center mb-4">
        <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger d-flex align-items-center mb-4">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="clean-card">
    <div class="clean-card-header">
        <h6><i class="bi bi-shield-fill-check"></i> System Roles</h6>
    </div>
    <div class="table-responsive">
        <table class="clean-table">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Role Slug</th>
                    <th>Label</th>
                    <th>Description</th>
                    <th class="text-center">Users</th>
                    <th class="text-center pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $i => $role): ?>
                <tr>
                    <td class="text-muted" style="font-size:0.82rem;"><?= sprintf('%02d', $i + 1) ?></td>
                    <td>
                        <span class="badge-gold" style="font-family:monospace;">@<?= esc($role['name']) ?></span>
                        <?php if ($role['name'] === 'admin'): ?>
                            <i class="bi bi-shield-fill-check ms-1" style="color:var(--gold-500);font-size:0.8rem;" title="System Protected"></i>
                        <?php endif; ?>
                    </td>
                    <td style="font-weight:700;color:var(--navy-900);"><?= esc($role['label']) ?></td>
                    <td style="font-size:0.85rem;color:var(--text-secondary);max-width:280px;"><?= esc($role['description'] ?? '—') ?></td>
                    <td class="text-center">
                        <span class="badge-navy"><?= $role['user_count'] ?></span>
                    </td>
                    <td class="text-center pe-4">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="<?= base_url('/admin/roles/edit/' . $role['id']) ?>"
                               class="clean-btn-secondary" style="padding:0.35rem 0.75rem;font-size:0.8rem;">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <?php if ($role['name'] !== 'admin'): ?>
                                <button type="button"
                                        class="btn btn-sm"
                                        style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:var(--radius-sm);padding:0.35rem 0.75rem;font-size:0.8rem;transition:all 0.15s;"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="<?= $role['id'] ?>"
                                        data-label="<?= esc($role['label']) ?>"
                                        data-count="<?= $role['user_count'] ?>">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            <?php else: ?>
                                <button class="btn btn-sm" style="background:#f8fafc;color:#cbd5e1;border:1px solid #e2e8f0;border-radius:var(--radius-sm);padding:0.35rem 0.75rem;font-size:0.8rem;cursor:not-allowed;" disabled>
                                    <i class="bi bi-lock-fill"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius:var(--radius-md);box-shadow:var(--shadow-lg);">
            <div class="modal-header" style="border-bottom:1px solid var(--border-light);padding:1.25rem 1.5rem;">
                <h5 class="modal-title" style="font-weight:800;color:var(--navy-900);font-size:1rem;">
                    <i class="bi bi-exclamation-triangle-fill me-2" style="color:var(--danger);"></i>Delete Role
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding:1.5rem;">
                <p style="color:var(--text-secondary);font-size:0.9rem;margin-bottom:1rem;">
                    Are you sure you want to delete the <strong id="deleteRoleLabel" style="color:var(--navy-900);font-family:monospace;"></strong> role?
                </p>
                <div id="deleteWarning" class="d-none" style="background:var(--warning-light);border-left:4px solid var(--warning);border-radius:var(--radius-sm);padding:0.75rem 1rem;font-size:0.85rem;color:var(--gold-600);">
                    <i class="bi bi-people-fill me-2"></i><span id="deleteWarningText"></span>
                </div>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--border-light);padding:1rem 1.5rem;gap:0.5rem;">
                <button type="button" class="clean-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteConfirmBtn" class="clean-btn-primary" style="background:var(--danger);box-shadow:none;">
                    <i class="bi bi-trash3-fill"></i> Delete Role
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
document.getElementById('deleteModal').addEventListener('show.bs.modal', function(e) {
    const btn   = e.relatedTarget;
    const count = parseInt(btn.dataset.count);
    document.getElementById('deleteRoleLabel').textContent = btn.dataset.label;
    document.getElementById('deleteConfirmBtn').href = '<?= base_url('/admin/roles/delete/') ?>' + btn.dataset.id;
    const warn = document.getElementById('deleteWarning');
    if (count > 0) {
        warn.classList.remove('d-none');
        document.getElementById('deleteWarningText').textContent = count + ' user(s) will lose this role assignment.';
    } else {
        warn.classList.add('d-none');
    }
});
</script>
<?= $this->endSection() ?>
