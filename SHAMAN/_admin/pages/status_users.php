<?php
require '../../inc/crud.php';
/*$tmp = explode('/', $_SERVER["SCRIPT_NAME"]);
$file = $tmp[count($tmp) - 1];
$filename = explode('.', $file)[0];*/
$datas=$status_users;
$tblName = 'status_users';
$ar = array("root","visitor","manager","user");
?>
<?php include('head.php');?>

<body>


    <div id="wrapper">


        <?php include('menu_top.php'); ?>  <!-- Include Menu Left !!! -->




        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">USERS STATUS</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
               
                    <!-- /.panel -->






                           
            <div class="row" id="row">
                <div class="panel panel-default users-content">
                    <div class="panel-heading">Status <a href="#" class="glyphicon glyphicon-plus" id="trigger_add"></a></div>
                    <table class="table">
                        <tr>
                            <th width="10px">#</th>
                            <th width="30px">Active</th>
                            <th width="16%">Status</th>
                             <th width="8%">Color</th>
                            <th width="20%">Rules</th>
                            <th width="22%">Description</th>
                            <th width="8%">Modified</th>
                            <th width="8%">Created</th> 
                            <th width="30px"></th>
                        </tr>
                        <?php
/*                        include 'DB.php';
                        $db = new DB();
                        $datas = $db->getRows('$datas',array('order_by'=>'id DESC'));*/
                        if(!empty($datas)){ $count = 0; foreach($datas as $data){ $count++;
                            $checked = '';
                            if ($data['archived']==1){$checked = ' checked';}
                            $active = "<input type=\"checkbox\" data-group-cls=\"btn-group-sm\" ".$checked.">";
                            $delete = "<a href=\"crud/delete_action.php?tblName=".$tblName."&action_type=delete&id=".$data['id']."\" class=\"glyphicon glyphicon-trash\" onclick=\"return confirm('Delete [ ".$data['status']." ] Status?');\"></a>";
                            if (in_array($data['status'], $ar)){
                                $active = "";
                                $delete = "";
                            }
                            ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $active; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td><?php echo $data['color']; ?></td>
                            <td><?php echo $data['rules']; ?></td>
                            <td><?php echo $data['description']; ?></td> 
                            <td><?php echo substr($data['modified'],0,-8); ?></td>
                            <td><?php echo substr($data['created'],0,-8); ?></td>
                            <td style="float:right;">
                               <a href="#" class="glyphicon glyphicon-edit" id="trigger_edit" value="<?php echo $data['id']; ?>"></a>
                                <?php echo $delete; ?>
                            </td>
                        </tr>
                        <?php } }else{ ?>
                        <tr><td colspan="4">No data found...</td>
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

<script>

$(document).ready(function(){

    
    // add
    $('#trigger_add').click(function(e){
         e.preventDefault();
        $("#row").load("crud/status_users_add.php");
      });
    // edit
    $("#trigger_edit[value]").click(function(e) {
        e.preventDefault();
        var id =   $(this).attr("value");
        $("#row").load("crud/status_users_edit.php?id="+id);
    });
    //delete

});

</script>






    
</body>

</html>
