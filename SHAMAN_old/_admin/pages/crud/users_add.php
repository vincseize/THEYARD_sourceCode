<?php
@session_start();
require '../../../inc/crud.php';
$tbl = strtolower(substr($tblName,0,-1));
$datas_status=$status_users; 
$datas_projets=$projects;

?>

<link href="styles_crud.css" rel="stylesheet">
<link href="jquery.multiselect.css" rel="stylesheet" type="text/css">



<div class="row" id="row_add-edit">
    <div class="panel panel-default crud-add-edit">
        <div class="panel-heading">Add new <?php echo $tbl;?> <a href="<?php echo $tblName;?>.php" class="glyphicon glyphicon-remove" style="float:right;"></a></div>

        <div class="panel-body">

            <form role="form" data-toggle="validator" method="post" action="crud/<?php echo $tblName;?>_action.php" class="form" id="userForm">
                    <div class="form-group">
                        <label for="name" class="control-label">Name *</label>
                        <input type="text" class="form-control" name="name"   data-minlength="3"  required/>
                        <div class="help-block">Minimum of 3 characters</div>
                    </div>
                    <div class="form-group">
                        <label for="pseudo" class="control-label">Pseudo *</label>
                        <input type="text" class="form-control" name="pseudo"   data-minlength="3"  required/>
                    </div>
                    <div class="form-group">
                        <label for="login" class="control-label">Login *</label>
                        <input type="text" class="form-control" name="login"   data-minlength="3"  required/>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password *</label>
                        <input type="text" class="form-control" name="password"   data-minlength="3"  required/>
                    </div>
                    <div class="form-group">
                        <label for="mail" class="control-label">Mail *</label>
                        <input type="email" class="form-control" name="mail"  data-error="email invalid" required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                      <label for="sel1">Status</label>
                          <select class="form-control" id="status" name="status">
                          <?php
                                if(!empty($datas_status)){ 
                                    $count = 0; 
                                    foreach($datas_status as $data2){ 
                                        echo "<option  value='".$data2['id']."'>".$data2['status']."</option>";
                                    }
                                }
                            ?>

                          </select>
                    </div>
                    <div class="form-group">
                        <label>Projects</label>
                        <select class="form-control" name="ids_projects[]" multiple id="ids_projects">
                              <?php
                                    if(!empty($datas_projets)){ 
                                        foreach($datas_projets as $data3){ 
                                            echo "<option value='".$data3['id']."' ".$selected.">".$data3['project']."</option>";
                                        }
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Active</label>
                        <input id='active' name='active' type="checkbox" class="btn-group-sm" name="active" checked>
                    </div>

                            <input type="hidden" name="action_type" value="add"/>
                            <input type="hidden" name="tblName" value="<?php echo $tblName; ?>"/>
                            <input type="hidden" name="activeValue" value="1"/>
                            <input type="hidden" name="id_status_usersValue" value="1"/>
                            <input type="hidden" name="archivedValue" value="0"/>
                            <input type="hidden" name="id_creator" value="<?php echo $_SESSION['id']; ?>"/>
                            <input type="hidden" name="modified_by" value="<?php echo $_SESSION['id']; ?>"/>
                            <input type="hidden" name="ids_projectsValue" value=""/>

                        <input type="submit" class="form-control btn-default" name="submit" value="Confirm"/>
                    
            </form>

        </div>    
    </div>
</div>


<!-- IMPORTANT at the end  -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-checkbox.min.js"></script>
<script src="jquery.multiselect.js"></script>

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
            }else{
               $('input[name="activeValue"]').val(0);
            }
        });

        $("#status").change(function () {
                $('input[name="id_status_usersValue"]').val(this.value);
        });

        $('#ids_projects').multiselect({
            columns: 1,
            placeholder: 'Select Projects',
            search: true,
            selectAll: true
        });

/*        $("#ids_projects").change(function () {
                $('input[name="ids_projectsValue"]').val(this.value);
        });*/

    });


});

</script>