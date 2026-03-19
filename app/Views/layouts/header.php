<?php
$role     = session('user')['role'] ?? 'user';
$fullname = session('user')['fullname'] ?? 'User';
$segment  = service('uri')->getSegment(1);
$page     = ucfirst($segment ?: 'Dashboard');

$roleBg    = $role === 'admin'   ? '#fdf3c8' : ($role === 'teacher' ? '#f0fdf4' : '#eef4fb');
$roleColor = $role === 'admin'   ? '#b8860b' : ($role === 'teacher' ? '#15803d' : '#1e3a6e');
?>
<header class="header-wrapper">
    <div class="header-breadcrumb">
        <i class="bi bi-grid-fill" style="color: var(--gold-400); font-size:0.9rem;"></i>
        <span>AdminPanel</span>
        <span class="sep">›</span>
        <span class="current"><?= esc($page) ?></span>
    </div>

    <div class="d-flex align-items-center gap-3 ms-auto">
        <span style="background:<?= $roleBg ?>;color:<?= $roleColor ?>;font-size:0.7rem;font-weight:800;padding:0.3rem 0.85rem;border-radius:20px;letter-spacing:0.06em;text-transform:uppercase;">
            <?= esc($role) ?>
        </span>

        <?php $profileImage = session('user')['profile_image'] ?? ''; ?>
        <div class="dropdown">
            <button class="d-flex align-items-center gap-2 border-0 bg-transparent" style="cursor:pointer;padding:0.4rem 0.75rem;border-radius:10px;border:1.5px solid var(--border) !important;background:#fff !important;font-family:inherit;font-size:0.85rem;font-weight:600;color:var(--text-primary);transition:all 0.15s;" data-bs-toggle="dropdown">
                <?php if (!empty($profileImage)): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($profileImage)) ?>" style="width:30px;height:30px;border-radius:50%;object-fit:cover;border:2px solid var(--gold-300);">
                <?php else: ?>
                    <div style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,var(--gold-400),var(--gold-600));color:var(--navy-900);display:flex;align-items:center;justify-content:center;font-size:0.78rem;font-weight:800;flex-shrink:0;">
                        <?= strtoupper(substr($fullname, 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <span><?= esc($fullname) ?></span>
                <i class="bi bi-chevron-down" style="font-size:0.65rem;color:var(--text-muted);"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <span style="display:block;padding:0.5rem 0.9rem;font-size:0.72rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;">Account</span>
                </li>
                <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="bi bi-person-circle" style="color:var(--gold-500);"></i> My Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Sign Out</a></li>
            </ul>
        </div>
    </div>
</header>
