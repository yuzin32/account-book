<?
//db가 필요없는 펑션모음
if(!function_exists('alert')){
    function alert($msg){
		echo '<script>
		alert("' . $msg . '");
		</script>';
    }
}
function cleanXSS($get_String) {
    // 일부 특수문자 이스케이프 처리
    $get_String = str_replace("&", "&amp;", $get_String);
    $get_String = str_replace("<", "&lt;", $get_String);
    $get_String = str_replace(">", "&gt;", $get_String);

    // XSS 공격 가능 요소들 대체
    $get_String = str_replace("<xmp", "<x-xmo", $get_String);
    $get_String = str_replace("javascript", "<x-javascript", $get_String);
    $get_String = str_replace("script", "<x-script", $get_String);
    $get_String = str_replace("iframe", "<x-iframe", $get_String);
    $get_String = str_replace("document", "<x-document", $get_String);
    $get_String = str_replace("vbscript", "<x-vbscript", $get_String);
    $get_String = str_replace("applet", "<x-applet", $get_String);
    $get_String = str_replace("embed", "<x-embed", $get_String);
    $get_String = str_replace("object", "<x-object", $get_String);
    $get_String = str_replace("frame", "<x-frame", $get_String);
    $get_String = str_replace("grameset", "<x-grameset", $get_String);
    $get_String = str_replace("layer", "<x-layer", $get_String);
    $get_String = str_replace("bgsound", "<x-bgsound", $get_String);
    
    // 이벤트 핸들러 제거
    $get_String = str_replace("alert", "", $get_String);
    $get_String = str_replace("onblur", "", $get_String);
    $get_String = str_replace("onchange", "", $get_String);
    $get_String = str_replace("onclick", "", $get_String);
    $get_String = str_replace("onfocus", "", $get_String);
    $get_String = str_replace("onload", "", $get_String);
    $get_String = str_replace("onmouse", "", $get_String);
    $get_String = str_replace("onscroll", "", $get_String);
    $get_String = str_replace("onsubmit", "", $get_String);
    $get_String = str_replace("onunload", "", $get_String);
    $get_String = str_replace("onerror", "", $get_String);

    // 안전한 HTML 엔티티 변환
    $get_String = htmlspecialchars($get_String, ENT_QUOTES, 'UTF-8');

    return $get_String;
}


//비밀번호 일방향 해쉬암호화 (SHA-256)
function setPwdEncrypt($str){
	if(!$str) $str = '';

	$str = trim($str);

		$pstr = hash('sha256', $str ) ;
	return $pstr;
}
?>