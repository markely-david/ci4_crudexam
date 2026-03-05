<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h2 class="mb-4">Create Exam Record</h2>
    
    <div class="card">
        <div class="card-body">
            <form action="/exam/store" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-control" value="Active" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="/exam" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
