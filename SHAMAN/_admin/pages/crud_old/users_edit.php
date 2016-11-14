<?php
require '../../../inc/crud.php';
$datas = $db->getRows($tblName,array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$tbl = strtolower(substr($tblName,0,-1));
$datas_status=$status_users; 
$datas_projets=$projects;
?>




<link href="styles_crud.css" rel="stylesheet">
<link href="jquery.multiselect.css" rel="stylesheet" type="text/css">


<?php
if(!empty($datas)){
    $disabled_fieldRoot = '';
    if($datas['login']=='root' and $datas['pseudo']=='root'  and $datas['id_status_users']=='4' and $datas['id_creator']=='1'){ 
        //$disabled_fieldRoot = ' disabled="disabled"'; 
        $disabled_fieldRoot = ' readonly'; 
        
    }

    $checked = '';
    if ($datas['active']==1){$checked = ' checked';}
    $active = "<input id='active' name='active' value ='".$datas['active']."' type='checkbox' data-group-cls='btn-group-sm' ".$checked." ".$disabled_fieldRoot.">";



?>

<div class="row" id="row_add-edit">
    <div class="panel panel-default crud-add-edit">
        <div class="panel-heading">Edit <?php echo $tbl;?> <a href="<?php echo $tblName;?>.php" class="glyphicon glyphicon-menu-left" style="float:right;"></a></div>
        <div class="panel-body">

            <form method="post" action="crud/<?php echo $tblName;?>_action.php" class="form" id="userForm">

                <div class="form-group">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $datas['name']; ?>" <?php echo $disabled_fieldRoot; ?>/>
                        </div>

                        <div class="form-group">
                            <label>Pseudo</label>
                            <input type="text" class="form-control" name="pseudo" value="<?php echo $datas['pseudo']; ?>" <?php echo $disabled_fieldRoot; ?>/>
                        </div>
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" class="form-control" name="login" value="<?php echo $datas['login']; ?>" <?php echo $disabled_fieldRoot; ?> />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" name="password" value="<?php echo $datas['password']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Mail</label>
                            <input type="text" class="form-control" name="mail" value="<?php echo $datas['mail']; ?>"/>
                        </div>
                        <div class="form-group">
                          <label for="sel1">Status</label>
                          <select class="form-control" id="status" name="status" <?php echo $disabled_fieldRoot; ?>>
                          <?php
                                if(!empty($datas_status)){ 
                                    foreach($datas_status as $data2){ 
                                        $selected = '';
                                        if($data2['id']==$datas['id_status_users']){ $selected = ' selected';}
                                        echo "<option value='".$data2['id']."' ".$selected.">".$data2['status']."</option>";
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
                            <td><?php echo $active; ?></td>
                        </div>

                            <input type="hidden" name="id" value="<?php echo $datas['id']; ?>"/>
                            <input type="hidden" name="action_type" value="edit"/>
                            <input type="hidden" name="tblName" value="<?php echo $tblName; ?>"/>
                            <input type="hidden" name="id_status_usersValue" value="<?php echo $datas['id_status_users']; ?>"/>
                            <input type="hidden" name="activeValue" value="<?php echo $datas['active']; ?>"/>
                            <input type="hidden" name="archivedValue" value="<?php echo $datas['archived']; ?>"/>
                            <input type="hidden" name="modified_by" value="<?php echo $_SESSION['id']; ?>"/>
                            <input type="hidden" name="ids_projectsValue" value=""/>

                        <input type="submit" class="form-control btn-default" name="submit" value="Update"/>


                </div>

            </form>
        
    </div>
</div>
<?php } ?>





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
                $('input[name="archivedValue"]').val(0);
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