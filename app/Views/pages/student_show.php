<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Student Details</h2>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="150">ID</th>
                            <td><?= esc($student['id']) ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?= esc($student['name']) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= esc($student['email']) ?></td>
                        </tr>
                        <tr>
                            <th>Course</th>
                            <td><?= esc($student['course']) ?></td>
                        </tr>
                    </table>
                    <a href="/students" class="btn btn-secondary">Back to List</a>
                    <a href="/student/edit/<?= $student['id'] ?>" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
