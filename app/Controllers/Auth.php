<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, langsung ke daftar buku
        if (session()->get('user_id')) {
            return redirect()->to('books'); // ❌ /books
        }

        return view('auth/login');
    }

    public function doLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = (new UserModel())->where('username', $username)->first();

        if ($user && $user['password'] === $password) { // plain text (UAS)
            session()->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'logged_in' => true
            ]);

            return redirect()->to('books'); // ❌ /books
        }

        return redirect()->back()->with('error', 'Login gagal. Periksa username/password.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login'); // ❌ /login
    }
}
log_message('error', 'TES LOG AUTH LOGIN');
