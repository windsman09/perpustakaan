<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-3"><i class="bi bi-journal-text"></i> Daftar Buku</h3>

<div id="alertBox" class="alert d-none"></div>

<div class="card mb-4">
  <div class="card-header bg-success text-white">
    <i class="bi bi-plus-circle"></i> Tambah Buku
  </div>
  <div class="card-body">
    <form id="formTambahBuku">
      <div class="row g-2">
        <div class="col-md-4">
          <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="col-md-3">
          <input type="text" name="pengarang" class="form-control" required>
        </div>
        <div class="col-md-3">
          <input type="number" name="tahun_terbit" class="form-control" required>
        </div>
        <div class="col-md-2 d-grid">
          <button class="btn btn-success">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-body table-responsive">
    <table class="table" id="tableBuku">
      <thead>
        <tr>
          <th>#</th>
          <th>Judul</th>
          <th>Pengarang</th>
          <th>Tahun</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($books)): ?>
          <?php foreach ($books as $i => $b): ?>
          <tr>
            <td><?= $i+1 ?></td>
            <td><?= esc($b['judul']) ?></td>
            <td><?= esc($b['pengarang']) ?></td>
            <td><?= esc($b['tahun_terbit']) ?></td>
            <td>
              <a href="/books/delete/<?= $b['id'] ?>"
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('Hapus?')">
                Hapus
              </a>
            </td>
          </tr>
          <?php endforeach ?>
        <?php else: ?>
          <tr><td colspan="5">Belum ada data</td></tr>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</div>

<script>
$('#formTambahBuku').on('submit', function(e){
  e.preventDefault();
  $.post('/books/store', $(this).serialize(), function(){
    location.reload();
  });
});
</script>

<?= $this->endSection() ?>
