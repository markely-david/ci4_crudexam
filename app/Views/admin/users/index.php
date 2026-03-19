<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h2>User Management</h2>
        <p>Assign roles and manage system user access.</p>
    </div>
    <a href="<?= base_url('/admin/roles') ?>" class="clean-btn-secondary"><i class="bi bi-shield-check"></i> Manage Roles</a>
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
        <h6><i class="bi bi-people-fill"></i> System Users
            <span class="badge-navy ms-2"><?= count($users) ?> total</span>
        </h6>
    </div>
    <div class="table-responsive">
        <table class="clean-table">
            <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Current Role</th>
                    <th class="text-end pe-4">Assign Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $i => $u): ?>
                <?php $isSelf = ($u['id'] == (session('user')['id'] ?? 0)); ?>
                <tr>
                    <td class="text-muted" style="font-size:0.82rem;font-family:monospace;"><?= sprintf('%04d', $u['id']) ?></td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <?php if (!empty($u['profile_image'])): ?>
                                <img src="<?= base_url('uploads/profiles/' . esc($u['profile_image'])) ?>"
                                     style="width:38px;height:38px;border-radius:50%;object-fit:cover;border:2px solid var(--gold-200);" alt="">
                            <?php else: ?>
                                <div style="width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,var(--navy-700),var(--navy-900));color:var(--gold-300);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.85rem;flex-shrink:0;">
                                    <?= strtoupper(substr($u['name'] ?? 'U', 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                            <div>
                                <div style="font-weight:700;color:var(--navy-900);"><?= esc($u['name']) ?></div>
                                <?php if ($isSelf): ?>
                                    <div style="font-size:0.68rem;font-weight:700;color:var(--gold-500);text-transform:uppercase;letter-spacing:0.06em;">You</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:0.85rem;color:var(--text-secondary);"><?= esc($u['email']) ?></td>
                    <td>
                        <?php
                            $rn = $u['role_name'] ?? '';
                            $cls = $rn === 'admin' ? 'badge-danger' : ($rn === 'teacher' ? 'badge-success' : 'badge-navy');
                        ?>
                        <span class="<?= $cls ?>"><?= esc($u['role_label'] ?? 'Unassigned') ?></span>
                    </td>
                    <td class="text-end pe-4">
                        <?php if ($isSelf): ?>
                            <span style="font-size:0.8rem;color:var(--text-muted);"><i class="bi bi-lock-fill me-1"></i>Self-locked</span>
                        <?php else: ?>
                            <form action="<?= base_url('/admin/users/assign-role/' . $u['id']) ?>" method="POST" class="d-flex align-items-center justify-content-end gap-2">
                                <?= csrf_field() ?>
                                <select name="role_id" class="clean-input" style="width:auto;padding:0.4rem 0.75rem;font-size:0.82rem;">
                                    <?php foreach ($roles as $roleId => $roleLabel): ?>
                                        <option value="<?= $roleId ?>" <?= $u['role_id'] == $roleId ? 'selected' : '' ?>><?= esc($roleLabel) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="clean-btn-primary" style="padding:0.4rem 1rem;font-size:0.82rem;">Save</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
