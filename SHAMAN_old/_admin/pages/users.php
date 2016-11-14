<?php
/*@session_start();*/
// if(!isset($_SESSION['user_session'])){header("Location: ../logout.php");}
require '../../inc/crud.php';

$datas        =$users; 
$datas_status =$status_users; 
$datas_projects =$projects; 

$array_projets = array();
if(!empty($datas_projects)){ 
    foreach($datas_projects as $data3){ 
        $array_projets[$data3['project']]=$data3['id'];
    }
}
$ar = array("root");
?>

<?php include('head.php');?>



<style type="text/css" media="screen">
.projects_user {
 width:fit-content;height:20px;
 background-color: white;
 border:1px solid gray;
 border-radius: 5px;
 margin-right: 5px;
 padding-left: 5px;
 padding-right: 5px;
 padding-bottom: 20px;
}
</style>




<body>


    <div id="wrapper">


        <?php include('menu_top.php'); ?>  <!-- Include Menu Left !!! -->
           


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">USERS</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
               
                    <!-- /.panel -->






                           
            <div class="row" id="row">
                <div class="panel panel-default users-content">
                    <div class="panel-heading">Users <a href="#" id="trigger_add" class="glyphicon glyphicon-plus"></a></div>
                    <table class="table">
                        <tr>
                            <th width="5px">#</th>
                            <th width="10%">Active</th>
                            <th width="30px">Avatar</th>
                            <th width="8%">Name</th>
                            <th width="8%">Pseudo</th>
                            <th width="8%">Login</th>
                            <th width="8%">Password</th>
                            <th width="10%">Mail</th>
                            <th width="10%">Projects</th>
                            <th width="10%">Status</th>
                            <th width="8%">Modified</th>
                            <th width="8%">Created</th>
                            <th width="8%">Created by</th>
                            <th width="10%"></th> 
                        </tr>
                        <?php
                        if(!empty($datas)){ 
                            $count = 0; foreach($datas as $data){ 
                                $count++;
                                $delete = "<a href=\"crud/archive_action.php?tblName=".$tblName."&action_type=archive&id=".$data['id']."\" class=\"glyphicon glyphicon-trash\" onclick=\"return confirm('Delete [ ".$data['name']." ] User ?');\"></a>";
                                $style_bg_deleted = "";
                                if ($data['archived']==1){
                                    $style_bg_deleted = " style='background-color:red;' title='archived to be deleted'";
                                    $delete = "";
                                }
                                $checked = '';
                                if ($data['active']==1){$checked = ' checked';}
                                $active = "<input type=\"checkbox\" data-group-cls=\"btn-group-xs\" ".$checked." disabled> ";
                                $password = $data['password'];
 
                                if (in_array($data['login'], $ar)){
                                    $password = "<input type='password' disabled value='******' style='border:none;background-color:transparent;'></input>";
                                    $active = "";
                                    $delete = "";
                                }
                                $cl_projects_user = "";
                                if(strlen($data['ids_projects'])>0){$cl_projects_user="class='projects_user';";}
                        ?>
                                <tr>
                                    <td <?php echo $style_bg_deleted; ?>><?php echo $count; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td><?php echo $data['pic']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['pseudo']; ?></td>
                                    <td><?php echo $data['login']; ?></td>
                                    <td><?php echo $password; ?></td>
                                    <td><?php echo $data['mail']; ?></td>
                                    <td>


<?php  
$projects_array_user = explode(",",$data['ids_projects'] );
foreach($projects_array_user as $id_p){
        $p = array_search($id_p, $array_projets);
        echo "<div $cl_projects_user>$p</div>";
        } 
?>




                                    </td>
                                    <td>
                                    <?php
                                        if(!empty($datas_status)){ 
                                            foreach($datas_status as $data2){ 
                                                if($data['id_status_users']==$data2['id']){echo $data2['status'];}
                                            }
                                        }
                                    ?>
                                    </td>

                                    <td><?php echo substr($data['modified'],0,-8); ?></td> 
                                    <td><?php echo substr($data['created'],0,-8); ?></td>
                                    <td><?php echo $data['id_creator']; ?></td>
                                    <td style="float:right;">
                                        <a href="#" class="glyphicon glyphicon-edit" id="trigger_edit" value="<?php echo $data['id']; ?>"></a>

                                        <?php echo $delete; ?>
                                    </td>
                                </tr>
                                <?php } }else{ ?>
                                <tr><td colspan="4">No user(s) found......</td>
                        <?php } ?>
                    </table>















                </div>
                
            </div>

                    
















                    
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    
<!-- IMPORTANT at the end  -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-checkbox.min.js"></script>
<script src="js/validator-min.js"></script>

<script type="text/javascript">

$( document ).ready(function() {

    $(function () {
        $('input[type="checkbox"]').checkboxpicker();   
/*        $('#renewalStatus').prop('offLabel', 'OFF');
        $('#renewalStatus').prop('onLabel', 'ON');*/
    });



    // add
    $('#trigger_add').click(function(e){
         e.preventDefault();
        $("#row").load("crud/users_add.php");
      });
    // edit
    $("#trigger_edit[value]").click(function(e) {
        e.preventDefault();
        var id =   $(this).attr("value");
        $("#row").load("crud/users_edit.php?id="+id);
    });
    //delete todo




    // update active todo
/*    $("#active").change(function(){
        if($(this).prop("checked") == true){
           //alert(true)
           $('input[name="activeValue"]').val(1);
        }else{
           $('input[name="activeValue"]').val(0);
        }
        $("#row").load("crud/users_edit.php?id="+id);
    });*/









});

</script>





</body>

</html>
