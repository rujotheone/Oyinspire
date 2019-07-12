<div id ="overlay"></div>
<div class="modal">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

        <div class="close_button text-right" style="font-size:20px;cursor:pointer;margin-bottom:0px;width:20px;float:right">X</div>
        
          <form  class="signpage" action="/oyinspire/login" method="post" id="login" data-parsley-validate="" style="display:none" >              
            <div class="modalactn text-centered" style="margin-bottom:5px"><h2>Login</h2>   or  <a href="">Sign up</a></div>

            <input type="hidden" id="nonce" name="nonce" value="">

            <input type="hidden" id="ref" name="ref" value="<?php echo $_SERVER['REQUEST_URI'];?>">

            <div class="form-group">       
               <input type="text" class="form-control" id="username" name="username" data-parsley-length="[4, 20]" required="" placeholder="Username">
            </div>

             <div class="form-group">
              <input type="password" class="form-control" id="password" name="password" data-parsley-length="[6, 150]" required="" placeholder="Password">
            </div>

            <div class="form-group">
              <input type="checkbox" name="autologin" value="1"> Remember me 
              <a href="<?php echo $router->generate('reset'); ?>" class="text-right" style="margin-left:30px">Forgot password?</a>
             </div>
             

             <div class="error"><?php echo $msg; ?></div>
             <div class="form-group">
                <button type="submit" class="btn btn-default">Login</button>
            </div>      
            
        </form> 
       
       <form class="signpage" action="/oyinspire/signup" method="post" id="signup" data-parsley-validate="" style="display:none"> 
     
          <div class="modalactn text-centered"><h2>Sign up</h2></div>   
          <div class="modalactn text-centered" style="margin-bottom:5px">Already have an account? <a href="">Login</a></div>
           <div class="form-group">      
               <input type="text" class="form-control" id="email" name="email" required="" data-parsley-type="email" placeholder="Email">
            </div>

            <div class="form-group"> 
               <input type="text" class="form-control" id="username" name="username" data-parsley-length="[4, 20]" required="" placeholder="Username">
            </div>

             <div class="form-group">        
              <input type="password" class="form-control" id="password" name="password" data-parsley-length="[6, 150]" required="" placeholder="Password">
            </div>

             <div class="form-group">            
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" data-parsley-length="[6, 150]" required="" placeholder="Confirm Password">
            </div>

              <div class="error"><?php echo $msg; ?></div>
             <div class="form-group">
                <button type="submit" class="btn btn-default">Sign up</button>
            </div>   
            <p class="text-centered">By signing up, I agree to Oyinspire me's <a href="<?php echo $router->generate('terms'); ?>">terms and conditions</a>  and
               <a href="<?php echo $router->generate('privacy'); ?>">privacy policy.</a> </p>     
        </form>
      </div> 
    </div>
  </div>

  <script type="text/javascript">

    $(function(){
        $('.signform').parsley().on('field:validate', function(formInstance) {

           var ok = formInstance.isValid({force:true});
          $('.error')
              .html(ok ? '' : 'Please fill all required fields')
              .toggleClass('hidden', ok);
              $('html, body').scrollTop(50);

               if (!ok)
              formInstance.validationResult = false;
        });

        $('.searchform').parsley().on('form:validate', function (formInstance) {
            var ok = formInstance.isValid({group: 'block1', force: true}) || formInstance.isValid({group: 'block2', force: true});
            $('.error')
              .html(ok ? '' : 'You must correctly fill *at least one of these two blocks!')
              .toggleClass('filled', !ok);
            if (!ok)
              formInstance.validationResult = false;
          });
                
      });
</script>