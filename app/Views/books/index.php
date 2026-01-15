<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php $title = 'Daftar Buku'; ?>

<h3 class="mb-3"><i class="bi bi-journal-text"></i> Daftar Buku</h3>

<!-- Alert Notifikasi -->
<div id="alertBox" class="alert d-none" role="alert"></div>

<!-- Form Tambah (AJAX) -->
<div class="card mb-4">
  <div class="card-header bg-success text-white"><i class="bi bi-plus-circle"></i> Tambah Buku</div>
  <div class="card-body">
    <form id="formTambahBuku">
      <div class="row g-2">
        <div class="col-md-4">
          <input type="text" name="judul" class="form-control" placeholder="Judul" required>
        </div>
        <div class="col-md-3">
          <input type="text" name="pengarang" class="form-control" placeholder="Pengarang" required>
        </div>
        <div class="col-md-3">
          <input type="number" name="tahun_terbit" class="form-control" placeholder="Tahun Terbit" required>
        </div>
        <div class="col-md-2 d-grid">
          <button class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Tabel Buku -->
<div class="card">
  <div class="card-header bg-secondary text-white"><i class="bi bi-card-list"></i> List Buku</div>
  <div class="card-body table-responsive">
    <table class="table table-striped align-middle" id="tableBuku">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Judul</th>
          <th>Pengarang</th>
          <th>Tahun Terbit</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($books as $i => $b): ?>
          <tr data-id="<?= $b['id'] ?>">
            <td><?= $i + 1 ?></td>
            <td><?= esc($b['judul']) ?></td>
            <td><?= esc($b['pengarang']) ?></td>
            <td><?= esc($b['tahun_terbit']) ?></td>
            <td class="text-center">
 <a href="/books/edit/<?= $b['id'] ?>" class="btn btn-sm btn-warning">
  <i class="bi bi-pencil-square"></i> Edit
</a>

<a href="/books/delete/<?= $b['id'] ?>" class="btn btn-sm btn-danger"
   onclick="return confirm('Yakin?')">
  <i class="bi bi-trash"></i> Hapus
</a>


  <a href="<?= site_url('books/delete/' . $b['id']) ?>"
     class="btn btn-sm btn-danger"
     onclick="return confirm('Yakin ingin menghapus buku ini?');">
    <i class="bi bi-trash"></i> Hapus
  </a>
</td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
$(function() {
  // Tambah buku via AJAX (tanpa reload)
  $('#formTambahBuku').on('submit', function(e) {
    e.preventDefault();

    const form = $(this);
    const data = form.serializeArray();

    // Jika CSRF aktif di CI4, sertakan token
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const csrfHash  = $('meta[name="csrf-hash"]').attr('content');
    if (csrfToken && csrfHash) {
      data.push({ name: csrfToken, value: csrfHash });
    }

    $.post('/books/store', data, function(resp) {
      if (resp.success) {
        // Tambah baris baru ke tabel
        const b = resp.book;
        const rowCount = $('#tableBuku tbody tr').length + 1;
        const newRow = `
          <tr data-id="${b.id}">
            const newRow = `
<tr data-id="${b.id}">
  <td>${rowCount}</td>
  <td>${escapeHtml(b.judul)}</td>
  <td>${escapeHtml(b.pengarang)}</td>
  <td>${escapeHtml(b.tahun_terbit)}</td>
  <td class="text-center">
    <a href="/books/edit/${b.id}" class="btn btn-sm btn-warning">
      <i class="bi bi-pencil-square"></i> Edit
    </a>
    <a href="<?= site_url('/books/delete/' . $b['id']) ?>"
   class="btn btn-sm btn-danger"
   onclick="return confirm('Yakin ingin menghapus buku ini?');">
  <i class="bi bi-trash"></i> Hapus
</a>

  </td>
</tr>
`;


          </tr>
        `;
        $('#tableBuku tbody').prepend(newRow);

        // Notifikasi sukses
        showAlert('success', 'Buku berhasil ditambahkan!');

        // Reset form
        form[0].reset();
      } else {
        showAlert('danger', 'Gagal menambahkan buku.');
      }
    }, 'json')
    .fail(function() {
      showAlert('danger', 'Terjadi masalah koneksi.');
    });
  });

  function showAlert(type, message) {
    const alertBox = $('#alertBox');
    alertBox.removeClass('d-none alert-success alert-danger alert-warning')
            .addClass('alert-' + type)
            .text(message);
    setTimeout(() => alertBox.addClass('d-none'), 3000);
  }

  // Helper sederhana untuk escape HTML (hindari XSS)
  function escapeHtml(text) {
    return $('<div/>').text(text).html();
  }
});
</script>

<?= $this->endSection() ?>