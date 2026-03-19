<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php $isCore = $role && in_array($role['name'], ['admin','teacher','student']); ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h2>Edit Role <span class="badge-gold ms-2" style="font-family:monospace;font-size:0.85rem;">@<?= esc($role['name']) ?></span></h2>
        <p>Update the label and description for this role.</p>
    </div>
    <a href="<?= base_url('/admin/roles') ?>" class="clean-btn-secondary"><i class="bi bi-arrow-left"></i> Back to Roles</a>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="clean-card">
            <div class="clean-card-header">
                <h6><i class="bi bi-shield-fill-check"></i> Role Details</h6>
                <?php if ($isCore): ?>
                    <span class="badge-gold"><i class="bi bi-lock-fill me-1"></i>Core Role</span>
                <?php endif; ?>
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

                <form action="<?= base_url('admin/roles/update/' . $role['id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <label class="form-label fw-bold" style="font-size:0.82rem;color:var(--navy-800);">Role Slug <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center" style="border:1.5px solid var(--border);border-radius:var(--radius-sm);overflow:hidden;background:<?= $isCore ? 'var(--navy-50)' : '#fff' ?>;">
                            <span style="padding:0.65rem 0.85rem;background:var(--navy-50);color:var(--navy-600);font-weight:700;border-right:1.5px solid var(--border);font-size:0.9rem;">@</span>
                            <input type="text" name="name" class="clean-input" value="<?= old('name', $role['name']) ?>"
                                   <?= $isCore ? 'readonly' : '' ?>
                                   style="border:none;border-radius:0;box-shadow:none;<?= $isCore ? 'color:var(--text-muted);' : '' ?>">
                            <?php if ($isCore): ?>
                                <span style="padding:0.65rem 0.85rem;color:var(--gold-500);"><i class="bi bi-lock-fill"></i></span>
                            <?php endif; ?>
                        </div>
                        <?php if ($isCore): ?>
                            <div style="font-size:0.75rem;color:var(--gold-600);margin-top:0.4rem;"><i class="bi bi-shield-lock me-1"></i>Core role slug is locked and cannot be changed.</div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold" style="font-size:0.82rem;color:var(--navy-800);">Display Label <span class="text-danger">*</span></label>
                        <input type="text" name="label" class="clean-input" value="<?= old('label', $role['label']) ?>">
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-bold" style="font-size:0.82rem;color:var(--navy-800);">Description</label>
                        <textarea name="description" class="clean-input" rows="3"><?= old('description', $role['description'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="clean-btn-primary w-100 justify-content-center" style="padding:0.75rem;">
                        <i class="bi bi-check-lg"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
