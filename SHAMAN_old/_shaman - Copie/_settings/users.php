
<?php
@session_start();
?>

<?php include('head.php'); ?>


<body>





<div class="header">
<?php 

include('menu_top_settings.php'); 


?>
</div>







<div id="content-item" class="content-item after-box"  style="padding-top:70px;">

<?php 

include('back_ui.php'); 


?>


    <div class='item add-item box_shadow box'>
            <div class='data-name'>add</div>
            <div style='position:absolute; top:110px; left:90px; text-align:center; color:white;'>
            <a href='index.php'  id='index' name='index'>
              <span class='glyphicon glyphicon-plus-sign'></span> 
              </a>
            </div>
    </div>   


<?php
foreach($users as $user){ 
?>

    <div class='item add-item box_shadow box'>
            <div class='data-name'><?php echo $user['login'];?></div>
            <div class='data-name'><?php echo $user['id_status_users'];?></div>
            <div style='position:absolute; top:110px; left:90px; text-align:center; color:white;'>
            <a href='users.php'  id='users_<?php echo $user['id'];?>' name='users_<?php echo $user['id'];?>'>
              <span class='glyphicon glyphicon-user'></span> 
              </a>
            </div>
    </div>       

<?php


}


?>











</div>
</body>