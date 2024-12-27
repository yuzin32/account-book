<?
if(!function_exists('array_combine')) {
	function array_combine($arr1, $arr2) {
		$out = array();
		$arr1 = array_values($arr1);
		$arr2 = array_values($arr2);
		foreach($arr1 as $key1 => $value1) $out[(string)$value1] = $arr2[$key1];
		return $out;
	}
}

if(!function_exists('array_fill_keys')) {
	function array_fill_keys($target, $value = '') {
		if(is_array($target)) {
			foreach($target as $key => $val) $filledArray[$val] = is_array($value) ? $value[$key] : $value;
		}
		return $filledArray;
	}
}

if(!function_exists('alert')){
    function alert($msg){
		echo '<script>
		alert("' . $msg . '");
		</script>';
    }
}
if(!function_exists('sec2mins')){
    function sec2mins($sec){
        if($sec!='') $sec = round($sec,0);
        else $sec = 0;
        $reValue='';
        if($sec=='') $sec = 0;
        $min = cint($sec/60);
        $hour = cint($min/60);
        $restmin = $min - $hour*60;
        
        $restsec = $sec-$min*60;
        
        if($hour>0){
            if(strlen($hour)==1) $reValue = "0".$hour."시간";
            else $reValue = $hour."시간";
        }
        if($restmin>0){
            if(strlen($restmin)==1)	$reValue .= ' 0'.$restmin."분";
            else 	$reValue .= ' '.$restmin."분";
            
        }else  $reValue .= '';
        if($restsec>0){
            if(strlen($restsec)==1)	$reValue .= ' 0'.$restsec."초";
            else 	$reValue .= ' '.$restsec."초";
        }else $reValue .= '00초';
        
        return $reValue;
    }
    
}

//한글 문자만 추출하는 역할
function remainKorean($convMsg) {
	$convMsg = conv($convMsg, "utf-8");
	$pattern = '/[\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]+/u';
	preg_match_all($pattern,$convMsg,$match);
	return conv(implode('',$match[0]),"kr");
}
// XSS(크로스 사이트 스크립팅) 공격 방지
function RemoveXSS($v)
{
	$input_data = strip_tags($v);    //turn all characters into their html equivalent
	$preview_data = htmlentities($input_data, ENT_QUOTES);
	return $preview_data;
}

function Replace($str,$str1,$str2){
	return str_replace($str1,$str2,$str);
}

Function cleanXSS($get_String){

   //$get_String = Replace($get_String, "&", "&amp;");
   $get_String = Replace($get_String, "<xmp", "<x-xmo");
   $get_String = Replace($get_String, "javascript", "<x-javascript");
   $get_String = Replace($get_String, "script", "<x-script");
   $get_String = Replace($get_String, "iframe", "<x-iframe");
   $get_String = Replace($get_String, "document", "<x-document");
   $get_String = Replace($get_String, "vbscript", "<x-vbscript");
   $get_String = Replace($get_String, "applet", "<x-applet");
   $get_String = Replace($get_String, "embed", "<x-embed");
   $get_String = Replace($get_String, "object", "<x-object");
   $get_String = Replace($get_String, "frame", "<x-frame");
   $get_String = Replace($get_String, "grameset", "<x-grameset");
   $get_String = Replace($get_String, "layer", "<x-layer");
   $get_String = Replace($get_String, "bgsound", "<x-bgsound");
   $get_String = Replace($get_String, "alert", "");
   $get_String = Replace($get_String, "onblur", "");
   $get_String = Replace($get_String, "onchange", "");
   $get_String = Replace($get_String, "onclick", "");
   $get_String = Replace($get_String, "ondblclick","",  1, -1, 1);
   $get_String = Replace($get_String, "enerror", "");
   $get_String = Replace($get_String, "onfocus", "");
   $get_String = Replace($get_String, "onload", "");
   $get_String = Replace($get_String, "onmouse", "");
   $get_String = Replace($get_String, "onscroll", "");
   $get_String = Replace($get_String, "onsubmit", "");
   $get_String = Replace($get_String, "onunload", "");
   $get_String = Replace($get_String, "onerror", "");

   $get_String = Replace($get_String, "Alert", "");
   $get_String = Replace($get_String, "onBlur", "");
   $get_String = Replace($get_String, "onChange", "");
   $get_String = Replace($get_String, "onClick", "");
   $get_String = Replace($get_String, "onDblclick","",  1, -1, 1);
   $get_String = Replace($get_String, "enError", "");
   $get_String = Replace($get_String, "onFocus", "");
   $get_String = Replace($get_String, "onLoad", "");
   $get_String = Replace($get_String, "onMouse", "");
   $get_String = Replace($get_String, "onScroll", "");
   $get_String = Replace($get_String, "onSubmit", "");
   $get_String = Replace($get_String, "onUnload", "");
   $get_String = Replace($get_String, "onError", "");
   //$get_String = Replace($get_String, "<", "&lt;");
  // $get_String = Replace($get_String, ">", "&gt;");

   return $get_String;
}

Function Check_sql($str,$level=1){
	$result_str = "";

	$SQL_Val = $str;
	//$SQL_Val = Replace($SQL_Val, ";", " ");
	$SQL_Val = Replace($SQL_Val, "@variable", " ");
	$SQL_Val = Replace($SQL_Val, "@@variable", " ");
	//$SQL_Val = Replace($SQL_Val, "+", " ");
	//$SQL_Val = Replace($SQL_Val, "print", " ");
	//$SQL_Val = Replace($SQL_Val, "set", " ");
	//$SQL_Val = Replace($SQL_Val, "%", " ");
	$SQL_Val = Replace($SQL_Val, "<script>", " ");
	$SQL_Val = Replace($SQL_Val, "<SCRIPT>", " ");
	$SQL_Val = Replace($SQL_Val, "script", " ");
	$SQL_Val = Replace($SQL_Val, "SCRIPT", " ");
	//$SQL_Val = Replace($SQL_Val, "or", " ");
	$SQL_Val = Replace($SQL_Val, "union", " ");
	//$SQL_Val = Replace($SQL_Val, "and", " ");
	//$SQL_Val = Replace($SQL_Val, "insert", " ");
	$SQL_Val = Replace($SQL_Val, "openrowset", " ");
	$SQL_Val = Replace($SQL_Val, "xp_", " ");
	$SQL_Val = Replace($SQL_Val, "decare", " ");
	$SQL_Val = Replace($SQL_Val, "select", " ");
	//$SQL_Val = Replace($SQL_Val, "update", " ");
	//$SQL_Val = Replace($SQL_Val, "delete", " ");
	$SQL_Val = Replace($SQL_Val, "shutdown", " ");
	$SQL_Val = Replace($SQL_Val, "drop", " ");
	$SQL_Val = Replace($SQL_Val, "--", " ");
	$SQL_Val = Replace($SQL_Val, "/*", " ");
	$SQL_Val = Replace($SQL_Val, "*/", " ");
	$SQL_Val = Replace($SQL_Val, "XP_", " ");
	$SQL_Val = Replace($SQL_Val, "DECLARE", " ");
	$SQL_Val = Replace($SQL_Val, "SELECT", " ");
	//$SQL_Val = Replace($SQL_Val, "UPDATE", " ");
	//$SQL_Val = Replace($SQL_Val, "DELETE", " ");
	//$SQL_Val = Replace($SQL_Val, "INSERT", " ");
	$SQL_Val = Replace($SQL_Val, "SHUTDOWN", " ");
	$SQL_Val = Replace($SQL_Val, "DROP", " ");
	if($level==0) $SQL_Val = Replace($SQL_Val, "'", "");

	$result_str = cleanXSS($SQL_Val);
	return $result_str  ;
}

function getSystemCodeName($args) {
	$args['retstr'] = '';

	if(isset($args['arrcode']) && isset($args['arrname']) && isset($args['instr'])) {
		if(is_array($args['arrcode']) && is_array($args['arrname'])) {
			$arrname = $args['arrname'];
			$arrcode = $args['arrcode'];

			if(array_search($args['instr'], $arrcode)!==false) $args['retstr'] = $arrname[array_search($args['instr'], $arrcode)];
			else $args['retstr'] = $args['instr'];
		}
	}
	return $args['retstr'];
}

function getNameByDividedString($instr, $divide_str, $inarr, $outarr) {
	if($divide_str=="") $divide_str = ",";
	$temp_outarr = array();
	if($instr!="") {
		if(is_array($inarr) && is_array($outarr)) {
			foreach( explode($divide_str, $instr) as $inkey ) {
				if(array_search($inkey, $inarr)!==false) array_push($temp_outarr, $outarr[array_search($inkey, $inarr)]);
			}
		}
	}
	return implode($divide_str, $temp_outarr);
}

function getNameByString($instr, $inarr, $outarr) {
	$outstr = "";
	if($instr!="") {
		if(is_array($inarr) && is_array($outarr)) {
			if(array_search($instr, $inarr)!==false) $outstr = $outarr[array_search($instr, $inarr)];
		}
	}
	return $outstr;
}



function getCardName($ccode){
	switch($ccode){
	case "01":
		$cname = "외환 카드";
		break;
	case "03":
		$cname = "롯데 카드 (구 동양)";
		break;
	case "04":
		$cname = "현대 카드 (구 다이너스)";
		break;
	case "06":
		$cname = "국민카드";
		break;
	case "11":
		$cname = "BC 카드";
		break;
	case "12":
		$cname = "삼성 카드";
		break;
	case "14":
		$cname = "신한 카드";
		break;
	case "15":
		$cname = "한미 카드";
		break;
	case "16":
		$cname = "NH 카드";
		break;
	case "17":
		$cname = "하나 SK 카드";
		break;
	case "21":
		$cname = "해외 비자카드";
		break;
	case "22":
		$cname = "해외 마스터카드";
		break;
	case "23":
		$cname = "해외 JCB카드";
		break;
	case "24":
		$cname = "해외 아맥스카드";
		break;
	case "25":
		$cname = "해외 다이너스카드";
		break;
	case "31":
		$cname = "주택 카드 (구 동남카드)";
		break;
	case "32":
		$cname = "광주 카드";
		break;
	case "33":
		$cname = "전북 카드";
		break;
	case "34":
		$cname = "하나 카드 (구 보람카드)";
		break;
	case "41":
		$cname = "농협(축협) 카드";
		break;
	case "42":
		$cname = "한미 카드";
		break;
	case "43":
		$cname = "씨티 카드";
		break;
	case "44":
		$cname = "평화 카드";
		break;
	case "45":
		$cname = "신세계 카드";
		break;
	case "51":
		$cname = "수협 카드";
		break;
	case "52":
		$cname = "제주 카드";
		break;
	case "53":
		$cname = "조흥 카드 (구 강원카드)";
		break;
	case "99":
		$cname = "기타 카드";
		break;
	}
	return $cname;
}

function getBankName($bcode){
	switch($bcode){
	case "02":
		$bname="한국산업은행";
		break;
	case "03":
		$bname="기업은행";
		break;
	case "04":
		$bname="국민은행";
		break;
	case "05":
		$bname="하나은행(구 외환)";
		break;
	case "06":
		$bname="국민은행(구 주택)";
		break;
	case "07":
		$bname="수협중앙회";
		break;
	case "11":
		$bname="농협중앙회";
		break;
	case "12":
		$bname="단위농협";
		break;
	case "16":
		$bname="축협중앙회";
		break;
	case "20":
		$bname="우리은행";
		break;
	case "21":
		$bname="신한은행";
		break;
	case "22":
		$bname="상업은행";
		break;
	case "23";
	$bname="SC제일은행";
	break;
	case "24";
	$bname="한일은행";
	break;
	case "25";
	$bname="서울은행";
	break;
	case "26";
	$bname="구)신한은행";
	break;
	case "27";
	$bname="한국씨티은행 (구 한미)";
	break;
	case "31";
	$bname="대구은행";
	break;
	case "32";
	$bname="부산은행";
	break;
	case "34";
	$bname="광주은행";
	break;
	case "35";
	$bname="제주은행";
	break;
	case "37";
	$bname="전북은행";
	break;
	case "38";
	$bname="강원은행";
	break;
	case "39";
	$bname="경남은행";
	break;
	case "41";
	$bname="비씨카드";
	break;
	case "45";
	$bname="새마을금고";
	break;
	case "48";
	$bname="신용협동조합중앙회";
	break;
	case "50";
	$bname="상호저축은행";
	break;
	case "53";
	$bname="한국씨티은행";
	break;
	case "54";
	$bname="홍콩상하이은행";
	break;
	case "55";
	$bname="도이치은행";
	break;
	case "56";
	$bname="ABN 암로";
	break;
	case "57";
	$bname="JP모건";
	break;
	case "59";
	$bname="미쓰비시도쿄은행";
	break;
	case "60";
	$bname="BOA(Bank of America)";
	break;
	case "64";
	$bname="산림조합";
	break;
	case "70";
	$bname="신안상호저축은행";
	break;
	case "71";
	$bname="우체국";
	break;
	case "81";
	$bname="하나은행";
	break;
	case "83";
	$bname="평화은행";
	break;
	case "87";
	$bname="신세계";
	break;
	case "88";
	$bname="신한(통합)은행";
	break;
	case "89";
	$bname="케이뱅크";
	break;
	case "90";
	$bname="카카오뱅크";
	break;
	case "D1";
	$bname="유안타증권(구 동양증권)";
	break;
	case "D2";
	$bname="현대증권";
	break;
	case "D3";
	$bname="미래에셋증권";
	break;
	case "D4";
	$bname="한국투자증권";
	break;
	case "D5";
	$bname="우리투자증권";
	break;
	case "D6";
	$bname="하이투자증권";
	break;
	case "D7";
	$bname="HMC 투자증권";
	break;
	case "D8";
	$bname="SK 증권";
	break;
	case "D9";
	$bname="대신증권";
	break;
	case "DA";
	$bname="하나대투증권";
	break;
	case "DB";
	$bname="굿모닝신한증권";
	break;
	case "DC";
	$bname="동부증권";
	break;
	case "DD";
	$bname="유진투자증권";
	break;
	case "DE";
	$bname="메리츠증권";
	break;
	case "DF";
	$bname="신영증권";
	break;
	case "DG";
	$bname="대우증권";
	break;
	case "DH";
	$bname="삼성증권";
	break;
	case "DI";
	$bname="교보증권";
	break;
	case "DJ";
	$bname="키움증권";
	break;
	case "DK";
	$bname="이트레이드";
	break;
	case "DL";
	$bname="솔로몬증권";
	break;
	case "DM";
	$bname="한화증권";
	break;
	case "DN";
	$bname="NH증권";
	break;
	case "DO";
	$bname="부국증권";
	break;
	}
	return $bname;
}

function getTrnxtypeName($str){
	if(!isset($str)) $str = "";
	$rstr = "";

	if($str=='50' || $str=='19') $rstr = '일반입금';
	elseif($str=='13') $rstr = '일반입금취소';
	elseif($str=='18') $rstr = '타행환입금';
	elseif($str=='28') $rstr = '타행환입금취소';
	elseif($str=='DT') $rstr = '카드승인(카드결재)';
	elseif($str=='CT') $rstr = '카드승인취소';
	elseif($str=='AA') $rstr = '기타현금';
	elseif($str=='BB') $rstr = '기타카드';

	return $rstr;
}

//원단위 절삭
function floorp($num){
	global $system_basic_unit;

	if($system_basic_unit=='') $system_basic_unit = 10;

	$rnum = ($num/$system_basic_unit);
	$vrnum = explode(".",$rnum);
	return $vrnum[0]*$system_basic_unit;
}

//원단위 절상
function ceilp($num){
	global $system_basic_unit;

	if($system_basic_unit=='') $system_basic_unit = 10;

	$rnum = ($num/$system_basic_unit);
	$vrnum = explode(".",$rnum);
	if(!isset($vrnum[1])) $vrnum[1] = '';
	if($vrnum[1]>0) $renum = $vrnum[0]+1;
	else $renum = $vrnum[0];
	return $renum*$system_basic_unit;
}

function getAccountstateName ($str) {
	global $vsystem_account_state,$vsystem_account_state_code;
	$cnt = ecount($vsystem_account_state_code);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vsystem_account_state_code[$i] == $str ) {
			$str = $vsystem_account_state[$i];
			break;
		}
	} return $str;
}
function getAccounttypeName ($str) {
	global $vsystem_account_type,$vsystem_account_type_code;
	$cnt = ecount($vsystem_account_type_code);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vsystem_account_type_code[$i] == $str ) {
			$str = $vsystem_account_type[$i];
			break;
		}
	} return $str;
}

/*
function getAccountStateName($accountstate){
	$rname='';
	switch ($accountstate) {
		case "신청":
			$rname= "<font color=blue>신청</font>";
			break;
		case "취소":
			$rname= "<font color=black>취소</font>";
			break;
		case "완납":
			$rname= "<font color=red>완납</font>";
			break;
		case "환불신청":
			$rname= "<font color=#8A5E00>환불신청</font>";
			break;
		case "환불완료":
			$rname= "<font color=#FF8F59>환불완료</font>";
			break;
	}
	return $rname;
}
*/
function getAstateName ($str) {
	global $vsystem_astate,$vsystem_astate_name;
	$cnt = ecount($vsystem_astate);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vsystem_astate[$i] == $str ) {
			$str = $vsystem_astate_name[$i];
			break;
		}
	} return $str;
}

function getHopelicenseName($str){
	$cstr = "";
	global $vsystem_hopelicense,$vsystem_hopelicense_name;
	$cnt = ecount($vsystem_hopelicense);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vsystem_hopelicense[$i] == $str ) {
			$cstr = $vsystem_hopelicense_name[$i];
			break;
		}
	}
	return $cstr;
}

function getKnowselectName($str){
	$cstr = "";
	global $vsystem_know_select,$vsystem_know_select_name;
	$cnt = ecount($vsystem_know_select);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vsystem_know_select[$i] == $str ) {
			$cstr = $vsystem_know_select_name[$i];
			break;
		}
	}
	if ($cstr=="") $cstr=$str;
	return $cstr;
}

function getTeachertypeName($str){
	$cstr = "";
	global $vsystem_teacher_type,$vsystem_teacher_type_name;
	$cnt = ecount($vsystem_teacher_type);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vsystem_teacher_type[$i] == $str ) {
			$cstr = $vsystem_teacher_type_name[$i];
			break;
		}
	}
	return $cstr;
}

function getBranchGroupName($str){
	$cstr = "";
	global $vSystem_branch_group,$vSystem_branch_group_name,$vSystem_branch_group_count;
	for ($i=0; $i<$vSystem_branch_group_count;$i++) {
		if ( $vSystem_branch_group[$i] == $str ) {
			$cstr = $vSystem_branch_group_name[$i];
			break;
		}
	}
	return $cstr;
}

function getTypeSelectName($str){
	$cstr = "";
	global $vsystem_course_typeselect_name,$vsystem_course_typeselect_code,$vsystem_course_typeselect_type_count;
	for ($i=0; $i<$vsystem_course_typeselect_type_count;$i++) {
		if ( $vsystem_course_typeselect_code[$i] == $str ) {
			$cstr = $vsystem_course_typeselect_name[$i];
			break;
		}
	}
	return $cstr;
}

function getClassbanName($str) {
	global $vsystem_class_count,$vsystem_class_code,$vsystem_class_name;

	$cstr = "";
	for ($i=0; $i<$vsystem_class_count;$i++) {
		if ( $vsystem_class_code[$i] == $str ) {
			$cstr = $vsystem_class_name[$i];
			break;
		}
	}
	return $cstr;
}

function getUnitName($str){
	$cstr = "";
	global $vsystem_unit_idx,$vsystem_unit_name,$vsystem_unit_count;
	for ($i=0; $i<$vsystem_unit_count;$i++) {
		if ( $vsystem_unit_idx[$i] == $str ) {
			$cstr = $vsystem_unit_name[$i];
			break;
		}
	}
	return $cstr;
}

function getCstateName ($str) {
	global $vsystem_cstate,$vsystem_cstate_name;
	$cnt = ecount($vsystem_cstate);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vsystem_cstate[$i] == $str ) {
			$str = $vsystem_cstate_name[$i];
			break;
		}
	} return $str;
}

function getCoursetake_State_Name ($str) {
	global $vsystem_coursetake_state,$vsystem_coursetake_state_name;
	$cnt = ecount($vsystem_coursetake_state);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vsystem_coursetake_state[$i] == $str ) {
			$str = $vsystem_coursetake_state_name[$i];
			break;
		}
	} return $str;
}
function getLastschoolstateName($str){
	$cstr = "";
	global $vsystem_lastschool_state_code,$vsystem_lastschool_state;
	$cnt = ecount($vsystem_lastschool_state_code);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vsystem_lastschool_state_code[$i] == $str ) {
			$cstr = $vsystem_lastschool_state[$i];
			break;
		}
	}
	return $cstr;
}
function getScholarshipName($str){
	$cstr = "";
	global $vsystem_scholarship_code,$vsystem_scholarship;
	$cnt = ecount($vsystem_scholarship_code);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vsystem_scholarship_code[$i] == $str ) {
			$cstr = $vsystem_scholarship[$i];
			break;
		}
	}
	return $cstr;
}

function getChkQualifyName($str){
	$cstr = "";
	global $vSystem_chk_qualify,$vSystem_chk_qualify_name;
	$cnt = ecount($vSystem_chk_qualify);
	for ($i=0; $i<$cnt;$i++) {
		if ( $vSystem_chk_qualify[$i] == $str ) {
			$cstr = $vSystem_chk_qualify_name[$i];
			break;
		}
	}
	return $cstr;
}
//수강정보의 등록상태
function getCoursetakeStateName($cstate){ //신청 : 1, 취소 : 2, 완료 : 3
	if($cstate==1)
		$cname = "신청";
	elseif($cstate==2)
		$cname = "취소";
	else
		$cname = "등록";

	return $cname;
}

//학위코드
function getAuthorityName($str){
	global $vsystem_authority, $vsystem_authority_code;

	$rstr = "";
	$jCount = ecount($vsystem_authority_code);
	for($i=0;$i<$jCount;$i++){
		if($vsystem_authority_code[$i]==$str){
			$rstr = $vsystem_authority[$i];
			break;
		}
	}

	return $rstr;
}


function convArr(&$item, $key=null, $ctype) {
	if(is_array($item)) array_walk($item, 'convArr', $ctype);
	else $item = conv($item, $ctype);
}

function convPost ($ctype) {
	array_walk($_POST, 'convArr', $ctype);
}

function stripLine($str){
	$strOut = str_replace(chr(10)," ",$str);
	$strOut = str_replace(chr(13)," ",$str);
	return $strOut;

}
function set_form($strIn){
	$strOut = "";
	$strOut = str_replace("\'","'",$strIn);
	$strOut = str_replace("'","`",$strOut);
	$strOut = str_replace('\"','"',$strOut);
	//$strOut = str_replace('"','',$strOut);
	//$strOut = $strIn;
	return $strOut;
}

function setOrderbyField($strIn,$orderfield,$fieldIn,$orderdesc,$valueIn){
	$strOut = "";
	$strOut = str_replace("=".$orderfield,"=".$fieldIn,$strIn);
	$strOut = str_replace("=".$orderdesc,"=".$valueIn,$strOut);
	return $strOut;
}

//인젝션 기본코드 삭제
function stripInjection($strIn){
	$strOut = "";
	$strOut = str_replace(" ","",$strIn);
	$strOut = str_replace("'","",$strOut);
	$strOut = str_replace('"','',$strOut);
	$strOut = str_replace("'or","",$strOut);
	$strOut = str_replace("'Or","",$strOut);
	$strOut = str_replace("'oR","",$strOut);
	$strOut = str_replace("'OR","",$strOut);
	return $strOut;
}

//문서발급번호
function setEncryptNumber($strIn){

	$strIn = trim($strIn);
	srand();
	$strOut = "";

	$s_key = "12345678"; //"encrypt seed key";
	$s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
	//echo "s_vector_iv = $s_vector_iv <Br>";

	### 암호화 ####
	$en_str = mcrypt_encrypt(MCRYPT_3DES, $s_key, $strIn, MCRYPT_MODE_ECB, $s_vector_iv);
	//echo "en_str = $en_str <Br>";

	//암호화된 값은 binary 데이터이므로, ascii로 처리하기 위해서는 별도의 변환이 필요하다
	$en_base64 = base64_encode($en_str);  //base64 encoding을 한 경우 => SVzBe9MN9Htf7zEtp+Rn3g==
	//echo "en_base64 = $en_base64 <Br>";

	$en_hex = bin2hex($en_base64);  //hex로 변환한 경우 => 495cc17bd30df47b5fef312da7e467de
	//echo "en_hex = $en_hex <Br>";

	$strOut = $en_hex;
	return $strOut;
}

//임시비밀번호
//난수 발생 Pool
function setPwdRand(){
	$pass_pool	= array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O', 'P', 'X', 'Y', 'Z','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

	$rand_num = array_rand($pass_pool, 8);
	for($i = 0; $i < 8; $i++){
		$new_pass	.= $pass_pool[$rand_num[$i]];
	}

	return ($new_pass);
}
function setPwdRandEasy(){//2020-08-07 안정현 비밀번호 변경 시 간단하게 전송 test
	$pass_pool	= array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

	$rand_num = array_rand($pass_pool, 6);
	for($i = 0; $i < 6; $i++){
		$new_pass	.= $pass_pool[$rand_num[$i]];
	}

	return ($new_pass);
}

//비밀번호 일방향 해쉬암호화 (SHA-256)
function setPwdEncrypt($str){

	global $objdb,$isEncyptServer;
	if(!$str) $str = '';

	$str = trim($str);

	if($isEncyptServer=='local'){
		$pstr = hash('sha256', $str ) ;
	}else{
		$sql = "select CRYPTO.HASH(6,'$str') from dual";
		$pstr = $objdb->sqlRowOne($sql);
	}
	return $pstr;
}


/**seed암호화**/

if(!function_exists('arraycopy')){
    function arraycopy($src, $srcPos, &$dest, $destPos, $length)
    {
        for ($i=$srcPos; $i < $srcPos+$length; $i++) {
            $dest[$destPos] = $src[$i];
            $destPos++;
        }
    }
    
}

if(!function_exists('xor16')){
    function xor16(&$t, $x1, $x2)
    {
        $t[0] = $x1[0] ^ $x2[0];
        $t[1] = $x1[1] ^ $x2[1];
        $t[2] = $x1[2] ^ $x2[2];
        $t[3] = $x1[3] ^ $x2[3];
        $t[4] = $x1[4] ^ $x2[4];
        $t[5] = $x1[5] ^ $x2[5];
        $t[6] = $x1[6] ^ $x2[6];
        $t[7] = $x1[7] ^ $x2[7];
        $t[8] = $x1[8] ^ $x2[8];
        $t[9] = $x1[9] ^ $x2[9];
        $t[10] = $x1[10] ^ $x2[10];
        $t[11] = $x1[11] ^ $x2[11];
        $t[12] = $x1[12] ^ $x2[12];
        $t[13] = $x1[13] ^ $x2[13];
        $t[14] = $x1[14] ^ $x2[14];
        $t[15] = $x1[15] ^ $x2[15];
    }
    
}

if(!function_exists('encryptseed')){
    function encryptseed ($str){
		global $objseed;
        $pbUserKey = array(49,-97,101,-52,57,97,49,97,-49,101,98,49,50,-48,55,50);
        $IV = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16);
        $block= 16;
        
        $planBytes = array_slice(unpack('c*',$str), 0); // 평문을 바이트 배열로 변환
        if (count($planBytes) == 0) {
            return $str;
        }
        
        $objseed->SeedRoundKey($pdwRoundKey, $pbUserKey); // 라운드키 생성
        
        $planBytesLength = ecount($planBytes);
        $start = 0;
        $end = 0;
        $cipherBlockBytes = array();
        $cbcBlockBytes = array();
        
        arraycopy($IV, 0, $cbcBlockBytes, 0, $block);
        
        $ret = null;
        
        while ($end < $planBytesLength) {
            $end = $start + $block;
            if ($end > $planBytesLength) {
                $end = $planBytesLength;
            }
            arraycopy($planBytes, $start, $cipherBlockBytes, 0, $end - $start); // 암호블록을 평문 블록으로 대치
            
            $nPad = $block - ($end - $start); // 블록내 바이트 패딩값 계산
            for ($i = ($end - $start); $i < $block; $i++) {
                $cipherBlockBytes[$i] = $nPad; // 비어있는 바이트에 패딩 추가
            }
            
            xor16($cipherBlockBytes, $cbcBlockBytes, $cipherBlockBytes); // CBC운영모드로 새로운 암호화 블록 생성
            $objseed->SeedEncrypt($cipherBlockBytes, $pdwRoundKey, $encryptCbcBlockBytes); // 암호블록을 SEED로 암호화
            arraycopy($encryptCbcBlockBytes, 0, $cbcBlockBytes, 0, $block); // 다음 블록에서 사용할 CBC블록을 SEED암호 블록으로 대치
            
            foreach($encryptCbcBlockBytes as $encryptedString) {
                $ret .= bin2hex(chr($encryptedString)); // 암호화된 16진수 스트링 추가 저장
            }
            $start = $end;
        }
        return $ret;
    }
    
}

if(!function_exists('convertMinus128')){
    function convertMinus128($bytes)
    {
        if(PHP_INT_SIZE > 4) { // 64비트가 아닌 경우 그대로 출력
            return $bytes;
        }
        
        if (is_array($bytes)) {
            $ret = array();
            foreach($bytes as $val) {
                $ret[] = (($val+128) % 256) -128;
            }
            return $ret;
        }
        return (($bytes+128) % 256) -128;
    }
    
}

if(!function_exists('pkcs5Unpad')){
    function pkcs5Unpad($text)
    {
        $pad = ord ( $text {strlen ( $text ) - 1} );
        if ($pad > strlen ( $text ))
            return $text;
            if (strspn ( $text, chr ( $pad ), strlen ( $text ) - $pad ) != $pad)
                return $text;
                return substr ( $text, 0, - 1 * $pad );
    }
    
}

if(!function_exists('decryptseed')){
    function decryptseed ($str){
		global $objseed;
        $pbUserKey = array(49,-97,101,-52,57,97,49,97,-49,101,98,49,50,-48,55,50);
        $IV = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16);
        $block= 16;
        
        $planBytes = array();
        for ($i = 0; $i < strlen($str); $i += 2) {
            $planBytes[] = convertMinus128(hexdec(substr($str, $i, 2))); // 16진수를 바이트 배열로 변환
        }
        if (count($planBytes)<$block) { //count($planBytes) == 0
            return $str;
        }
        $objseed->SeedRoundKey($pdwRoundKey, $pbUserKey);
        
        $planBytesLength = ecount($planBytes);
        $start = 0;
        $isEnd = false;
        $cipherBlockBytes = array();
        $cbcBlockBytes = array();
        $thisEE = array();
        arraycopy($IV, 0, $cbcBlockBytes, 0, $block); // CBC블록을 IV 바이트로 초기화
        
        while (!$isEnd) {
            if ($start + $block >= $planBytesLength) {
                $isEnd = true;
            }
            
            arraycopy($planBytes, $start, $cipherBlockBytes, 0, $block); // 암호블록을 평문블록으로 대치
            $objseed->SeedDecrypt($cipherBlockBytes, $pdwRoundKey, $ee); // 암호블록을 SEED로 복호화
            xor16($thisEE, $cbcBlockBytes, $ee); // CBC운영모드로 새로운 복호화 블록 생성
            $thisEE = convertMinus128($thisEE);
            
            arraycopy($thisEE, 0, $planBytes, $start, $block); // 평문블록을 생성한 복호화 블록으로 대치
            arraycopy($cipherBlockBytes, 0, $cbcBlockBytes, 0, $block); // 다음 블록에서 사용할 CBC블록을 암호 블록으로 대치
            $start += $block; // 다음블록의 시작 위치 계산
        }
        
        $rst = call_user_func_array("pack", array_merge(array("c*"), $planBytes)); // 평문블록 바이트 배열을 문자열로 변환
        return pkcs5Unpad($rst); // 패딩처리해서 반환
    }
    /**seed암호화**/
    
}




//암호화 함수 (암호화방식 : 대칭키 암호알고리즘 AES256)
function setEncrypt2($strIn){
   /*
   global $objseed;

   $strIn = trim($strIn);
   $crypttext64 =  encryptseed($strIn);
	*/
   srand();
   $key = "1ae49a1a1eb120723f07f1260b145556"; 
   $text = trim($strIn); 
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB); 
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND); 

   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv); 
   $crypttext64 = base64_encode($crypttext);

   return trim($crypttext64);
}


//복호화 함수 (암호화방식 : 대칭키 암호알고리즘 AES256)
function getDecrypt2($strIn){
   /*
   global $objseed;
   if(strlen($strIn)>14){
	   $strIn = trim($strIn);
	   $decrypttext =  decryptseed($strIn);

   }else{
		$decrypttext = $strIn;
   }
   $decrypttext = trim($decrypttext);
   */
   
   srand();
   $key = "1ae49a1a1eb120723f07f1260b145556"; 
   $value64 = base64_decode(trim($strIn)); //base64 encoding을 binary로 변환

   $crypttext = $value64; 
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB); 
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND); 
   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv); 
   
   return trim($decrypttext);
}
function setEncrypt($str){
	//return encrypt256($str,'a5sf545s45sfasasfewrewr');
	return encryptseed($str);
}
function getDecrypt($str){
	//return decrypt256($str,'a5sf545s45sfasasfewrewr');
	return decryptseed($str);
	//return $str;
}

//echo "setEncrypt = " . setEncrypt("123456-1234567") . "<br>";
//echo "getDecrypt = " . getDecrypt("76304e534b68653342754e7a714653353565644849513d3d") . "<br>";

function len2Zero($str,$len){
	$str2 = "";
	for ($len_i=0;$len_i<($len-strlen($str));$len_i++) $str2 = "0".$str2;
	return ($str2.$str);
}

function sec2min($sec){
	if($sec!='') $sec = round($sec,0);
	else $sec = 0;
	$reValue='';
	if($sec=='') $sec = 0;
	$min = cint($sec/60);
	$hour = cint($min/60);
	$restmin = $min - $hour*60;

	$restsec = $sec-$min*60;

	if($hour>0){
		if(strlen($hour)==1) $reValue = "0".$hour."시간";
		else $reValue = $hour."시간";
	}
	if($restmin>0){
		if(strlen($restmin)==1)	$reValue .= ' 0'.$restmin."분";
		else 	$reValue .= ' '.$restmin."분";

	}else  $reValue .= '';
	if($restsec>0){
		if(strlen($restsec)==1)	$reValue .= ' 0'.$restsec."초";
		else 	$reValue .= ' '.$restsec."초";
	}else $reValue .= '00초';

	return $reValue;
}
//ip주소 gps위치 추적
function getIpLocation($client_ip){
	//$LocationURL = "http://api.ipinfodb.com/v3/ip-city/?key=5ce56516ea0743df5e30cf749fe4e07d4b0e1e136cb019d9912eefa449b9a2f2&ip=$client_ip";
	/*
0: OK
1:
2: 164.125.9.2
3: KR
4: KOREA, REPUBLIC OF
5: PUSAN-JIKHALSI
6: PUSAN
7: -
8: 35.7
9: 128.033
10: +09:00

	*/
	$r = getXmlHttpBody(xmlHttpGet("api.ipinfodb.com","/v3/ip-city/?key=5ce56516ea0743df5e30cf749fe4e07d4b0e1e136cb019d9912eefa449b9a2f2&ip=$client_ip"));
	//$r = ";;;;;;;;;;;;";
	$vLocation = explode(";",$r);
	/*
	for($i=0;$i<ecount($vLocation);$i++){
		echo $i . ": " . $vLocation[$i]."<br>";
	}
	*/
	$vData = Array (Latitude=>$vLocation[8],Longitude=>$vLocation[9],City=>$vLocation[6],CountryName=>$vLocation[4],DomainIp=>$vLocation[2]);
	return $vData;
}

function alert($str){
	echo '<script language=javascript>
	alert("'. $str . '");
	history.back(-1);
	</script>';
	exit;
}

####################################################################################
//					os정보
####################################################################################
function set_os($os){
global $os_version,$os_name,$array;
$os_version="";

	for($i=0;$i<sizeof($array);$i++){
		$j=$i+1;
		//if(eregi("$os",$array[$i]) && eregi("^[0-9]{1,2}([\.]{1}[0-9]{1,2})*[a-z]{0,1}$",$array[$j])){
		if (preg_match("/$os/i", $array[$i]) && preg_match("/^[0-9]{1,2}([\\.]{1}[0-9]{1,2})*[a-z]{0,1}$/i", $array[$j])) {
		$os_version=$array[$j];
		}
	}
}

####################################################################################
//					browser정보
####################################################################################
function set_br($br){
global $br_version,$br_name,$array;
$br_version="";

	for($i=0;$i<sizeof($array);$i++){
		$j=$i+1;
		//if(eregi("$br",$array[$i]) && eregi("^[0-9]{1,2}([\.]{1}[0-9]{1,2})*[a-z]{0,1}$",$array[$j])){
		if (preg_match("/$br/i", $array[$i]) && preg_match("/^[0-9]{1,2}([\\.]{1}[0-9]{1,2})*[a-z]{0,1}$/i", $array[$j])) {
		$br_version=$array[$j];
		}
	}
}

####################################################################################
//					os+browser체크
####################################################################################
function check_agent()
{
	global $HTTP_SERVER_VARS, $os_name, $br_name;

	/*-----------------------------------------------------------------

	OS Pattern

	'keyword' => 'name',

	-----------------------------------------------------------------*/
	$OS	= array(

		/* PC */
		array('Windows CE', 'Windows CE'),
		array('Win98', 'Windows 98'),
		array('Windows 9x', 'Windows ME'),
		array('Windows me', 'Windows ME'),
		array('Windows 98', 'Windows 98'),
		array('Windows 95', 'Windows 95'),
		array('Windows NT 6', 'Windows Vista'),
		array('Windows NT 6.1', 'Windows 7'),
		array('Windows NT 5.2', 'Windows 2003/XP x64'),
		array('Windows NT 5.01', 'Windows 2000 SP1'),
		array('Windows NT 5.1', 'Windows XP'),
		array('Windows NT 5', 'Windows 2000'),
		//2024-05-10 추가 OS
		array('Windows NT 10.0', 'Windows 10'),
		array('Windows NT 11.0', 'Windows 11'),

		array('Windows NT', 'Windows NT'),
		array('Macintosh', 'Macintosh'),
		array('Mac_PowerPC', 'Mac PowerPC'),
		array('Unix', 'Unix'),
		array('bsd', 'BSD'),
		array('Linux', 'Linux'),
		array('Wget', 'Linux'),
		array('windows', 'ETC Windows'),
		array('mac', 'ETC Mac'),

		//2024-05-10 추가 OS
		array('macOS', 'macOS'),
		array('iOS', 'iOS'),
		array('Android', 'Android'),
		array('Chrome OS', 'Chrome OS'),
		array('Ubuntu', 'Ubuntu'),
		array('Fedora', 'Fedora'),
		array('CentOS', 'CentOS'),
		array('Debian', 'Debian'),
		array('FreeBSD', 'FreeBSD'),
		array('OpenBSD', 'OpenBSD'),

		/* MOBILE */
		array('PSP', 'PlayStation Portable'),
		array('Symbian', 'Symbian PDA'),
		array('Nokia', 'Nokia PDA'),
		array('LGT', 'LG Mobile'),
		array('mobile', 'ETC Mobile'),
		array('iOS', 'iOS'),
		array('Android', 'Android'),

		/* WEB ROBOT */
		array('Googlebot', 'GoogleBot'),
		array('OmniExplorer', 'OmniExplorerBot'),
		array('MJ12bot', 'majestic12Bot'),
		array('ia_archiver', 'Alexa(IA Archiver)'),
		array('Yandex', 'Yandex bot'),
		array('Inktomi', 'Inktomi Slurp'),
		array('Giga', 'GigaBot'),
		array('Jeeves', 'Jeeves bot'),
		array('Planetwide', 'IBM Planetwide bot'),
		array('bot', 'ETC Robot'),
		array('Crawler', 'ETC Robot'),
		array('library', 'ETC Robot'),
	);


	/*-----------------------------------------------------------------

	Browser Pattern

	'keyword' => 'name',

	-----------------------------------------------------------------*/
	$BW	= array(

		/* BROWSER */
		array('MSIE 2',	'InternetExplorer 2'),
		array('MSIE 3',	'InternetExplorer 3'),
		array('MSIE 4',	'InternetExplorer 4'),
		array('MSIE 5',	'InternetExplorer 5'),
		array('MSIE 6',	'InternetExplorer 6'),
		array('MSIE 7',	'InternetExplorer 7'),
		array('MSIE 8',	'InternetExplorer 8'),
		array('MSIE 9',	'InternetExplorer 9'),
		array('MSIE 10','InternetExplorer 10'),
		array('MSIE', 'ETC InternetExplorer'),
		array('Firefox', 'FireFox'),
		array('Chrome', 'Chrome'),
		array('Safari', 'Safari'),
		array('Opera', 'Opera'),
		array('Lynx', 'Lynx'),
		array('LibWWW', 'LibWWW'),
		array('Konqueror', 'Konqueror'),
		array('Internet Ninja', 'Internet Ninja'),
		array('Download Ninja', 'Download Ninja'),
		array('WebCapture', 'WebCapture'),
		array('LTH', 'LTH Browser'),
		array('Gecko', 'Gecko compatible'),
		array('Mozilla', 'Mozilla compatible'),
		array('wget', 'Wget command'),

		/* MOBILE */
		array('PSP', 'PlayStation Portable'),
		array('Symbian', 'Symbian PDA'),
		array('Nokia', 'Nokia PDA'),
		array('LGT', 'LG Mobile'),
		array('mobile', 'ETC Mobile'),
		//2024-05-10 추가 BW
		array('iPhone', 'iPhone'),
		array('iPad', 'iPad'),

		/* WEB ROBOT */
		array('Googlebot', 'GoogleBot'),
		array('OmniExplorer', 'OmniExplorerBot'),
		array('MJ12bot', 'majestic12Bot'),
		array('ia_archiver', 'Alexa(IA Archiver)'),
		array('Yandex', 'Yandex bot'),
		array('Inktomi', 'Inktomi Slurp'),
		array('Giga', 'GigaBot'),
		array('Jeeves', 'Jeeves bot'),
		array('Planetwide', 'IBM Planetwide bot'),
		array('bot', 'ETC Robot'),
		array('Crawler', 'ETC Robot'),

		//2024-05-10 추가 BW
		array('Edge', 'Microsoft Edge'),
		array('Safari (iOS)', 'Safari (iOS)'),
		array('Firefox Focus', 'Firefox Focus'),
		array('Brave', 'Brave Browser'),
		array('Samsung Internet', 'Samsung Internet'),
		array('UC Browser', 'UC Browser'),
		array('Vivaldi', 'Vivaldi'),
		array('DuckDuckGo Browser', 'DuckDuckGo Browser'),
		array('Opera Mini', 'Opera Mini'),
		array('Edge (Legacy)', 'Microsoft Edge (Legacy)'),

		array('Edge Mobile', 'Microsoft Edge Mobile'),
		array('Firefox Mobile', 'Firefox Mobile'),
		array('Chrome Mobile', 'Chrome Mobile'),
		array('Opera Mobile', 'Opera Mobile'),
		array('Samsung Internet', 'Samsung Internet'),
		array('UC Browser', 'UC Browser'),

	);

	foreach($OS as $val)
	{
		if(preg_match('/' . $val[0] . '/i', $_SERVER['HTTP_USER_AGENT']))
			//if (preg_match('/' . $val[0] . '/i', '')) {
		{
			$os_name	= $val[1];
			break;
		}
	}

	foreach($BW as $val)
	{
		if(preg_match('/' . $val[0] . '/i', $_SERVER['HTTP_USER_AGENT']))
			//if(preg_match('/$val[0]/i', $_SERVER['HTTP_USER_AGENT']))
		{
			$br_name	= $val[1];
			break;
		}
	}
	if(!isset($os_name)) $os_name = '';
	if(!isset($os_version)) $os_version = '';
	if(!isset($br_name)) $br_name = '';
	if(!isset($br_version)) $br_version = '';
}
function reFieldsName($str){
	$str = str_replace(" ","_",$str);
	$str = str_replace("-","_",$str);
	$str = str_replace("/","_",$str);
	$str = str_replace("%","_",$str);
	$str = str_replace("(","_",$str);
	$str = str_replace(")","",$str);
	$str = str_replace(":","_",$str);
	$str = str_replace("&","_",$str);
	return $str;
}
function chkChr($obj,$rule){
	$chk = 1;
	$obj = trim($obj);
	if($obj){
		//한글체크
		if(!eregi("kr",trim($rule))){
			if(preg_match("/[\xA1-\xFE\xA1-\xFE]/",$obj)) $chk = 0;
		}

		//영문체크
		if(!eregi("en",trim($rule))){
			if(preg_match("/[a-zA-Z]/",$obj)) $chk = 0;
		}

		//숫자체크
		if(!eregi("int",trim($rule))){
			if(preg_match("/[0-9]/",$obj)) $chk = 0;
		}

		//특수문자체크
		if(!eregi("special",trim($rule))){
			if(preg_match("/[!#$%^&*()?+=\/]/",$obj)) $chk = 0;
		}
		//echo $obj.":".$rule.":".$chk." // ";

		if($chk != 1) {
			//echo "'".$obj."' 값에 금지된 문자가 포함되어 있습니다.";
			return false;
			exit;
		}else{
			return true;
			exit;

		}
	}
/*

//공통 차단 목록 2009.10.07
chkChr($idx,"int");
chkChr($no,"int");
chkChr($num,"int");
chkChr($tmpl,"en");
chkChr($linkid,"int");
chkChr($linkid,"int, kr, en");
chkChr($linkid,"int, special");
*/
}

function getMonthEnglish($nmonth){

	switch($nmonth){
		case "01":
			$return = "January";
			break;
		case "02":
			$return = "February";
			break;
		case "03":
			$return = "March";
			break;
		case "04":
			$return = "April";
			break;
		case "05":
			$return = "May";
			break;
		case "06":
			$return = "June";
			break;
		case "07":
			$return = "July";
			break;
		case "08":
			$return = "August";
			break;
		case "09":
			$return = "September";
			break;
		case "10":
			$return = "October";
			break;
		case "11":
			$return = "November";
			break;
		case "12":
			$return = "December";
			break;
	}
	return $return;
}

//echo get_filesize(Yget_dir_size($_syspath));
function Yget_dir_size($dir, $debug=false){
  if (!is_dir($dir)) return false;
  if (!preg_match("`/$`", $dir)) $dir .= '/';

  $get_size = 0;
  $d = dir($dir);
  while (false !== ($entry = $d->read())) {
    if (substr($entry, 0, 1) == '.') continue;
    if (is_file($dir . $entry)) {
      $get_size += filesize($dir . $entry);
      if ($debug == true) echo $dir . $entry . ' ' . filesize($dir . $entry) . "<br>\n";
    }
    else if (is_dir($dir . $entry)){
      $get_size += Yget_dir_size($dir . $entry, $debug);
    }
    else{
      continue;
    }
  }
  $d->close();
  return $get_size;
}

function getPortname($port){
	$portname  = "";

	switch($port){
		case ":21":
			$portname = "FTP";
			//echo "|" . $port ."<br>";
			break;
		case ":22":
			$portname = "보안텔넷(SSH)";
			//echo $port."<br>";
			break;
		case ":23":
			$portname = "텔넷";
			break;
		case ":25":
			$portname = "SMTP(메일 발송)";
			break;
		case ":42":
			$portname = "호스트 네임 서버";
			break;
		case ":53":
			$portname = "도메인 메인 서버";
			break;
		case ":70":
			$portname = "고퍼(Gopher)";
			break;
		case ":79":
			$portname = "핑거(Finger)";
			break;
		case ":80":
			$portname = "웹(HTTP)";
			break;
		case ":88":
			$portname = "커베로스 보안 규격";
			break;
		case ":110":
			$portname = "POP3(메일 수신)";
			break;
		case ":118":
			$portname = "SQL 서비스";
			break;
		case ":156":
			$portname = "SQL 서비스";
			break;
		case ":137":
			$portname = "NetBIOS(파일 서버)";
			break;
		case ":138":
			$portname = "NetBIOS(파일 서버)";
			break;
		case ":139":
			$portname = "NetBIOS(파일 서버)";
			break;
		case ":161":
			$portname = "SNMP(네트워크 관리)";
			break;
		case ":220":
			$portname = "IMAP3(일부 메일 서비스)";
			break;
		case ":812":
			$portname = "버디버디";
			break;
		case ":987":
			$portname = "버디버디";
			break;
		case ":1214":
			$portname = "카자";
			break;
		case ":1521":
			$portname = "ORACLE";
			break;
		case ":1720":
			$portname = "넷미팅";
			break;
		case ":1863":
			$portname = "MSN 메신저";
			break;
		case ":3306":
			$portname = "MYSQL";
			break;
		case ":6891":
			$portname = "MSN 메신저";
			break;
		case ":6892":
			$portname = "MSN 메신저";
			break;
		case ":6893":
			$portname = "MSN 메신저";
			break;
		case ":6894":
			$portname = "MSN 메신저";
			break;
		case ":6895":
			$portname = "MSN 메신저";
			break;
		case ":6896":
			$portname = "MSN 메신저";
			break;
		case ":6897":
			$portname = "MSN 메신저";
			break;
		case ":6898":
			$portname = "MSN 메신저";
			break;
		case ":6899":
			$portname = "MSN 메신저";
			break;
		case ":6900":
			$portname = "MSN 메신저";
			break;
		case ":3389":
			$portname = "터미널 서비스(원격 데스크톱)";
			break;
		case ":4000번":
			$portname = "ICQ";
			break;
		case ":4000":
			$portname = "배틀넷(디아블로, 스타크래스트, 워크래프트)";
			break;
		case ":6112":
			$portname = "배틀넷(디아블로, 스타크래스트, 워크래프트)";
			break;
		case ":4662":
			$portname = "e동키(기본값)";
			break;
		case ":5500":
			$portname = "VNC";
			break;
		case ":5800":
			$portname = "VNC";
			break;
		case ":5900":
			$portname = "VNC";
			break;
		case ":6257":
			$portname = "윈MX(기본값)";
			break;
		case ":6699":
			$portname = "윈MX(기본값)";
			break;
		case ":6346":
			$portname = "그누텔라";
			break;
		case ":6699":
			$portname = "냅스터";
			break;
		case ":7674":
			$portname = "소리바다 2";
			break;
		case ":22321":
			$portname = "소리바다 2";
			break;
		default :
			$portname = "";
			break;
	}
	return $portname;

}

// 파일의 용량을 구한다.
//function get_filesize($file)
function get_filesize($size)
{
    //$size = @filesize(addslashes($file));
    if ($size >= 1048576*1024) {
        $size = number_format($size/(1048576*1024), 1) . "G";
	}elseif ($size >= 1048576) {
        $size = number_format($size/1048576, 1) . "M";
    } else if ($size >= 1024) {
        $size = number_format($size/1024, 1) . "K";
    } else {
        $size = number_format($size, 0) . "byte";
    }
    return $size;
}


function get_dirsize($dir)
{
    $size = 0;
    $d = dir($dir);
    while ($entry = $d->read()) {
        if ($entry != "." && $entry != "..") {
            $size += filesize("$dir/$entry");
        }
    }
    $d->close();
    return $size;
}

// 세션변수 생성
function set_session($session_name, $value)
{
    if (PHP_VERSION < '5.3.0')
        session_register($session_name);
    // PHP 버전별 차이를 없애기 위한 방법
    $session_name = $_SESSION["$session_name"] = $value;
}


// 세션변수값 얻음
function get_session($session_name)
{
	if(!isset($_SESSION[$session_name])) $_SESSION[$session_name] = '';
    return $_SESSION[$session_name];
}

function set_cookie($keys,$values, $expire=0,$domain=null){
	//if($domain==null) $domain = "."._xN_DOMAIN_;

	$server_time = 0; //time();

	if($values!='') $rvalues = base64_encode($values);
	else $rvalues = null;

	if($domain==null) setcookie("USER[" . $keys . "]",$rvalues, $server_time + $expire,"/");
	else setcookie("USER[" . $keys . "]",$rvalues, $server_time + $expire,"/",$domain);

	//setcookie("user[id]","userid",0,"/", ".abc.com");

	return $rvalues;
}

function get_cookie($keys, $expire=1,$domain=null){
	//if($domain==null) $domain = "."._xN_DOMAIN_;

	$rvalues = "";
	//global $_COOKIE;
	$server_time = 0; //time();
	$cookie_domain = $_SERVER["SERVER_NAME"];

	if(!isset($_COOKIE["USER"])) $_COOKIE["USER"] = '';
	$temp = $_COOKIE["USER"];
	//_SERVER["HTTP_COOKIE"]
	//$temp = iconv("EUC-KR","UTF-8",$temp);

	if(!is_array($temp)){
		$vtemp = explode("&",$temp);

		for($j=0;$j<ecount($vtemp);$j++){
			if(strpos(" ".$vtemp[$j],$keys)){
				//echo $vtemp[$j]."/" . $vkeys[$k] . "<br>";
				$values = str_replace($keys."=","",$vtemp[$j]);
				//$values = iconv("UTF-8","EUC-KR",$values);
				if($domain==null) setcookie("USER[".$keys."]",$values, $server_time + $expire, '/');
				else  setcookie("USER[".$keys."]",$values, $server_time + $expire, '/',$domain);
				$rvalues = base64_decode($values);
			}
		}
	}else{
		$rvalues = base64_decode($_COOKIE["USER"]["$keys"]);
	}

	//$rvalues = conv($rvalues);
	return $rvalues;
}

function convert_cookie(){
	//global $_COOKIE;
	$server_time = time();
	$cookie_domain = $_SERVER["SERVER_NAME"];
	$expire = 1;

	$skeys = "_USERID,_USEREMAIL,_USERNAME";
	$vkeys = explode(",",$skeys);

	$temp = $_COOKIE["USER"];
	//echo $temp;
	if(!is_array($temp)){
		$vtemp = explode("&",$temp);
		for($k=0;$k<ecount($vkeys);$k++){
			for($j=0;$j<ecount($vtemp);$j++){
				if(strpos(" ".$vtemp[$j],$vkeys[$k])){
					//echo $vtemp[$j]."/" . $vkeys[$k] . "<br>";
					$values = str_replace($vkeys[$k]."=","",$vtemp[$j]);
					setcookie("USER[".$vkeys[$k]."]",$values, $server_time + $expire, '/');
					$rvalues = base64_decode($values);
					break;
				}
			}
		}
	}
}

//길이만큼 자동으로 공백을 앞에 붙임
function len2blank($str,$len){
	$str2 = "";
	if(strlen($str)>$len){
		$str2 = substr($str,0,$len);
		return $str2;
	}else{
		for ($len_i=0;$len_i<($len-strlen($str));$len_i++) $str2 = " ".$str2;
		return ($str2.$str);
	}
}

function birthday2age($tbirthday) {
	$tbirthday = str_replace("-","",$tbirthday);
    $birth_year = substr($tbirthday,0,4);

    $age = date('Y') - intval($birth_year);
    return $age;
}

function jumin2age($jumin) {
	$jumin = str_replace("-","",$jumin);
    $birth_year = substr($jumin,0,2);
    $gubun = substr($jumin,6,1);

    if($gubun==1 || $gubun==2)    //1900년대(남자:1, 여자:2)
        $year_prefix = "19";
    else if($gubun==3 || $gubun==4)    //2000년대(남자:3, 여자:4)
        $year_prefix = "20";
    else if($gubun==9 || $gubun==0)    //1800년대(남자:9, 여자:0)
        $year_prefix = "18";
    else
        return 0;

    $age = date('Y') - intval($year_prefix.$birth_year);
    return $age;
}

//dateadd("d",date,31)
function dateadd($intype,$indate,$interm){

	$temp_indate = explode("-",$indate);
	if($temp_indate[1]=="01" || $temp_indate[1]=="03" || $temp_indate[1]=="05" || $temp_indate[1]=="07" || $temp_indate[1]=="08" || $temp_indate[1]=="10" || $temp_indate[1]=="12"){
		$month_day = 31;
	}elseif($temp_indate[1]=="02"){
		$month_day = 28;
	}else{
		$month_day = 30;
	}


	if ($intype=="d"){
		$times = 24*60*60*$interm;//10 : 날짜수
		$r = date("Y-m-d",strtotime($indate)+$times);
	}elseif ($intype=="m"){
		$times = $month_day*24*60*60*$interm;//10 : 월수
		$r = date("Y-m-d",strtotime($indate)+$times);
	}elseif ($intype=="y"){
		$times = 12*$month_day*24*60*60*$interm;//10 : 년수
		$r = date("Y-m-d",strtotime($indate)+$times);
	}
	return $r;
}
function datediff ($interval, $date1,$date2) {
// 두 날짜간 시간간격을 초로 얻을 수 있습니다.
// bcdiv()는 오른쪽의 인자로 왼쪽의 인자를 나누어준 값을 반환합니다.
	if($date1!='' && $date2!=''){
		$date1 = strtotime($date1);
		$date2 = strtotime($date2);
		$timedifference = $date2 - $date1;
		//echo "date1 = ". $date1 . "<br>";
		//echo "date2 = ". $date2 . "<br>";

		switch ($interval) {
			case "w":
				$retval = bcdiv($timedifference ,604800);
				break;
			case "d":
				$retval = bcdiv( $timedifference,86400);
				break;
			case "h":
				$retval = bcdiv ($timedifference,3600);
				break;
			case "n":
				$retval = bcdiv( $timedifference,60);
				break;
			case "s":
				$retval = $timedifference;
				break;
		}
	}else{
		$retval = 0;
	}
	return $retval;
}

function left($s,$l){
	return (!$s) ? '' : (preg_match('/^([\xa1-\xfe]{2}|.){'.$l.'}/s', $s, $m) ? $m[0] : $s);
	return $s;
}

function right($s,$l){
	if(strlen($s)>=$l && strlen($s)>0){
		$s = substr($s,strlen($s)-$l,strlen($s));
	}
	return $s;
}


function hanLen($indata){
	$String = $indata;
	$StringLen = strlen($String); // 원래 문자열의 길이를 구함

	for ($i3 = 0; $i3 <= $StringLen; $i3++) {
		$LastStr = substr($String, $i3, 1);
		if ( ord($LastStr) > 127 ) $i3++;
	}
	return $i3;
}


//주민등록번호 뒷자리 *로 변경
function xjumin($jumintemp){
	if (empty($jumintemp)) $jumintemp="&nbsp;";
  else{
  	$curjumin=explode("-",$jumintemp);
    $jumintemp=$curjumin[0]."-".left($curjumin[1], 1)."******";
  }
	return $jumintemp;
}

//외따옴표 자동으로 ''로 치환 (데이타베이스 저장시 에러방지)
function q2bnk($indata){
		$outdata = str_replace("'","''",$indata);
		$outdata = str_replace('"','""',$outdata);
		return $outdata;
}

function getDate2Weekday($indate,$outtype) {
	if($indate) {
		$curYear=substr($indate,0,4);
		$curMonth=substr($indate,5,2);
		$curDate=substr($indate,8,2);
	}
	if(empty($curYear)) $curYear=date("Y",mktime());
	if(empty($curMonth)) $curMonth=date("m",mktime());
	if(empty($curDate)) $curDate=date("d",mktime());
	if ($outtype=='kor')
		$varweek = Array("일","월","화","수","목","금","토");
	else
		$varweek = Array(1,2,3,4,5,6,7);
	return $varweek[date("w", mktime(0,0,0,$curMonth,$curDate,$curYear))];
}

function getMonthLastday($curYear,$curMonth){
	if($curMonth=="01" || $curMonth=="03" ||$curMonth=="05" ||$curMonth=="07" ||$curMonth=="08" ||$curMonth=="10" ||$curMonth=="12") $endDay=31;
	else if($curMonth=="04" || $curMonth=="06" ||$curMonth=="09" ||$curMonth=="11") $endDay=30;
	else {
		if(checkdate($curMonth, 29, $curYear)) $endDay=29;
		else $endDay=28;
	}
	return $endDay;
}



//글내용중 스크립트 내용이 있을 경우 자동으로 주석처리
function make_safe($string) {
	$string=preg_replace("!<script(.*?)<\/script>!is","",$string);
	$string=preg_replace("!<embed(.*?)<\/embed>!is","",$string);
	$string=preg_replace("!<object(.*?)<\/object>!is","",$string);
	$string=preg_replace("!<applet(.*?)<\/applet>!is","",$string);
	$string=preg_replace("!<iframe(.*?)<\/iframe>!is","",$string);
 	return $string;
}

//2009.11.26 버림함수
function cint($num, $d = 0)
{
	return sgn($num)*cfloor(abs($num), $d);
}

function cfloor( $val, $d )
{
	return floor($val * pow (10, $d) )/ pow (10, $d) ;
}
function sgn($x)
{
	return $x ? ($x>0 ? 1 : -1) : 0;
}

function xmlHttpPost($host, $target, $posts, $port = 80){
  if( is_array($posts))
  {
   foreach( $posts AS $name => $value )
    $postValues .= urlencode( $name ) . "=" . urlencode( $value ) . '&';

   $postValues = substr($postValues, 0, -1);
  }
  $postLength = strlen($postValues);

  $req  = "POST $target HTTP/1.1\r\n";
  $req .= "Host: $host\r\n";
  $req .= 'User-Agent: Mozilla/4.0\r\n';
  $req .= 'Accept: text/xml,application/xml,application/xhtml+xml,';
  $req .= 'text/html;q=0.9,text/plain;q=0.8,video/x-mng,image/png,';
  $req .= "image/jpeg,image/gif;q=0.2,text/css,*//*;q=0.1\r\n";
  $req .= "Content-Type: application/x-www-form-urlencoded\r\n";
  $req .= "Content-Length: " . $postLength . "\r\n";
  $req .= "Connection: close\r\n";
  $req .= "\r\n";
  $req .= $postValues;

  $socket  = fsockopen($host, $port, $errno, $errstr, 100);
  fputs($socket, $req);

  $ret = "";

  while(!feof($socket)){
   $ret .= fgets( $socket, 4096 );
  flush();
  }
  fclose( $socket );
  

  return $ret;
}

function xmlHttpGet($host, $target,$port = 80){
	$pos = strpos($target, "?");
	$postValues = substr($target, $pos + 1);

  //$postValues .= urlencode( $name ) . "=" . urlencode( $value ) . '&';
  //$postValues = substr($postValues, 0, -1);
  $postLength = strlen($postValues);

  $req  = "POST $target HTTP/1.1\r\n";
  $req .= "Host: $host\r\n";
  $req .= 'User-Agent: Mozilla/4.0\r\n';
  $req .= 'Accept: text/xml,application/xml,application/xhtml+xml,';
  $req .= 'text/html;q=0.9,text/plain;q=0.8,video/x-mng,image/png,';
  $req .= "image/jpeg,image/gif;q=0.2,text/css,*/*;q=0.1\r\n";
  $req .= "Content-Type: application/x-www-form-urlencoded\r\n";
  $req .= "Content-Length: " . $postLength . "\r\n";
  $req .= "Connection: close\r\n";
  $req .= "\r\n";
  $req .= $postValues;

  $socket  = fsockopen($host, $port, $errno, $errstr, 100);
  fputs($socket, $req);

  $ret = "";
  while(!feof($socket))
   $ret .= fgets( $socket, 4096 );

  fclose( $socket );

  return $ret;
}

function getXmlHttpBody($in_data){
	$crlf = "\r\n";
	$pos = strpos($in_data, $crlf . $crlf);
	$body = substr($in_data, $pos + 2 * strlen($crlf));
	return $body;
}

//데이타베이스 값가져오기에서 오브젝트일 씨 자동으로 calling load function
function nullbnk($indata){
	if (is_object($indata)) $indata = $indata->load();
	if(is_string($indata)) {
		if ($indata=='null') {
			$indata = "";
		}
	}

	$indata = rsconv($indata);
	return $indata;
}


function PageToExcel($filename){

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename".".xls");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: no-cache");
}
function getHeader(){
	if(empty($system_code_sender))$system_code_sender="";
	global $system_code_sender_name,$system_code_sender_email,$_http_homeurl;

	$strHead ='<html>
<head>
<title>Sheet1$</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="Excel.Sheet" name="Sheet1$">
<meta content="PHP5" name="Generator">
	';

	$strHead .= '
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Subject>Sheet1$</o:Subject>
  <o:Author>'.$system_code_sender_name. '</o:Author>
  <o:LastAuthor>' . $system_code_sender_name. '</o:LastAuthor>
  <o:Created>' . date("Y-m-d") . '</o:Created>
  <o:LastSaved>' . date("Y-m-d") . '</o:LastSaved>
  <o:Manager>' . $system_code_sender . ' ' . $system_code_sender_email . '</o:Manager>
  <o:Company>' . $_http_homeurl . '</o:Company>
  <o:Version>1.0</o:Version>
 </o:DocumentProperties>
</xml><![endif]-->
<!--[if gte mso 9]><xml>
 <x:ExcelWorkbook>
  <x:ExcelWorksheets>
   <x:ExcelWorksheet>
    <x:Name>Sheet1</x:Name>
    <x:WorksheetOptions>
     <x:DefaultRowHeight>270</x:DefaultRowHeight>
     <x:Print>
      <x:ValidPrinterInfo/>
      <x:PaperSizeIndex>9</x:PaperSizeIndex>
      <x:HorizontalResolution>-3</x:HorizontalResolution>
      <x:VerticalResolution>0</x:VerticalResolution>
     </x:Print>
     <x:Selected/>
     <x:FreezePanes/>
     <x:FrozenNoSplit/>
     <x:SplitHorizontal>2</x:SplitHorizontal>
     <x:TopRowBottomPane>2</x:TopRowBottomPane>
     <x:ActivePane>2</x:ActivePane>
     <x:Panes>
      <x:Pane>
       <x:Number>3</x:Number>
      </x:Pane>
      <x:Pane>
       <x:Number>2</x:Number>
       <x:ActiveRow>4</x:ActiveRow>
       <x:ActiveCol>1</x:ActiveCol>
      </x:Pane>
     </x:Panes>
     <x:ProtectContents>False</x:ProtectContents>
     <x:ProtectObjects>False</x:ProtectObjects>
     <x:ProtectScenarios>False</x:ProtectScenarios>
    </x:WorksheetOptions>
   </x:ExcelWorksheet>
   <x:ExcelWorksheet>
    <x:Name>Sheet2</x:Name>
    <x:WorksheetOptions>
     <x:DefaultRowHeight>270</x:DefaultRowHeight>
     <x:ProtectContents>False</x:ProtectContents>
     <x:ProtectObjects>False</x:ProtectObjects>
     <x:ProtectScenarios>False</x:ProtectScenarios>
    </x:WorksheetOptions>
   </x:ExcelWorksheet>
   <x:ExcelWorksheet>
    <x:Name>Sheet3</x:Name>
    <x:WorksheetOptions>
     <x:DefaultRowHeight>270</x:DefaultRowHeight>
     <x:ProtectContents>False</x:ProtectContents>
     <x:ProtectObjects>False</x:ProtectObjects>
     <x:ProtectScenarios>False</x:ProtectScenarios>
    </x:WorksheetOptions>
   </x:ExcelWorksheet>
  </x:ExcelWorksheets>
  <x:WindowHeight>13395</x:WindowHeight>
  <x:WindowWidth>17760</x:WindowWidth>
  <x:WindowTopX>0</x:WindowTopX>
  <x:WindowTopY>90</x:WindowTopY>
  <x:ProtectStructure>False</x:ProtectStructure>
  <x:ProtectWindows>False</x:ProtectWindows>
 </x:ExcelWorkbook>
</xml><![endif]-->
</head>
<body link=blue vlink=purple>
';
$strHead .= '</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
';
	return $strHead;
}

//'변수값 구분자를 일정문자로 대체하여 전달하고 나중에 다시 보냄
function setUrlQuery($urlquery){
	if ($urlquery=='' || is_null($urlquery)) $urlquery = "";
	$urlquery = str_replace("&","|*",$urlquery);
	return $urlquery;
}

// replace to received url data
function getUrlQuery($urlquery){
	if ($urlquery=='' || is_null($urlquery)) $urlquery = "";
	$urlquery = str_replace("|*","&",$urlquery);
	return $urlquery;
}

/******************************************* database function ************************************************************************/

//데이타베이스의 코드규칙 회원아이디 변경시 변경된 이전아이디를 새 아이디로 업데이트
function MemberIDChangeDB($objdb,$PreUserid,$NextUserid){
	$sql = "update lms2_coursetake set userid='$NextUserid' where userid='$PreUserid'";
	$objdb->sqlExe($sql);

	$sql = "update lms2_applicationform set userid='$NextUserid' where userid='$PreUserid'";
	$objdb->sqlExe($sql);

	$sql = "update lms_bbs set userid='$NextUserid' where userid='$PreUserid'";
	$objdb->sqlExe($sql);
	$sql = "update lms_bbs_recomm set userid='$NextUserid' where userid='$PreUserid'";
	$objdb->sqlExe($sql);
	$sql = "update lms_bbs_comment set userid='$NextUserid' where userid='$PreUserid'";
	$objdb->sqlExe($sql);
}


// extract query to excel data
function QueryToExcel($objdb,$sql,$filename){

	unset($columns);
	if (empty($sql)){
		$sql = "";
	}
	//echo $sql;
	//$sql = strtoupper($sql);
	$sql = str_replace("\\","",$sql);

	$sql_cnt = "select count(*) cnt from ($sql)";
	$totalcount=$objdb->sqlRowOne($sql_cnt);

	$cut_sql = substr($sql,strpos($sql,"select")+6,strpos($sql,"from")-6);
	$result=$objdb->sqlResult($sql); //515-3701
	

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename".$totalcount.".xls");
	header("Content-charset=utf-8" );
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
	echo '<meta http-equiv="Content-Type" content="application/vnd.ms-excel;charset=utf-8">';
	echo "<table width=100% cellpadding=0 cellspacing=0 border=1>";
	
	foreach($row as $fieldname=>$val){
		$columns[$k] = strtoupper(trim($columns[$k]));
		//echo strpos($columns[$k],".")."<br>";
		if (strpos(" ".$columns[$k],".")){
			//echo "성공";
			unset($varCol1);
			$varCol1 = explode(".",$columns[$k]);
			$columns[$k] = $varCol1[ecount($varCol1)-1];
		}
		if (" ".strpos($columns[$k]," ")){
			unset($varCol1);
			$varCol1 = explode(" ",$columns[$k]);
			$columns[$k] = $varCol1[ecount($varCol1)-1];
		}

		//echo $varCol1."<br>";
		echo "<td bgcolor=#f4f4f4 align=center>".$columns[$k]."</td>";
	}
	foreach($result as $rowIdx=>$row){
		echo "<tr>";
		foreach($row as $fieldname=>$val){
			//echo $columns[$k]."<br>";
			if (strpos(" ".$columns[$k],"NUM_RECEIPT")==false){
				echo "<td align=left  style=mso-number-format:'\@'>".$row[$columns[$k]]."</td>";
			}else{
				echo "<td align=left  style=mso-number-format:'\@'>"."".$row[$columns[$k]]."</td>";//xjumin($row[$columns[$k]])
			}
		}
		echo "</tr>";
	}
	echo "</table>";
	unset($columns);

}



function getResultType($vresultbase_num_start,$vresultbase_num_end,$vresultbase_level_result,$vresultbase_grade,$pointnum,$rtype){
	$rl = "";
	$rg = "";
	$vr_cnt = ecount($vresultbase_level_result);

	for ($i_1=0;$i_1<$vr_cnt;$i_1++){
		if ($vresultbase_num_start[$i_1]<=$pointnum && $vresultbase_num_end[$i_1]>=$pointnum){
			$rl = $vresultbase_level_result[$i_1];
			$rg = $vresultbase_grade[$i_1];
			//echo $rg."<br>";
			break;
		}
	}
	if ($rtype=="level")
		return $rl;
	else
		return $rg;
}

//************************* 카페 블로그에서 lms비밀번호 변경 ************/
function updateBlogMemberInformation($userid,$pwd,$email){
	if($pwd!=''){
		$pwdenc = left($pwd,2);
		for($i=2;$i<strlen($pwd);$i++) $pwdenc.="*";
		$pwd = setPwdEncrypt($pwd); //비밀번호 암호화

		$sql = "select userid from uzn_member where userid='$userid'";
		//echo $sql;
		//exit;
		$jCount = sql_fetch_array(_query($sql));
		if($jCount){
			$sql = "update uzn_member set pwd='$pwd',pwdenc='$pwdenc',email='$email' where userid='$userid'";
			_query($sql);
		}
	}
}


//회원구분에 따른 한글명
function getMembertypeName($member_type){
	global $vSystem_member_type,$vSystem_member_type_name,$vSystem_member_type_count;
	$outValue = "";
	for($f_i=0;$f_i<$vSystem_member_type_count;$f_i++){
		if($vSystem_member_type[$f_i]==$member_type){
			$outValue = $vSystem_member_type_name[$f_i];
			break;
		}
	}
	return $outValue;
}




function getNameVAstate($state){
	$rstate='';
	switch ($state) {
		case "0":
			$rstate='입금전';
			break;
		case "1":
			$rstate='입금완료';
			break;
		case "2":
			$rstate='입금취소(당일)';
			break;
		case "3":
			$rstate='입금삭제(환불)';
			break;
	}
	return $rstate;
}


//특정 날짜 기준으로 다음 요일인날 짜 구하기
function getNextDate($indate,$inweek){
	global $objdb;

	//if(!strpos($inweek,"요일")) $inweek.="요일";
	//echo $inweek;
	$inweek = getWeekEngName($inweek);

	$sql = "select to_char(next_day(str_to_date('$indate','YYYY-MM-DD'),$inweek),'YYYY-MM-DD') rdate from dual";
///	echo "다음주 구하기 ". $sql . "<br>";
	$next_days = $objdb->sqlRowOne($sql);
	//$next_days = '2011-03-02';
	return $next_days;
}

function getWeekEngName($inweek){
	$rname='';
	switch ($inweek) {
		case "일":
			$rname= "1";
			//$rname= "SUNDAY";
			break;
		case "월":
			$rname= "2";
			//$rname= "MONDAY";
			break;
		case "화":
			$rname= "3";
			//$rname= "TUEDAY";
			break;
		case "수":
			$rname= "4";
			//$rname= "WEDDAY";
			break;
		case "목":
			$rname= "5";
			//$rname= "THUDAY";
			break;
		case "금":
			$rname= "6";
			//$rname= "FRIDAY";
			break;
		case "토":
			$rname= "7";
			//$rname= "SATDAY";
			break;
	}
	return $rname;
}

//요일함수에 따라 한글로 가져옴(이름)
function getWeekdayName($weekdayname){
	$wname = '';
	if($weekdayname=="1") $wname="일";
	elseif($weekdayname=="2") $wname="월";
	elseif($weekdayname=="3") $wname="화";
	elseif($weekdayname=="4") $wname="수";
	elseif($weekdayname=="5") $wname="목";
	elseif($weekdayname=="6") $wname="금";
	elseif($weekdayname=="7") $wname="토";
	return $wname;
}

// 중간 문자 * 처리
function remake_name($str, $start = 1, $end = 1, $ch = '*'){
	if(!$str || !is_string($str)) return ''; //입력된 값이 없으면 리턴값도 없다.

	$str_ch = array();
	$pointer = 0;

	//입력된 문자열을 바이트 수로 구분하여 하나의 배열을 만든다.
	while($str[$pointer] != false){
		if(ord($str[$pointer]) <= 127){
			$str_ch[] = substr($str, $pointer, 1);
			$pointer = $pointer + 1;
		}else{
			$str_ch[] = substr($str, $pointer, 2);;
			$pointer = $pointer + 2;
		}
	}

	//문자열 배열을 start, end, ch 값에 따라 치환한다.
	$total = ecount($str_ch);
	if($total <= $start+$end) $end = 0;
	foreach($str_ch as $k => $v){
		if($k >= $start && $k <= $total - $end -1){
			$str_ch[$k] = $ch;
		}
	}

	return implode( '', $str_ch);
}



//홈페이지 접근시 비회원 회원 카운트
if(!function_exists('addaccesslog')){
	 addaccesslog($g_user_ip,$sess_userid){
	global $objdb;
	/*
	member_accesslog 
	idx,userid,regist_date,ip,member_type
	*/		
	$m_day=date('Y-m-d');

			if($sess_userid!=''){//현재날짜 ip 채크
				$sql="update member_accesslog set userid='".$sess_userid."',member_type='member' where ip ='".$g_user_ip."' and regist_date='".$m_day."'";
				$objdb -> sqlExe($sql);

			}else{
				$log_idx = $objdb->sqlSeq("member_accesslog"); //시퀀스에서 구해오기

				$sql = "insert into member_accesslog(idx,userid,regist_date,ip,member_type) values ($log_idx,'$userid',now(),'$g_user_ip','guest')";
				$objdb -> sqlExe($sql);
			}

			
	}
}
//파일이 존재하는지 체크
function file_chk($path){
	if (file_exists($path)) {
		echo "파일이 존재합니다.\n";
		echo "파일 내용:\n";
		echo file_get_contents($path); // 파일 내용 출력
		include $path;
	} else {
		echo "파일이 존재하지 않습니다.\n";
	}
}