<?php
function selected_on($base,$data) {
	if($base==$data){echo 'selected';}
}

function checked_on($base,$data) {
	if($base==$data){echo 'checked';}
}

if(!function_exists('ecount')){
	function ecount($arr){
		$count = 0;
		if(is_array($arr)){
			$count = count($arr);
		}
		return $count;
	}
}

?>