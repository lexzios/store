<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="footer-ribbon">
        <span>Get in Touch</span>
      </div>
      <div class="col-md-3">
        <div class="newsletter">
          <h4>Newsletter</h4>
          <!-- <p>Keep up on our always evolving product features and technology. Enter your e-mail and subscribe to our newsletter.</p> -->
          <p>Daftar ke langganan Kami untuk mendapatkan Update-an dari Central PC. Masukkan Email Anda.</p>

          <div class="alert alert-success hidden" id="newsletterSuccess">
            <strong>Success!</strong> You've been added to our email list.
          </div>

          <div class="alert alert-danger hidden" id="newsletterError">Failed adding to our email list</div>
          <div class="alert alert-danger hidden" id="newsletterInvalid">Invalid Email Address</div>

          <form id="newsletterForm" action="/newsletter" method="POST">
            <div class="input-group">
              <input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
              </span>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-3">
        <h4>Latest Tweet</h4>
        <div id="tweet" class="twitter" data-account-id="KomputerZone">
          <p>Please wait...</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="contact-details">
          <h4>Contact Us</h4>
          <ul class="contact">
            <li><p><i class="icon icon-map-marker"></i> <strong>Address:</strong> Plaza Harco Mangga Dua Lt. 3 Blok B No.49D</br>Jl. Arteri Mangga Dua Raya Jakarta - 10730</p></li>
            <li><p><i class="icon icon-phone"></i> <strong>Phone:</strong> (0851) 0120 2123, (0851) 0770 9278<br/> (021) 612 1193, (021) 612 1197</p></li>
            <li><p><i></i> <strong>Fax:</strong> (021) 612-1197</p></li>
            <li><p><i></i> <strong>Pin BB:</strong> 5727189F</p></li>
            <li><p><i class="icon icon-envelope"></i> <strong>Email 1:</strong> <a href="mailto:support@tokocentralpc.com">support@tokocentralpc.com</a></p></li>
            <li><p><i class="icon icon-envelope"></i> <strong>Email 2:</strong> <a href="mailto:tokocentralpc@gmail.com">tokocentralpc@gmail.com</a></p></li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <h4>Follow Us</h4>
        <div class="social-icons">
          <ul class="social-icons">
            <li class="facebook"><a href="http://www.facebook.com/TokoCentralPC" target="_blank" data-placement="bottom" rel="tooltip" title="Facebook">Facebook</a></li>
            <li class="twitter"><a href="http://www.twitter.com/komputerzone" target="_blank" data-placement="bottom" rel="tooltip" title="Twitter">Twitter</a></li>
            <li class="instagram"><a href="http://instagram.com/central_pc" target="_blank" data-placement="bottom" rel="tooltip" title="Instagram">Instagram</a></li>
            <li class="kaskus"><a href="http://www.kaskus.co.id/profile/viewallclassified/4983376" target="_blank" data-placement="bottom" rel="tooltip" title="Kaskus">Kaskus</a></li>
            <li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" data-placement="bottom" rel="tooltip" title="Linkedin">Linkedin</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <p>CentralPC &copy; Copyright 2014. All Rights Reserved.</p>
        </div>
        <div class="col-md-4">
          <nav id="sub-menu">
            <ul>
              <li><a href="#">FAQ's</a></li>
              <li><a href="#">Sitemap</a></li>
              <li><a href="/about-us">Contact</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</footer>
