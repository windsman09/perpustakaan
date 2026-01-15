<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table         = 'buku';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['judul', 'pengarang', 'tahun_terbit'];
}
