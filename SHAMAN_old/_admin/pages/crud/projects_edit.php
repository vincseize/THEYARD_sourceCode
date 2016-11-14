<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../../../index.php");exit;}
require '../../../inc/crud.php';
$datas = $db->getRows($tblName,array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$tbl = strtolower(substr($tblName,0,-1));
?>
<link href="styles_crud.css" rel="stylesheet">
<?php
if(!empty($datas)){


$checked = '';
    if ($datas['active']==1){$checked = ' checked';}
    $active = "<input id='active' name='active' value ='".$datas['active']."' type='checkbox' data-group-cls='btn-group-sm' ".$checked.">";



?>
<div class="row" id="row_add-edit">
    <div class="panel panel-default crud-add-edit">
        <div class="panel-heading">Edit <?php echo $tbl;?> <a href="<?php echo $tblName;?>.php" class="glyphicon glyphicon-menu-left" style="float:right;"></a></div>
        <div class="panel-body">

            <form method="post" action="crud/<?php echo $tblName;?>_action.php" class="form" id="userForm">

                <div class="form-group">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="project" value="<?php echo $datas[$tbl]; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $datas['description']; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Active</label>
                        <td><?php echo $active; ?></td>
                    </div>

                            <input type="hidden" name="id" value="<?php echo $datas['id']; ?>"/>
                            <input type="hidden" name="tblName" value="<?php echo $tblName; ?>"/>
                            <input type="hidden" name="activeValue" value="<?php echo $datas['active']; ?>"/>
                            <input type="hidden" name="archivedValue" value="<?php echo $datas['archived']; ?>"/>
                            <input type="hidden" name="action_type" value="edit"/>
                            <input type="hidden" name="modified_by" value="<?php echo $_SESSION['id']; ?>"/>

                        <input type="submit" class="form-control btn-default" name="submit" value="Update"/>


                </div>

            </form>
        
    </div>
</div>
<?php } ?>



<!-- IMPORTANT at the end  -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-checkbox.min.js"></script>

<script type="text/javascript">
$( document ).ready(function() {
    $(function () {
        $('input[type="checkbox"]').checkboxpicker();   
        $('#renewalStatus').prop('offLabel', 'OFF');
        $('#renewalStatus').prop('onLabel', 'ON');

        $("#active").change(function(){
            if($(this).prop("checked") == true){
               //alert(true)
               $('input[name="activeValue"]').val(1);
               $('input[name="archivedValue"]').val(0);
            }else{
               $('input[name="activeValue"]').val(0);
            }
        });



    });


    });

</script>