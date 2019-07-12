 <header class="" role="vendor" id="header">

    <div class="buttons" role="vendor">
        <div class="header-nav">
            <span class="hamburger">
                <span class="line1 line"></span>
                <span class="line2 line"></span>
                <span class="line3 line"></span>               
            </span>
          </div>

          
        <div class="nav-container" id="side-nav">
          <ul class="header-menu">
            <li class="menu-item"><a href="<?php echo $router->generate('home'); ?>">Home</a></li>
            <li class="menu-item"><a href="<?php echo $router->generate('how'); ?>">How It Works</a></li>
            <li class="menu-item"><a href="<?php echo $router->generate('faq'); ?>">FAQ</a></li>            
            <li class="menu-item" ><a href="<?php echo $router->generate('search').'?p=planner'; ?>">Hire a planner</a></li>
            <li class="menu-item tablet"><a href="<?php echo $router->generate('services'); ?>">Services</a></li>
          </ul>
        </div>    
        

        <div class="logo"><a  href="<?php echo $router->generate('home'); ?>" data-ajax="false">
            Oyinspire
        </a></div>

        <div class="dash">
          <?php echo $dash; ?>
        </div>
        <div class="account-menu">
          <ul class="list">
            <li><a href="<?php echo $router->generate('profile').$_SESSION['username']; ?>">Profile</a></li>
            <li><a href="<?php echo $router->generate('profile').$_SESSION['username'].'#events'; ?>">Events</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo $router->generate('vendors').$_SESSION['username']?>">My Vendor Page</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo $router->generate('edit'); ?>">Account Settings</a></li>
            <li><a href="<?php echo $router->generate('logout'); ?>">Logout</a></li>
            
          </ul>

        </div>

        <div class="services tablet">
          <div class="outer">
            <!-- <div class="inner"></div> -->
          </div>
        </div>
        <div class="more-nav-btn">
          <a href="javascript:void(0)" onclick="" title="more options"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
        </div>
    </div>

  </header> 
  <div class="more-nav">
    <div class="container" style="margin-top:20px">
      <div class="row">        
        <div class="col-md-2 col-sm-12 col-xs-12">
         <a href="<?php echo $router->generate('create'); ?>" > <button  style="height:46px" class="btn btn-default"> Create Event</button></a>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">  
          <div class="search">
            <form class="form" role="form" action="<?php echo $router->generate('search'); ?>" method="post">
              <div class="input-group  input-group-lg">
                <input type="text" class="form-control" id="search" name="q" placeholder="Search">                                    
                <span class="input-group-btn">
                  <button type="submit"  class="search-btn btn btn-default">Search</button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

