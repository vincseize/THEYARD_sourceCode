<?php
require '../../inc/crud.php';
$datas=$assets; 
?>

<?php include('head.php');?>

<body>


    <div id="wrapper">


        <?php include('menu_top.php'); ?>  <!-- Include Menu Left !!! -->
           

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ASSETS</h1>
                </div>
            </div>


            <!-- crud/projects_add.php -->
                           
            <div class="row" id="row">
                <div class="panel panel-default projects-content">
                    <div class="panel-heading">Assets <a href="#" class="glyphicon glyphicon-plus" id="trigger_add"></a></div>
                    <table class="table">
                        <tr>
                            <th width="10px">#</th>
                            <th width="10%">Active</th>
                            <th width="10%">Visible by</th>
                            <th width="15%">Name</th>
                            <th width="20%">Description</th>
                            <th width="10%">Modified</th>
                            <th width="10%">Modified by</th>
                            <th width="15%">Created</th>
                            <th width="10%"></th> 
                        </tr>
                        <?php
                        if(!empty($datas)){ 
                            $count = 0; foreach($datas as $data){ 
                                $count++;
                                $checked = '';
                                $delete = "<a href=\"crud/archive_action.php?tblName=".$tblName."&action_type=archive&id=".$data['id']."\" class=\"glyphicon glyphicon-trash\" onclick=\"return confirm('Delete [ ".$data['name']." ] Asset ?');\"></a>";
                                
                                $style_bg_deleted = "";
                                if ($data['archived']==1){
                                    $style_bg_deleted = " style='background-color:red;' title='archived to be deleted'";
                                    $delete  = '';
                                }
                                
                                if ($data['active']==1){$checked = ' checked';}
                                $active = "<input type=\"checkbox\" data-group-cls=\"btn-group-xs\" ".$checked." disabled>";

                                ?>
                                <tr>
                                    <td <?php echo $style_bg_deleted; ?>><?php echo $count; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td><?php echo $data['visible_by']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['description']; ?></td>
                                    <td><?php echo substr($data['modified'],0,-8); ?></td> 
                                    <td><?php echo substr($data['modified_by'],0,-8); ?></td> 
                                    <td><?php echo substr($data['created'],0,-8); ?></td>
                                    <td style="float:right;">
                                    <a href="#" class="glyphicon glyphicon-edit" id="trigger_edit" value="<?php echo $data['id']; ?>"></a>
                                    <?php echo $delete; ?>
                                    </td>
                                </tr>
                        <?php } }else{ ?>
                        <tr><td colspan="4">No assets(s) found...</td>
                        <?php } ?>
                    </table>
                </div>
                
            </div>

                    










    </div>
    <!-- /#wrapper -->



<!-- IMPORTANT at the end  -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-checkbox.min.js"></script>



<script>

$(document).ready(function(){


    $(function () {
        $('input[type="checkbox"]').checkboxpicker();   
        $('#renewalStatus').prop('offLabel', 'OFF');
        $('#renewalStatus').prop('onLabel', 'ON');
    });










    
    // add
    $('#trigger_add').click(function(e){
         e.preventDefault();
        $("#row").load("crud/assets_add.php");
      });
    // edit
    $("#trigger_edit[value]").click(function(e) {
        e.preventDefault();
        var id =   $(this).attr("value");
        $("#row").load("crud/assets_edit.php?id="+id);
    });
    //delete

});

</script>












    
</body>

</html>
