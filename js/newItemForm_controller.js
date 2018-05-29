
$(function() {
    
    function after_form_submitted(data) {
        loadList();
        document.getElementById('name').value = ''
        document.getElementById('description').value = ''
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


