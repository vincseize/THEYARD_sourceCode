			<div style="background-color:blue;" class="w3-third">
<!-- 			  <h2>ici image 01</h2>
			  <p>l'image quoi</p>
			  <p>image only quoi</p> -->
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