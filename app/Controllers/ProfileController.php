<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function show()
    {
        $session = session();
        $username = $session->get('username');

        if (!$username) {
            $session->destroy();
            return redirect()->to('/login')->with('error', 'Session expired. Please login again.');
        }

        $user = $this->userModel->where('username', $username)->first();

        if (!$user) {
            $session->destroy();
            return redirect()->to('/login')->with('error', 'User not found.');
        }

        $data = array_merge($this->data, ['user' => $user]);
        return view('profile/show', $data);
    }

    public function edit()
    {
        $session = session();
        $username = $session->get('username');

        if (!$username) {
            $session->destroy();
            return redirect()->to('/login')->with('error', 'Session expired. Please login again.');
        }

        $user = $this->userModel->where('username', $username)->first();

        if (!$user) {
            $session->destroy();
            return redirect()->to('/login')->with('error', 'User not found.');
        }

        $data = array_merge($this->data, ['user' => $user]);
        return view('profile/edit', $data);
    }

    public function update()
    {
        $session = session();
        $username = $session->get('username');

        if (!$username) {
            return redirect()->to('/login')->with('error', 'Session expired. Please login again.');
        }

        $user = $this->userModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found.');
        }

        $userId = $user['id'];

        // Validation rules
        $rules = [
            'fullname' => 'required|min_length[3]|max_length[100]',
            'username' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$userId}]",
            'student_id' => 'permit_empty|max_length[20]',
            'course' => 'permit_empty|max_length[100]',
            'year_level' => 'permit_empty|integer|in_list[1,2,3,4,5]',
            'section' => 'permit_empty|max_length[50]',
            'phone' => 'permit_empty|max_length[20]',
            'address' => 'permit_empty|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare update data
        $updateData = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'student_id' => $this->request->getPost('student_id'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section' => $this->request->getPost('section'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ];

        // Handle image upload
        $file = $this->request->getFile('profile_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validate image
            $validated = $this->validate([
                'profile_image' => [
                    'rules' => 'uploaded[profile_image]|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[profile_image,2048]',
                    'errors' => [
                        'uploaded' => 'Please select an image.',
                        'is_image' => 'The file must be an image.',
                        'mime_in' => 'Only JPG, PNG, and WEBP images are allowed.',
                        'max_size' => 'Image size must not exceed 2MB.',
                    ]
                ]
            ]);

            if ($validated) {
                // Delete old image if exists
                if (!empty($user['profile_image'])) {
                    $oldImagePath = FCPATH . 'uploads/profiles/' . $user['profile_image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Generate unique filename
                $ext = $file->getExtension();
                $newName = 'avatar_' . $userId . '_' . time() . '.' . $ext;

                // Move file to uploads/profiles
                $file->move(FCPATH . 'uploads/profiles/', $newName);

                $updateData['profile_image'] = $newName;
            } else {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }

        // Update profile
        if ($this->userModel->updateProfile($userId, $updateData)) {
            // Update session data
            $session->set('fullname', $updateData['fullname']);
            $session->set('username', $updateData['username']);

            return redirect()->to('/profile')->with('success', 'Profile updated successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update profile.');
    }
}
