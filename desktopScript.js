
$(document).ready(function(){
    $(".studentAdd").keyup(function(){
        $(this).parents(".courses-instructors-addStudents").next(".results").empty();
        if($(this).val().length==0){
            return;
        }
        var id=$(this).parents(".courses-instructors-course").attr("id");
        var query={query:$(this).val()};
        $.ajax({type:"POST", url:"studentSearch.php", invokedata:id, data:query, success:search});
        });
    });

$(document).ready(function(){
    $(".appt-enter-student").keyup(function(){
        $(this).parents(".appt-add-student").next("#sresults").empty();
        if($(this).val().length==0){
            return;
        }
        var query={query:$(this).val()};
        $.ajax({type:"POST", url:"studentSearch.php", data:query, success:sSearch});
        });
    });
function search(data,status){
    var id="#"+this.invokedata;
    $(id).find(".results").append(data);
}
function sSearch(data,status){
    $("#sresults").append(data);
}
function addedToCourse(data,status){
    alert(data);
    location.reload();
    
}
function onError(data,status){
    alert("OH NO");
}
$(document).ready(function(){
    $(".instructorAdd").keyup(function(){
        $(this).parents(".courses-instructors-addInstructors").next(".iresults").empty();
        if($(this).val().length==0){
            return;
        }
        var id=$(this).parents(".courses-instructors-course").attr("id");
        var query={query:$(this).val()};
        $.ajax({type:"POST", url:"instructorSearch.php", invokedata:id, data:query, success:isearch});
        });
    });

function isearch(data,status){
    var id="#"+this.invokedata;
    $(id).find(".iresults").append(data);
}

$(document).ready(function(){
       $(".results").on("click", "li", function(e){
	    var found= $(this).find(".suid").val();
            var course= $(this).parents(".courses-instructors-course").attr("id");
	    $.ajax({type:"POST", url:"addStudent.php", data:{'suid':found, 'guid':course}, error:onError, success:addedToCourse});
		});
	    });

$(document).ready(function(){
       $(".iresults").on("click", "li", function(e){
	    var found= $(this).find(".uuid").val();
            var course= $(this).parents(".courses-instructors-course").attr("id");
		$.ajax({type: "POST", url: "addInstructor.php", data: {'uuid':found, 'guid':course}, error: onError, success:addedToCourse});
		});
	    });

$(document).ready(function(){
    $("#sresults").on("click","li", function(e){
	var name=$(this).attr("id");
	$(".appt-enter-student").val(name);
	});
    });
