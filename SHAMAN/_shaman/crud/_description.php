<?php
/*$class_edit_description = " class='edit_description' ";
if($_SESSION['is_root']==true){ $class_edit_comment = ""; }*/
?>

<div id="description_title" style="width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">
Description
</div>

Frames : <?php echo $datas['duree']; ?>
<br>
Description :<br> 

<textarea id="description" name="description" rows="3" cols="30" <?php echo $disabled_description; ?> style="background: transparent;outline: none; border: 0 none;">
<?php echo $datas['description'];?>
</textarea>



<!-- <?php
echo "<div ".$class_edit_description." valign='top' style='width:400px' id='description' name='description' >";
echo $datas['description'];
echo " </div>";
?> -->


<br>
<input type="hidden" name="post_id_description" id="post_id_description" value="<?php echo $_GET['id']; ?>"/>





Path : 
<br>

Mail ? : 