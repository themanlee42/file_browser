$(document).ready(function(){
	 
   	 //$('.folder a').click(function() {
     //this will bind click even on dynamically changed element     
	 $(document).on('click','.folder a',function() {   

    	var clickedLi = $(this).parent('li');

    	if( clickedLi.attr('action') == 'open' ){
    		clickedLi.find('ul').slideToggle( "fast" );
    		return false;    		
        }
        
    	if( clickedLi.attr('action') == '' ){
    		clickedLi.attr('action','open')
		
        }
        
        //get the fullpath
        var data =  {
        	      "path": clickedLi.attr('data_ref')
        };

    	$.ajax({ 
    		  type: 'POST',
    	      url: 'ajax.php', 
    	      data: data, 
    	      dataType: 'json',
    	      context: document.body, 
    	      success: function(){
    	    	    //alert('AJAX successful');
    	      }
    	    })
    	    .done(function(data) {
        	 	var filetype;
        	 	var list = clickedLi.append('<ul>').find('ul');
    	    	$.each( data, function( i, val ) {
    	    		
        	    	if(val.type == "D")
        	    		 filetype = 'folder';        	    	
        	    	else
        	    		filetype = 'file';	
    	    		
        	    	list.append('<li action="" data_ref="'+ val.full +'" class="'+ filetype +'"><a href="#">' + val.base + '</a></li>').hide(); 	    		
    	    	});

    	    	list.slideToggle( "fast" );
    	    	
    	    });
    	    return false; // keeps the page from not refreshing
    });
});