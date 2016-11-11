<script src="dropzone.js"></script>
<script src="dropzone_vignette.js"></script>

<link rel="stylesheet" href="dropzone.css">
<link rel="stylesheet" href="dropzone_vignette.css">


    <div id="collapse1" style="display:none;background-color:black;">
       
 <table style="width: 100%;"> 
        <tr>
            <th style="width: 1px;"> 

                    <form action="comments_action.php?action_type=add" method="post">
                    <textarea id='comments' name="comments" rows="10" cols="100"></textarea>
                    <br>
                    <!-- <input type="submit"/> -->

                    <input type="hidden" id="id_asset" name="id_asset" value='<?php echo $datas['id'];?>'/>
                    <input type="hidden" id="id_creator" name="id_creator" value='<?php echo $_SESSION['id'];?>'/>
                    <input type="hidden" id="modified_by" name="modified_by" value='<?php echo $_SESSION['id'];?>'/>
                    <input type="hidden" id="timestamp_id_creator" name="timestamp_id_creator" value='<?php echo $timestamp_id_creator;?>'/>
                    
                    <input type="submit" id="add_comment" name="add_comment" value='add'/>
                    </form>

          </th>        

          <th> 
                  <div  style="height: 100%;background-color: black;">
                                 


<?php 
$ds = DIRECTORY_SEPARATOR;


$DATASstoreFolder = "../../".$_SESSION['$DATASstoreFolder'].$ds.$datas['ids_projects']."_".$datas_projects['project'].$ds."assets".$ds.$datas['folder_name'].$ds."comments".$ds.$timestamp_id_creator;

// echo $DATASstoreFolder;
?>

                          <form action="_comment_upload_files.php?ids_projects=<?php echo $datas['ids_projects'];?>&name_project=<?php echo $datas_projects['project'];?>&id_asset=<?php echo $_GET['id'];?>&folder_name=<?php echo $datas['folder_name'];?>&timestamp_id_creator=<?php echo $timestamp_id_creator;?>" id="dropzoneFiles" class="dropzone"></form>

                  </div>
          </th>        
          <tr>

    </table>


    </div>
