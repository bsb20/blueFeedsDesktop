
$(document).ready(function(){
    $(".studentAdd").keyup(function(){
        $("#results").empty();
        if($(this).val().length==0){
            return;
        }
        var id=$(this).attr("id");
        var query={query:$(this).val()};
        $.ajax({type:"POST", url:"studentSearch.php", invokedata:id, data:query, success:search});
        });
    });

function search(data,status){
    $("#results").append(data);
}

$(document).ready(function(){
    $(".instructorAdd").keyup(function(){
        $("#iresults").empty();
        if($(this).val().length==0){
            return;
        }
        var id=$(this).attr("id");
        var query={query:$(this).val()};
        $.ajax({type:"POST", url:"instructorSearch.php", invokedata:id, data:query, success:isearch});
        });
    });

function isearch(data,status){
    $("#iresults").append(data);
}