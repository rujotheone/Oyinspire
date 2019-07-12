<footer id="footer"  class="site-foot">
  <div class="horizontal">
     <div class="site-map clearfix">
        <div id="sitemap" class="widget">
          <div class="widget-title">The Site</div>
          <div class="widget-content">
            <div>
              <ul>
                 <li><a href="<?php echo $router->generate('home'); ?>">Home</a></li>
            <li><a href="<?php echo $router->generate('how'); ?>">How It Works</a></li>
            <li><a href="<?php echo $router->generate('faq'); ?>">FAQ</a></li>            
            <li><a href="<?php echo $router->generate('search').'?p=planner'; ?>">Hire a planner</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div id="address" class="widget">
          <div class="widget-title">Oyinspire.</div>
          <div class="widget-content">
            <p><b>Lagos</b><br>Festac town lagos the city</p>
          </div>
        </div>
        <div id="contact" class="widget">
          <div class="widget-title">Contact</div>
          <div class="widget-content">
            <p><a href="mailto:connect@jdand.co.uk">connect@oyinspire.me</a><br>
              <a href="tel:00442034329882">0044 203 432 98 82</a>
            </p><p></p>
          </div>
        </div>
        <div id="social" class="widget">
          <div class="widget-title">Social</div>
          <div class="widget-content">
            <ul>
              <li><a  href="http://www.twitter.com/oyinspire" target="_blank">Twitter</a></li>
              <li><a  href="http://www.facebook.com/oyinspire" target="_blank">Facebook</a></li>
              <li><a  href="http://www.instagram.com/oyinspire" target="_blank">Instagram</a></li>
              <li><a  href="http://www..com/oyinspire" target="_blank">Google+</a></li>
            </ul>
          </div>
        </div>
    </div>

  <div class="foot-bar">    
    
    <nav style="text-align:center" role="navigation">
      <ul class="small-nav">
        <li class="item"><a href="<?php echo $router->generate('about'); ?>">About</a></li>
        <li class="item"><a href="<?php echo $router->generate('privacy'); ?>">Privacy policy</a></li>
        <li class="item"><a href="<?php echo $router->generate('terms'); ?>">Terms</a></li>
            
      </ul>
    </nav>
    <div class="copyright">2015 Oyinspire  All rights reserved.</div>
    <div class="credits"><a href="mailto:rujotech@gmail.com"> Website by Richard Onyekwere.</a></div>
    
  </div>
</div>

</footer>
