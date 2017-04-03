jQuery(function($){ "use strict";


//scroll sections
	$(".scroll").click(function(event){
					
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top}, 1000);
});

//active jpushmenu navigation	
$('.push_nav li a').on('click', function(){
    $('.push_nav li a.active').removeClass('active');
    $(this).addClass('active');
});

	// JS circleGraphic File 
	$(".myStat").circliful();
	
	// JS MixITup File 
	$(".gallery").mixItUp();
	
	//JS FancyBox
	$(".fancybox").fancybox();

	//owlCarouseltimeline
  $("#text-demo").owlCarousel({
    autoPlay : 2000,
    stopOnHover : true,
    navigation:true,
    paginationSpeed : 1000,
    singleItem : true,

  });
		
		//Animate
		jQuery('.animate').appear();
			jQuery(document.body).on('appear', '.animate', function(e, $affected) {
				var fadeDelayAttr;
				var fadeDelay;
				jQuery(this).each(function(){
				
	
					if (jQuery(this).data("delay")) {
						fadeDelayAttr = jQuery(this).data("delay")
						fadeDelay = fadeDelayAttr;				
					} else {
						fadeDelay = 0;
					}			
					jQuery(this).delay(fadeDelay).queue(function(){
						jQuery(this).addClass('animated').clearQueue();
					});			
				})			
			});

		//PushMenu on click
	jQuery('.toggle-menu').jPushMenu();
	  jQuery(document).on('click', function () {
        jQuery('.cbp-spmenu-left').removeClass('menu-open');
    });
    jQuery('#menu-toggle').on('click', function (e) {
        e.stopPropagation();
        jQuery('.cbp-spmenu-left').toggleClass('menu-open');
    });

//======================
//      Back to top
//======================


// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});
	


// Contact Form

$("#btn-submit").click(function() { 
        //get input field values
        var user_name       = $('input[name=name]').val(); 
        var user_email      = $('input[name=email]').val();
		var user_message    = $('textarea[name=message]').val();
        
        //simple validation at client's end
        var proceed = true;
        if(user_name==""){ 
            proceed = false;
        }
        if(user_email==""){ 
            proceed = false;
        }
		if(user_message=="") {  
            proceed = false;
        }
		
		var post_data, output;

        //everything looks good! proceed...
        if(proceed) 
        {
            //data to be sent to server
            post_data = {'userName':user_name, 'userEmail':user_email, 'userMessage':user_message};
			            
            //Ajax post data to server
            $.post('contact_me.php', post_data, function(response){  

                //load json data from server and output message     
				if(response.type == 'error')
				{
					output = '<div class="error"><p style="text-align:left; color:#fff;">'+response.text+'</p></div>';
				}else{
				    output = '<div class="success"><p style="text-align:left; color:#fff;">'+response.text+'</p></div>';
					
					//reset values in all input fields
					$('#contact-form input').val(''); 
					$('#contact-form textarea').val('');
					$('#btn-submit').val('Submit Now'); 
					
				}
				
				$("#result").hide().html(output).slideDown();
            }, 'json');
			
        }
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $(".form-inline input, .form-inline textarea").keyup(function() { 
        $("#result").slideUp();
    });

	
	
	
	
	if(screen.width <720 ){ 
 $('div, img, input, textarea, button, a').removeClass('animate'); // to remove transition
 }
 
});
