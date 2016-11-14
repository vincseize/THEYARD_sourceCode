


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









<div style="position:absolute;top:35px;right:25px;">


<li class="dropdown"  style="background-color: #333333;border:none;color: #333333;font-size: 12px;" >

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >
                    <span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $title_user;?>&nbsp;<span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">


                    <?php
                        if($_SESSION['login']=='vincseize'){ 
                            echo "<li><a href='todo.php'><span class='glyphicon glyphicon-cog'></span>&nbsp;My Todos</a></li>";
                        }
                    ?> 

                    <li><a href="#"><span class="glyphicon glyphicon-pencil"></span>&nbsp;My Settings wip</a>
                    </li>


                    <?php
                        if($_SESSION['is_root']==True)
                                        echo "<li><a href='../_admin/index.php'><span class='glyphicon glyphicon-list-alt'></span>&nbsp;Administration</a></li>";
                        ?>

                      <li><a href="logout.php"><span class="glyphicon glyphicon-remove"></span>&nbsp;Disconnect</a></li>
                    </ul>





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

    