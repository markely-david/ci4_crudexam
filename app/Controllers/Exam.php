<?php

namespace App\Controllers;

use App\Models\ExamModel;

class Exam extends BaseController
{
    public function index()
    {
        $model = new ExamModel();
        $data = array_merge($this->data, [
            'exams' => $model->findAll()
        ]);
        return view('pages/exam/index', $data);
    }

    public function create()
    {
        $data = $this->data;
        return view('pages/exam/create', $data);
    }

    public function store()
    {
        $model = new ExamModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'status' => $this->request->getPost('status'),
        ];
        $model->insert($data);
        return redirect()->to('/exam');
    }

    public function edit($id)
    {
        $model = new ExamModel();
        $data = array_merge($this->data, [
            'exam' => $model->find($id)
        ]);
        return view('pages/exam/edit', $data);
    }

    public function update($id)
    {
        $model = new ExamModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'status' => $this->request->getPost('status'),
        ];
        $model->update($id, $data);
        return redirect()->to('/exam');
    }

    public function delete($id)
    {
        $model = new ExamModel();
        $model->delete($id);
        return redirect()->to('/exam');
    }
}
