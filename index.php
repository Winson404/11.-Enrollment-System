<?php 
  include 'navbar.php';
?>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

      <div class="container">
        <h2 data-aos="fade-up" data-aos-delay="100" class="">Empowering Education,<br>Shaping Tomorrow's Leaders</h2>
        <p data-aos="fade-up" data-aos-delay="200">"We're a skilled team of developers dedicated to designing intuitive enrollment platforms tailored to your needs."</p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
          <a href="login.php" class="btn-get-started">Begin Your Journey</a>
        </div>
      </div>



    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container">

    <div class="row gy-4">

      <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
        <img src="assets/img/about.jpg" class="img-fluid" alt="">
      </div>

      <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
        <h3>Embracing Opportunities for Growth</h3>
        <p class="fst-italic">
          Discover potential pathways for personal and professional development, fostering growth and innovation.
        </p>
        <ul>
          <li><i class="bi bi-check-circle"></i> <span>Explore diverse learning opportunities to enhance skills and knowledge.</span></li>
          <li><i class="bi bi-check-circle"></i> <span>Navigate challenges with resilience, gaining invaluable experience.</span></li>
          <li><i class="bi bi-check-circle"></i> <span>Pursue excellence through continuous improvement and dedication.</span></li>
        </ul>
        <a href="#" class="read-more"><span>Learn More</span><i class="bi bi-arrow-right"></i></a>
      </div>

    </div>

  </div>

</section>
<!-- /About Section -->

    <!-- Counts Section -->
    <section id="counts" class="section counts">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 d-flex justify-content-center">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <?php $tbl_enroll=$db->getEnrolledStudents(); ?>
              <span data-purecounter-start="0" data-purecounter-end="<?= $tbl_enroll->num_rows > 0 ? $tbl_enroll->num_rows : "0"; ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Student</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <?php $tbl_course=$db->getCourse(); ?>
              <span data-purecounter-start="0" data-purecounter-end="<?= $tbl_course->num_rows > 0 ? $tbl_course->num_rows : "0"; ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p class="">Courses</p>
            </div>
          </div><!-- End Stats Item -->

          <!-- <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1" class="purecounter"></span>
              <p class="">Events</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
              <p class="">Trainers</p>
            </div>
          </div> -->

        </div>

      </div>

    </section><!-- /Counts Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="section why-us">

        <div class="container">

    <div class="row gy-4">

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="why-box">
          <h3>Why Opt for Our Solutions?</h3>
          <p>
            Discover the reasons behind choosing our products, tailored to meet your needs and exceed expectations.
          </p>
          <div class="text-center">
            <a href="#" class="more-btn"><span>Explore More</span> <i class="bi bi-chevron-right"></i></a>
          </div>
        </div>
      </div><!-- End Why Box -->

      <div class="col-lg-8 d-flex align-items-stretch">
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

          <div class="col-xl-4">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-clipboard-data"></i>
              <h4>Efficiency in Data Management</h4>
              <p>Streamline your operations with our efficient data management solutions, ensuring seamless processes.</p>
            </div>
          </div><!-- End Icon Box -->

          <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-gem"></i>
              <h4>Exceptional Quality Assurance</h4>
              <p>Experience unparalleled quality assurance with our products, ensuring reliability and satisfaction.</p>
            </div>
          </div><!-- End Icon Box -->

          <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-inboxes"></i>
              <h4>Seamless Workflow Integration</h4>
              <p>Integrate our solutions seamlessly into your workflow, enhancing productivity and efficiency.</p>
            </div>
          </div><!-- End Icon Box -->

        </div>
      </div>

    </div>

  </div>

</section>
  <!-- /Why Us Section -->

    
   

  </main>

<?php include 'footer_2.php'; ?>