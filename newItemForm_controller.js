
$(function() {
    
    function after_form_submitted(data) {
        if(data.result == 'success') {
            
        }
    }

	$('#newItem_form').submit(function(e) {
        e.preventDefault();
        
            var formdata = new FormData(this);
            $.ajax({
                type: "POST",
                url: 'api/newItem.php',
                data: formdata,
                success: after_form_submitted,
                dataType: 'json' ,
                processData: false,
                contentType: false,
                cache: false        
            });
        
      });	
});