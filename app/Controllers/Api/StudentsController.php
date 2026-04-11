<?php

namespace App\Controllers\Api;

use App\Models\StudentModel;

/**
 * GET  /api/v1/students        → list all students
 * GET  /api/v1/students/{id}   → single student
 *
 * Requires: Bearer token
 */
class StudentsController extends BaseApiController
{
    private StudentModel $studentModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        $students = $this->studentModel->findAll();
        return $this->ok($students);
    }

    public function show(int $id)
    {
        $student = $this->studentModel->find($id);

        if (! $student) {
            return $this->notFound("Student #{$id} not found.");
        }

        return $this->ok($student);
    }
}
