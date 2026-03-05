<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Exam Management System</h2>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Exam</h3>
                </div>
                <div class="card-body">
                    <form action="/exam/store" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Exam Title" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="description" class="form-control" placeholder="Description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Exam</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Exams</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($exams)): foreach($exams as $e): ?>
                            <tr>
                                <td><?= esc($e['title']) ?></td>
                                <td><?= esc($e['description']) ?></td>
                                <td><?= esc($e['date']) ?></td>
                                <td>
                                    <form action="/exam/delete/<?= $e['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger btn-hover">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No exams found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
