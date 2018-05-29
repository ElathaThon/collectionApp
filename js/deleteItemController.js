
function deleteItemController(){

    console.log("Ajax params:")

    var params = {
       "uuid" : document.getElementById('uuid').value
    };
    
    console.log(params)

    $.ajax({
        type: "POST",
        url: 'api/deleteItem.php',
        data: params,
        dataType: "json",
        success: function(data) {
            console.log(data);

            window.location.href = 'index.php'
            
        }
    });

}