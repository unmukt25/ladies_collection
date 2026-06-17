<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $email = $this->request
            ->getPost('email');

        $password = $this->request
            ->getPost('password');

        $userModel = new UserModel();

        $user = $userModel
            ->where('email', $email)
            ->first();

        // user not found
        if (!$user) {
            return redirect()
                ->to(base_url('/admin/login'))
                ->with(
                    'error',
                    'Invalid Email'
                );
        }

        // password verify
        if (
            !password_verify(
                $password,
                $user['password']
            )
        ) {
            return redirect()
                ->to(base_url('/admin/login'))
                ->with(
                    'error',
                    'Invalid Password'
                );
        }

        // create session
        session()->set([
            'admin_id' => $user['id'],
            'admin_name' => $user['user_name'],
            'logged_in' => true
        ]);

        return redirect()
            ->to(base_url('/admin/dashboard'));
    }

    public function logout()
    {
        // Destroy all session data
        session()->destroy();

        // Optional: remove specific keys instead
        // session()->remove(['user_id', 'email', 'role']);

        // Redirect to login page
        return redirect()->to(base_url('/admin/login'));
    }

    public function updateProfile()
    {
        $userModel = new UserModel();

        $userId = session()->get('admin_id');

        $userModel->update($userId, [
            'user_name' => $this->request->getPost('user_name')
        ]);

        session()->set('admin_name', $this->request->getPost('user_name'));

        return redirect()->back()->with(
            'success',
            'Profile updated successfully.'
        );
    }

    public function changePassword()
    {
        $userModel = new UserModel();

        $userId = session()->get('admin_id');

        $user = $userModel->find($userId);

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->back()->with(
                'error',
                'Current password is incorrect.'
            );
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with(
                'error',
                'Password confirmation does not match.'
            );
        }

        $userModel->update($userId, [
            // 'password' => password_hash($newPassword, PASSWORD_DEFAULT)
            'password' => $newPassword
        ]);

        return redirect()->back()->with(
            'success',
            'Password changed successfully.'
        );
    }
}