
<?php


// where ffmpeg is located  
$ffmpeg = '/usr/bin/ffmpeg';  
//video dir  
$video = 'test.mp4';  
//where to save the image  
$image = 'test.jpg';  
//time to take screenshot at  
$interval = 5;  
//screenshot size  
$size = '640x480';  
//ffmpeg command  
$cmd = "$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1";

exec($cmd);




?>
