<?php
require '../../../inc/crud.php';
$tblName = 'status_users';
$tbl = strtolower(substr($tblName,0,-1));

?>
<link href="styles_crud.css" rel="stylesheet">


<div class="row" id="row_add-edit">
    <div class="panel panel-default crud-add-edit">
        <div class="panel-heading">Add new User Status <a href="<?php echo $tblName;?>.php" class="glyphicon glyphicon-remove" style="float:right;"></a></div>
        <div class="panel-body">
            <form method="post" action="status_action.php" class="form" id="userForm">
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" class="form-control" name="status"/>
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" class="form-control" name="color"/>
                </div>
                <div class="form-group">
                    <label>Rules</label>
                    <input type="text" class="form-control" name="rules"/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description"/>
                </div>
                <input type="hidden" name="action_type" value="add"/>
                <input type="hidden" name="tblName" value="<?php echo $tblName; ?>"/>
                <input type="submit" class="form-control btn-default" name="submit" value="Add Status"/>
            </form>
        </div>
    </div>
</div>