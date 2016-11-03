

  
$(document).ready(function (e) {







$('.thumbnail').click(function(){
$('.modal-body').empty();
var title = $(this).parent('a').attr("title");
$('.modal-title').html(title);  
  //get the source of thumb image
    var image = $(this).attr("src");
    //remove thumb directory from image 
    var image = image.replace("thumb/","");

    // create html for modal body
    var html ='<img src="'+image+'" />';
    // add to the modal body.
    $('.modal-body').html(html);
$('#myModal').modal({show:true});
});


    $('.thumbnail_comments').click(function(){
        $('.modal-body').empty();
        var title = $(this).parent('a').attr("title");
        //var src = $(this).attr("src");
        var src = $(this).attr("path");
        var ext = $(this).attr("ext");
        //alert(ext);
        var number = $(this).parent('a').attr("number");

        //$('.modal-title').html(title);
        //$($(this).parents('div').html()).appendTo('.modal-body');


if(ext!='mp4'){
    $('<div><a href="#" title="Image '+number+'"><img src="'+src+'"  width="1280" height="720"></a></div>').appendTo('.modal-body');
}      





if(ext=='mp4'){
$('<div><a href="#" title="Image '+number+'"><video controls preload="auto"><source src="'+src+'" type="video/mp4"><source src="'+src+'" type="video/webm"><source src="'+src+'" type="video/ogv"></video>').appendTo('.modal-body');
}



        $('#myModal').modal({show:true});






    });

    



    $(function() {
          $("#file").change(function() {
              $("#message").empty(); // To remove the previous error message
              var file = this.files[0];
              var imagefile = file.type;
              /*var match= ["image/jpeg","image/png","image/jpg"];
              if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
              {
                alert("jpeg, jpg and png type allowed");
                return false;
              }
              else
              {*/
              var reader = new FileReader();
              reader.onload = imageIsLoaded;
              reader.readAsDataURL(this.files[0]);
             /* }*/
          });
    });

    function imageIsLoaded(e) {
            $('form#uploadimage').submit();
            $('#image_preview').css('background-image', 'url('+e.target.result+')');
            //$("#a7_vignette").load();
            //$('#a7_vignette').load(location.href+ '#a7_vignette');
            $('#a7_vignette').html(retour)
    };














          $('.nav-toggle').click(function(e){
            //get collapse content selector
            var collapse_content_selector = $(this).attr('href');
            var toggle_switch = $(this);
            $(collapse_content_selector).toggle(function(e){
              if($(this).css('display')=='none'){
                //$('.table_top').show();                                
                toggle_switch.html('add comment : +');
              }else{
                //$('.table_top').hide();
                toggle_switch.html('Cancel');
              }
            });
          });
















    window.onkeyup = function(e) {

        var event = e.which || e.keyCode || 0; // .which with fallback

        if (event == 27) { // ESC Key
            window.location.href = '../index.php'; // Navigate to URL
        }
    }



    $('.modify_comment').click(function(){
        var id_comment = $(this).attr("id_comment");
        var comments = $('#textarea_comment_'+id_comment).val();
        /*alert(comments);*/
        $('.div_modify_comment_'+id_comment).hide();
        //$('#delete_comment_'+id_comment).show();
        //$('#textarea_'+id_comment).removeAttr('cellEditing');
        //$('#textarea_'+id_comment).prop('disabled', true);
/*        $('#textarea_'+id_comment).removeAttr('disabled');*/




                $.ajax({  
                     url:"save_comments.php",  
                     method:"POST",  
                     data:{comments:comments, id:id_comment},  
                     dataType:"text",  
                     success:function(data)  
                     {  
/*                          if(data != '')  
                          {  
                               $('#description').val(description);  
                          }  
                          setInterval(function(){  
                          }, 2000);  */
                     }  
                });  

                setTimeout(function(){ 
                         window.location.href = self.location;
                    }, 1000);  

    





    });

      $(".edit_comment").dblclick(function () {
        
        var id_comment = $(this).attr("id");
		var timestamp_id_creator = $(this).attr("timestamp_id_creator");
        // alert(id_comment);
        $('.delete_comment').hide();
        $('#update_upload').show();
/*        $('#update_upload').load('new_upload.php');*/
// alert(timestamp_id_creator);

	$( "#update_upload" ).load( "new_upload.php?id=<?php echo $_GET['id'];?>&timestamp_id_creator=" + timestamp_id_creator + "" );

        var OriginalContent = $(this).text();
        $(this).addClass("cellEditing");
        
        //$('.modify_comment').attr('visibility', 'visible');
        $('#div_modify_comment_'+id_comment).show();
        //$(this).html("<input type='text' value='" + OriginalContent + "' />");
        $(this).html("<textarea cols=100 rows=5 id='textarea_comment_"+id_comment+"'>" + OriginalContent + "</textarea>");
                $(this).children().first().focus();
                $(this).children().first().keypress(function (e) {
/*                    if (e.which == 13) {
                        var newContent = $(this).val();
                        $(this).parent().text(newContent);
                        $(this).parent().removeClass("cellEditing");
                    }*/
        });
    });



      function autoSave(e)  
      {  
           var description = $('#description').val();  
           var id = $('#post_id_description').val();  
           if(description != '')  
           {  
                $.ajax({  
                     url:"save_description.php",  
                     method:"POST",  
                     data:{description:description, id:id},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          if(data != '')  
                          {  
                               $('#description').val(description);  
                          }  
                          setInterval(function(){  
                          }, 2000);  
                     }  
                });  
           }            
      }  
      setInterval(function(){   
           autoSave();   
           }, 2000);  




/*      $(".edit_description").dblclick(function () {
        
        var id_description = $(this).attr("id");
       
        $('#div_modify_description_'+id_comment).show();
        //$(this).html("<input type='text' value='" + OriginalContent + "' />");
        $(this).html("<textarea cols=30 rows=5 id='textarea_comment_"+id_comment+"'>" + OriginalContent + "</textarea>");
                $(this).children().first().focus();
                $(this).children().first().keypress(function (e) {

        });
    });


*/






});





