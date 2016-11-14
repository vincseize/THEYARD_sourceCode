
  var playlist=Array();
  var current = 0;
  var loading = $("<IMG SRC='images/loading.gif'>");
  var zoom=1;
  
  var videoPlayer= null;
  

  
  function LecteurAnnotate(){
	  var v=$("#video-overlay-content > VIDEO").data('jqueryVideoControls');
	  if (typeof v === "object") {
		 	 v.stopMovie();
		 	 v.deactivateKeyControl();
	  }
	  if(typeof(initAnnotation) != "function") {
	          $.getScript('js/annotation.js', function() {
					goAnnotate();
	          });
	      }else{
				goAnnotate();
	     }
  }

function goAnnotate(){
	
	if($("#video-overlay-content").is(':visible')){
		// Video file, convert to image first
		captureImageFromVideo();
		$("#video-overlay-content").hide();
	  	$("#lecteur-overlay-content").show();	
	}
	initAnnotation();
	$("#lecteur-toolbar-viewer").hide();
   	$("#lecteur-overlay-thumbs").hide();
   	$("#lecteur-toolbar-annotate").show();		   
	 $("#layertmp").show();
	 $("#layerfg").show();
	 $("body").addClass("bodypreventtouch");
}
	


	function captureImageFromVideo() {
		var video = $("#video-overlay-content > VIDEO").get(0);
        var canvas = document.createElement("canvas");
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        
		$("#layerbg").get(0).src = canvas.toDataURL();
        var w =$(".lecteur-overlay").outerWidth()-20;
		var h =$(".lecteur-overlay").outerHeight()-90;
		var fw = Math.min(canvas.width,w);
		var fh = Math.min(canvas.height,h);
		ratio = canvas.width/canvas.height;
		if(fw<canvas.width && fh<canvas.height){
			// w et h sont trop grand => On reduit en h puis en w si cela ne suffit pas
			fh = h;
			fw = Math.floor(h*ratio);
			if(fw>w){
				fw = w;
				fh = Math.floor(w/ratio);
			}
		}else if(fw<canvas.width){
			// La largeur est trop grande
			fw = w;
			fh = Math.floor(w/ratio);
		}else if(fh<canvas.height){
			// La hauteur est trop grande
			fh = h;
			fw = Math.floor(h*ratio);
		}
		posx = Math.floor((w-fw)/2);
		posy = Math.floor((h-fh)/2);
		$("#layerbg").width(fw).height(fh);
		$("#layerbg").css({"top":posy, "left":posx});
    }

  function openLecteur(){
	 $(".lecteur-overlay").addClass("lecteur-overlay-open");
 	 $(".lecteur-overlay").removeClass("lecteur-overlay-close");
 	 $(".item-details").addClass("noscroll");
 	 window.addEventListener("orientationchange",resize);
 	 if(screen=="Mobile"){
		     $("#Lecteur-button-file").hide();
		     $("#Lecteur-button-annotate").hide();
	}

  }
    
  function resize(){
	  showImage();
  }
  
  function closeLecteur(){
	 $("#layerbg").replaceWith("<IMG id='layerbg'>");
	 $("#video-overlay-content").hide();
	 $("#metadata-overlay").hide();
   	 $("#lecteur-toolbar-viewer").show();
 	 $("#lecteur-toolbar-annotate").hide();
 	 var v=$("#video-overlay-content > VIDEO").data('jqueryVideoControls');
 	 if (typeof v === "object") {
 	 	v.stopMovie();
 	 	v.deactivateKeyControl();
 	 }
	 $("#layertmp").hide();
 	 $("#layerfg").hide();
	 $(".lecteur-overlay").removeClass("lecteur-overlay-open");
 	 $(".lecteur-overlay").addClass("lecteur-overlay-close");
	 $("body").removeClass("bodypreventtouch");
  	 $(".item-details").removeClass("noscroll");
  }
  
  function showLecteurIMG(id){
	  playlist = Array();
	  var viewable = $(".comment-file-holder #"+id).parent().children(".viewable");
	  var i =0;
	  viewable.each(function(){
		  if($(this).attr("id")==id) current=i;
		  playlist.push(Array($(this).first().attr("id"), $(this).first().attr("filename"), $(this).first().attr("thumb")));
		  i++;
	  });
	  $("#lecteur-overlay-thumbs").empty();showThumbs();
	  openLecteur();
	  LecteurActive($("#lecteur-overlay-thumbs > li.active"));
  }
  
  function changeComment(move){
	  
	  var id = (move==1?playlist[playlist.length-1][0]:playlist[0][0]);// Last or first thumb
	  var ce = $(".comment-file-holder > .comment-file-thumb.viewable[id='"+id+"']"), all = $(".comment-file-holder > .comment-file-thumb.viewable[id='"+id+"'], .comment-file-holder > .comment-file-thumb.viewable");
	  var next = all.eq(all.index(ce)+move);
  	  var id = next.attr("id");
	  if(next.length==1){
		  	  playlist = Array();
		  var viewable = next.parent().children(".viewable");
		  var i =0;
		  viewable.each(function(){
		  	if($(this).attr("id")==id) current=i;
		  	playlist.push(Array($(this).first().attr("id"), $(this).first().attr("filename"), $(this).first().attr("thumb")));
		  	i++;
	  	});
	  
	  $("#lecteur-overlay-thumbs").empty();showThumbs();
	  openLecteur();
	  LecteurActive($("#lecteur-overlay-thumbs > li.active"));
	  }
		  
  }
  function LecteurActive(newActive){
  	$("#lecteur-overlay-thumbs > li.active").removeClass("active");
	newActive.addClass("active");
	current = newActive.attr("num");
	$("#Lecteur-button-download").attr("download",decodeURIComponent(basename(playlist[current][1])));
	$("#Lecteur-button-file").html(decodeURIComponent(basename(playlist[current][1])));
	$("#Lecteur-button-download").attr("href",decodeURIComponent(playlist[current][1]));
	$("#Lecteur-button-download").attr("attach",decodeURIComponent(playlist[current][0]));
	var ext = extension(playlist[current][1]);
	if(ext=="mov" || ext =="mp4" || ext=="m4v"){
		showVideo();
	}else{
		showImage();
	}
	if($("#metadata-overlay").is(":visible")){
		getAttachMetadata();
	}
  }
  function LecteurNext(){
	  $( "#Lecteur-button-next" )
	      .animate({ opacity: "1" }, 150 )
	      .animate({ opacity: "0.5" }, 250 )
	var next= $("#lecteur-overlay-thumbs > li.active").next();
	if(next.length==0){
		next=$("#lecteur-overlay-thumbs > li:first-child");
	}
	LecteurActive(next);
  }
  function LecteurPrev(){
	  $( "#Lecteur-button-prev" )
	      .animate({ opacity: "1" }, 150 )
	      .animate({ opacity: "0.5" }, 250 )
  	var prev= $("#lecteur-overlay-thumbs > li.active").prev();
  	if(prev.length==0){
  		prev=$("#lecteur-overlay-thumbs > li:last-child");
  	}
  	LecteurActive(prev);
  }

 function showVideo(){
    $("#videoerror").hide();
	$("#lecteur-overlay-content").hide();
	$("#Lecteur-button-zoomout").hide();		  
	$("#Lecteur-button-zoomin").hide();
	$("#video-overlay-content").children(".errlecture").remove();
	$("#video-overlay-content > VIDEO").attr("SRC",playlist[current][1]);
	$("#video-overlay-content > VIDEO").videoControls();
	$("#video-overlay-content > VIDEO").data('jqueryVideoControls').player.currentTime=0;
	$("#video-overlay-content > VIDEO").data('jqueryVideoControls').brightness(0);
	$("#video-overlay-content > VIDEO").data('jqueryVideoControls').activateKeyControl();
	$("#video-overlay-content > DIV > DIV.play_head").css("left",0);//.display_timecode();
	$("#video-overlay-content").show();

 }

 function playbackFailed(e){
	 console.log("PLAYBACK ERROR:"+e.target.error.code);
	 if(e.target.error.code==4){
		 $("#videoerror").show();
		 $("#video-overlay-content").hide();
	 }
	 
 } 

  function showImage(){
      $("#videoerror").hide();
	  $("#video-overlay-content").hide();
	  var w =$(".lecteur-overlay").outerWidth()-20;
      var h =$(".lecteur-overlay").outerHeight()-90;
	  $("#Lecteur-button-zoomout").show();
	  $("#Lecteur-button-zoomin").show();
	  $("#lecteur-overlay-content").show();	

	  loading.css({"position":"absolute", "top":Math.floor((h-62)/2), "left":Math.floor((w-180)/2)}).width(180).height(62);
 	  $("#lecteur-overlay-content > IMG").replaceWith(loading);

	  $('<img src="'+ playlist[current][1] +'" id=layerbg>').load(function(){		
//	console.log("WxH:"+w+"x"+h);
		//max size :
		var fw = Math.min(this.width,w);
		var fh = Math.min(this.height,h);
		ratio = this.width/this.height;
		if(fw<this.width && fh<this.height){
			// w et h sont trop grand => On reduit en h puis en w si cela ne suffit pas
			fh = h;
			fw = Math.floor(h*ratio);
			if(fw>w){
				fw = w;
				fh = Math.floor(w/ratio);
			}
		}else if(fw<this.width){
			// La largeur est trop grande
			fw = w;
			fh = Math.floor(w/ratio);
		}else if(fh<this.height){
			// La hauteur est trop grande
			fh = h;
			fw = Math.floor(h*ratio);
		}
		posx = Math.floor((w-fw)/2);
		posy = Math.floor((h-fh)/2);
		$(this).width(fw).height(fh);
		$(this).css({"top":posy, "left":posx});
		//console.log("("+posx+","+posy+") - WxH :"+fw+"x"+fh+" - ratio:"+ratio);
		$("#lecteur-overlay-content > IMG").replaceWith($(this));
	  });
	  
  }
  
  function zoomin(){
	  $( "#Lecteur-button-zoomin" )
	      .animate({ opacity: "1" }, 150 )
	      .animate({ opacity: "0.5" }, 250 )
		var w=0;var h=0;
	
		w = Math.floor($("#layerbg").width()*1.25);
		h = Math.floor($("#layerbg").height()*1.25);
		posx = Math.max(0,Math.floor(($(".lecteur-overlay").outerWidth()-20-w)/2));
		posy = Math.max(0,Math.floor(($(".lecteur-overlay").outerHeight()-90-h)/2));
		$("#layerbg").width(w).height(h).css({"top":posy, "left":posx});
  }

  function zoomout(){
	  $( "#Lecteur-button-zoomout" )
	      .animate({ opacity: "1" }, 150 )
	      .animate({ opacity: "0.5" }, 250 )
  	var w = Math.floor($("#layerbg").width()/1.25);
  	var h = Math.floor($("#layerbg").height()/1.25);
  	posx = Math.max(0,Math.floor(($(".lecteur-overlay").outerWidth()-20-w)/2));
  	posy = Math.max(0,Math.floor(($(".lecteur-overlay").outerHeight()-90-h)/2));
	$("#layerbg").width(w).height(h).css({"top":posy, "left":posx});
  }
  function makeAnnotation(){
//  	http://jsfiddle.net/9g9Nv/1/

  }
  
  function LecteurDownload(){
	  $( "#Lecteur-button-download" )
	      .animate({ opacity: "1" }, 150 )
	      .animate({ opacity: "0.5" }, 250 );
		 $("#Lecteur-button-download")[0].click()
  }
  
  function showThumbs(){
	if(playlist.length==1)
		$("#lecteur-overlay-thumbs").hide();
	else 
		$("#lecteur-overlay-thumbs").show();
		
	for(var i=0; i<playlist.length;i++){
	  	$("#lecteur-overlay-thumbs").append("<li "+(i==current?"class='active'":"")+" onclick='LecteurActive($(this))' num="+i+"><IMG SRC='"+playlist[i][2].replace(/'/g, "%27")+"' BORDER=0 class='thumb-lecteur' /></li>");
	}
  }
  
  function basenameWithoutExt(str)
  {
     var base = new String(str).substring(str.lastIndexOf('/') + 1); 
     if(base.lastIndexOf(".")!=-1) base = base.substring(0, base.lastIndexOf("."));
     return base;
  }

  function extension(str){
	return str.split('.').pop().toLowerCase();
  }