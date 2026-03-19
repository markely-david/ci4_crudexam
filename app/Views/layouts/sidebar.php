<?php
$role       = session('user')['role'] ?? 'guest';
$fullname   = session('user')['fullname'] ?? 'User';
$segment    = service('uri')->getSegment(1);
$subsegment = service('uri')->getSegment(2);
$initial    = strtoupper(substr($fullname, 0, 1));
?>
<aside class="sidebar-wrapper">
    <a href="<?= base_url() ?>" class="sidebar-logo text-decoration-none">
        <div class="logo-icon"><i class="bi bi-grid-fill"></i></div>
        <div class="logo-text">
            <span class="name">AdminPanel</span>
            <span class="tagline">Management System</span>
        </div>
    </a>

    <nav class="sidebar-nav">
        <?php if ($role === 'admin'): ?>
            <div class="nav-group-title">Overview</div>
            <a href="<?= base_url('dashboard') ?>" class="nav-item-link <?= $segment === 'dashboard' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= base_url('students') ?>" class="nav-item-link <?= $segment === 'students' ? 'active' : '' ?>">
                <i class="bi bi-people-fill"></i> Students
            </a>

            <div class="nav-group-title">Administration</div>
            <a href="<?= base_url('admin/roles') ?>" class="nav-item-link <?= ($segment === 'admin' && $subsegment === 'roles') ? 'active' : '' ?>">
                <i class="bi bi-shield-fill-check"></i> Roles
            </a>
            <a href="<?= base_url('admin/users') ?>" class="nav-item-link <?= ($segment === 'admin' && $subsegment === 'users') ? 'active' : '' ?>">
                <i class="bi bi-person-gear"></i> Users
            </a>

        <?php elseif ($role === 'teacher'): ?>
            <div class="nav-group-title">Overview</div>
            <a href="<?= base_url('dashboard') ?>" class="nav-item-link <?= $segment === 'dashboard' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= base_url('students') ?>" class="nav-item-link <?= $segment === 'students' ? 'active' : '' ?>">
                <i class="bi bi-people-fill"></i> Students
            </a>

        <?php else: ?>
            <div class="nav-group-title">Overview</div>
            <a href="<?= base_url('student/dashboard') ?>" class="nav-item-link <?= ($segment === 'student' || $segment === 'dashboard') ? 'active' : '' ?>">
                <i class="bi bi-house-fill"></i> Dashboard
            </a>

            <div class="nav-group-title">My Account</div>
            <a href="<?= base_url('profile') ?>" class="nav-item-link <?= ($segment === 'profile' && empty($subsegment)) ? 'active' : '' ?>">
                <i class="bi bi-person-circle"></i> My Profile
            </a>
            <a href="<?= base_url('profile/edit') ?>" class="nav-item-link <?= ($segment === 'profile' && $subsegment === 'edit') ? 'active' : '' ?>">
                <i class="bi bi-pencil-square"></i> Edit Profile
            </a>
        <?php endif; ?>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <?php if (!empty(session('user')['profile_image'])): ?>
                <img src="<?= base_url('uploads/profiles/' . esc(session('user')['profile_image'])) ?>" style="width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid var(--gold-300);flex-shrink:0;">
            <?php else: ?>
                <div class="avatar"><?= $initial ?></div>
            <?php endif; ?>
            <div class="user-info">
                <div class="name"><?= esc($fullname) ?></div>
                <div class="role-badge"><?= esc($role) ?></div>
            </div>
        </div>
        <a href="<?= base_url('logout') ?>" class="nav-logout">
            <i class="bi bi-box-arrow-left"></i> Sign Out
        </a>
    </div>
</aside>
