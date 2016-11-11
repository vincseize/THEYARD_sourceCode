<?php

class movie { 


	function mp4_to_jpeg($targetFile,$image,$W,$H,$wich_sec) {
		$ffmpeg = '/usr/bin/ffmpeg';  
		$video = $targetFile;  
		//$image = $DATASstoreFolder .$ds. "thumbMP4_".$basename;  
		$image = $image;  
		$interval = $wich_sec;  // 2 secs
		//$size = '128x72';  
		$size = $W.'x'.$H;
		$cmd = "$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1";
		exec($cmd);
	}







} 


?>