<?php include 'includes/header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

      <h2 class="text-center mb-4" data-aos="fade-up">Contact Us</h2>

      <p class="text-center text-muted mb-4" data-aos="fade-up" data-aos-delay="100">
        Have a question or suggestion? Send us a message using the form below.
      </p>

      <form action="proses_contact.php" method="post" class="shadow p-4 rounded bg-light" data-aos="zoom-in" data-aos-delay="200">
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Example: Ali bin Abu" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Contoh: ali@email.com" required>
        </div>

        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea name="message" id="message" class="form-control" rows="5" placeholder="Write your message here" required></textarea>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Send Message</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800, // kelajuan animasi
    once: true     // hanya animate sekali
  });
</script>

<?php include 'includes/footer.php'; ?>
