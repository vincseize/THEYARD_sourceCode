

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
function basename(path) {
    return path.replace(/\\/g,'/').replace( /.*\//, '' );
}
if (!String.prototype.trim) {
	String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, '');};
}

function sizeOfObject(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
}

function createItem(){
	var item = { "name":$("#add-name").val(), "length":$("#add-length").val(), "description":$("#add-description").val(), "id_project": currentProject,"tags":tmpAddNewTags};
	jsonCall("json/create-item-info.php",item,createItemDone);
}
function createItemDone(data){
	if(data[0]==true){
		getItemsWithTags(selectedTags);
		$("#overlay-add-item").hide();
		$("#add-description").val("");
		$("#add-length").val("");
		$("#add-name").val("");
	}
}
function getItems() {
	jsonCall("json/get-items.php?id="+currentProject, {"sort":sortItems?1:0}, displayItems);
}

function getItemsDetails() {
		jsonCall("json/get-itemsDetails.php?id="+currentProject,   {"ids":listItems}, displayItemsDetails);
}

function getAttachMetadata(){
		var attach = $("#Lecteur-button-download").attr("attach").substr(3);
		jsonCall("json/get-info.php",   { "attach":  attach}, getAttachMetadataDone);		
}
function getAttachMetadataDone(data){
	data = data["metadata"];
	var htmldata = "";
	for(var d in data){
			htmldata += "<h2>"+d+"</h2>";
			for(var e in data[d]){
				htmldata += "<DIV>"+e+" = <B>"+data[d][e]+"</B></DIV>";
			}
	}

	$("#metadata-content").html(htmldata);
	$("#metadata-overlay").show();
}

function getItemsWithTags(tags){
	jsonCall("json/get-items.php?id="+currentProject, {"tags":tags, "sort":sortItems?1:0}, displayItems);
}



function deleteItem(id){
	if(confirm("Etes vous certain de vouloir supprimer cet asset/plan et tous ce qu'il contient ?")) jsonCall("json/delete-item.php", {"id":id}, deleteItemDone);	
}

function recycleItem(id){
	if(confirm("Etes vous certain de vouloir mettre cet asset/plan à la corbeille (tag poubelle) ?")) 
		jsonCall("json/add-tag-item.php", {"id-tag":0,"id-item":id}, recycleItemDone);	
}

function recycleItemDone(data){
	closeDetailsOverlay();
	getItemsWithTags(selectedTags);	
}


function deleteItemDone(data){
	closeDetailsOverlay();
	getItemsWithTags(selectedTags);
}

function displayNotifyManager(idproject){
	jsonCall("json/get-notify.php", {"id":idUser}, displayNotifyManagerDone);
}
function displayNotifyManagerDone(data){
	var notify = data["notify"];
	projectTags = data["projects"];
	var html = ""; var curProj=-1;
	var sel=0;
	for(i=0;i<notify.length;i++){
		if(curProj != notify[i]["id_project"]){
			html += "<div class='tagmanager-intitule'>Tags suivi sur le projet "+notify[i]["name_project"]+"</div>";
			curProj = notify[i]["id_project"];
		}
		html += "<div class='tag tag-manager'>"+notify[i]["tag"].toUpperCase()+"<span class=icon onClick='deleteNotify("+notify[i]["id"]+")'>X</span></div>";
	}

	var htmlselproj ="<SELECT id='notify-selectproject' onChange='refreshNotifyTag();'>";
	for(i=0;i<projectTags.length;i++){
		htmlselproj+="<OPTION VALUE="+projectTags[i]["id_project"]+(projectTags[i]["id_project"]==currentProject?" SELECTED ":"")+">"+projectTags[i]["name_project"]+"</OPTION>";
	}
	htmlselproj+="</SELECT>";
	
	$("#notifymanager-selectproject").html(htmlselproj);
	refreshNotifyTag();
	$("#notifymanager-content-notif").html(html);
	$("#overlay-notifymanager").show();
}
function refreshNotifyTag(){
	var idproject = $("#notify-selectproject option:selected").val();
	var k=-1; var html="";
	do{k++;}while(projectTags[k]["id_project"]!=idproject); //search id
	var tags = JSON.parse("["+projectTags[k]["tags"]+"]");
	tags.sort(function(a,b){return a["name_tag"].localeCompare(b["name_tag"]);});
	html+="<SELECT id='notify-selecttag'><OPTION VALUE='-1'>Tous les tags</OPTION>";
	for(i=0;i<tags.length;i++){
		html+="<OPTION VALUE='"+tags[i]["id_tag"]+"'>"+tags[i]["name_tag"]+"</OPTION>";
	}
	html+="</SELECT>";
	$("#notifymanager-selecttag").html(html);
}
function addNotify(){
	var idproject = $("#notify-selectproject option:selected").val();
	var idtag= $("#notify-selecttag option:selected").val();
	jsonCall("json/add-notify.php", {"id_project":idproject, "id_user":idUser,"id_tag":idtag}, addNotifyDone);
}
function addNotifyDone(data){
	displayNotifyManager(0);
}
function deleteNotify(id){
	jsonCall("json/delete-notify.php", {"id":id}, deleteNotifyDone);
}
function deleteNotifyDone(id){
	displayNotifyManager(0);
}

function displayTagManager(idproject){
	jsonCall("json/get-tags.php", {"id":idproject}, displayTagManagerDone);
}

function displayTagManagerDone(data){
	var type = Array("generic", "specific");
	for(var k in type){
		var tags = "";
		var curType = -1;
		for(var t in data[type[k]]){
			// INTITULES 
			tt = data[type[k]][t]["type"];
			if(curType != tt){
				if(tt<100){
					//Tâche
					if(tt<100 && curType<100 && curType!=-1){
						// Deja fait
					}else{
						tags += "<div class=tagmanager-intitule-section>Tags de tâche</div>";
					}
				}else{
					tags += "<div class=tagmanager-intitule-section>Tags de rangement</div>";
					// Rangement
				}
				curType = tt;
			}
			//tmpid= "tagmanager-"+data[type[k]][t]["id"]+"-"+Math.round(Math.random()*1000);
			tags += "<div class='tag tag-manager'>"+data[type[k]][t]["name"].toUpperCase()+"<span class=icon"+(type[k]=="generic" && group!=0?"disabled":" onClick='deleteTag("+data[type[k]][t]["id"]+","+(type[k]=="generic"?1:null)+")'")+">X</span></div>";
		}
		$("#tagmanager-content-"+type[k]).html(tags);
	}
	$("#overlay-tagmanager").show();
}
function deleteTag(id, important){
	important = typeof important !== 'undefined' ? important : null;
	if(confirm("Etes vous certain de vouloir supprimer ce tag ?"))
		if(important!=null){
			if(confirm("ATTENTION : CE TAG SERA SUPPRIMÉ POUR TOUS LES PROJETS ! \n Etes vous certains de vouloir supprimer ce tag PARTOUT ?"))
				jsonCall("json/delete-tag.php", {"id":id}, deleteTagDone);
		}else{jsonCall("json/delete-tag.php", {"id":id}, deleteTagDone);}
		
}
function deleteTagDone(data){
	displayTagManager(currentProject);
	getTagsFilter();
}


function addTag(idproject, name, type , icon, color, values, allproject){
	icon = typeof icon !== 'undefined' ? icon : null;
	color = typeof color !== 'undefined' ? color : null;
	values = typeof values !== 'undefined' ? values : null;
	jsonCall("json/add-tag.php", {"type":type, "name":name, "id":(allproject?-1:idproject),"icon":icon, "color":color, "values":values}, addTagDone);
}

function getTagsFilter(){
	jsonCall('json/get-project-tags.php?id='+currentProject, {}, refreshTypeahead);
}

function addTagDone(data){
	displayTagManager(currentProject);
	getTagsFilter();
}

function displayItemsDetails(data) {
	for (var curid in data) {
		var curItem = $("#item-"+curid);
		for (var k in data[curid]) {
			switch(k){
				case "tags":
					holder=curItem.find(".item-tag-holder");
					holder.html("");
					displayTag(holder, data[curid]["tags"]);
//					for(var z=0;z< data[curid]["tags"].length;z++){
//						elem = displayTag(data[curid]["tags"][z]);
//						holder.append(elem);
//					}
					break;
				case "comments":
					for (var l in data[curid]["comments"][0]) {
						m = curItem.find(".data-" + l);
						if (m.length > 0) {
							m.html(data[curid]["comments"][0][l]);
						}
					}
					break;

				default:
					console.log("Error ("+k+")");
			}
		}
	}
}

function displayItems(data) {
		
		$(".content-item").empty();
		
		listItems=Array();
	for (var i = 0; i < data.length; i++) {
		var newItem = $(".template-item").clone(true, false);
		newItem.removeClass("template-item");
		listItems.push(data[i]["id"]);
		
		for (var k in data[i]) {
//			console.log(".data-" + k + "=" + data[i][k] + "----" + newItem.find(".data-" + k).length);
			switch(k){
				case "vignette":
					m = newItem.find(".data-" + k);
					if (m.length > 0) {
						if (data[i][k] == null) 
							m.attr("src", "images/vignette-error2.png"); 
						else 
							m.attr("src", "data/vignette/"+currentProject+"/"+data[i]["id"]+"/192/"+data[i][k]);
					}
					break;
				case "id":
					newItem.attr("id", "item-"+data[i]["id"]);
					m = newItem.find(".data-" + k);
					if (m.length > 0) {
						m.html(data[i][k]);
					}
				break;
				case "tags":
					m=newItem.find(".item-tag-holder");
					m.html("");
					curtag = JSON.parse(data[i]["tags"]);
					displayTag(m, curtag);
					break;
				default:
					m = newItem.find(".data-" + k);
					if (m.length > 0) {
						m.html(data[i][k]);
					}
					break;
			}
		}
		newItem.appendTo(".content-item");
	}
	$("#add-item").clone(true,true).appendTo(".content-item");
	if($('#main-container').hasClass('side-menu-open')) getStatistics();
	$(document).scrollTop(0);
	if($(".selecteditem").length == 0)$("#notify-panel-multitag").hide();
}

function displayTag(holder, tags) {
	var nbicon=0;
for(var z=0;z< tags.length;z++){
		var tag = tags[z];
		var ret = "";
		switch(tag["type"]){
		case '1': // Progress
			var val = parseInt(tag["value"]);
			var list = JSON.parse(tag["list"]);
			ret = "<div class='template-tag-2 tagtaskdesc' >"+tag["name"].toUpperCase()+"</div>";
			ret += "<div class='template-tag-1 tagtaskval tag-dot' >"+Array(val+1).join("•")+"<span class='inact' >"+Array(list.length-val).join("•")+"</span></div><BR CLEAR=ALL />";
			if(list[val]["i"]!= null){
				tag["icon"] = list[val]["i"];
				tag["color"] = list[val]["c"];
				tag["id"]= 	tag["id"]+"-"+val;
				tag["name"] = tag["name"]+":"+list[val]["n"];
			}

			break;
		case '2' : // Choice
			var val = parseInt(tag["value"]);
			var list = JSON.parse(tag["list"]);
			ret = "<div class='template-tag-2 tagtaskdesc' >"+tag["name"].toUpperCase()+"</div>";
			ret += "<div class='tagtaskval data-value' style='color:"+list[val]["c"]+";'' >"+list[val]["n"]+"</div><BR CLEAR=ALL />";
			if(list[val]["i"]!= null){
				tag["icon"] = list[val]["i"];
				tag["color"] = list[val]["c"];		
				tag["id"]= 	tag["id"]+"-"+val;
				tag["name"] = tag["name"]+":"+list[val]["n"];	
			}
			break;
		default:
			//ret = "<div class='template-tag-2 tagtaskdesc data-name' >"+tag["name"]+" :</div><div class='tagtaskval data-value' style='color:#FF2A02;'' >"+tag["value"]+"</div>";
		}
		if(tag["icon"]!= null && tag["icon"]!=""){			
			ret +=	"<DIV class=tagicon data-tag='"+tag['name']+"' data-tagid='"+tag["id"]+"' style='background-color:"+convertHex(tag["color"],75);
			ret += ";top:"+(-105+25*(nbicon%3))+";";
			ret += (nbicon>2?"left: "+(2+Math.floor((nbicon-3)/4)*25)+"px; border-radius: 0px 8px 8px 0px;":"");
			ret += "'><I class='"+tag["icon"]+"'></I></DIV>";
			nbicon++;
			
		}
	
		holder.append(ret);
	}
	
}
function convertHex(hex,opacity){
    hex = hex.replace('#','');
    r = parseInt(hex.substring(0,2), 16);
    g = parseInt(hex.substring(2,4), 16);
    b = parseInt(hex.substring(4,6), 16);

    result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
    return result;
}
function displayDetailsTag(tag, holder) {
	tmpid= "t-"+tag["id"]+"-"+Math.round(Math.random()*1000);
	addlisten = Array();
	switch(tag["type"]){
	case '1': // Progress
		var val = parseInt(tag["value"]);
		var list = JSON.parse(tag["list"]);
		var dots = "";
		for(var k=0;k<list.length;k++){
			dots += "<SPAN class='tag-dot-c"+ ((k>val)?" dot-inact":"")+"' val='"+k+"' cid='"+tag["id"]+"' title='"+list[k]["n"]+"' '>•</span>";
		}
		ret = "<div class='tag tagtask' id='progress-"+tag["id"]+"'>"+tag["name"].toUpperCase()+" :";
		ret += dots+"<SPAN CLASS=icon id='"+tmpid+"'>X</SPAN></div><BR CLEAR=ALL />";

		break;
	case '2' : // Choice
		var val = parseInt(tag["value"]);
		var list = JSON.parse(tag["list"]);

		ret = "<div class='tag tagtask' >"+tag["name"].toUpperCase()+" : <SELECT class=tag-choice id='sel-"+tmpid+"' cid='"+tag["id"]+"'>";
		for(var k=0;k<list.length;k++){
			ret += "<option value='"+k+"' style='color:"+list[k]["c"]+"'"+ (k==val?" SELECTED":"")+" >"+list[k]["n"]+"</option>";
		}
		ret += "</SELECT><SPAN CLASS=icon id='"+tmpid+"'>X</SPAN></DIV><BR CLEAR=ALL />";
		addlisten.push('sel-'+tmpid);
		break;
	case '3' : // To do / Done
		var val = parseInt(tag["value"]);
		ret = "<div class='template-tag-2 tagtaskdesc data-name' >"+tag["name"].toUpperCase()+" :</div>";
		ret += "<div class='tagtaskval data-value' style='color:"+(val==0?"orange":"green")+";'' >"+(val==0?"TODO":"DONE")+"</div>";
		break;
	default:
		ret = "<div class=tag>"+tag['name'].toUpperCase()+"<SPAN CLASS=icon id='"+tmpid+"'>X</SPAN></div>";
	}
	
	holder.append(ret);
	if(screen == "Computer") $('.tag-dot-c').aToolTip(); 
	$('.tag-dot-c').off('click').on('click',function(){tagProgressClick(this)}); 
	for (var i = 0; i < addlisten.length; i++) $("#"+addlisten.pop()).change(function(){tagChoiceClick(this)});
	$("#"+tmpid).data("id", tag["id"]);
	$("#"+tmpid).click(function(){
		removeTagItem($(this).data("id"));
		$(this).parent().remove();
	});
}
function tagChoiceClick(item){
	jsonCall("json/update-tag-item.php", {"id":$(item).attr("cid"),"value":$(item).val()}, tagChoiceClickDone);
}
function tagChoiceClickDone(data){
	listNeedsRefresh = true;
	getDetails(currentItem);
}
function tagProgressClick(item){
	if(currentRole!=2)
		jsonCall("json/update-tag-item.php", {"id":$(item).attr("cid"),"value":$(item).attr("val")}, tagProgressClickDone);
}

function tagProgressClickDone(data){
	listNeedsRefresh = true;
	getDetails(currentItem);
	$("#progress-"+data["id"]).children(".tag-dot-c").each(function(){
		if($(this).attr("val")<=data["value"]){
			$(this).removeClass("dot-inact");
		}else{
			$(this).addClass("dot-inact");
		}
	});

}


function tagMultipleItems(idTag,idItems, add){
	if(add==1)
		jsonCall("json/add-tag-mulitple-item.php", {"id-tag":idTag,"id-items":idItems}, addTagMultipleItemsDone);
	else
		jsonCall("json/remove-tag-mulitple-item.php", {"id-tag":idTag,"id-items":idItems}, removeTagMultipleItemsDone);
}

function addTagMultipleItemsDone(data){
	if(data["STATUS"]!= undefined){
		alert("Tag ajoutés à "+data["STATUS"]+" assets");
		getItemsWithTags(selectedTags);	
	}
}

function removeTagMultipleItemsDone(data){
	if(data["STATUS"]!= undefined){
		alert("Tag supprimé à "+data["STATUS"]+" assets");
		getItemsWithTags(selectedTags);	
	}
}


function addTagItem(idTag,idItem){
	jsonCall("json/add-tag-item.php", {"id-tag":idTag,"id-item":idItem}, addTagItemDone);
}
function addTagItemDone(data){
	if(data["STATUS"]== undefined){
		displayDetailsTag(data[0],$("#details-tag-holder"));
		listNeedsRefresh=true;
	}else{
		alert("Tag déjà existant pour cet item.");
	}
}

function removeTagItem(idTag){
	jsonCall("json/remove-tag-item.php", {"id":idTag}, removeTagItemDone);
}
function removeTagItemDone(data){
	listNeedsRefresh=true;
}

function deleteComment(idComment){
	jsonCall("json/delete-comment.php", {"id":idComment}, deleteCommentDone);
}

function deleteCommentDone(data){
	$("#comment"+data["id"]).remove();
	listNeedsRefresh=true;
	
}

function likeComment(idComment){
	if($("#comment"+idComment+" .likeicon:first").attr("src")=='images/plusone_white.png'){
		jsonCall("json/like-comment.php", {"id-comment":idComment}, likeCommentDone);		
	}else{
		jsonCall("json/dislike-comment.php", {"id-comment":idComment}, dislikeCommentDone);		
	}
}

function likeCommentDone(data){
	if(data["count"]>0){
		$("#comment"+data["id"]+" .likeicon:first").attr("src",'images/minusone_white.png');
		refreshLike(data);
	}else{
		alert("Vous ne pouvez pas vous auto-congratuler.");
	}

}
function dislikeCommentDone(data){
	$("#comment"+data["id"]+" .likeicon:first").attr("src",'images/plusone_white.png');
	refreshLike(data);
}
function refreshLike(data){
	if(data["count"]>0){
		$("#comment"+data["id"]+" .ribbon:first").html("+"+data["count"]);
		$("#comment"+data["id"]+" .ribbon-names:first").html(data["names"]);
		if(data["role"]!=1){
			$("#comment"+data["id"]+" .ribbon:first").removeClass("ribbon-red");
			$("#comment"+data["id"]+" .ribbon:first").addClass("ribbon-lightred");
		}else{
			$("#comment"+data["id"]+" .ribbon:first").removeClass("ribbon-lightred");
			$("#comment"+data["id"]+" .ribbon:first").addClass("ribbon-red");			
		}
		$("#comment"+data["id"]+" .comment-title:first").addClass("ribbon-title");
		$("#comment"+data["id"]+" .ribbon-tooltip:first").show();
	}else{
		$("#comment"+data["id"]+" .ribbon:first").html("+"+data["count"]);
		$("#comment"+data["id"]+" .ribbon-title:first").removeClass("ribbon-title");
		$("#comment"+data["id"]+" .ribbon-tooltip:first").hide();
	}
}

function showEditComment(id){
	jsonCall("json/get-comment.php", {"id":id}, showEditCommentDone);
}
function showEditCommentDone(data){

	var oldComment = $('comment'+data["id_comment"]).contents();
	var editComment = $('#commentedit0').clone();
	editComment.attr('id', 'commentedit'+data["id_comment"]);

	$('#comment'+data["id_comment"]).before(editComment);
	//createDropzone(item, uploadurl, callback, data)
	createDropzone('#commentedit'+data["id_comment"] + ' .comment-add-file',"upload-attach.php?id="+data["id_comment"]);
		
	$('#commentedit'+data["id_comment"]+' .comment-edit-text').val(data["text"]);
	$('#commentedit'+data["id_comment"]+' .comment-edit-text').attr('id','commentedittxt'+data["id_comment"]);
	$('#commentedit'+data["id_comment"]+' .comment-edit-attach-holder').html(displayVignette(data, true));
	
	$('#comment'+data["id_comment"]).hide();
	createWysiwyg('commentedittxt'+data["id_comment"]);
	$('#commentedit'+data["id_comment"]).show();
}

function commentSaveAttachDone(id){

}
function commentCancelEdit(domE){
	var id= domE.attr("id").substring(11);
	$('#comment'+id).show();
	$('#commentedit'+id).remove();	
}

function commentSaveEdit(domE){
	var id= domE.attr("id").substring(11);
	var text=$('#commentedittxt'+id).data("editor").getData();	
	var deleteattach=Array();
	var attach = $('#commentedit'+id+' .comment-edit-attach-holder a').each(function(){
		var img = $(this).children(".vign");
		if(img.attr("delete")==1){
			deleteattach.push(img.attr("id").substring(10));
		}
	});
	var drop = $('#commentedit'+id+' .comment-add-file').data("drop");
	data = {"id":id, "text":text, "delete-attach":deleteattach};
	if(drop.files.length >0){
		drop["data"] = data;
		drop.callback = function(){jsonCall("json/update-comment.php", this["data"], updateCommentDone);};
		drop.processQueue();
		$("#overlay-wait").show();
	}else{
		jsonCall("json/update-comment.php", data, updateCommentDone);
	}
}

function updateCommentDone(data){
	
	jsonCall("json/send-notification.php",{"id_item":currentItem, "id_comment":data["id"], "update":1},sendNotificationDone);
	getDetails(currentItem);
}
function deleleAttach(id){
	if($("#attachedit"+id).attr("delete")==1){
		$("#attachdelete"+id).remove();
		$("#attachedit"+id).attr("delete", 0);
	}else{
		$("#attachedit"+id).before("<DIV id='attachdelete"+id+"' class=attachdelete>X</div>");
		$("#attachedit"+id).attr("delete", 1);
	}
}

function updateThumbWithAttach(idattach){
	jsonCall("json/change-thumb-with-attach.php",{"id_attach":idattach, "id_item":currentItem},updateThumbWithAttachDone);
}

function updateThumbWithAttachDone(data){
	$("#data-item-vignette").attr("src",data["vignette"]);
	listNeedsRefresh=true;
}

function displayVignette(comment, hasDelete){
	var ret = "";
	if(comment["files"].length >0){
		ret+="<div class='comment-file-holder'>"
		for(f in comment["files"]){
			var viewable = "";				
			var attachid = "";
			var upvign="";
			if(hasDelete){
				link = "javascript:deleleAttach('"+comment["files"][f]["id"]+"')";
			}else{
				if(/.+\.(jpg|jpeg|png|bmp|tif|tiff|gif)$/i.test(comment["files"][f]["file"])){
					viewable = " viewable";
					attachid = "att"+comment["files"][f]["id"];
					upvign="<span class='up-vignette fa-caret-square-o-up'></span>";
					link = "javascript:showLecteurIMG('"+attachid+"');";
				}else{
					if(/.+\.(mp4|mov|m4v|mpg|h264)$/i.test(comment["files"][f]["file"])){
						viewable = " viewable comment-file-video";
						attachid = "att"+comment["files"][f]["id"];
						link ="javascript:showLecteurIMG('"+attachid+"');";
					}else{
						link = comment["files"][f]["file"];							
					}

				}
			}
			ret += "<A HREF=\""+link+"\" "+(viewable.length>0?"":"TARGET='_blank'")+" class='comment-file-thumb"+viewable+"' id="+attachid+" filename=\""+encodeURI(comment["files"][f]["file"])+"\" title=\""+encodeURI(basename(comment["files"][f]["file"]))+"\" thumb=\""+encodeURI(comment["files"][f]["thumb"])+"\">";
			if(!(comment["files"][f]["thumb"] == "")){
				ret+=upvign+"<IMG class=vign id='"+(hasDelete?'attachedit':'attach')+comment["files"][f]["id"]+"' SRC=\""+encodeURI(comment["files"][f]["thumb"])+"\" ALT=\""+encodeURI(comment["files"][f]["file"])+"\"></A>";
			}else{
				ret+="<DIV id='"+(hasDelete?'attachedit':'attach')+comment["files"][f]["id"]+"' class='unknown-file vign'>"+basename(comment["files"][f]["file"])+"</div></A>";
			}
		}
		ret+="</div>";
	}
	return ret;
}
function displayDetailsComment(comment, showdelete) {

	var del = (comment["id_user"]==idUser||comment["status"]==1?"":"<img class='comment-icons likeicon' onClick='likeComment("+comment["id_comment"]+");' SRC='images/"+(comment["likes"]==1?"minus":"plus")+"one_white.png' width=16 title='LIKE !' >")+(showdelete?(comment["status"]==0?"<img class='comment-icons' onClick='showEditComment("+comment["id_comment"]+");' SRC='images/pencil_white.png' width=16 title='Modifier' >":"")+"<img class='comment-icons' onClick='deleteComment("+comment["id_comment"]+");' SRC='images/delete_white.png' width=16 title='Supprimer' >":"");

	var ribbon = "<a class=ribbon-tooltip "+(comment["count"]>0?"":"style='display:none;'")+"><div class='ribbon-wrapper'><div class='ribbon ribbon-"+(comment["role"]==1?'red':'lightred')+"'>+"+comment["count"]+"</div></div><span>Ce commentaire a été apprécié par : <BR><div class=ribbon-names>"+comment["names"]+"</div></span></a>";
	var ret ="";
	if(comment["status"]==0){
		ret = "<div class=comment id='comment"+comment["id_comment"]+"'>"+ribbon+"<div class='comment-title "+(comment["count"]>0?'ribbon-title':'')+"'><div class=left data-id="+comment["id_user"]+">&gt; "+comment["firstname"]+" "+comment["lastname"]+"</div><div class=right>"+comment["creationdate"]+del+"</div><div class=clear></div></div><div class='comment-content'>";
		ret += "<div class='comment-text'>"+comment["text"]+"</div>";
		ret +=displayVignette(comment, false);
		ret+="</div><div class=clear></div><div class='small-button comment-cite'>Citer / Répondre</div></div>";
	}else{
		ret="<div class='comment comment-status' id='comment"+comment["id_comment"]+"'>"+"<div class='comment-title' style='color:#BC173C;background-color:transparent;'><div class=left style='letter-spacing:2px;font-size:13px;'><B>&gt;"+comment["text"]+"</B></div><div class=right>"+comment["firstname"]+" "+comment["lastname"]+" - "+comment["creationdate"]+del+"</div><div class=clear></div></div></div>";
	}

	//var ret = "<div class='template-tag-2 tagtaskdesc data-name' >"+tag["name"]+" :</div><div class='tagtaskval data-value' style='color:#FF2A02;'' >"+tag["value"]+"</div>";
	return ret;
}

function getDetails(itemId) {
	jsonCall("json/get-details.php?id=" + itemId, "", displayDetails);
}

function saveDetailsInfo(){
	var details = {"id":currentItem, "name":$("#data-item-name").val(), "length":$("#data-item-length").val(), "description":$("#data-item-description").val(),storage:$("#data-item-storage").val()};
	jsonCall("json/save-item-info.php",details,saveDetailsInfoDone);
}
function saveDetailsInfoDone(data){
	if(data[0]==true){
		console.log("SAVED INFOS");
		$("#item-details-save-info-button").hide(200);
	}else{
		console.log("ERROR SAVING INFOS");
	}
	listNeedsRefresh=true;
}

function displayDetails(data) {
	var details = $("#item-overlay");
	// Update item details
	currentItem = data["id"];
	for (var k in data) {
		switch(k){
			case "vignette":
				m = details.find("#data-item-" + k);
				if (m.length > 0) {
					if (data[k] == null){
						m.attr("src", "images/vignette-error2.png");
					}else{
						m.attr("src", "data/vignette/"+currentProject+"/"+data["id"]+"/960/"+data[k]);
					}
				}
			break;
			case "vignette_bg":
				if (data[k] == null){
					$(".item-details").css("background-image","none");
				}else{
					$('<img/>').attr('src', 'data/vignette/'+data[k]).load(function() {
						$(".item-details").css('background-image', "url('"+$(this).attr('src')+"')");
						$(this).remove();
					});
				}
			break;
			case "comments":
				holder=$("#comments-holder");
				holder.html("");
				for(var z=0;z< data["comments"].length;z++){
					elem = displayDetailsComment(data["comments"][z], (idUser==data["comments"][z]["id_user"] || currentRole==1));
					holder.append(elem);
				}
			break;
			case "tags":
				holder=$("#details-tag-holder");
				holder.html("");
				for(var z=0;z< data["tags"].length;z++){
					displayDetailsTag(data["tags"][z], holder);
					
				}
			break;
			case "canwrite":
				changeCanWrite(data["canwrite"]);
			break; 
			case "follower":
				$("#data-item-follower").html((data["follower"].length>0?data["follower"]:"Aucun"));
			break;
			default:
				m = details.find("#data-item-" + k);
				if (m.length > 0) {
					m.val(data[k]); // update text inputs
				}
			break;
		}
	}
	$("#overlay-details").show();
	$("body").data("scroll",window.pageYOffset);
    $("body").css({'position': 'fixed', 'top': -window.pageYOffset + 'px'});
    $(".item-details").scrollTop(0);
    $("body").addClass("noscroll");
    if(screen=="Mobile"){ 
    	$(".content-pusher").hide();
    }
}

function saveNewComment(){
	var comment = {"id_item":currentItem, "text":	$("#comment-add-text").data("editor").getData(), "id_user":idUser};
	jsonCall("json/save-item-comment.php",comment,saveNewCommentDone);
}
function sendNotificationDone(data){
	console.log("Notification Done.");
}
function saveNewCommentDone(data){
	if(!(data["id"]==false) && isNumber(data["id"])){
		console.log("SAVED new comment");
		if(dropComment.files.length >0){
			console.log("Saving Files...");
			dropComment.options.url = "upload-attach.php?id="+data["id"];
			dropComment.processQueue();
			$("#overlay-wait").show();
			currentCommentUpload = data["id"];
			//dropComment.complete = Array(function(){});
/*			dropComment.on("complete", function (file) {
      			if (dropComment.getUploadingFiles().length === 0 && dropComment.getQueuedFiles().length === 0) {
        			jsonCall("json/send-notification.php",{"id_item":currentItem, "id_comment":data["id"]},sendNotificationDone);
					$("#overlay-wait").hide();					
      			}
    		});*/
		}else{
			jsonCall("json/send-notification.php",{"id_item":currentItem, "id_comment":data["id"]},sendNotificationDone);
			$("#comment-add-text").data("editor").setData("");
			toggleAddComment();
			getDetails(currentItem);
		}
		listNeedsRefresh=true;
	}else{
		alert("ERROR SAVING COMMENT");
	}}
function getUsers(text){
	jsonCall("json/get-users.php",{"id_item":currentItem, "id_project":currentProject, "text":text},getUsersDone);
}
function getUsersDone(data){
	currentUsers = data;
    if(CKEDITOR.currentInstance != null) CKEDITOR.currentInstance.execCommand('reloadSuggetionBox',currentUsers);
}

function toggleStatistics(){
	if(	$('#main-container').hasClass('side-menu-open')){
		$('#main-container').removeClass('side-menu-open');
	}else{
		getStatistics();
	}
}
function getStatistics(){
		jsonCall("json/get-stat.php",{"items":listItems},getStatisticsDone);
}


function getStatisticsDone(data){

	$("#stat-menu").empty();
	var colors=["#e5e5e5","#bdbdbd","#bd97a2","#bd7188","#bd4b6d","#bc1749","#bc1749"];
	var stat =Array();
	for(t in data){
		stat[t]=Array();
		var ids=Array();
		var sum = 0;var len = 0;
		var idtag=data[t][0][4];
		if(data[t].length == 1 && data[t][0][1]==null){
			// Simple tags
			$('<DIV style="text-align:center">').html('<DIV class=tagstat data-tag="'+t+'" data-tagid="'+idtag+'">'+t+"</DIV><DIV class=stat-subtitle>"+data[t][0][2]+" assets"+(data[t][0][3]>0?" ("+data[t][0][3]+"f.)":"")+"</DIV>").appendTo('#stat-menu');

		}else{
			for(k in data[t]){
				ids[data[t][k][1]]=data[t][k][0];
				stat[t].push( {value:data[t][k][2],color:colors[data[t][k][0]],highlight:"#FF0000",label:""+data[t][k][1], idtag:""+idtag});
				sum += parseInt(data[t][k][2]);
				len += parseInt(data[t][k][3]);
			}
	
			// Create canvas
			var elementID = 'canvas' + $('canvas').length; // Unique ID
			$('<DIV style="text-align:center">').html('<DIV class=tagstat data-tag="'+t+'" data-tagid="'+idtag+'">'+t+"</DIV><DIV class=stat-subtitle>"+sum+" assets"+(len>0?" ("+len+"f.)":"")+"</DIV>").appendTo('#stat-menu');
			$('<canvas>').attr({id: elementID}).addClass("stat-piechart").appendTo('#stat-menu');
			
			var ctx = document.getElementById(elementID).getContext("2d");
			var chart = new Chart(ctx).Doughnut(stat[t], {percentageInnerCutout:30, segmentStrokeColor : "#CCC", onAnimationComplete: function() {
		        ctx.fillText(stat[t].value + "%", 100 - 20, 100, 200);}});			
			//window.myDoughnut = chart;
			$('#'+elementID).data('chart', chart);
			$('#'+elementID).data('idtag', idtag);
			$('#'+elementID).data('nametag', t.toUpperCase());
			$('#'+elementID).data('ids', ids); // correspondance nom-value pour les etapes		
		}
	}

	$('<DIV>').addClass('stat-spacer').appendTo('#stat-menu');

	if(	!$('#main-container').hasClass('side-menu-open')) $('#main-container').addClass('side-menu-open');
}	


function jsonError(jqXHR, exception, error) {
		if (jqXHR.status === 0) {
	        return ('Not connected.\nPlease verify your network connection.');
	    } else if (jqXHR.status == 404) {
	        return ('The requested page not found. [404]');
	    } else if (jqXHR.status == 500) {
	        return ('Internal Server Error [500].');
	    } else if (exception === 'parsererror') {
	        return ('Requested JSON parse failed.');
	    } else if (exception === 'timeout') {
	        return ('Time out error.');
	    } else if (exception === 'abort') {
	        return ('Ajax request aborted.');
	    } else {
	        return ('Uncaught Error.\n' + jqXHR.responseText);
	    }
}

function jsonCall(url, data, callback) {
	data = typeof data !== 'undefined' ? data : '';
	if(data!=""){
		$.ajax({
			type:"POST",
			dataType: "json",
			url: url,
			data: data,
			error: jsonError,
			success: function(data){jsonCallBack(callback,data)}
		});		
	}else{
		$.ajax({
			type:"GET",
			dataType: "json",
			url: url,
			error: jsonError,
			success: function(data){jsonCallBack(callback,data)}
		});
	}
}
function jsonCallBack(f, data){
	if(data["ERROR"]!= undefined){
		var url = 'login.php';
		var form = $('<form action="' + url + '" method="post">' +
		  '<input type="text" name="error" value="' + data["ERROR"] + '" />' +
		  '</form>');
		$('body').append(form);
		$(form).submit();
	}else{
		f(data);
	}
	
}
