

function getDBItem(id,page){
  //alert("getting item " + id)

	$.ajax({     
     type: "POST",
     url: "http://mcgraw.mcservices.com/mcgrawAJAX.php?t=" + page + "&o=" + id,
    success: function (data) {

     	var arr = $.parseJSON(data);
      console.log(arr);
     	for (var key in arr) {
        var index = key;

     		index = index.replace(" ", "_");
               index = index.replace(" ", "_");
               index = index.replace(" ", "_");
               index = index.replace(" ", "_");
               index = index.replace(" ", "_");
     		var objects = $("#" + index);
     		if(objects[0] == undefined){
     			objects = $("#" + index + "_path");
     		}
     		var type = objects[0].tagName;
        console.log(type);
     		if(objects.hasClass("file-path") && arr[key]){
     			$("#" + index+ "_get").attr("href","uploads/"+arr[key]);target="_blank";
     			$("#" + index+ "_get").attr("target","_blank");
     		}


      

     		if(type == "SELECT" && arr[key]){
     		 objects.val(arr[key]);
         console.log(objects);
         // objects.material_select();	
        
     		}else{
				$("#" + index).val(arr[key]);
        if(!arr[key] || arr[key] == "" ){

          $("#check-" + index).addClass("check-error");

        }

    		
     		}
        
     		if(arr[key] && type != "SELECT"){
     			$("label[for=" + index+"]").addClass("active");
     		}
     	}
         var gos = $("#" + "Tenant"+ "_go");
              gos.each(function(){
                   var href = $(this).attr("href");
                  $(this).attr("href",href.replace("[id]", arr["Tenant"]) );
               });
         var gos = $("#" + "Asset"+ "_go");
              gos.each(function(){
                   var href = $(this).attr("href");
                   $(this).attr("href",href.replace("[id]", arr["Asset"]) );
              });


     	}
     }
 );
}

$(document).ready(function() {
  //  $('select').material_select();

    if (window.location.hash != "") {
        $('html, body').animate({
           scrollTop: $(window.location.hash).offset().top
         }, 1000);

        var hash = "#btn-" + window.location.hash.substring(1);
        var btn = $( hash);
        btn.click();
        $("#modal1").css("display", "block");
      }
});