

<div style="background-color: #303030;width:100%;color:#A9A9A9;">


		<div id="description_title" style="color:#A9A9A9;width: 100%;border-width:1px;border-color:#262626;border-style:solid;background-color: #262626;">
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

</div>