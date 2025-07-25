<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
  .site-footer {
    background-color: #4a69bd;
    color: #ffffff;
    padding: 20px 0;
    text-align: center;
    margin-top: 50px;
  }

  .site-footer .social-icons a {
    color: #ffffff;
    margin: 0 10px;
    font-size: 20px;
    transition: color 0.3s;
  }

  .site-footer .social-icons a:hover {
    color: #ffc107; /* warna kuning bila hover */
  }

  .site-footer p {
    margin-top: 15px;
    font-size: 14px;
  }
</style>

<footer class="site-footer">
  <div class="container">
    <div class="social-icons mb-2">
      <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
      <a href="https://instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
      <a href="https://twitter.com" target="_blank"><i class="bi bi-twitter"></i></a>
      <a href="https://youtube.com" target="_blank"><i class="bi bi-youtube"></i></a>
    </div>
    <p>&copy; <?php echo date('Y'); ?> Lensa TigaD. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
