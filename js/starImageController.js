
function starItem(uuidItem, uuidImage){

    console.log("Ajax params:")

    var params = {
       "uuidItem" : uuidItem,
       "uuidImage" : uuidImage
    };
    
    console.log(params)

    $.ajax({
        type: "POST",
        url: 'api/starItem.php',
        data: params,
        dataType: "json",
        success: function(data) {
            console.log(data);

            window.location.href = 'itemDetail.php?uuid=' + uuidItem
            
        }
    });

}