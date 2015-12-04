  $(document).ready(function(){
  		$('.grades').hide();
         $('.gradeShow').click(function(){ 
        	$(this).find('.grades').slideToggle('slow');
        	return false;
         });
    });