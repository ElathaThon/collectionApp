

function deleteImage(uuidImage){

    console.log("Ajax params:")

    var params = {
       "uuidImage" : uuidImage,
    };
    
    console.log(params)

    $.ajax({
        type: "POST",
        url: 'api/deleteImage.php',
        data: params,
        dataType: "json",
        success: function(data) {
            console.log(data);

            location.reload();
           
        }
    });

}