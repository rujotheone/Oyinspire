$(document).ready(
	function(){


 			$(".loader").css('display','none');

 			$("#myCarousel").carousel({interval: 10000});
 			var wordIndex=0;
 			$("#myCarousel").on('slide.bs.carousel', 
 				function () {

           			$("#Captionbig .caption").animate({width:'toggle'},'slow');           			
 					$("#Captionbig .word").eq(wordIndex%4).css('display','none');
 					$("#Captionbig .word").eq((wordIndex+1)%4).css('display','block');
           			$("#Captionbig .caption").animate({width:'toggle'},'slow');
           			wordIndex++;
   				 }); 				

				//control modal
				$(".modalbtn").click(
 						function(){
 							$(".buttons > div").removeClass('open');
 							$('#overlay').fadeIn();	
 							// $('.services-menu-con').removeClass("open");
						  //   $('.services-menu-con').fadeOut();							

 							var actn=$(this).data('action');
 							
 							$(".modal").slideDown()
 							//css('display','block');
 							$(".modal"+" #"+actn).css('display','block');
 							$('body').css('overflow','hidden');
 							

 							$('#overlay').click(function(){
		                        $(this).fadeOut();	
		                        $(".modal").slideUp();
		                        //css('display','none');
		                        $(".modal #login").css('display','none');
		                        $(".modal #signup").css('display','none');
		                        $('body').css('overflow','scroll');

                      		});

                      		$('.close_button').click(function(){
		                        $('#overlay').fadeOut();	
		                        $(".modal").slideUp();
		                        //css('display','none');
		                        $(".modal #login").css('display','none');
		                        $(".modal #signup").css('display','none');
		                        $('body').css('overflow','scroll');	                    
                      		});
                      		return false;
 					});
 			
				//switch modal action
			$('.modalactn > a').click(
				function(){
					if ((this).text==("Sign up"))
						{
							$('#login').css('display','none');
							$('#signup').css('display','block');
						}
					if ((this).text=='Login')
						{
							$('#signup').css('display','none');
							$('#login').css('display','block');
						}
					return false;
				});


			// open left menu
			var logoStat=$(".buttons .logo").css('display');			
			$('.hamburger').click(
				function(){
					
					if ($(".buttons").hasClass("open"))
					{
						$(".buttons.open").removeClass('open');						
						$(".buttons .logo").css('display',logoStat);												
					}
					else
					{
						$(".buttons").addClass('open');
						$(".buttons .logo").css('display','none');
						close_all_navs("left");
					}				
				})

				//open and close services menu

				$('.services-menu-con .close_button').click(function(){

								$('.buttons .services').removeClass("open");
								$('.services-menu-con').removeClass("open");
								$('.services-menu-con').fadeOut();
								$('#overlay').fadeOut();   
								$('body').css('overflow','scroll');               
                      		});

				$('.buttons .services').click(
				function(){									
						
						$('.services-menu-con').css('z-index','600');
						$(this).addClass("open");										
						$('.services-menu-con').fadeIn();						
						$('.services-menu-con').addClass("open");	
						$('#overlay').fadeIn();
						$('body').css('overflow','hidden');							    
				});

				//select or deselect vendors in pick page
				//toggle filters

				//toggle more navigation
				$('.not-home .more-nav-btn').click(function(){
					$('.not-home .more-nav').toggle();
					close_all_navs("more");
				});

				//fade header 
				$(window).scroll(
					function(){

					if ($(this).scrollTop()>50)
					{
						$('.home .buttons').fadeOut();	
										
					}
					if($(this).scrollTop()<50)
					{
						$('.home .buttons').fadeIn();	
					}
				});

				//ratings builder
				var ratebox=$('.ratings');

				ratebox.each(function(i,obj){

					var rating=parseInt($(this).data('rate'));					

					 for (var j=1;j<=rating;j++)
		            {
		              $(this).append('*');
		              
		            }
				})

				// for(var j=0;j<ratebox.length;j++){
		            
		           
		  //       }

	            //rate an item
	            $('.rate').click(function(){
            		$(this).next().slideToggle(800);
            		
	            })
	            
	             $('.rate-btn').on('click', function(event){

	             	event.preventDefault();
	            	var url = '/oyinspire/rate';
	            	var ref=$(this);
	            	var id=ref.data('id');
	            	var val=parseInt(ref.data('val'));
	            	var type=ref.data('type');
	            	console.log(val)
	            	var requestData = {data: val, prof: type, pid: id };        	
	            	
	            	if(url)
	            	{
	            		$.post(url,requestData, function(data,status){
	            		 console.log(data);
	            		 ref.parent().parent().html(data);
	            		})
				    }	            	
	            });

	            //view vendor services
	            $('.vendor_services').on('click', function(event){
	            	var url = '/oyinspire/vendor_service';
	            	var ref=$(this);
	            	var id=ref.data('id');
	            	var requestData = {data: id};            	
	            	
	            	if(url)
	            	{
	            		ref.load(url,requestData, function(data,status){
	            		console.log(data);
	            		})
				    }
	            	event.preventDefault();
	            });
				//view event vendor
				//client-side image upload
				function readURL(e) {
				    if (this.files && this.files[0]) {
				        var reader = new FileReader();
				        $(reader).load(function(e) { $('#img-preview').attr('src', e.target.result); });
				        reader.readAsDataURL(this.files[0]);
				    }}

				$("input#image").change(readURL);
			
 })

				//dropdown user menu
					 function accountMenu() 
					 {
					 	var acct=document.getElementsByClassName("account-menu")[0];
					 	if (acct.style.display=='block')
					 	{
						  acct.style.display = 'none';
						  
						}
						else 
						{							  	
						  	acct.style.display = 'block';
						  	close_all_navs("account");
						  						  
						}
						  
						   return false;
					  }

			
			function close_all_navs(nav)
 				{
 					//left menu
 					if(nav=="left")
 					{	 					
	 					$('.account-menu').css('display','none');
	 					$('.not-home .more-nav').fadeOut();
 					}
 					if(nav=="more")
 					{
	 					$(".buttons.open").removeClass('open');
	 					$('.account-menu').css('display','none');
 					}
 					if(nav=="account")
 					{
	 					$(".buttons.open").removeClass('open');
	 					$('.not-home .more-nav').fadeOut();
	 				}
 				}



