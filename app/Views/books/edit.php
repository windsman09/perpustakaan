<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-3"><i class="bi bi-pencil-square"></i> Edit Buku</h3>

<div class="card">
  <div class="card-body">
    /books/update/<?= $book[]>
      <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" value="<?= esc($book['judul']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Pengarang</label>
        <input type="text" name="pengarang" class="form-control" value="<?= esc($book['pengarang']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" class="form-control" value="<?= esc($book['tahun_terbit']) ?>" required>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
        /books<i class="bi bi-arrow-left"></i> Kembali</a>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>