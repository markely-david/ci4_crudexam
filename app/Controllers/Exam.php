<?php

namespace App\Controllers;

use App\Models\ExamModel;

class Exam extends BaseController
{
    public function index()
    {
        $model = new ExamModel();
        $data = array_merge($this->data, [
            'exams' => $model->paginate(10),
            'pager' => $model->pager
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
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|min_length[3]',
            'description' => 'required',
            'category' => 'required',
            'status' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new ExamModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'status' => $this->request->getPost('status'),
        ];
        $model->insert($data);
        return redirect()->to('/exam')->with('success', 'Exam added successfully');
    }

    public function edit($id)
    {
        $model = new ExamModel();
        $exam = $model->find($id);
        if (!$exam) {
            return redirect()->to('/exam')->with('error', 'Exam not found');
        }
        $data = array_merge($this->data, [
            'exam' => $exam
        ]);
        return view('pages/exam/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|min_length[3]',
            'description' => 'required',
            'category' => 'required',
            'status' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new ExamModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'status' => $this->request->getPost('status'),
        ];
        $model->update($id, $data);
        return redirect()->to('/exam')->with('success', 'Exam updated successfully');
    }

    public function delete($id)
    {
        $model = new ExamModel();
        $model->delete($id);
        return redirect()->to('/exam')->with('success', 'Exam deleted successfully');
    }
}
