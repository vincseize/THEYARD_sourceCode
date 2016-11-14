
<form action="post_file.php?id=<?php echo $_GET['id'];?>&timestamp_id_creator=<?php echo $_GET['timestamp_id_creator'];?>" method="post" enctype="multipart/form-data">
    <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
<button class="mybutton" id="mybutton" name="mybutton">valid</button>
</form>



