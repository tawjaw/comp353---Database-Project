  $(document).ready(function(){
  		$('.filter3').hide();
         $('.filter2').click(function(){ 
        	$(this).find('.filter3').slideDown('slow');
        	return false;
         });
    });