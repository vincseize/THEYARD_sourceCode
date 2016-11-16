<?php

class FCTS { 



		var $pattern_accents = array("'é'", "'è'", "'ë'", "'ê'", "'É'", "'È'", "'Ë'", "'Ê'", "'á'", "'à'", "'ä'", "'â'", "'å'", "'Á'", "'À'", "'Ä'", "'Â'", "'Å'", "'ó'", "'ò'", "'ö'", "'ô'", "'Ó'", "'Ò'", "'Ö'", "'Ô'", "'í'", "'ì'", "'ï'", "'î'", "'Í'", "'Ì'", "'Ï'", "'Î'", "'ú'", "'ù'", "'ü'", "'û'", "'Ú'", "'Ù'", "'Ü'", "'Û'", "'ý'", "'ÿ'", "'Ý'", "'ø'", "'Ø'", "'œ'", "'Œ'", "'Æ'", "'ç'", "'Ç'");


		var $pattern_accents_replace = array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'I', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'y', 'y', 'Y', 'o', 'O', 'a', 'A', 'A', 'c', 'C');






		function consoleLog( $title, $data ) {
		    // print_r($data);
		    if ( is_array( $data ) )
		        $output = "<script>console.log( 'Debug Objects ".$title.": " . implode( ',', $data) . "' );</script>";
		    else
		        $output = "<script>console.log( 'Debug Objects ".$title.": " . $data . "' );</script>";

		    echo $output;
		}


		function replace_accents( $chain ) {

			//echo $chain;

			$asset = preg_replace($this->pattern_accents, $this->pattern_accents_replace, $chain);
			//echo $asset;
			return $asset;
		}



		







} 





?>