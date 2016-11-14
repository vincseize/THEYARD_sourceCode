<?php
require '../../../inc/crud.php';
$tbl = strtolower(substr($tblName,0,-1));
?>

<link href="styles_crud.css" rel="stylesheet">

<div class="row" id="row_add-edit">
    <div class="panel panel-default crud-add-edit">
        <div class="panel-heading">Add new <?php echo $tbl;?> <a href="<?php echo $tblName;?>.php" class="glyphicon glyphicon-remove" style="float:right;"></a></div>
        <div class="panel-body">
            <form method="post" action="crud/<?php echo $tblName;?>_action.php" class="form" id="userForm">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control input-add" name="tag"/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control input-add" name="description"/>
                </div>
                <div class="form-group">
                    <label>Icon</label>
                    <input type="text" class="form-control input-add" name="pic"/>
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" class="form-control input-add" name="color"/>
                </div>
                <div class="form-group">
                    <label>Active</label>
                    <input type="checkbox" class="btn-group-sm" name="active" checked>
                </div>


                
                        <input type="hidden" name="action_type" value="add"/>
                        <input type="hidden" name="tblName" value="<?php echo $tblName; ?>"/>
                        <input type="hidden" name="activeValue" value="1"/>
                        <input type="hidden" name="archivedValue" value="0"/>
                        <input type="hidden" name="id_creator" value="<?php echo $_SESSION['id']; ?>"/>
                        <input type="hidden" name="modified_by" value="<?php echo $_SESSION['id']; ?>"/>


                <input type="submit" class="form-control btn-default-add" name="submit" value="Confirm"/>
            </form>
        </div>
    </div>
</div>










<!-- IMPORTANT at the end  -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-checkbox.min.js"></script>

<script type="text/javascript">
$( document ).ready(function() {
    $(function () {
        $('input[type="checkbox"]').checkboxpicker();   
        $('#renewalStatus').prop('offLabel', 'OFF');
        $('#renewalStatus').prop('onLabel', 'ON');
    });


    });

</script>