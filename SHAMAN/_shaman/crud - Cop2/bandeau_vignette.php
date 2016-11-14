        <!-- Page Header -->
<div class="row"  style=" background-color: gray; margin-bottom:0px;height:50px;padding-bottom:0px;">
            <div class="col-lg-12">
                <h1 style="color:black;font-size:20px;font-weight:bold;">
                    <?php echo $datas['name'];?>
                </h1>
            </div>
</div>




<!-- .row vignette-->
<?php 
    $vignette = "../../".DATASstoreFolderName."/".$ids_projects."_".$name_project."/assets/".$folder_name."/vignette.jpg";
    $vignette_comp = "../../".DATASstoreFolderName."/".$ids_projects."_".$name_project."/assets/".$folder_name."/vignette_comp.jpg";
    if (!file_exists($vignette_comp)) {$vignette_comp = '';$vignette = '';}
    //echo $vignette_comp;

?>
<div class="row" style=" background-color: white; padding-bottom:0px;margin-bottom:0px;padding-top:0px;height:245px;">
            <div id='a7_vignette' name='a7_vignette' class="col-md-4 portfolio-item">



                <!-- 

                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->

                    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">

                          <div id="image_preview" style=" border: 1px solid black;width:<?php echo W_V_EDIT;?>px;height:<?php echo H_V_EDIT;?>px;background-image: url(<?php echo $vignette_comp;?>);background-size: contain">

                                  <div id="selectImage">
                                    <input type="file" name="file" id="file" required style="opacity:0;
                                    overflow: hidden;width:<?php echo W_V_EDIT;?>px;height:<?php echo H_V_EDIT;?>px;background-size:contain;)"/> 
                                    <input type="hidden" name="ids_projects" id="ids_projects" value='<?php echo $ids_projects;?>'> 
                                    <input type="hidden" name="name_project" id="name_project" value='<?php echo $name_project;?>'>  
                                    <input type="hidden" name="folder_name" id="folder_name" value='<?php echo $folder_name;?>'>              
                                  </div>
                          </div>   
                    </form>

<!-- <a href='#' title='Image $number' number='$number'>
                  <img class='thumbnail_comments' src='<?php echo $vignette;?>' width='10px' height='10px'/>
                  </a> -->
            </div>
             <!-- /.row vignette-->



                   <!-- .row description-->
                  <div class="col-md-4 portfolio-item">

                
                        <div id="description_title" style="width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">
                        Description
                        </div>

                        Frames : <?php echo $datas['duree']; ?>
                        <br>
                        Description :<br> 

        <!-- <form name="form_description" method='post'> -->


                        <textarea id="description" name="description" rows="5" cols="50" <?php echo $disabled_description; ?>><?php echo $datas['description'];?></textarea><br>
                        <input type="hidden" name="post_id_description" id="post_id_description" value="<?php echo $_GET['id']; ?>"/>
                      <!--   <input type='submit' id='update_description' name='update_description' value='update'/> -->
        <!-- </form> -->







                        Path : 
                        <br>

                        Mail ? : 
           











                        </div>
                        <!-- /.row description-->


                        <!-- .row tags steps-->
                        <div class="col-md-4 portfolio-item">




 <!--            <table class="tg">
              <tr>
                <th class="tg-031e" style="vertical-align:top;"> -->
            <!-- .row tags-->

            <?php include('check_tags.php'); ?>


<!--                 </th>
              </tr>
            </table> -->







            </div>
             <!-- /.row tags steps-->
            </div>



</div>
<!-- /.row steps tags-->





