 <!--  <footer class="main-footer">
    <div class="row p-3">
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 bg-white">
        <label>Mission</label>
        <p class="text-sm text-justify text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem ipsam saepe culpa, quia dolor recusandae obcaecati eligendi assumenda pariatur sapiente tempora iusto excepturi quasi minima voluptates ipsum reiciendis corrupti. Laudantium.</p>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 bg-white">
        <label>Vision</label>
        <p class="text-sm text-justify text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque vel deleniti in adipisci, facere quisquam amet aliquid qui, repudiandae, asperiores illum cupiditate voluptatibus? Natus optio minima veniam perspiciatis, deserunt. Eveniet.</p>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 bg-white">
        <label>Contact Us</label>
        <p class="text-sm text-justify text-muted"><i class="fa-solid fa-phone"></i> +63 9123456789</p>
        <p class="text-sm text-justify text-muted"><i class="fa-solid fa-envelope"></i> admin@gmail.com</p>
      </div>
    </div>
    <div class="dropdown-divider"></div>
    <strong>Copyright &copy; 2023 <a href="#">Enrollment System</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer> -->
  
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Custom JS -->
  <script src="dist/js/script.js"></script>
  <!-- SweetAlert Message -->
  <script src="dist/js/sweetalert2.min.js"></script>
  <?php if(isset($_SESSION['message']) && isset($_SESSION['text']) && isset($_SESSION['status'])) { ?>
    <script>
      swal ({
        title: '<?php echo $_SESSION['message']; ?>',
        text: "<?php echo $_SESSION['text']; ?>",
        icon: "<?php echo $_SESSION['status']; ?>",
        confirmButtonColor: '#3085d6',
        confirmButtonText: "Okay",
        timer: 3000
      });
    </script>
  <?php unset($_SESSION['message']); unset($_SESSION['text']); unset($_SESSION['status']); } ?>
  </div>
</body>
</html>