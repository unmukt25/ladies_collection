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
}