
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">

          <div id="image_preview" style=" border: 1px solid black;width:500px;height:300px;background-image: url(bg_vignette_edit_default.jpg);background-size: contain;">

                  <div id="selectImage">
                    <input type="file" name="file" id="file" required style="opacity:0;
                    overflow: hidden;width:500px;height:300px;background-size: contain;)"/>              
                  </div>
          </div>   
    </form>


<script type="text/javascript">
  
$(document).ready(function (e) {

    $("#uploadimage").on('submit',(function(e) {
      e.preventDefault();
        $.ajax({
            url: "xUP.php", 
            type: "POST",             
            data: new FormData(this), 
            contentType: false,       
            cache: false,             
            processData:false,        
            success: function(data)   
            {
            console.log(data)
            }
        });
    }));

    $(function() {
          $("#file").change(function() {
              $("#message").empty(); // To remove the previous error message
              var file = this.files[0];
              var imagefile = file.type;
              var match= ["image/jpeg","image/png","image/jpg"];
              if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
              {
                    alert("jpeg, jpg and png type allowed");
                    return false;
              }
              else
              {
              var reader = new FileReader();
              reader.onload = imageIsLoaded;
              reader.readAsDataURL(this.files[0]);
              }
          });
    });

    function imageIsLoaded(e) {
            $('form#uploadimage').submit();
            $('#image_preview').css('background-image', 'url('+e.target.result+')');
    };

});

</script>

