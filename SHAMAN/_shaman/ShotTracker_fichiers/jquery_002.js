function loopItOld(){
		this.currentTime = 0;
		this.play();
}

jQuery.fn.videoControls = function() {
  
  var instance = {};
  
  create = function(src) {
   		instance.refreshDisplay = function() {
			instance.wrapper_width=instance.playerj.parent().parent().width();
			instance.wrapper_height=instance.playerj.parent().parent().height();

				var w = instance.wrapper_width-20;
				var h = instance.wrapper_height-90-52;
		  		var fw = Math.min(instance.player.videoWidth,w);
				var fh = Math.min(instance.player.videoHeight,h);
				ratio = instance.player.videoWidth/instance.player.videoHeight;

				if(fw<instance.player.videoWidth && fh<instance.player.videoHeight){
					// w et h sont trop grand => On reduit en h puis en w si cela ne suffit pas
					fh = h;
					fw = Math.floor(h*ratio);
					if(fw>w){
						fw = w;
						fh = Math.floor(w/ratio);
					}
				}else if(fw<instance.player.videoWidth){
					// La largeur est trop grande
					fw = w;
					fh = Math.floor(w/ratio);
				}else if(fh<instance.player.videoHeight){
					// La hauteur est trop grande
					fh = h;
					fw = Math.floor(h*ratio);
				}
				posx = Math.floor((w-fw)/2);
				posy = Math.floor((h-fh)/2);
				instance.playerj.width(fw).height(fh);
				instance.wrapper.css("position","absolute");
				instance.wrapper.css({"top":posy, "left":posx});

	    instance.wrapper.find('.playbar').css('width', instance.playerj.width()+'px');
	    instance.wrapper.find('.video_toolbar').css('width', instance.playerj.width()+'px');
	    instance.playbar_width = parseInt(instance.wrapper.find('.playbar').css('width'), 10);
	    instance.playhead_width = parseInt(instance.wrapper.find('.play_head').css('width'), 10);

	  }; 
    // Base settings
		instance.playerj = $(src);
		//$(src).parent().attr("videoPlayer",instance);
		instance.wrapper_width=instance.playerj.parent().width();
		instance.wrapper_height=instance.playerj.parent().height();
		instance.wrapper = instance.playerj.parent();
	    instance.wrapper.find('.playbar').hide();instance.wrapper.find('.video_toolbar').hide();
		instance.player = instance.playerj[0];
		instance.src_url = instance.playerj.attr('src');
		instance.file_name = instance.src_url.split('.')[0];
		instance.frame_rate = instance.playerj.attr("data-framerate");
		instance.current_position = 0;
		instance.isLooping=false;
		instance.isFullscreen=false;

	
	
    // DOM Elements
    instance.player.addEventListener("timeupdate", display_timecode, false);
    instance.player.addEventListener("progress", loading, false);
    instance.player.addEventListener("loadedmetadata", function(){
	    if(instance.player.videoWidth==0){
	     instance.playerj.parent().prepend("<H1 class=errlecture style='color:#AAA;width:100%;line-height:200%;text-align:center;margin-top:10%;'>Fichier vidéo non supporté.<BR> Le fichier ne peut être lu. <BR>Cliquez sur 'Sauver' (ALT+S) pour télécharger.</H1>");instance.playerj.hide(); 
	     }else {
   		     instance.playerj.show();
		     instance.refreshDisplay();
			 instance.wrapper.find('.playbar').show();instance.wrapper.find('.video_toolbar').show();
		 }
	}, false);




    // Setup Controls

 	if (typeof instance.hasEvents == 'undefined'){
		instance.hasEvents = true;
    	instance.wrapper.find('.video_button.pp').click(playpause);
    	instance.wrapper.find('.video_button.rw').mousedown(function(){ instance.player.currentTime = instance.player.currentTime - 1/instance.frame_rate; return false;});
    	instance.wrapper.find('.video_button.fw').mousedown(function(){ instance.player.currentTime = instance.player.currentTime + 1/instance.frame_rate; return false;});
    	instance.wrapper.find('.video_button.loop').mousedown(function(){ loopVideo(); return false;});
    	instance.wrapper.find('.video_button.fs').mousedown(function(){ fullscreenVideo(); return false;});
    	instance.wrapper.find('.video_button.brightplus').mousedown(function(){ instance.brightness(1); return false;});    
    	instance.wrapper.find('.video_button.brightminus').mousedown(function(){ instance.brightness(-1); return false;}); 
    	instance.wrapper.find('.play_head').mousedown(function(e){ playHeadDrag(e); return false; });
    	instance.wrapper.find('.track_loaded').mousedown(function(e){ playHeadDrag(e); return false;});
    
    	// Control Bar

    	instance.wrapper.find('.track_loaded').mousedown(function(e) { instance.offset = $(e.target).offset();}).click(function(e) { position_to_time(e);});

    	activateInput(instance.wrapper.find('.timerInput'), instance.player);
	}
		// INIT	
		loopVideo();
		instance.brightness(0);
    	instance.activateKeyControl();
		return instance;
  };
  

  // Control Methods
  
  var playpause = function() {
    if (instance.playing) {
      instance.stopMovie();

    } else {
      instance.playMovie();
    }
  };

instance.bright = 1;
instance.brightness = function(i){
	switch(i){
		case 0: //reset
			instance.bright=1;
		break;
		case 1: //increase
			instance.bright +=0.1;
		break;
		case -1: //decrease
			instance.bright -=0.1;		
		break;
	}
	instance.playerj.css("-filter","brightness("+instance.bright+")");
};  
  
instance.playMovie = function() {
    instance.player.play();       
    instance.wrapper.find('.button.pp').removeClass('play').addClass('pause').text('Pause');
	instance.wrapper.find(".video_button.pp")[0].src = "images/video-Pause.png";
    instance.playing = true;
  };
  
instance.stopMovie = function() {
    instance.player.pause();
    instance.wrapper.find('.button.pp').removeClass('pause').addClass('play').text('Play');
    instance.wrapper.find(".video_button.pp")[0].src = "images/video-Play.png";
    instance.playing = false;
  };

  var loopVideo = function() {
		instance.isLooping = !instance.isLooping;
		
		$(".video_button.loop").attr("src",(instance.isLooping?"images/video-Loop-active.png":"images/video-Loop.png"))
  		// Loop Control
		if (typeof instance.player.loop == 'boolean') { // loop supported
  			instance.player.loop = instance.isLooping;
		} else { // loop property not supported
			if(instance.isLooping){
  				instance.player.addEventListener('ended', loopItOld, false);
			}else{
				instance.player.removeEventListener('ended', loopItOld, false);
			}
		}
  };
	
 var fullscreenVideo = function(){
	elem = instance.player;
	instance.isFullscreen = !instance.isFullscreen;
	if(instance.isFullscreen){
		if (elem.requestFullscreen) {
	  		elem.requestFullscreen();
		} else if (elem.mozRequestFullScreen) {
	  		elem.mozRequestFullScreen();
		} else if (elem.webkitRequestFullscreen) {
	  		elem.webkitRequestFullscreen();
		}
	}else{
		if (elem.exitFullscreen) {
	  		elem.exitFullscreen();
		} else if (elem.mozExitFullScreen) {
	  		elem.mozExitFullScreen();
		} else if (elem.webkitExitFullscreen) {
	  		elem.webkitExitFullscreen();
		}
		
	}
};
  
  var seek = function(speed) {
    if (!instance.playing) { 
      instance.stopAgain = true;
      instance.playMovie(); 
    };
    instance.player.playbackRate = speed;
    if (instance.stopAgain && speed == 1) {
      instance.stopAgain = false;
      instance.stopMovie();
    };
  };
  
  // Keyboard Control
  
instance.activateKeyControl = function() {
    $(document).off('keydown', processKeybVideo).on('keydown',processKeybVideo);
  };

instance.deactivateKeyControl = function() {
    $(document).off('keydown', processKeybVideo);
  };
  
function processKeybVideo(e) {
    if (e.keyCode == 32) { // Space Bar
      playpause();
		e.stopPropagation();
    }
    // Arrow Keys
    if (e.keyCode == 37) {
      instance.player.currentTime = instance.player.currentTime - 1/instance.frame_rate;
		if (instance.playing)instance.stopMovie();
    }
    if (e.keyCode == 39) {
      instance.player.currentTime = instance.player.currentTime + 1/instance.frame_rate;
		if (instance.playing)instance.stopMovie();
    }
    if (e.keyCode == 38) {
      instance.player.currentTime = 0;
    }
    if (e.keyCode == 66) {
      instance.brightness(1);
    }
    if (e.keyCode == 78) {
      instance.brightness(-1);
    }
    if (e.keyCode == 40) {
      playpause();
    }
	  if (e.keyCode == 76) {
      loopVideo();
    }
	  if (e.keyCode == 70) {
      fullscreenVideo();
    }

  }

  // Drag Playhead
  
  var playHead = {
   mdown:false
  };
  
  var playHeadDrag = function(e) {
   playHead.mdown = true;
   if (instance.playing) { 
     instance.startAgain = true;
     instance.stopMovie();
   };
  };
  
  $(document).mouseup(function(e) {
   if (playHead.mdown) { 
     playHead.mdown = false;
     if (instance.startAgain) {
       instance.startAgain = false;
       instance.playMovie();
     };
   }
  });
  
  $(document).mousemove(function(e) {
    if (playHead.mdown) {
      position_to_time(e);
    }
  });
  
  // Timecode Display
  
  var display_timecode = function() {
    instance.wrapper.find('.video_timecode').text(Math.round(instance.player.currentTime*instance.frame_rate )+"f. - "+formatTimer(instance.player.currentTime));
    instance.playhead = Math.round((instance.player.currentTime / instance.player.duration) * (instance.playbar_width));
    instance.wrapper.find('.play_head').css('left', instance.playhead-(instance.playhead_width/2)+'px');
  };
  
 
 



  // Timecode Control
  
   var activateInput = function(o, framerate) {
     o.keydown(function(e){
        if (e.keyCode === 13) {
          var vals = o.val().split(':');
          var pos = 0;
          pos += parseInt(vals[0], 10) * 60 * 60; // Hours
          pos += parseInt(vals[1], 10) * 60; // Minutes
          pos += parseInt(vals[2], 10); // Seconds
          pos += vals[3] * (1 / instance.frame_rate); // Frames
          instance.player.currentTime = pos;
          return false;
        } else if (e.keyCode > 47 && e.keyCode < 58 || e.keyCode > 95 && e.keyCode < 106) {
          var val = o.val().replace(/:/g,'') + String.fromCharCode(e.keyCode);
          if (val.length <= 8) {
            var newval = '';
            for (var i=0; i < val.length; i++) {
              newval += val.charAt(i);
              if (i % 2 == 1 && i < 7) newval += ':';
            }
            o.val(newval);
          }
          return false;
       } else if (e.keyCode === 186 || e.keyCode === 8 || e.keyCode === 46 || e.keyCode > 36 && e.keyCode < 41) {
         return true;
       } else {
         return false;
       }
     }).keyup(function(){return false;});
   };   
  
  // Loaders
  
  var loading = function(e) {
if (instance.player && instance.player.buffered && instance.player.buffered.length > 0 && instance.player.buffered.end && instance.player.duration) {
   if (instance.player.buffered.end(0) >= instance.player.duration) {
     instance.wrapper.find('.track_loaded').css('width', '100%');
   } else {          
     var pl = (instance.player.buffered.end(0)/instance.player.duration)*100;
     instance.wrapper.find('.track_loaded').css('width', pl+'%');
   }
}else{
	 instance.wrapper.find('.track_loaded').css('width', '100%');
}
  };
  
  // Utilities
  
  var position_to_time = function(e) {
    var pos;
    var clickx = e.clientX-instance.playerj.offset().left;
    if (clickx >= (instance.playbar_width)) { 
      pos = instance.player.duration;  
    } else if (clickx <= 0) {
      pos = Math.floor(0);  
    } else {
      pos = instance.player.duration*(clickx/instance.playbar_width);  
    }
    instance.player.currentTime = pos;
  };
  
  var formatTimer = function(position) {
   var ft_hours = Math.floor((position / (60 * 60)) %24 );
   var ft_minutes = Math.floor((position / (60) ) % 60 );
   var ft_seconds = Math.floor((position) % 60);
   var ft_frames = Math.floor((position - Math.floor(position))*instance.frame_rate);
   ft_hours += '';
   ft_hours = pad(ft_hours);
   ft_minutes += '';
   ft_minutes = pad(ft_minutes);
   ft_seconds += '';
   ft_seconds = pad(ft_seconds);
   ft_frames += '';
   ft_frames = pad(ft_frames);
   var formattedTime = ft_hours +':'+ ft_minutes +':'+ ft_seconds+':'+ft_frames;
   return formattedTime;
  };   
  
  var pad = function(val) {
    if (val < 10) { val = "0" + val; }
    return val;
  };  
  
  return $(this).each(function() {
	 var instance = $(this).data('jqueryVideoControls');
	        if (!instance) {
    			var instance = create(this);
	            $(this).data('jqueryVideoControls', instance);
	        }

  });  
	
};
