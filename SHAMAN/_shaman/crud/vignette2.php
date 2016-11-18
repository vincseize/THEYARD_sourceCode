<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
</style>


    <script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript"></script>



<div class="section group" style="background-color:red;padding-right:0px;margin-right:0px;right:0px;width:100%;height:100px;">
	<div style=" background-color:blue;display:inline-block;width:500px;">
a
	</div>
	<div style="background-color:green;display:inline-block;width:300px;">
b
	</div>
	<div   id="tags" style="background-color:yellow;display:inline-block;">
c
	</div>

</div>


<div id="op"></div>


<script type="text/javascript">
// viewport refers to portion of your browser that is actually used for displaying your web page
// viewport doesnt include space taken by scrollbars
var op = $("#op");

window.addEventListener("resize", displayViewportSize, false);
displayViewportSize(null);

function displayViewportSize(e) {
    op.text("");
    op.append("width : " + document.documentElement.clientWidth + "<br/>");
    op.append("height : " + document.documentElement.clientHeight + "<br/><br/>");
    
    //excluding scrollbars
    op.append("inner width : " + window.innerWidth + "<br/>");
    op.append("inner height : " + window.innerHeight + "<br/><br/>");
    
    // including titlebar
    op.append("outer width : " + window.outerWidth + "<br/>");
    op.append("outer height : " + window.outerHeight + "<br/><br/>");
    
    // screen size (Including taskbar)
    op.append("screen width : " + window.screen.width + "<br/>");
    op.append("screen height : " + window.screen.height+ "<br/><br/>");
    
    // available screen size (Excluding taskbar)
    op.append("available screen width : " + window.screen.availWidth + "<br/>");
    op.append("available screen height : " + window.screen.availHeight + "<br/><br/>");
    
    // document size
    op.append("document width : " + document.body.clientWidth + "<br/>");
    op.append("document height : " + document.body.clientHeight + "<br/><br/>");


var w_tags = document.documentElement.clientWidth - (500+300) - 40;
    //document.getElementById('tags').style.width = w_tags + "px";
    $( "#tags" ).css("max-width",w_tags + "px") ;
    $( "#tags" ).css("min-width",500 + "px") ;
    $( "#tags" ).css("width",w_tags + "px") ;

}
</script>