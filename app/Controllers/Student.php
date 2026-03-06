<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Student extends BaseController
{
    public function index()
    {
        $model = new StudentModel();
        $data = array_merge($this->data, [
            'students' => $model->paginate(10),
            'pager' => $model->pager
        ]);
        return view('pages/student_view', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[students.email]',
            'course' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new StudentModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ];
        $model->insert($data);
        return redirect()->to('/students')->with('success', 'Student added successfully');
    }

    public function show($id)
    {
        $model = new StudentModel();
        $student = $model->find($id);
        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found');
        }
        $data = array_merge($this->data, ['student' => $student]);
        return view('pages/student_show', $data);
    }

    public function edit($id)
    {
        $model = new StudentModel();
        $student = $model->find($id);
        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found');
        }
        $data = array_merge($this->data, ['student' => $student]);
        return view('pages/student_edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[students.email,id,{$id}]",
            'course' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new StudentModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ];
        $model->update($id, $data);
        return redirect()->to('/students')->with('success', 'Student updated successfully');
    }

    public function delete($id)
    {
        $model = new StudentModel();
        $model->delete($id);
        return redirect()->to('/students')->with('success', 'Student deleted successfully');
    }
}
