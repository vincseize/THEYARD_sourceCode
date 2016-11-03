


  <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top"  style="background-color: #333333;width: 100%;border:none;">





  
<!-- navbar-header -->
        <div style="position:absolute;">
         
             <ul class="nav navbar-nav">
        
                          <select class="form-control" style="background-color: #333333;border:none;font-size: 18px;font-weight:bold;" id="select_projects" name="select_projects">
                          <?php
                                if(!empty($datas_projects)){ 
                                    foreach($datas_projects as $data3){ 

                                        $selected = ' ';
                                        if($data3['project']=="M2"){ $selected = ' selected';}
                                        if($data3['active']==1){
                                          echo "<option value='".$data3['id']."'  ".$selected.">".$data3['project']."</option>";
                                        }
                                    }
                                }
                            ?>
                          </select>
                </ul>
        </div>
<!-- /.navbar-header -->















    <div style="position:absolute;top:5px;right:15px;">
    <ul class="nav navbar-nav">
        <img src='images/logo_shaman_menutop.png'>    
         </ul> 
    </div>









<div style="position:absolute;top:35px;right:5px;">


    <li  style="background-color: #333333;border:none;color: #333333;font-size: 12px;" >

<!--           // admin -->
          <?php
              if($_SESSION['is_root']==True or $_SESSION['admin']=='1'){
                  echo "<a href='../_admin/index.php'  role='button' aria-haspopup='true' aria-expanded='false'>";
                  echo "<span class='glyphicon glyphicon-wrench'>&nbsp;</span>";
                  echo "</a>";
              }
          ?> 
<!--           // settings -->
          <?php
              if($_SESSION['status']=='2' or $_SESSION['is_root']==True or $_SESSION['admin']=='1'){ 
                  echo "<a href='_settings/index.php'  role='button' aria-haspopup='true' aria-expanded='false'>";
                  echo "<span class='glyphicon glyphicon-pencil'>&nbsp;</span>";
                  echo "</a>";
                }
          ?> 
<!--           // profile -->
          <?php
              if($_SESSION['id_status_user']!='3'){ 
                  echo "<a href='_myProfile/index.php' role='button' aria-haspopup='true' aria-expanded='false' title='Profile ".$_SESSION['login']."'>";
                  echo "<span class='glyphicon glyphicon-user'>&nbsp;</span>";
                  echo "</a>";
          }
          ?>

<!--           // logout -->
          <a href='logout.php' role='button' aria-haspopup='true' aria-expanded='false' title='Logout <?php echo $_SESSION['login'] ;?>'>
          <span class="glyphicon glyphicon-remove">&nbsp;</span>
          </a>




              <?php
/*                  if($_SESSION['status']=='2' or $_SESSION['is_root']==True){ 
                      echo "<li><a href='_settings/index.php'><span class='glyphicon glyphicon-list-alt'></span>&nbsp;Settings</a></li>";*/
              ?> 

<!--                 <li><a href="_profile/index.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp;My Profile</a></li> -->

              <?php
/*                  if($_SESSION['is_root']==True or $_SESSION['login']=='vincseize'){
                          echo "<li><a href='../_admin/index.php'><span class='glyphicon glyphicon-list-alt'></span>&nbsp;Administration</a></li>";
                      }*/
                  ?>

<!--                   <li><a href="logout.php"><span class="glyphicon glyphicon-remove"></span>&nbsp;Disconnect</a></li> -->





    </li>




      </ul>

</div>


















      <div class="container-fluid"  style="background-color: #333333;width: 100%;height:60px;border:none;" >
       
        

<!--/########################################################################## -->

<!--/########################################################################## -->






















        <!-- nav-collapse -->
        <div id="navbar" class="navbar-collapse collapse" style="background-color: #333333;margin-top:35px;border:none;">

              <ul class="nav navbar-nav navbar-middle">
                  <div>

<div class="filter"  style="position:relative;left:-5px">
<li class="filter active" data-filter="all"><a href="#">ALL</a></li>
<!--     <li class="filter" data-filter="antipasto"><a href="#">tag1</a></li>
  <li class="filter" data-filter="main"><a href="#">tag2</a></li>
  <li class="filter" data-filter="desert"><a href="#">tag3</a></li> -->

                          <?php
                                if(!empty($datas_tags)){ 
                                    foreach($datas_tags as $data2){ 
                                        if($data2['active']==1){ 
                                            echo "<li class='filter' data-filter='".$data2['tag']."'><a href='#''>".$data2['tag']."</a></li>";
                                        }
                                    }
                                }
                            ?>



</div>


                  </div>

                </ul>

        </div><!--/.nav-collapse -->

















<!--/########################################################################## -->



    </nav>



    <br>

    