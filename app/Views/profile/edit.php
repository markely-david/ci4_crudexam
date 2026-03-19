<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2>Edit Profile</h2>
        <p>Update your personal and academic information.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= base_url('profile') ?>" class="clean-btn-secondary"><i class="bi bi-x-lg"></i> Discard</a>
        <button type="submit" form="profileForm" class="clean-btn-primary"><i class="bi bi-check-lg"></i> Save Changes</button>
    </div>
</div>

<?php if (session('errors')): ?>
    <div class="alert alert-danger d-flex align-items-start gap-2 mb-4">
        <i class="bi bi-exclamation-triangle-fill mt-1 flex-shrink-0"></i>
        <div>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-1 ps-3">
                <?php foreach (session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>

<form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data" id="profileForm">
    <?= csrf_field() ?>

    <div class="row g-4">
        <!-- Avatar -->
        <div class="col-lg-4">
            <div class="clean-card p-4 text-center">
                <div class="position-relative d-inline-block mb-3">
                    <?php if (!empty($user['profile_image'])): ?>
                        <img id="preview" src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>"
                             style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:4px solid #e2e8f0;">
                    <?php else: ?>
                        <div id="preview" style="width:120px;height:120px;border-radius:50%;background:#eef2ff;color:#4f46e5;display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:700;border:4px solid #e2e8f0;margin:0 auto;">
                            <?= strtoupper(substr($user['fullname'], 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                    <label for="profile_image" style="position:absolute;bottom:4px;right:4px;width:32px;height:32px;border-radius:50%;background:#4f46e5;color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;border:2px solid #fff;box-shadow:0 2px 8px rgba(79,70,229,0.4);">
                        <i class="bi bi-camera-fill" style="font-size:0.8rem;"></i>
                    </label>
                    <input type="file" name="profile_image" id="profile_image" class="d-none" accept="image/jpeg,image/png,image/webp">
                </div>
                <h6 style="font-weight:800;margin-bottom:0.25rem;"><?= esc($user['fullname']) ?></h6>
                <p id="fileInfo" style="font-size:0.78rem;color:#4f46e5;display:none;margin:0.5rem 0 0;"></p>
                <p style="font-size:0.8rem;color:#94a3b8;margin-top:0.5rem;">JPG, PNG or WEBP. Max 2MB.</p>
            </div>
        </div>

        <!-- Fields -->
        <div class="col-lg-8 d-flex flex-column gap-4">
            <!-- Personal -->
            <div class="clean-card">
                <div class="clean-card-header">
                    <h6><i class="bi bi-person me-2 text-primary"></i>Personal Details</h6>
                </div>
                <div class="p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="fullname" class="clean-input"
                                value="<?= old('fullname', esc($user['fullname'])) ?>" required placeholder="Your full name">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="clean-input"
                                value="<?= old('username', esc($user['username'])) ?>" required placeholder="your@email.com">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Phone Number</label>
                            <input type="tel" name="phone" class="clean-input"
                                value="<?= old('phone', esc($user['phone'] ?? '')) ?>" placeholder="+63 9XX XXX XXXX">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Home Address</label>
                            <input type="text" name="address" class="clean-input"
                                value="<?= old('address', esc($user['address'] ?? '')) ?>" placeholder="Street, City, Province">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic -->
            <div class="clean-card">
                <div class="clean-card-header">
                    <h6><i class="bi bi-mortarboard me-2 text-primary"></i>Academic Record</h6>
                </div>
                <div class="p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Student ID</label>
                            <input type="text" name="student_id" class="clean-input"
                                value="<?= old('student_id', esc($user['student_id'] ?? '')) ?>" placeholder="e.g. 2024-00001">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Course / Program</label>
                            <input type="text" name="course" class="clean-input"
                                value="<?= old('course', esc($user['course'] ?? '')) ?>" placeholder="e.g. BS Computer Science">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Year Level</label>
                            <select name="year_level" class="clean-input">
                                <option value="">— Select —</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>" <?= old('year_level', $user['year_level'] ?? '') == $i ? 'selected' : '' ?>>Year <?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Section</label>
                            <input type="text" name="section" class="clean-input"
                                value="<?= old('section', esc($user['section'] ?? '')) ?>" placeholder="e.g. A">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="clean-card">
                <div class="clean-card-header">
                    <h6><i class="bi bi-shield-lock me-2 text-primary"></i>Change Password <small class="text-muted fw-normal ms-1">— leave blank to keep current</small></h6>
                </div>
                <div class="p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">New Password</label>
                            <div class="position-relative">
                                <input type="password" name="new_password" id="newPassword" class="clean-input" placeholder="Min. 8 characters" style="padding-right:2.5rem;">
                                <button type="button" class="toggle-pw position-absolute border-0 bg-transparent" style="right:0.75rem;top:50%;transform:translateY(-50%);color:#94a3b8;cursor:pointer;" data-target="newPassword"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Confirm Password</label>
                            <div class="position-relative">
                                <input type="password" name="confirm_password" id="confirmPassword" class="clean-input" placeholder="Repeat new password" style="padding-right:2.5rem;">
                                <button type="button" class="toggle-pw position-absolute border-0 bg-transparent" style="right:0.75rem;top:50%;transform:translateY(-50%);color:#94a3b8;cursor:pointer;" data-target="confirmPassword"><i class="bi bi-eye"></i></button>
                            </div>
                            <div id="pwMismatch" class="d-none mt-1" style="font-size:0.78rem;color:#ef4444;"><i class="bi bi-exclamation-circle me-1"></i>Passwords do not match</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
(function(){
    // Avatar preview
    document.getElementById('profile_image').addEventListener('change', function(){
        const file = this.files[0];
        if (!file) return;
        if (file.size > 2*1024*1024) { alert('Max 2MB.'); this.value=''; return; }
        document.getElementById('fileInfo').textContent = file.name;
        document.getElementById('fileInfo').style.display = 'block';
        const reader = new FileReader();
        reader.onload = e => {
            const prev = document.getElementById('preview');
            if (prev.tagName === 'IMG') { prev.src = e.target.result; }
            else {
                const img = document.createElement('img');
                img.id = 'preview';
                img.src = e.target.result;
                img.style.cssText = 'width:120px;height:120px;border-radius:50%;object-fit:cover;border:4px solid #e2e8f0;';
                prev.parentNode.replaceChild(img, prev);
            }
        };
        reader.readAsDataURL(file);
    });

    // Password toggle
    document.querySelectorAll('.toggle-pw').forEach(btn => {
        btn.addEventListener('click', function(){
            const inp = document.getElementById(this.dataset.target);
            const ico = this.querySelector('i');
            inp.type = inp.type === 'password' ? 'text' : 'password';
            ico.className = inp.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
        });
    });

    // Password match
    const np = document.getElementById('newPassword');
    const cp = document.getElementById('confirmPassword');
    const mm = document.getElementById('pwMismatch');
    function check(){ mm.classList.toggle('d-none', !cp.value || np.value === cp.value); }
    np.addEventListener('input', check);
    cp.addEventListener('input', check);

    document.getElementById('profileForm').addEventListener('submit', function(e){
        if (np.value && np.value !== cp.value){ e.preventDefault(); mm.classList.remove('d-none'); cp.focus(); }
    });
})();
</script>
<?= $this->endSection() ?>
