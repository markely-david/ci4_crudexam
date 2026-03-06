<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="m-0">Exam Records</h2>
            <small class="text-muted">Logged in as: <?= session()->get('email') ?></small>
        </div>
        <a href="/exam/create" class="btn btn-primary">Add New</a>
    </div>
    
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($exams)): $no = 1; foreach($exams as $e): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><a href="/exam/edit/<?= $e['id'] ?>"><?= esc($e['title']) ?></a></td>
                        <td><?= esc($e['category']) ?></td>
                        <td><?= esc($e['status']) ?></td>
                        <td>
                            <a href="/exam/edit/<?= $e['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <form action="/exam/delete/<?= $e['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No exams found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if(isset($pager)): ?>
        <div class="card-footer">
            <?= $pager->links() ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection(); ?>
