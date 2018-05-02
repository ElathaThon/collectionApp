

function loadList(){

    console.log("Loading list of items")
    
    $.ajax({
        type: "POST",
        url: 'api/getAllItems.php',
        data: "",
        success: function(data) {
            console.log(data);
            var stringList = "";

            $.each(data.items, function(index, value){
                stringList = stringList + '<a href="itemDetail.php?uuid='+value.uuid+'" class="list-group-item list-group-item-action">'+value.name+': '+value.description+'</a>';
    
            })
        
            document.getElementById("listItems").innerHTML = stringList;        

        },
        dataType: 'json' ,
        processData: false,
        contentType: false,
        cache: false        
    });

}