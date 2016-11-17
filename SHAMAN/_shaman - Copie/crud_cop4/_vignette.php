<!-- 	<link rel="stylesheet" href="assets/css/styles.css" /> -->		


<?php 



    $vignette = "../../".DATASstoreFolderName."/".$ids_projects."_".$name_project."/assets/".$folder_name."/vignette.jpg";
    $vignette_comp = "../../".DATASstoreFolderName."/".$ids_projects."_".$name_project."/assets/".$folder_name."/vignette_comp.jpg";
    if (!file_exists($vignette_comp)) {$vignette_comp = '';$vignette = '';}
    //echo $vignette_comp;

?>

      
<div id="dropbox" style=" border: 1px solid black;width:<?php echo W_V_EDIT;?>px;height:<?php echo H_V_EDIT;?>px;background-image: url(<?php echo $vignette_comp;?>);background-size: cover;padding:0px;">

</div>
    
<script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="jquery.filedrop.js"></script>
<!-- <script src="upload_vignette.js"></script> -->




<style>







/*-------------------------
  Dropbox Element
--------------------------*/



#dropbox{
  background-color:gray;
  
/*    border-radius:3px;
position: relative;
  margin:80px auto 90px;
  min-height: 290px;*/
  overflow: hidden;
  padding-bottom: 0px;
    width: 100%;
  
  /*box-shadow:0 0 4px rgba(0,0,0,0.3) inset,0 -3px 2px rgba(0,0,0,0.1);*/
}


#dropbox .message{
  font-size: 11px;
    text-align: center;
    padding-top:0px;
    display: block;
}

#dropbox .message i{
  color:#ccc;
  font-size:10px;
}

#dropbox:before{
  /*border-radius:3px 3px 0 0;*/
}



/*-------------------------
  Image Previews
--------------------------*/



#dropbox .preview{
    top:0;
  left:0;
  width:245px;
  height: 215px;
  float:left;
/*  margin: 55px 0 0 60px;*/
  position: relative;
/*  text-align: center;*/
}

#dropbox .preview img{
    top:0;
  left:0;
  width:<?php echo W_V_EDIT;?>px;
  height:<?php echo H_V_EDIT;?>px;
    max-width: <?php echo W_V_EDIT;?>px;
  max-height:<?php echo WHV_EDIT;?>px;

  display: block;
  
  /*box-shadow:0 0 2px #000;*/
}

#dropbox .imageHolder{
    top:0;
  left:0;
  display: inline-block;
  position:relative;
}

#dropbox .uploaded{
  position: absolute;
  top:0;
  left:0;
  height:100%;
  width:100%;
/*  background: url('../img/done.png') no-repeat center center rgba(255,255,255,0.5);
  */
  display: none;
}

#dropbox .preview.done .uploaded{
    top:0;
  left:0;
  display: block;
}



/*-------------------------
  Progress Bars
--------------------------*/



#dropbox .progressHolder{
  position: absolute;
  background-color:#252f38;
  height:12px;
  width:100%;
  left:0;
  bottom: 0;
  
  box-shadow:0 0 2px #000;
  display: none;
}

#dropbox .progress{
  background-color:#2586d0;
  position: absolute;
  height:100%;
  left:0;
  width:0;
  
  box-shadow: 0 0 1px rgba(255, 255, 255, 0.4) inset;
  
  -moz-transition:0.25s;
  -webkit-transition:0.25s;
  -o-transition:0.25s;
  transition:0.25s;
    display: none;
}

#dropbox .preview.done .progress{
  width:100% !important;
    display: none;
}

</style>
















<script type="text/javascript">
$(function(){
  
  var dropbox = $('#dropbox'),
    message = $('.message', dropbox);
  
  dropbox.filedrop({
    // The name of the $_FILES entry:
    paramname:'pic',
    maxfiles: 1,
    maxfilesize: 4,
    url: 'upload_vignette_asset_edit.php?id=<?php echo $_GET['id'];?>',

    
    uploadFinished:function(i,file,response){
      $.data(file).addClass('done');
      // response is the JSON object that post_file.php returns
    },
    
      error: function(err, file) {
      switch(err) {
        case 'BrowserNotSupported':
          showMessage('Your browser does not support HTML5 file uploads!');
          break;
        case 'TooManyFiles':
          alert('Too many files! Please select 5 at most! (configurable)');
          break;
        case 'FileTooLarge':
          alert(file.name+' is too large! Please upload files up to 4mb (configurable).');
          break;
        default:
          break;
      }
    },
    
    // Called before each upload is started
    beforeEach: function(file){
      if(!file.type.match(/^image\//)){
        alert('Only images are allowed!');
        
        // Returning false will cause the
        // file to be rejected
        return false;
      }
    },
    
    uploadStarted:function(i, file, len){
      createImage(file);
    },
    
    progressUpdated: function(i, file, progress) {
      $.data(file).find('.progress').width(progress);
    }
       
  });
  
  var template = '<div class="preview">'+
            '<span class="imageHolder">'+
              '<img />'+
              '<span class="uploaded"></span>'+
            '</span>'+
            '<div class="progressHolder">'+
              '<div class="progress"></div>'+
            '</div>'+
          '</div>'; 
  
  
  function createImage(file){

    var preview = $(template), 
      image = $('img', preview);
      
    var reader = new FileReader();
    
    image.width = 100;
    image.height = 100;
    
    reader.onload = function(e){
      
      // e.target.result holds the DataURL which
      // can be used as a source of the image:
      
      image.attr('src',e.target.result);
    };
    
    // Reading the file as a DataURL. When finished,
    // this will trigger the onload function above:
    reader.readAsDataURL(file);
    
    message.hide();
    preview.appendTo(dropbox);
    
    // Associating a preview container
    // with the file, using jQuery's $.data():
    
    $.data(file,preview);
  }

  function showMessage(msg){
    message.html(msg);
  }

});
</script>