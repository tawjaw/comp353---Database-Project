  $(document).ready(function(){

  			var total=0;
  			$('.support').each(function(){
  				total+=parseInt($(this).html().replace('$',''));
  			});
  			$('#total').html(total+"$");
  		
         
    });