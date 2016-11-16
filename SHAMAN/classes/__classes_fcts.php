<?php

class fcts { 

		function consoleLog( $title, $data ) {
		    // print_r($data);
		    if ( is_array( $data ) )
		        $output = "<script>console.log( 'Debug Objects ".$title.": " . implode( ',', $data) . "' );</script>";
		    else
		        $output = "<script>console.log( 'Debug Objects ".$title.": " . $data . "' );</script>";

		    echo $output;
		}
} 





?>