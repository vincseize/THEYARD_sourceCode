
var idUser = 0;
var nameUser ="";
var dropComment;
var dropCommentEdit;
var currentItem = -1;
var currentCommentUpload=-1;
var listItems=Array();
var currentProject = 0;
var currentRole=0;
var selectedTags=Array();
var selectedTagsValue=Array();
var tmpAddNewTags=Array();
var tmpAddNewTagsValue=Array();
var listNeedsRefresh=false;
var projectTags=Array();
var currentUsers=Array;
var sortItems=true;

function start(){
	if(screen=="Mobile"){
			$(".item").css({"height":"130px"});
			$(".add-item > div").css({"top":"40px"});
	}

	$(window).resize(window_resize);
	window_resize();
		$("#tagmanager-add-text").focus(function(){
			$(this).val("");
		});
		
	// Changement de projet
	$("#project-select").change(function(){
		currentProject = $("#project-select").val();
		currentRole=$("#project-select :selected").attr('role');
		console.log("Change project : "+currentProject+" (role:"+currentRole+")");
		changeRole(currentRole);
		selectedTags = Array();
		selectedTagsValue = Array();
		$("#selected-filter-tags").empty();
		getItemsWithTags(selectedTags);
		getTagsFilter();
	});
	$("#data-item-name").focus(function(){
		$(this).data("oldvalue",$(this).val());
	});
	$("#data-item-name").focusout(function(){
		if($(this).val()!=$(this).data("oldvalue")){
			$(this).css("background-color","rgba(250,239,239,1)");
		}
	})

	
	$("#logotracker").click(function(event){
		if(event.altKey)
			toggleIcons();
		else
			toggleAssetDetails();
	});
	
	// Ajout de la gestion du clavier
	$(document).keyup(function(e) {
		if($("#lecteur-overlay").hasClass('lecteur-overlay-open')){
			// Lecteur ouvert
			if(e.which == 27) {
				if($("#metadata-overlay").is(':visible')){
					$("#metadata-overlay").hide();
				}else{
					closeLecteur(); // Escape = Ferme l'overlay
				}
			}
			if($("#lecteur-overlay").is(':visible')){
				if(e.which == 83 && e.altKey) LecteurDownload();//ALT+S
				if(e.which == 73) if(!$("#lecteur-toolbar-annotate").is(":visible")) ($("#metadata-overlay").is(":visible")?$("#metadata-overlay").hide():getAttachMetadata());//I informations
				if(!$("#lecteur-toolbar-annotate").is(":visible")){
					if(e.altKey){
						if(e.which == 38) {changeComment(-1); e.stopPropagation();}// up +alt : Previous comment
						if(e.which == 40) {changeComment(+1); e.stopPropagation();}// down +alt : Next comment
					}else{
						if(e.which == 187 || e.which == 38) {zoomin();e.stopPropagation();} //+
						if(e.which == 189 || e.which == 40 ) {zoomout(); e.stopPropagation();}//-
					}
				}
				if(!$("#video-overlay-content").is(":visible")){
			 		if(e.which == 37) LecteurPrev();//Left arrow
					if(e.which == 39 ) LecteurNext();//Right arrow
				}
			}
			
		}else{
            if($("#overlay-details").is(':visible')){
	          // Fenetre de détail
           	 if(e.which == 27) closeDetailsOverlay(); // Escape = Ferme l'overlay
			 if((e.target.nodeName!="INPUT" && e.target.nodeName!="TEXTAREA") || e.target.id == "search-tag-details"){
				 if(e.which == 82 && e.target.id != "search-tag-details") toggleAddComment();// R
				 if(e.which == 37) displayPrevious();//Left
				 if(e.which == 39 ) displayNext();//Right			 
			 }
			}else{	
	           	if($("#overlay-add-item").is(':visible') || $("#overlay-shortcuts").is(':visible')){
			   		// Fenetre d'ajout d'item
	           		if(e.which == 27) $(".overlay").hide(); // Escape = Ferme l'overlay				
				}else{
					if($("#overlay-tagmanager").is(':visible')){
						// Tag Manager
						if($("#overlay-tagdesigner").is(':visible')){
							if(e.which == 27) $("#overlay-tagdesigner").hide();
						}else{
		           			if(e.which == 27) $("#overlay-tagmanager").hide();
		           		}
							
					}else{
						// Interface de base
						if( (e.which==65 || e.which==73) && e.altKey){ 
							if(e.which==65) 
								$(".item").not(".add-item").not(".selecteditem").addClass("selecteditem");	// CTRL+A Select all
							if(e.which==73) 
								$(".item").not(".add-item").toggleClass("selecteditem");	// CTRL+I Invert Select
							var nb = $(".selecteditem").length;
							if(nb>0){
								$("#notify-panel-multitag").show();
								$("#count-item-selected").html(nb);
							}else{
								$("#notify-panel-multitag").hide();
							}
						}
						if(e.which==187)showAddItem(); // + pour ajout d'item
						if(e.altKey){
							if(e.which==82){getItemsWithTags(selectedTags);getTagsFilter();} // R pour rafraichir
							if(e.which==83)changeSort();// S pour changer le tri (par date / par nom)
							if(e.which==84)toggleIcons();
							if(e.which==86)toggleAssetDetails();
						}
					}
				}
			}
		}
        });

	$("#next-item").click(displayNext);
	$("#previous-item").click(displayPrevious);
	$("#delete-item").click(function(){
		deleteItem(currentItem);
	});
	$("#recycle-item").click(function(){
		recycleItem(currentItem);
	});

		    $("#item-close").click(closeDetailsOverlay);

	    $("#notify-panel-multitag .item-close").click(function (event) {
			$("#notify-panel-multitag").hide();
			$(".selecteditem").removeClass("selecteditem");
	    });

	    
	// Ouverture de la fenetre de gestion des alertes

		$("#button-notifymanager").click(function (event) {
			displayNotifyManager(currentProject);
	    }); 
	    $("#item-notifymanager-close").click(function () {
			$("#overlay-notifymanager").hide();
		});	
		
		// Ajout du respondeur pour le click sur citation
		$(".comment-cite").click(function(event){ 
			citer($(this));
		});
		
		// Ouverture de la fenetre de gestion des tags
		$("#button-shortcuts").click(function (event) {
			$("#overlay-shortcuts").show();
		});
		$("#shortcuts-close").click(function () {
			$("#overlay-shortcuts").hide();
		});	
		
		// Ouverture de la fenetre de gestion des tags
		$("#button-tagmanager").click(function (event) {
			displayTagManager(currentProject);
		});
		$("#item-tagmanager-close").click(function () {
			$("#overlay-tagmanager").hide();
		});	
		$("#tagmanager-button-add").click(function (event) {
			addTag(currentProject,$("#tagmanager-add-text").val(), $("#tagmanager-add-type option:selected").val());
		});
		        
		$("#tagmanager-button-designer").click(showTagDesigner);
		createTagDesigner();
		$("#item-tagdesigner-close").click(function () {
			$("#overlay-tagdesigner").hide();
		});
		
	// Ouverture de la fenetre de creation d'item
 		$("#add-item").click(showAddItem);
	// Fermeture de la fenetre  de creation d'item
	    $("#item-add-close").click(function () {
				$("#overlay-add-item").hide();
        });
	    $("#submit-cancel").click(function () {
				$("#overlay-add-item").hide();
        });

	// Affichage du bouton enregistrer dans la vue detaillée
	$("#data-item-length, #data-item-description, #data-item-name, #data-item-storage").on("input",changeDetailsInfo);
		
	// Enregistrement des informations de l'item (DETAILLEE)
	$("#item-details-save-info-button").click(saveDetailsInfo);
	
	// Panneau d'ajout de commentaire dans le détail d'un item
	$("#add-comment").click(toggleAddComment);
		
	// Creation de l'upload pour la vignette en vue detaillée
	Dropzone.autoDiscover = false;
	var dropVignette = new Dropzone("#data-item-vignette", { 
			url: "upload-vignette.php", 
			maxFilesize:20, 
			accept: function(file, done){this.options.url = "upload-vignette.php?id="+currentItem; done();}, 
			success: function(){getDetails(currentItem); listNeedsRefresh=true;}
		});
		dropVignette.on("error", function(file, errorMessage){ alert("ERROR:"+errorMessage)});
		dropVignette.on("totaluploadprogress", function(progress, totalBytes, totalBytesSent){
					$("#uploadprogress").html(Math.round(progress)+"%");
				});
	// Creation de l'upload pour les commentaires
	 	dropComment = new Dropzone("#comment-add-files", { 
			url: "upload-attach.php", 
			autoProcessQueue:false,
			parallelUploads:50,
			maxFiles:50,
			maxFilesize:250, 
			accept: function(file, done){done();}, 
			complete: function(){
				if (dropComment.getQueuedFiles().length == 0 && dropComment.getUploadingFiles().length==0) {
					jsonCall("json/send-notification.php",{"id_item":currentItem, "id_comment":currentCommentUpload},sendNotificationDone);
					$("#overlay-wait").hide();
					dropComment.removeAllFiles();
					$("#comment-add-text").val("");
					toggleAddComment();
					getDetails(currentItem);
				}
			},

			init: function(){
				this.on("totaluploadprogress", function(progress, totalBytes, totalBytesSent){
					$("#uploadprogress").html(Math.round(progress)+"%");
				});
				this.on("addedfile", function(file) {
					// Create the remove button
				    var removeButton = Dropzone.createElement("<button class=small-button>Remove file</button>");
				    // Capture the Dropzone instance as closure.
				    var _this = this;
				    // Listen to the click event
				    removeButton.addEventListener("click", function(e) {
						// Make sure the button click doesn't submit the form:
						e.preventDefault();
						e.stopPropagation();
						// Remove the file preview.
						_this.removeFile(file);
						// If you want to the delete the file on the server as well,
				    	// you can do the AJAX request here.
					});
					// Add the button to the file preview element.
					file.previewElement.appendChild(removeButton);
				});
			}
		});
	dropComment.on("error", function(file, errorMessage){ alert("ERROR:"+errorMessage)});	
	
    $("#details-comment-save-button").click(function () {
		var commentid = saveNewComment();
    });


	$("#submit-add").click(function(){
		createItem();
	});

	// Chargement du typeahead pour les recherches de tags
	getTagsFilter();
	prepTypeahead($('#tag-filter'),validateFilter);
	prepTypeahead($('#add-search-tag'),validateNewAddTag );
	prepTypeahead($('#add-multiple-tag'),validateMultipleAddTag );
	prepTypeahead($('#search-tag-details'),validateTagDetails );	
	$(".tagsearch-arrow").on("mousedown",function(e) {
        e.preventDefault();
		if($(this).parent().find(".tt-input").val() !=''){
	        var selectables = $(this).parent().find(".tt-selectable");
	        if (selectables.length > 0){
	             $(selectables[0]).trigger('click');    
	        }else{
		        $(this).parent().find(".tt-input").typeahead("val","");
	        }
		}
	});

	$("#metadata-close").click(function(){$("#metadata-overlay").hide()});
	$("#Lecteur-button-file").click(function(){getAttachMetadata()});
	
	if(screen == "Computer") {
		$(".icon-pref").aToolTip({fixed:true, xOffset:-80, yOffset:-60});
		$('.lecteur-button').aToolTip({fixed:true, xOffset:-80, yOffset:-60});
	}

	// Recuperation de la liste des utilisateurs du projet
	createWysiwyg("comment-add-text");


	// Ajout des clicks sur les items
	addDelegates();
			
	// Chargement des items par défauts
	getItems();	
}

function changeRole(role){
	if(role==2){
		$("#button-tagmanager").hide();
		$("#item-overlay .tagsearch").hide();
		$("#delete-item").hide();
		$("#recycle-item").hide();
		$(".add-item").hide();

	}else{
		$("#button-tagmanager").show();
		$("#item-overlay .tagsearch").show();
		$("#delete-item").show();
		$("#recycle-item").show();
		$(".add-item").show();
	}
}

function changeCanWrite(canWrite){
	if(canWrite==1){
		$("#add-comment").show();
		$("#data-item-name").prop("readonly",false);
		$("#data-item-length").prop("readonly",false);
		$("#data-item-description").prop("readonly",false);
		$("#data-item-storage").prop("readonly",false);
		$("#data-item-storage").prop("readonly",false);
		$("#details-tag-holder .tag select").attr('disabled', 'disabled');
		$("#details-tag-holder .tag .icon").hide();
		$("#Lecteur-button-annotate").hide();
	}else{
		$("#add-comment").hide();
		$("#data-item-name").prop("readonly",true);
		$("#data-item-length").prop("readonly",true);
		$("#data-item-description").prop("readonly",true);
		$("#data-item-storage").prop("readonly",true);
		$("#details-tag-holder .tag select").attr('disabled', 'disabled');
		$("#details-tag-holder .tag .icon").hide();
		$("#Lecteur-button-annotate").show();
	}
}

function addDelegates(){

	// Click sur les filtres par defaut
	$(".tagsearch").on("click", ".tt-default", function(event){
		event.stopPropagation();
		addDefaultFilter($(this).data("type"),$(this).data("val"));
		});
		
	// Suppression des filtres avec l'icone "x"
	$("#selected-filter-tags").on("click", ".icon" ,function(){
		var index = selectedTags.indexOf($(this).data("id"));
		selectedTags.splice(index,1);
		selectedTagsValue.splice(index,1);
		$(this).parent().remove();
		getItemsWithTags(selectedTags);
	});
	

	// Click sur les icones de tag pour générer un filtre
	$(".content-item").on("click", ".tagicon", function(event){
		event.stopPropagation();
		txtval = $(this).data("tag");
		id = $(this).data("tagid");
		if(event.altKey && id.indexOf("-") > -1){
			id = id.substr(0,id.indexOf("-"));
			txtval=txtval.substr(0,txtval.indexOf(":"));
		}
		addFilter(id, txtval);
		return false;
	});

	// Click sur un item pour ouverture de la fenetre de détails
 	$(".content-item").on("click",".item-spacer",function (event) {
			var id = $(this).find(".data-id").html();
	 		if(event.altKey && currentRole !=2){
					$(this).find(".item").not(".add-item").toggleClass("selecteditem");	 		
					var nb = $(".selecteditem").length;
					if(nb>0){
						$("#notify-panel-multitag").show();
						$("#count-item-selected").html(nb);
					}else{
						$("#notify-panel-multitag").hide();
					}
	 		}else{
				if(isNumber(id)) getDetails(id);
			}
        });

		// Click sur les intitulés des statistiques pour filtrer
		$("#stat-menu").on("click",".tagstat", function(event){
			addFilter( $(this).data("tagid"), $(this).data("tag"));
		});
		
		
		//Click sur les pie chart
		$("#stat-menu").on("click", ".stat-piechart" ,function(evt){
					var activePoints = $(this).data('chart').getSegmentsAtEvent(evt);           
					if(activePoints.length>0){
						var idval = $(this).data('idtag')+"-"+$(this).data('ids')[activePoints[0].label];
						var txtval= $(this).data('nametag')+" : "+activePoints[0].label;
						addFilter(idval,txtval);
					}
				}
			);
		$("#overlay-details").on("click", ".up-vignette", function(evt){
					updateThumbWithAttach($(this).parent().attr("id").substr(3));
					event.stopPropagation();
					return false;
		});
}

function addFilter(id, name){
	tmpid= "filter-"+id;
	if($("#"+tmpid).length==0){ // Check if filter exists
		html = "<div class=tag>"+name+"<span class=icon id='"+tmpid+"'>X</span></div>";
		$("#selected-filter-tags").append(html);
		$("#"+tmpid).data("id",id);
		$('#tag-filter').typeahead('val', '');
		selectedTags.push(id);
		selectedTagsValue.push(name);
		getItemsWithTags(selectedTags);
	}
}

function changeSort(){
	sortItems = !sortItems;
	$("#itemsortbutton").toggleClass("fa-sort-numeric-asc");
	$("#itemsortbutton").toggleClass("fa-sort-alpha-asc");
	$("#itemsortbutton").attr("title",(sortItems)?"Trié par date de mise à jour":"Trié par nom");
	getItemsWithTags(selectedTags);
	
}

function toggleIcons(){
	if($("#hideicon").length ==0)
		$('<style id="hideicon">.tagicon { display: none; }</style>').appendTo('body');
	else
		$("#hideicon").remove();
}
function toggleAssetDetails(){
	if($(".item").css("height") == "130px"){
		$(".item").css({"height":"250px"});
		$(".add-item > div").css({"top":"90px"});
	}else{ 
		$(".item").css({"height":"130px"});
		$(".add-item > div").css({"top":"40px"});
	}
}

// Verification que la vue details ne comporte pas de modifications non-enregistrées
function checkSave(){
	if($("#item-details-save-info-button").is(":visible")){
		if(confirm("Voulez-vous fermer sans enregistrer vos modifications ?")){
			$("#item-details-save-info-button").hide();
			return true;
		}else{
			return false;
		}
	}else{
		return true;
	}
}	



function showAddItem() {
	if(selectedTags.length>0){
		$("#selected-addnew-tags").empty();
		tmpAddNewTags = Array();
		tmpAddNewTagsValue = Array();
		for(i=0;i<selectedTags.length;i++)
				addNewAddTag(selectedTags[i],selectedTagsValue[i]);
	}
	$("#overlay-add-item").show();
	$("#add-name").focus();
}

function displayNext(){
	if(checkSave()){
		if($("#comment-add").is(':visible'))toggleAddComment();
		var i = listItems.indexOf(currentItem);
		$("#data-item-name").css("background-color","rgba(0)");
		if(i+1<listItems.length){
			getDetails(listItems[i+1]);
		}else{
			getDetails(listItems[0]);
			$(this).animate()
		}
	}
}


function displayPrevious(){
	if(checkSave()){
		if($("#comment-add").is(':visible'))toggleAddComment();
		var i = listItems.indexOf(currentItem);
		if(i>0){
			getDetails(listItems[i-1]);
		}else{
			getDetails(listItems[listItems.length-1]);
		}
	}
}

function changeDetailsInfo(){
	if(!$("#item-details-save-info-button").is(":visible")){
		$("#item-details-save-info-button").show(500);
	}
}


function validateNewAddTag(e, sugg){
	if(sugg !== undefined){
		addNewAddTag(sugg.id,sugg.value);
		$('#add-search-tag').typeahead('val', '');
	}
}

function validateMultipleAddTag(e, sugg){
	 if(sugg !== undefined){
		var selectedids = Array();
		$(".item.selecteditem .data-id").each(function(index){
			selectedids.push($(this).html());
		});
		tagMultipleItems(sugg.id, selectedids, $("#select-multiple-tag").val());
		$('#add-multiple-tag').typeahead('val', '');
	}
	
}

function addNewAddTag(id,value){
	tmpid= "addnew-"+id+"-"+Math.round(Math.random()*1000);
	html = "<div class=tag>"+value+"<span class=icon id='"+tmpid+"'>X</span></div>";
	$("#selected-addnew-tags").append(html);
	$("#"+tmpid).data("id",id)
	$("#"+tmpid).click(function(){var index = tmpAddNewTags.indexOf($(this).data("id"));tmpAddNewTags.splice(index,1); $(this).parent().remove();});
	tmpAddNewTags.push(id);
	tmpAddNewTagsValue.push(value);
}

function addDefaultFilter(type,val){
	$('#tag-filter').typeahead('val', '');
	
	typename = (type==-1?"NAME":"STATUS")
	tmpid= "filter-"+typename;
	if($("#"+tmpid).length!=0){ // Check if filter exists
		var index = selectedTagsValue.indexOf($("#"+tmpid).data("id"));
		selectedTags.splice(index,1);
		selectedTagsValue.splice(index,1);
		$("#"+tmpid).parent().remove();
	}

	html = "<div class=tag><I class='fa fa-search'></I> "+(type==-1?"NOM":"ÉTAT")+" : '<B>"+val+"</B>'<span class=icon id='"+tmpid+"'>X</span></div>";
	$("#selected-filter-tags").append(html);
	$("#"+tmpid).data("id",typename+"-"+val);

	selectedTags.push(typename+"-"+val);
	selectedTagsValue.push(typename);
	getItemsWithTags(selectedTags);
	$('#tag-filter').typeahead('close');
}


function validateFilter(e, sugg){
	 if(sugg !== undefined){
		$('#tag-filter').typeahead('val', '');
		tmpid= "filter-"+sugg.id;
		if($("#"+tmpid).length==0){ // Check if filter exists
			html = "<div class=tag>"+sugg.value+"<span class=icon id='"+tmpid+"'>X</span></div>";
			$("#selected-filter-tags").append(html);
			$("#"+tmpid).data("id",sugg.id);			
			selectedTags.push(sugg.id);
			selectedTagsValue.push(sugg.value);
			getItemsWithTags(selectedTags);
		}
				 
	 }
}

function validateTagDetails(e, sugg){
	 if(sugg !== undefined){
		addTagItem(sugg.id,currentItem);
		$('#search-tag-details').typeahead('val', '');
	}
}

function refreshTypeahead(data){
	console.log("Refresh TypeAhead");
	$('#search-tag-details').typeahead('destroy');
	$('#add-search-tag').typeahead('destroy');
	$('#tag-filter').typeahead('destroy');
	$('#add-multiple-tag').typeahead('destroy');
	window.localStorage.clear();
	var source = new Bloodhound({
		datumTokenizer: function(d) { 
		return Bloodhound.tokenizers.whitespace(d.token); 
		},
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		local: data
	});
	source.initialize();
	// Change search to allow all results on empty search
	var _search = source.index.search;
	source.index.search = function(query, sync, async) {
		if(!query || query === '') {
			return this.all();
		} else {
			return _search.call(this, query, sync, async);
    	}
  	};
	
	var f = function(data){
				return "<DIV class='tt-suggestion tt-selectable tt-default' data-type='-1' data-val='"+data.query+"'><I class='fa fa-search'></I> <B STYLE='font-size:10px'>NOM = </B>'"+data.query+"'</DIV><DIV class='tt-suggestion tt-selectable tt-default' data-type='-2' data-val='"+data.query+"'><I class='fa fa-search'></I> <B STYLE='font-size:10px'>ÉTAT = </B> '"+data.query+"'</DIV>";};
	$('#tag-filter').typeahead({minLength:0}, {limit:1000, displayKey: 'value', source:source.ttAdapter(), templates:{ notFound:f, footer:f } });
	$('#search-tag-details').typeahead({minLength:0}, {limit:1000, displayKey: 'value', source:source.ttAdapter()});
	$('#add-search-tag').typeahead({minLength:0}, {limit:1000, displayKey: 'value', source:source.ttAdapter()});
	$('#add-multiple-tag').typeahead({minLength:0}, {limit:1000, displayKey: 'value', source:source.ttAdapter()});
}


// Fonction de preparation d'un champ input pour l'utilisation du typeahead
function prepTypeahead(item, func){	
	item.bind('typeahead:select', func);
	item.on("keyup", function(e) {
	    if(e.which == 13) {
		    if($(this).typeahead("val").length){
		        e.preventDefault();
				var selectables = $(this).siblings(".tt-menu").find(".tt-cursor");
				if(selectables.length==0)
					selectables = $(this).siblings(".tt-menu").find(".tt-selectable");
				if (selectables.length > 0){
	            	 $(selectables[0]).trigger('click');    
				}else{
					 $(this).typeahead("val","");
	        	}
			}
		}
	});
	
}


function toggleAddComment() {
	if($("#comment-add").is(':visible')){
		$("#add-comment").html("+ ajouter un commentaire");
		$(".comment-cite").hide();
		$("#comment-add-text").val("");
		$("#comment-add").hide();
		$("#comment-add-text").data("editor").setData('');
	}else{
		$("#add-comment").html("Annuler / Masquer");
		$("#comment-add").show();
		$(".comment-cite").show();
		$(".comment-cite").unbind('click').click(function(event){ 
			citer($(this));
		});
		$("#comment-add-text").data("editor").focus();	
	}
}
// Fermeture de la fenetre de détails
function closeDetailsOverlay() {
	    $("body").css({'position': 'inherit', 'top':'0px'}).scrollTop($("body").data("scroll"));
		$("body").removeClass("noscroll");
	     if(screen=="Mobile"){
	     	$(".content-pusher").show();
	     }
		if($("#comment-add").is(':visible'))toggleAddComment();
		if($("#item-details-save-info-button").is(":visible")){
			if(confirm("Voulez-vous fermer sans enregistrer vos modifications ?")){
				  $("#item-details-save-info-button").hide();
				  $("#overlay-details").hide();
				  if(listNeedsRefresh){
						getItemsWithTags(selectedTags);
						listNeedsRefresh = false;
				  }
			}
		} else {
			$("#overlay-details").hide();
		  	if(listNeedsRefresh){
				getItemsWithTags(selectedTags);
				listNeedsRefresh = false;
		  	}
		}
}

function createWysiwyg(idEdit){

	$("#"+idEdit).data("editor", CKEDITOR.replace(idEdit, { suggestionsTriggerKey: { keyCode: 192 }}));

	//CKEDITOR.timestamp='AAAD';
	CKEDITOR.timestamp=Math.random().toString(36).substring(7);
	if($("#"+idEdit).data("editor"))$("#"+idEdit).data("editor").focus();

//	$("#ed-"+idEdit).focus();
}

function citer(elem){
	elem = elem.parent().children(".comment-content").first();
	//console.log(elem.parent().children(".comment-title").first().children(".left").first().html());
	var caretPos = document.getElementById("comment-add-text").selectionStart;
	var textAreaTxt = $("#comment-add-text").val();
	var attach = elem.children('div.comment-file-holder').first().html();
	var name = elem.parent().children(".comment-title").first().children(".left").first().html();
	var id = elem.parent().children(".comment-title").first().children(".left").first().data("id");
	name = "<SPAN class=usertag contenteditable='false' data-sent=0 data-id="+id+" >@ "+name.replace(/\s/g, '&nbsp;')+"</SPAN>&nbsp;";
	var txtToAdd = "<BLOCKQUOTE><B>"+name+" a écrit : </B><P>"+ (attach==undefined?"":attach+"<BR CLEAR=ALL />") + elem.children('div.comment-text').first().html()+"</P></BLOCKQUOTE><BR>";
	$("#comment-add-text").data("editor").focus();
	
	$("#comment-add-text").data("editor").insertHtml(txtToAdd, 'unfiltered_html');


}

function createDropzone(item, uploadurl){
	// Creation de l'upload pour les modification de commentairesx
	
	 	var drop = new Dropzone(item, { 
			url: uploadurl, 
			autoProcessQueue:false,
			parallelUploads:50,
			maxFiles:50,
			maxFilesize:250, 
			accept: function(file, done){done();}, 
			complete: function(){
				if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length==0) {
					this.removeAllFiles();
					this.callback(this[data]);
					$("#overlay-wait").hide();
				}
				
				
			},
			init: function(){
				this.on("totaluploadprogress", function(progress, totalBytes, totalBytesSent){
					$("#uploadprogress").html(Math.round(progress)+"%");
				});
				this.on("addedfile", function(file) {
					// Create the remove button
				    var removeButton = Dropzone.createElement("<button class=small-button>Remove file</button>");
				    // Capture the Dropzone instance as closure.
				    var _this = this;
				    // Listen to the click event
				    removeButton.addEventListener("click", function(e) {
						// Make sure the button click doesn't submit the form:
						e.preventDefault();
						e.stopPropagation();
						// Remove the file preview.
						_this.removeFile(file);
						// If you want to the delete the file on the server as well,
				    	// you can do the AJAX request here.
					});
					// Add the button to the file preview element.
					file.previewElement.appendChild(removeButton);
				});
			}
		});
		drop.callback=null;
		drop["data"]=null;
		drop.on("error", function(file, errorMessage){ alert("ERROR:"+errorMessage)});
		$(item).data("drop",drop);
}

function window_resize() {
    var width = $(window).width();
    var nb = width / 210;
    nb = Math.floor(nb) 
    var spaceleft = Math.floor((width-nb*210)/(nb*2));
    $(".item-spacer").css('margin',"0px "+spaceleft+"px 0px "+spaceleft+"px");
}


		function valueUP(val){
			var v = val.parentsUntil(".tagdesigner-value").parent();
			var prev = v.prev(".tagdesigner-value");
			if(prev.length ==1){
				v.insertBefore(prev);
			}
		}
		function valueDOWN(val){
			var v = val.parentsUntil(".tagdesigner-value").parent();
			var next = v.next(".tagdesigner-value");
			if(next.length ==1){
				v.insertAfter(next);
			}
		}
		function addValueTagDesigner(name, color, icon){
			name = typeof name !== 'undefined' ? name : "";
			color = typeof color !== 'undefined' ? color : '#000000';
			icon = typeof icon !== 'undefined' ? icon : 'fa-exclamation';
			var obj = $(".tagdesigner-value-template").clone();
			obj.find(".tagdesigner-value-name").val(name);
			obj.find(".tagvalue-color-input").val(color);
			obj.find(".tagdesigner-iconpicker-container i").removeClass().addClass("fa fa-2x "+icon);
			obj.find(".tagdesigner-iconname").val(icon);
			obj.removeClass("tagdesigner-value-template").addClass("tagdesigner-value");
			obj.find(".tagvalue-color-input").minicolors();
			obj.find('.icp-auto').iconpicker();
			obj.find('.icp-auto').on('iconpickerSelected', function(e) {
                    $(this).siblings("i").get(0).className = 'fa-2x ' +
                            e.iconpickerInstance.options.iconBaseClass + ' ' +
                            e.iconpickerInstance.getValue(e.iconpickerValue);
				});

			obj.appendTo("#tagdesigner-values");
//			setTimeout(function() {
  //          }, 1000);
		}
		
		function deleteValueTagDesigner(item){
			if($(".tagdesigner-value").length>2){
				item.parentsUntil(".tagdesigner-value").parent().remove();				
			}else{
				alert("Un tag à etat doit comporter au moins deux états.")
			}
		

		}

		function createDesignedTagError(elem, message){
			elem.addClass("tagdesigner-error");
			alert(message);
			return true;
		}

		function createDesignedTag(){
			var error=false;
			$("#overlay-tagdesigner").find("*").removeClass("tagdesigner-error");
			var tagname = $("#tagdesigner-newname").val();
			if(tagname.length<1){ error = createDesignedTagError($("#tagdesigner-newname"),"Nom du tag indéfini");}
			var tagicon = null;
			var tagiconcolor = null;
			if($("#overlay-tagdesigner input[name='icon']:checked").val()!=0){
				tagicon = "fa "+$("#tagdesigner-newicon").val();
				if(tagicon.length<1){ error = createDesignedTagError($("#tagdesigner-newicon"),"Icône indéfinie");}
				tagiconcolor = $("#tagdesigner-newiconcolor").val();
				if(!tagiconcolor.match(/^#([0-9a-f]{3}){1,2}$/i)) error = createDesignedTagError($("#tagdesigner-newiconcolor"),"Couleur incorrecte ("+tagiconcolor+")");

			}
			var tagtype=$("#overlay-tagdesigner input[name='type']:checked").val();
			var values=[];
			if(tagtype!=100){
				$("#tagdesigner-values .tagdesigner-value").each(function(index){
					var name = $(this).find(".tagdesigner-value-name").val();
					if(name.length<1){ error = createDesignedTagError($(this).find(".tagdesigner-value-name"),"Nom indéfini");}
					var color = $(this).find(".tagvalue-color-input").val();
					if(!color.match(/^#([0-9a-f]{3}){1,2}$/i)) error = createDesignedTagError($(this).find(".tagvalue-color-input"),"Couleur incorrecte ("+color+")");
					var hasicon = $(this).find(".checkicon").is(':checked'); 
					if(hasicon){
						var icon = $(this).find(".tagdesigner-iconname").val();
						if(icon.length<1){ error = createDesignedTagError($(this),"Icône indéfinie");}
						values.push({n:name, v:index, c:color, i:"fa "+icon});
					}else
						values.push({n:name, v:index, c:color});
				});
			}
			var allproject = false;
			if($("#checkallprojects").length==1) allproject = $("#checkallprojects").is(':checked');
			addTag(currentProject, tagname, tagtype , tagicon, tagiconcolor, values, allproject);
			$('#overlay-tagdesigner').hide();
		}

		function showTagDesigner(){
			$("#tagdesigner-values").empty();
			$("#tagdesigner-newname").val(($("#tagmanager-add-text").val()=="nom du tag")?"":$("#tagmanager-add-text").val());
			$('#overlay-tagdesigner input:radio[name="type"][value="'+$("#tagmanager-add-type").val()+'"]').prop('checked', true);
			$('#overlay-tagdesigner input:radio[name="icon"][value="0"]').prop('checked', true);
			$("#tagdesigner-value-container").hide();

			var def = [["TO DO","#d88228"],["WIP","#d6a570"],["REVIEW","#999999"],["CBB","#68bd68"],["FINAL","#00BB00"]];
			for(var i=0;i<5;i++)	addValueTagDesigner(def[i][0], def[i][1]);

			$("#overlay-tagdesigner").show();
        	$("#tagdesigner-newname").focus();
		}
		function createTagDesigner(){
			$("#tagdesigner-newname").change(function(){
				$(".tagnameTEMP").html(($("#tagdesigner-newname").val().length>0)?$("#tagdesigner-newname").val():"TAG");
			});
			$('#add-tag-designed').on("click",createDesignedTag);
			$(".tag-color-input").minicolors();
			$('.tagdesigner-iconname').iconpicker();
			$('.tagdesigner-iconname').on('iconpickerSelected', function(e) {
        		$(this).siblings("i").get(0).className = 'fa-2x ' + e.iconpickerInstance.options.iconBaseClass + ' ' + e.iconpickerInstance.getValue(e.iconpickerValue);
        	});        	
			$("#overlay-tagdesigner input[name='type']").click(function() {
				if($("#overlay-tagdesigner input[name='type']:checked").val() != 100)
					$("#tagdesigner-value-container").show();
				else
					$("#tagdesigner-value-container").hide();
			});
		}


(function($){
    var links = {};

    $( "link[data-fallback]" ).each( function( index, link ) {
        links[link.href] = link;
    });

    $.each( document.styleSheets, function(index, sheet) {
        if(links[sheet.href]) {
            var rules = sheet.rules ? sheet.rules : sheet.cssRules;
            if(rules != null){
            if (rules.length == 0) {
                link = $(links[sheet.href]);
                link.attr( 'href', link.attr("data-fallback") );
            }
            }
        }
    });
})(jQuery);
	   
