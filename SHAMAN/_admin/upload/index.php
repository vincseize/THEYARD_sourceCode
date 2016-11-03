<!DOCTYPE html>
<!-- release v4.3.5, copyright 2014 - 2016 Kartik Visweswaran -->
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>STX Upload</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="js/fileinput.js" type="text/javascript"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>



<?php
if (isset($_GET['case'])) {
    //echo 'add';
    if ($_GET['case']=='add') {
      $type_upload       ='add';
        $path = "_medias/cases/";



$files = array();

foreach(glob($path.'/*', GLOB_ONLYDIR) as $dir) {
    //echo $dir;

    $dirname = basename($dir);

    $tmp = explode("_", $dirname);
    $files[] = $tmp[2]; // put in array.



}



natsort($files); // sort.
if (sizeof($files)==0){
    $inc = '0000';
}
else{
    $inc = intval(end($files));
    $inc = $inc + 1;
    $inc = str_pad($inc, 4, '0', STR_PAD_LEFT);
    //echo $inc;
}



$extDir = ['jpg', 'png','gif','svg','mp3','ogg'];

    }
    else {
        // update
        $case = 'update '.$_GET['case'];
        //echo $case;
    }

}
 ?>





        <a href="../">Home</a> | <a href="../pages/_cases/index.php">Cases</a>
        <br><br>
        <?php
        if (isset($_GET['case'])=='add') {
          //echo $type_upload.' XXX_case_'.$inc;
          echo '<br>';
          echo 'Choose name : ';
          echo '<input id="name_case" name="name_case" type="text"><font color=red>&nbsp;&nbsp;*</font>';
          echo '<br>';

        }
        else {
            //$caseInfos = 'wip';
            echo 'update wip';
            echo '<br>';
        }

        echo "Allowed .ext : ['<b>jpg</b>', 'jpeg', 'png','gif','svg','mp3','ogg']";
        echo '<br>';
        echo "Max File Size : 3 Mo (more wip , bug to solved)";
        echo '<br>';
        echo 'Nomenclature :';
        echo '<br>';
        echo '-> fg_XXX_0000.ext (fg = foreground, 0000 = layer level)';
        echo '<br>';
        echo '-> fg_XXX_0001.ext';
        echo '<br>';        
        echo '-> vignette_XXX.ext';
        echo '<br>';
        echo '-> bg_XXX_0000.ext (bg = background)';
        echo '<br>';
        echo '-> bg_XXX_0001.ext';
        echo '<br><br><br>';  
        ?>
        
<select>
  <option value="volvo" selected>Vignette</option>
  <option value="saab">Foreground</option>
  <option value="mercedes">Background</option>
</select>
        <div class="container kv-main">
            <div class="page-header">

            <form enctype="multipart/form-data">

                <div class="form-group">
                    <input id="upload_case" name="images[]" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1">
                  <!-- // count is min n files to upload -->
                </div>



                
            </form>
            
           
            <br>
        </div>
    </body>



	<script>


  
    $("#upload_case").fileinput({
        uploadUrl: 'upload.php', // you must set a valid URL here else you will get an error
        allowedFileExtensions : ['jpg', 'jpeg', 'png','gif','svg','mp3','ogg'],
        uploadAsync: true,
        overwriteInitial: false,
        maxFileSize: 10240000, // 10 Mo 
        maxFilesNum: 10,
          uploadExtraData: function() {
              return {
                  name_case: $("#name_case").val(),
                  //name_case: "<?php echo 'toti_case_0000' ;?>",
                  type_upload: "<?php echo $type_upload ;?>",
                  inc: "<?php echo $inc ;?>",
              };
          },
        SallowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
	});
    

	</script>
</html>