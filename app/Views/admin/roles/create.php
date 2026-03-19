<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h2>Create New Role</h2>
        <p>Define a new role for the access control system.</p>
    </div>
    <a href="<?= base_url('/admin/roles') ?>" class="clean-btn-secondary"><i class="bi bi-arrow-left"></i> Back to Roles</a>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="clean-card">
            <div class="clean-card-header">
                <h6><i class="bi bi-shield-plus"></i> Role Details</h6>
            </div>
            <div class="p-4">
                <?php if (session('errors')): ?>
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <ul class="mb-0 ps-3 mt-1">
                            <?php foreach (session('errors') as $err): ?>
                                <li><?= esc($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/roles/store') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <label class="form-label fw-bold" style="font-size:0.82rem;color:var(--navy-800);">Role Slug <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center gap-0" style="border:1.5px solid var(--border);border-radius:var(--radius-sm);overflow:hidden;background:#fff;">
                            <span style="padding:0.65rem 0.85rem;background:var(--navy-50);color:var(--navy-600);font-weight:700;border-right:1.5px solid var(--border);font-size:0.9rem;">@</span>
                            <input type="text" name="name" class="clean-input" value="<?= old('name') ?>" placeholder="e.g. coordinator" style="border:none;border-radius:0;box-shadow:none;">
                        </div>
                        <div style="font-size:0.75rem;color:var(--text-muted);margin-top:0.4rem;"><i class="bi bi-info-circle me-1"></i>Lowercase letters, numbers, and dashes only.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold" style="font-size:0.82rem;color:var(--navy-800);">Display Label <span class="text-danger">*</span></label>
                        <input type="text" name="label" class="clean-input" value="<?= old('label') ?>" placeholder="e.g. Department Coordinator">
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-bold" style="font-size:0.82rem;color:var(--navy-800);">Description</label>
                        <textarea name="description" class="clean-input" rows="3" placeholder="Describe the access level and responsibilities of this role..."><?= old('description') ?></textarea>
                    </div>

                    <button type="submit" class="clean-btn-gold w-100 justify-content-center" style="padding:0.75rem;">
                        <i class="bi bi-plus-circle-fill"></i> Create Role
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
