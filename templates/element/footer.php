<!--Footer-->
<div class="container-fluid header-view text-light shadow mt-5 pb-1"><!--fixed-bottom-->

  <!-- Site footer -->
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>			
			<p class="justify">CodeThePixel.com <i>(CTP) </i> is an initiative  to help the upcoming programmers with the code. CTP focuses on providing the most efficient code or snippets as the code wants to be simple. The idea is to help code explorer build up concepts using web-framework that include PHP, Java, HTML, CSS, Bootstrap, JavaScript, SQL and Algorithm.</p>
			<div class="badge bg-primary text-wrap">© Copyright <?= date('Y'); ?> <?php echo $system_name; ?></div>
<div class="badge bg-danger text-wrap">Powered by Re-CRUD</div>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Categories</h6>
            <ul class="footer-links">
              <li><?php echo $this->Html->link('Home', ['controller' => 'articles', 'action' => 'index'],['class' => '']); ?></li>
			  <li><?php echo $this->Html->link('Blog', ['controller' => 'blogs', 'action' => 'index'],['class' => '']); ?></li>
			  <li><?php echo $this->Html->link('Project', ['controller' => 'projects', 'action' => 'index'],['class' => '']); ?></li>
			  <li><?php echo $this->Html->link('Contact', ['controller' => 'contacts', 'action' => 'index'],['class' => '']); ?></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Contact Us</a></li>
              <li><a href="#">Contribute</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><?php echo $this->Html->link('Sitemap',['controller' => 'Sitemaps', 'action' => 'index', '_full' => true, 'target' => '_blank']); ?></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; <?= date('Y'); ?> All Rights Reserved by 
         <a href="#">Asyraf-wa</a> (<?php echo $system_name; ?>).
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a class="dribbble" href="#"><i class="fab fa-dribbble"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></a></li>   
            </ul>
          </div>
        </div>
      </div>
</footer>
</div>