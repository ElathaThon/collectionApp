

function loadList(){

    console.log("Loading list of items")
    
    $.ajax({
        type: "POST",
        url: 'controller/getItemList.php',
        data: "",
        success: function(data) {
            console.log(data);
            var stringList = "";

            $.each(data.items, function(index, value){
/*              stringList = stringList + '<a href="itemDetail.php?uuid='+ value.uuid +'" class="list-group-item list-group-item-action">'+ 
                value.name + ': '+value.description + 
                '</a>';
*/

                var imageSpan = '<img class="imageList" src="images/default.jpeg">';

                if (value.url != null) {
                    console.log("Si que te image!!" + value.url)
                    imageSpan = '<img class="imageList" src="images/' + value.url + '">';
                }

                stringList = stringList + `
                <li class="list-group-item clearfix">
                    `
                    + imageSpan +
                    `
                    `+value.name+` : `+value.description+`
                    <span class="pull-right button-group">
                        <a href="itemDetail.php?uuid=`+value.uuid+`" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                        <a href="deleteItem.php?uuid=`+value.uuid+`" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                    </span>
                </li>
                `
    
            })


            $.each(data.itemsPublic, function(index, value){

                var imageSpan = '<img class="imageList" src="images/default.jpeg">';

                if (value.url != null) {
                    console.log("Si que te image!!" + value.url)
                    imageSpan = '<img class="imageList" src="images/' + value.url + '">';
                }

                stringList = stringList + `
                <li class="list-group-item clearfix">
                    `
                    + imageSpan +
                    `
                    `+value.name+` : `+value.description+`
                    <span class="pull-right button-group">
                        <a href="itemDetail.php?uuid=`+value.uuid+`" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> View</a> 
                    </span>
                </li>
                `
    
            })
        
            document.getElementById("listItems").innerHTML = stringList;        

        },
        dataType: 'json' ,
        processData: false,
        contentType: false,
        cache: false        
    });

}