jQuery(document).ready(function($){ 

 $('#fl_to_top').click(function(){
   $('html, body').animate({scrollTop:0}, 'slow');
 });
  $('#fl_to_bottom').click(function(){
   $("html, body").animate({ scrollTop: $(document).height() }, "slow");
 });
   
  jQuery('.fl_slimer_Wrap').click(function($){

	   jQuery('.fl_inner_wrap').slideToggle('slow');

	   jQuery('.fl_slimer_Wrap .fa').toggleClass('fa-crosshairs');

 	});

  var fl_width = jQuery('.fl_inner_wrap').width();
 
 });

