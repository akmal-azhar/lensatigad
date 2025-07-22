<?php include 'includes/header.php'; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <h2 class="text-center mb-4">Hubungi Kami</h2>
      <p class="text-center text-muted mb-4">
        Ada pertanyaan atau cadangan? Hantar mesej kepada kami melalui borang di bawah.
      </p>

      <form action="proses_contact.php" method="post" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
          <label for="name" class="form-label">Nama Penuh</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Ali bin Abu" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Emel</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Contoh: ali@email.com" required>
        </div>

        <div class="mb-3">
          <label for="message" class="form-label">Mesej</label>
          <textarea name="message" id="message" class="form-control" rows="5" placeholder="Tulis mesej anda di sini..." required></textarea>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Hantar Mesej</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
