<?php
require '../../../inc/crud.php';
$tblName = 'status_users';
$datas = $db->getRows($tblName,array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$tbl = strtolower(substr($tblName,0,-1));

?>
<link href="styles_crud.css" rel="stylesheet">
<?php
/*include 'DB.php';
$db = new DB();
$data = $db->getRows('status',array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));*/
if(!empty($datas)){


$disabled_fieldRoot = '';
    if($datas['status']=='root' and $datas['id']=='4'){ 
        $disabled_fieldRoot = ' disabled="disabled"'; 
    }



?>
<div class="row" id="row_add-edit">
    <div class="panel panel-default crud-add-edit">
        <div class="panel-heading">Edit <?php echo $tbl;?> <a href="<?php echo $tblName;?>.php" class="glyphicon glyphicon-menu-left" style="float:right;"></a></div>
        <div class="panel-body">

                    <form method="post" action="status_users_action.php" class="form" id="userForm">


                            <div class="form-group">


                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" name="status" value="<?php echo $datas['status']; ?>" <?php echo $disabled_fieldRoot; ?>/>
                            </div>
                                <label>Color</label>
                                <input type="text" class="form-control" name="color" value="<?php echo $datas['color']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Rules</label>
                                <input type="text" class="form-control" name="rules" value="<?php echo $datas['rules']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description" value="<?php echo $datas['description']; ?>"/>
                            </div>

                        <input type="hidden" name="id" value="<?php echo $datas['id']; ?>"/>
                        <input type="hidden" name="action_type" value="edit"/>
                        <input type="submit" class="form-control btn-default" name="submit" value="Update Status"/>


                    </form>

        </div>
    </div>
</div>
<?php } ?>