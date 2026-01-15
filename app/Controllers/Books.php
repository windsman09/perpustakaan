<?php

namespace App\Controllers;

use App\Models\BookModel;

class Books extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('books/index', [
            'title' => 'Daftar Buku',
            'books' => $this->bookModel->findAll()
        ]);
    }

  public function store()
{
    $data = $this->request->getPost();
    $id = $this->bookModel->insert($data);

    return $this->response->setJSON([
        'success' => true,
        'book' => [
            'id' => $id,
            'judul' => $data['judul'],
            'pengarang' => $data['pengarang'],
            'tahun_terbit' => $data['tahun_terbit'],
        ]
    ]);
}



    public function delete($id)
    {
        $this->bookModel->delete($id);
        return redirect()->to('/books');
    }
}
