<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/books');
        }

        return view('auth/login');
    }

    public function doLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = (new UserModel())
            ->where('username', $username)
            ->first();

        if ($user && $user['password'] === $password) {
            session()->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'logged_in' => true
            ]);

            return redirect()->to('/books');
        }

        return redirect()->back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
