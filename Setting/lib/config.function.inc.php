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

function getVaId($args=array()) {
	global $objdb;
	if( !isset($args['userid']) ) return false;

	$sql = "select va_id from lms_member where userid='".$args['userid']."'";
	$va_id = $objdb->sqlRowOne($sql);

	if( empty($va_id) ) {
		$va_id = setVaId($args);
	}

	return $va_id;
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

//메뉴권한 체크
function sysMenuAuth($authtype){
	global $objdb,$user_authlevel, $sysMenuAuthFile,$sysmenuqry,$_qry,$sess_userid;

	$sql = "select ifnull(max(authlevel),0) from uzn_authlevel";
	$max_authlevel = $objdb->sqlRowOne($sql);

	$isValidate = true;
	if($authtype=='remove'){
		$sql = "select count(*) cnt from uzn_manager_menu where  menu_idx in (select menu_idx from uzn_manager_auth where menudeleteauth=$user_authlevel) and menuurl like '$sysMenuAuthFile%'";
		if($max_authlevel<$user_authlevel || ($max_authlevel>=$user_authlevel && $sysMenuAuthFile!='/nGmaster/form/permiss.php' && $sysMenuAuthFile!='/nGmaster/form/setting.php')){
			$sql.= " and menu_idx in (select mm.menu_idx from uzn_menu_widget mw, uzn_manager_menu mm where mw.itemid=mm.itemid and mw.userid='$sess_userid' and mw.chk_permission='Y')";
		}
		//echo $sql."<br>";
		$jCount = $objdb->sqlRowOne($sql);
		if($sysmenuqry!=''){
			if(strpos(" ".$_qry."&",$sysmenuqry."&")) $jCount = 1;
			else $jCount = 0;
		}
		if ($jCount<=0)	$isValidate = false;
	}elseif($authtype=='write'){
		$sql = "select menu_idx,menuqry from uzn_manager_menu where  menu_idx in (select menu_idx from uzn_manager_auth where menuwriteauth=$user_authlevel) and menuurl like '$sysMenuAuthFile%'";
		if($max_authlevel<$user_authlevel || ($max_authlevel>=$user_authlevel && $sysMenuAuthFile!='/nGmaster/form/permiss.php' && $sysMenuAuthFile!='/nGmaster/form/setting.php')){
			$sql.= " and menu_idx in (select mm.menu_idx from uzn_menu_widget mw, uzn_manager_menu mm where mw.itemid=mm.itemid and mw.userid='$sess_userid' and mw.chk_permission='Y')";
		}
		//echo $sql."<br>";
		$result=$objdb->sqlResult($sql);
		
		
		$l_i=0;
		foreach($result as $rowIdx=>$row){
			foreach($row as $fieldname=>$val){
				
				
				${"sys".$fieldname} = nullbnk($val);
			}
			if($sysmenuqry!=''){
				if(strpos(" ".$_qry."&",$sysmenuqry."&")) break;
			}
			$l_i++;
		}
		if($sysmenuqry!=''){
			if(strpos(" ".$_qry."&",$sysmenuqry."&")) $jCount = 1;
			else $jCount = 0;
		}else{
			if($l_i<=0) $jCount = 0;
			else $jCount = 1;
		}
		if ($jCount<=0)	$isValidate = false;
	}elseif($authtype=='modify'){
		//메뉴권한
		$sql = "select menu_idx,menuqry from uzn_manager_menu where  menu_idx in (select menu_idx from uzn_manager_auth where menumodifyauth=$user_authlevel) and menuurl like '$sysMenuAuthFile%'";
		if($max_authlevel<$user_authlevel || ($max_authlevel>=$user_authlevel && $sysMenuAuthFile!='/nGmaster/form/permiss.php' && $sysMenuAuthFile!='/nGmaster/form/setting.php')){
			$sql.= " and menu_idx in (select mm.menu_idx from uzn_menu_widget mw, uzn_manager_menu mm where mw.itemid=mm.itemid and mw.userid='$sess_userid' and mw.chk_permission='Y')";
		}
		//echo $sql."<br>";
		$result=$objdb->sqlResult($sql);
		
		
		$l_i=0;
		foreach($result as $rowIdx=>$row){
			foreach($row as $fieldname=>$val){
				
				
				${"sys".$fieldname} = nullbnk($val);
			}
			if($sysmenuqry!=''){
				if(strpos(" ".$_qry."&",$sysmenuqry."&")) break;
			}
			$l_i++;
		}
		if($sysmenuqry!=''){
			if(strpos(" ".$_qry."&",$sysmenuqry."&")) $jCount = 1;
			else $jCount = 0;
		}else{
			if($l_i<=0) $jCount = 0;
			else $jCount = 1;
		}
		if ($jCount<=0) $isValidate = false;
	}else{
		//읽기권한
		$sql = "select count(*) cnt from uzn_manager_menu where  menu_idx in (select menu_idx from uzn_manager_auth where menureadauth=$user_authlevel) and menuurl like '$sysMenuAuthFile%'";
		if($max_authlevel<$user_authlevel || ($max_authlevel>=$user_authlevel && $sysMenuAuthFile!='/nGmaster/form/permiss.php' && $sysMenuAuthFile!='/nGmaster/form/setting.php')){
			$sql.= " and menu_idx in (select mm.menu_idx from uzn_menu_widget mw, uzn_manager_menu mm where mw.itemid=mm.itemid and mw.userid='$sess_userid' and mw.chk_permission='Y')";
		}
		//echo $sql."<br>";
		$jCount = $objdb->sqlRowOne($sql);
		//echo "read : " . $jCount;
		if($sysmenuqry!=''){
			if(strpos(" ".$_qry."&",$sysmenuqry."&")) $jCount = 1;
			else $jCount = 0;
		}
		if ($jCount<=0)	$isValidate = false;
	}
	//echo $sql."<br>";
	//$isValidate = true;
	return $isValidate;
}

/******************************* 메뉴 구성 *****************************/
//($itemid,"{{NYEAR}}","년도",$nyear);
function QueryTemplc($itemid,$keyid,$keyname,$keyvalue){
	global $itemid,$objdb;

	$sql = "select count(*) from uzn_menu_query where itemid='$itemid' and keyid='$keyid'";
	$kCount = $objdb->sqlRowOne($sql);
	if($kCount<=0){
		$menu_query_idx =  $objdb->sqlSeq("uzn_menu_query"); //시퀀스에서 구해오기
		$sql = "insert into uzn_menu_query(menu_query_idx,keyid,keyname,keyvalue,itemid) ";
		$sql .= " values($menu_query_idx,'$keyid','$keyname','$keyvalue','$itemid')";
		$objdb->sqlExe($sql);
	}

}
function queryTemplk($query,$key){
	global $itemid,$objdb,$sess_userid;
	$vkey = explode("||",$key);
	$keyid = $vkey[0];
	$keyname = $vkey[1];

	$sql = "select count(*) from uzn_menu_query where itemid='$itemid' and keyid='$keyid'";
	$kCount = $objdb->sqlRowOne($sql);

	$sql = "select count(*) from uzn_menu_query_user where itemid='$itemid' and keyid='$keyid' and userid='$sess_userid'";
	$uCount = $objdb->sqlRowOne($sql);
	if($uCount<=0 && $kCount>0){

		$menu_query_user_idx =  $objdb->sqlSeq("uzn_menu_query_user"); //시퀀스에서 구해오기
		$sql = "insert into uzn_menu_query_user(menu_query_user_idx,keyid,keyname,keyvalue,itemid,userid) select $menu_query_user_idx,keyid,keyname,keyvalue,itemid,'$sess_userid' from uzn_menu_query ";
		$sql .= " where itemid='$itemid' and keyid='$keyid'";
		$objdb->sqlExe($sql);
	}

	$sql = "select count(*) from uzn_menu_query_user where itemid='$itemid' and keyid='$keyid' and userid='$sess_userid'";
	$uCount = $objdb->sqlRowOne($sql);
	if($uCount>0){
		$sql = "select keyvalue from uzn_menu_query_user where itemid='$itemid' and keyid='$keyid' and userid='$sess_userid'";
		$keyvalue = $objdb->sqlRowOne($sql);
		$query = str_replace($keyid,$keyvalue,$query);
	}

	return $query;
}

function queryTempl($query){
	global $itemid,$objdb;

	/*
	$vQueryTempl[$i++] = "{{NYEAR}}||년도";
	$vQueryTempl[$i++] = "{{UNIT}}||학기";
	$vQueryTempl[$i++] = "{{COURSE_IDX}}||과정개설코드";
	$vQueryTempl[$i++] = "{{COURSE_CODE}}||과정코드";
	$vQueryTempl[$i++] = "{{USERID}}||아이디";
	$vQueryTempl[$i++] = "{{COURSE_NAME}}||과정명";
	$vQueryTempl[$i++] = "{{PAGESIZE}}||페이징사이즈";
	*/

	$sql = "select keyid,keyname,count(*) cnt from uzn_menu_query group by keyid,keyname";
	//echo $sql."<Br>";
	$result=$objdb->sqlResult($sql);
	
	
	$i=0;
	foreach($result as $rowIdx=>$row){
		foreach($row as $fieldname=>$val){
			
			
			${"".$fieldname} = nullbnk($val);
		}
		$vQueryTempl[$i] = $keyid . "||" . $keyname;
		$i++;
	}

	for($i=0;$i<ecount($vQueryTempl);$i++){
		//$sql = "select count(*) from uzn_course where nyear='{{NYEAR}}'";
		//$sql = "select count(*) from uzn_course where nyear='{{NYEAR}}' and unit='{{UNIT}}'";
		//$sql = "select count(*) from uzn_course where course_idx={{COURSE_IDX}}'";
		//$sql = "select count(*) from uzn_course where course_code={{COURSE_CODE}}'";
		$key = $vQueryTempl[$i];
		$query = queryTemplk($query,$key);
	}

	return $query;
}

//아이콘 제어함수
/*
function xNIconMenuLoad($itemid, $itemview, $ismove){
	$count = 1000;
	$itemclass = "yellow";
	$itemurl = "./form/board.php?updatemode=search";
	$itemtitle = '<em><span><img src=./img/menu/menu02.png alt=메뉴 width=23 /></br><span class=mname>아이콘 ' . $itemid . '</span></span></em><span class=article_num><em class=_count>' . number_format($count,0) . '</em><span class=tail></span></span>';

	if($itemview=='list'){

		//$Contents = '<div><a href="javascript:xNformLoad(\'' . $itemurl . '\');"><em><span><img src="./img/menu/menu02.png" alt="아이콘 ' . $itemid . '" /></br><span class="mname">아이콘 '. $itemid . '</span></span></em><span class="article_num"><em class="_count">' . number_format($count,0) . '</em><span class="tail"></span></span></a></div>';
		$Contents = '<div><a href="javascript:xNformLoad(\'' . $itemurl . '\');">' . $itemtitle;
		if($ismove=='Y') $Contents .= '<a href="javascript:removeLeftItem(\'' . $itemid . '\')">X</a>';
		$Contents .= '</a></div>';


	}else{
		$Contents = '<div><a href="javascript:addIconMenuItem(\'' . $itemid . '\',\'' . $itemclass . '\',\'' . $itemurl . '\',\''. $itemtitle . '\');">' . $itemtitle . '</a></div>';
	}
	return $Contents;
}
*/

//버튼 제어 함수
function xNMenuLoad($itemid, $itemview, $ismove){
	global $objdb,$pagesize;

	$itemtype = "icon";

	if(strpos(" ".$itemid,"icon")) $itemtype = "icon";
	else $itemtype = "button";


	if($itemid=='icon001'){

		$itemclass = "yellow";
		$itemurl = "./form/homepage.php?updatemode=search";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_03.png alt=메뉴 width=40 /> 홈페이지관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_03.png alt=메뉴 width=23 />홈페이지관리</span></span></em>';
	}

	if($itemid=='icon002'){//박태정 아이콘9

		$itemclass = "yellow";
		$itemurl = "./form/promotion.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_04.png alt=메뉴 width=40 /> 진급관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_04.png alt=메뉴 width=23 />진급관리</span></span></em>';
	}

	if($itemid=='icon003'){//춘 아이콘1

		$itemclass = "blue";
		$itemurl = "./form/setting.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_27.png alt=메뉴 width=40 /> 시스템설정</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_27.png alt=메뉴 width=23 />시스템설정</span></span></em>';
	}

	if($itemid=='icon004'){//김진호 아이콘3

		$itemclass = "blue";
		$itemurl = "./form/account.sublist.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_32.png alt=메뉴 width=40 /> 수강등록현황</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_32.png alt=메뉴 width=23 />수강등록현황</span></span></em>';
	}

	if($itemid=='icon005'){//춘 아이콘2

		$itemclass = "blue";
		$itemurl = "./form/basiccode.php?updatemode=";
		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_127.png alt=메뉴 width=40 /> 기본코드관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_127.png alt=메뉴 width=23 />기본코드관리</span></span></em>';
	}

	if($itemid=='icon006'){//박태정 아이콘4

		$itemclass = "blue";
		$itemurl = "./form/classroom.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_128.png alt=메뉴 width=40 /> 강의실사용현황</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_128.png alt=메뉴 width=23 />강의실사용현황</span></span></em>';
	}


	if($itemid=='icon007'){//김진호 아이콘4

		$itemclass = "blue";
		$itemurl = "./form/adminpoll.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_02.png alt=메뉴 width=40 /> 설문평가관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_02.png alt=메뉴 width=23 />설문평가관리</span></span></em>';
	}

	if($itemid=='icon008'){//박태정 아이콘5

		$itemclass = "blue";
		$itemurl = "./form/totalbranch.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_116.png alt=메뉴 width=40 /> 과정분류관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_116.png alt=메뉴 width=23 />과정분류관리</span></span></em>';
	}

	if($itemid=='icon009'){//김병춘 아이콘3

		$itemclass = "blue";
		$itemurl = "./form/manager.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_131.png alt=메뉴 width=40 /> 관리자관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_131.png alt=메뉴 width=23 />관리자관리</span></span></em>';
	}
	if($itemid=='icon010'){//김병춘 아이콘4

		$itemclass = "blue";
		$itemurl = "./form/teacher.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_64.png alt=메뉴 width=40 /> 교강사관리 </span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_64.png alt=메뉴 width=23 />교강사관리</span></span></em>';
	}
	if($itemid=='icon011'){//김병춘 아이콘4

		$itemclass = "blue";
		$itemurl = "./form/course.report.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_04.png alt=메뉴 width=40 /> 학사통계</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_04.png alt=메뉴 width=23 />학사통계</span></span></em>';
	}
	if($itemid=='icon012'){//박태정 아이콘6

		$itemclass = "blue";
		$itemurl = "./form/courseopen.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_01.png alt=메뉴 width=40 /> 과목개설관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_01.png alt=메뉴 width=23 />과목개설관리</span></span></em>';
	}
	if($itemid=='icon013'){//김진호 아이콘5

		$itemclass = "blue";
		$itemurl = "./form/applicationform.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_105.png alt=메뉴 width=40 /> 입학원서관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_105.png alt=메뉴 width=23 />입학원서관리</span></span></em>';
	}
	if($itemid=='icon014'){//김진호 아이콘6

		$itemclass = "blue";
		$itemurl = "./form/sendsmsmail.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_29.png alt=메뉴 width=40 /> 발송내역</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_29.png alt=메뉴 width=23 />발송내역</span></span></em>';
	}
	if($itemid=='icon015'){//박태정 아이콘7

		$itemclass = "blue";
		$itemurl = "./form/opentotal.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_01.png alt=메뉴 width=40 /> 전체과목관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_01.png alt=메뉴 width=23 />전체과목관리</span></span></em>';
	}
	if($itemid=='icon016'){//김진호 아이콘7

		$itemclass = "blue";
		$itemurl = "./form/teacherpay.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_48.png alt=메뉴 width=40 /> 강사료관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_48.png alt=메뉴 width=23 />강사료관리</span></span></em>';
	}
	if($itemid=='icon017'){//박태정 아이콘8
	
		$itemclass = "blue";
		$itemurl = "./form/coursesub.php?updatemode=";
	
		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_01.png alt=메뉴 width=40 /> 개설과목관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_01.png alt=메뉴 width=23 />개설과목관리</span></span></em>';
	}
	if($itemid=='icon018'){ //회원관리

		$itemclass = "yellow";
		$itemurl = "./form/member.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_23.png alt=메뉴 width=40 /> 회원관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_23.png alt=메뉴 width=23 />회원관리</span></span></em>';
	}
	if($itemid=='icon019'){//김진호 아이콘8

		$itemclass = "blue";
		$itemurl = "./form/certificate.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_49.png alt=메뉴 width=40 /> 증명서출력</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_49.png alt=메뉴 width=23 />증명서출력</span></span></em></span>';
	}

	if($itemid=='icon020'){//박태정 아이콘10

		$itemclass = "blue";
		$itemurl = "./form/courseexcel.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_16.png alt=메뉴 width=40 /> 국평원자료다운로드</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_16.png alt=메뉴 width=23 />국평원자료다운로드</span></span></em>';
	}
/* if($itemid=='icon021'){//김진호 아이콘9
	
		$itemclass = "blue";
		$itemurl = "./form/unitclose.php?updatemode=";
	
		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_91.png alt=메뉴 width=40 /> 학기마감처리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_91.png alt=메뉴 width=23 />학기마감처리</span></span></em></span>';
	}*/
	if($itemid=='icon022'){//박태정 아이콘11

		$itemclass = "blue";
		$itemurl = "./form/label.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_79.png alt=메뉴 width=40 /> 라벨출력관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_79.png alt=메뉴 width=23 />라벨출력관리</span></span></em></span>';
	}
	if($itemid=='icon023'){//박태정 아이콘12

		$itemclass = "blue";
		$itemurl = "./form/authboard.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_115.png alt=메뉴 width=40 /> 게시판권한관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_115.png alt=메뉴 width=23 />게시판권한관리</span></span></em>';
	}
	if($itemid=='icon024'){//박태정 아이콘13

		$itemclass = "blue";
		$itemurl = "./form/coursetake.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_63.png alt=메뉴 width=40 /> 일괄수강신청</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_63.png alt=메뉴 width=23 />일괄수강신청</span></span></em>';
	}
	if($itemid=='icon025'){//김진호 아이콘10

		$itemclass = "blue";
		$itemurl = "./form/scholarship.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_138.png alt=메뉴 width=40 /> 장학금신청관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_138.png alt=메뉴 width=23 />장학금신청관리</span></span></em>';
	}
	if($itemid=='icon026'){//박태정 아이콘14

		$itemclass = "blue";
		$itemurl = "./form/profit.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_09.png alt=메뉴 width=40 /> 수지분석</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_09.png alt=메뉴 width=23 />수지분석</span></span></em>';
	}
	if($itemid=='icon027'){//김진호 아이콘11

		$itemclass = "blue";
		$itemurl = "./form/refund.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_138.png alt=메뉴 width=40 /> 수강료반환신청</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_138.png alt=메뉴 width=23 />수강료반환신청</span></span></em>';
	}
	/*if($itemid=='icon028'){//김진호 아이콘13

		$itemclass = "blue";
		$itemurl = "./form/pamphlet.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_84.png alt=메뉴 width=40 /> 안내책자신청관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_84.png alt=메뉴 width=23 />안내책자신청관리</span></span></em>';
	}
	if($itemid=='icon030'){//김진호 아이콘12

		$itemclass = "blue";
		$itemurl = "./form/coursesuggest.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_142.png alt=메뉴 width=40 /> 신규강좌제안</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_142.png alt=메뉴 width=23 />신규강좌제안</span></span></em>';
	}*/


	if($itemid=='icon033'){//박태정 아이콘12

		$itemclass = "blue";
		$itemurl = "./form/permiss.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_136.png alt=메뉴 width=40 /> 권한승인관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_136.png alt=메뉴 width=23 />권한승인관리</span></span></em>';
	}


	if($itemid=='icon035'){

		$itemclass = "blue";
		$itemurl = "./form/graduate.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_136.png alt=메뉴 width=40 /> 졸업사정관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_136.png alt=메뉴 width=23 />졸업사정관리</span></span></em>';
	}

	if($itemid=='icon036'){

		$itemclass = "blue";
		$itemurl = "./form/account.group.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_32.png alt=메뉴 width=40 /> 종합수강내역</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_32.png alt=메뉴 width=23 />종합수강내역</span></span></em>';
	}

/*	if($itemid=='icon037'){

		$itemclass = "blue";
		$itemurl = "./form/virtualaccount.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_32.png alt=메뉴 width=40 /> 가상계좌관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_32.png alt=메뉴 width=23 />가상계좌관리</span></span></em>';
	}*/

	if($itemid=='icon038'){

		$itemclass = "blue";
		$itemurl = "./form/managerlog.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_09.png alt=메뉴 width=40 /> 관리자계정기록</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_09.png alt=메뉴 width=23 />관리자계정기록</span></span></em>';
	}

	if($itemid=='icon039'){

		$itemclass = "blue";
		$itemurl = "./form/transfergrade.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_136.png alt=메뉴 width=40 /> 전적대학성적</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_136.png alt=메뉴 width=23 />전적대학성적</span></span></em>';

	/*} else if($itemid=='icon040'){

		$itemclass = "blue";
		$itemurl = "./form/workcontent.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_137.png alt=메뉴 width=40 /> 추가강사경력</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_137.png alt=메뉴 width=23 />추가강사경력</span></span></em>';

	}else if($itemid=='icon042'){

		$itemclass = "blue";
		$itemurl = "./form/contents.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=40 /> 콘텐츠차시설정</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=23 />콘텐츠차시설정</span></span></em>';*/
	}else if($itemid=='icon043'){

		$itemclass = "blue";
		$itemurl = "./form/certificate.list.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=40 />증명서 출력내역</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=23 />증명서 출력내역</span></span></em>';
	}/*
	else if($itemid=='icon044'){

		$itemclass = "blue";
		$itemurl = "./form/apply_license.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=40 /> 자격증취득신청관리</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=23 />자격증취득신청관리</span></span></em>';
	}else if($itemid=='icon045'){

		$itemclass = "blue";
		$itemurl = "./form/apply_job.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=40 /> 취/창업현황신청관리	</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=23 />취/창업현황신청관리	</span></span></em>';
	}*/
	else if($itemid=='icon046'){

		$itemclass = "blue";
		$itemurl = "./form/mergeuserid.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=40 /> 회원통합처리	</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=23 />회원통합처리	</span></span></em>';
	}
	else if($itemid=='icon047'){

		$itemclass = "blue";
		$itemurl = "./form/certificate.request.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=40 /> 증명서신청내역	</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=23 />증명서신청내역	</span></span></em>';
	}
	else if($itemid=='icon048'){

		$itemclass = "blue";
		$itemurl = "./nGmaster/form/member.log.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=40 /> 회원접속기록	</span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=23 />회원접속기록	</span></span></em>';
	}
	else if($itemid=='icon049'){

		$itemclass = "blue";
		$itemurl = "./nGmaster/form/member.log.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=40 /> 휴보강신청관리 </span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=23 />휴보강신청관리</span></span></em>';
	}
	else if($itemid=='icon055'){

		$itemclass = "blue";
		$itemurl = "./nGmaster/form/teacher.report.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=40 /> 강사진통계 </span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=23 />강사진통계</span></span></em>';
	}
		else if($itemid=='icon056'){

		$itemclass = "blue";
		$itemurl = "./nGmaster/form/account.sublist.minab.php?updatemode=";

		if($itemview=='main')
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=40 /> 수강료미납현황 </span></span></em>';
		else
			$itemtitle = '<em><span><span class=mname><img src=./img/icon/menu2_139.png alt=메뉴 width=23 />수강료미납현황</span></span></em>';
	}

	if($itemtype=='button'){
		if($itemview=='list' || $itemview=='main'){
			$Contents = loadButtonMenuItem($itemid,$itemclass,$itemurl,$itemtitle);
		}elseif($itemview=='add'){
			$Contents = addButtonMenuItem($itemid,$itemclass,$itemurl,$itemtitle);
		}else{
			//$Contents = loadButtonMenuItem($itemid,$itemclass,$itemurl,$itemtitle);
		}
	}else{
		if($itemview=='list' || $itemview=='main'){
			$Contents = loadIconMenuItem($itemid,$itemclass,$itemurl,$itemtitle);
		}elseif($itemview=='add'){
			$Contents = addIconMenuItem($itemid,$itemclass,$itemurl,$itemtitle);
		}else{
			//$Contents = loadButtonMenuItem($itemid,$itemclass,$itemurl,$itemtitle);
		}
	}
	return $Contents;
}


//new Icon 제어
function addIconMenuItem($itemid,$itemclass,$itemurl,$itemtitle){
	$itemtitle = strip_tags($itemtitle);
	$itemValue = '<div><a href="javascript:addIconMenuItem(\'' . $itemid . '\',\'' . $itemclass . '\',\'' . $itemurl . '\',\''. $itemtitle . '\');"><span>' . $itemtitle . '</span></a></div>';
	return $itemValue;
}

function loadIconMenuItem($itemid,$itemclass,$itemurl,$itemtitle){
	global $ismove,$itemview;
	$itemtitle = strip_tags($itemtitle);
	$itemValue = '';

	$addItemScript = "";
	$class = '';
	if($itemview=='main'){
		$addItemScript = "closeDialogTop();";
		$class = 'g1';
	}

	if($ismove=='Y'){
		$itemValue .= '<a href="javascript:removeLeftItem(\'' . $itemid . '\')" class="lnb_del"><img src=./img/icontip/x2_03.png></a>';
	}
	$itemValue .='<a href="javascript:xNformLoad(\'' . $itemurl . '\');selectedLeftMenu(\'' . $itemid . '\');' . $addItemScript . '" class="'.$class.' '.$itemid.'"><span>' . $itemtitle . '</span></a>';

	return $itemValue;
}

/*
//Icon 제어
function addIconMenuItem($itemid,$itemclass,$itemurl,$itemtitle){
	$itemValue = '<div><a href="javascript:addIconMenuItem(\'' . $itemid . '\',\'' . $itemclass . '\',\'' . $itemurl . '\',\''. $itemtitle . '\');">' . $itemtitle . '</a></div>';
	return $itemValue;
}

function loadIconMenuItem($itemid,$itemclass,$itemurl,$itemtitle){
	global $ismove,$itemview;
	$addItemScript = "";
	if($itemview=='main') $addItemScript = "closeDialogTop();";

	$itemValue = '<div>';
	if($ismove=='Y'){
		$itemValue .= '<a href="javascript:removeLeftItem(\'' . $itemid . '\')"><img src=./img/icontip/x2_01.png></a>&nbsp;&nbsp;';
	}
	$itemValue .='<a href="javascript:xNformLoad(\'' . $itemurl . '\');' . $addItemScript . '" onClick="selectedLeftMenu(\'' . $itemid . '\');">' . $itemtitle . '</a>';

	$itemValue .= '</div>';
	return $itemValue;
}
*/
//버튼 제어
function addButtonMenuItem($itemid,$itemclass,$itemurl,$itemtitle){
	$itemValue = '<div  class="' . $itemclass . '"><div class="fontz1"><a href="javascript:addButtonMenuItem(\'' . $itemid . '\',\'' . $itemclass . '\',\'' . $itemurl . '\',\'' . $itemtitle . '\');">' . $itemtitle . '</a>';
	$itemValue .= '</div></div>';

	return $itemValue;
}

function loadButtonMenuItem($itemid,$itemclass,$itemurl,$itemtitle){
	global $ismove,$itemview;

	$addItemScript = "";
	if($itemview=='main') $addItemScript = "closeDialogTop();";

	$itemValue = '<div  class="' . $itemclass . '"><div class="fontz1"><a href="javascript:xNformLoad(\'' . $itemurl . '\');' . $addItemScript . '" class="fontz1">' . $itemtitle .  '</a>';
	if($ismove=='Y'){
		$itemValue .= '<a href="javascript:removeRightItem(\'' . $itemid . '\')"><img src=./img/icontip/icon_01.png></a>';
		$itemValue .= '<a href="javascript:xNsetButtonForm(\'' . $itemid . '\')"><img src=./img/icontip/icon_02.png></a>';
	}
	$itemValue .= '</div></div>';
	return $itemValue;
}
/******************************* 메뉴 구성 *****************************/

function xNrImage($str){
	return str_replace("<IMG","<img",$str);
}

function conv2($str,$ctype='kr'){
	$rvalues = "";
	if($ctype=='kr' || $ctype=='euc-kr'){
		$rvalues = iconv("UTF-8","CP949",$str);
	}else{
		$rvalues = iconv("CP949","UTF-8",$str);
	}
	return $rvalues;
}

function conv($str,$ctype=null){
	$rvalues = "";
	/*
	if($ctype!=''){
		if($ctype=='kr' || $ctype=='euc-kr'){
			$rvalues = @iconv("UTF-8","EUC-KR//IGNORE",$str);
		}else{
			//$rvalues = iconv("EUC-KR","UTF-8",$str);
		}
	}else{*/
		$rvalues = $str;
	//}
	return $rvalues;
}


function rsconv($str){
	global $charsetdb;
//	return conv($str,$charsetdb);
	return $str;
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

/*
// 쿠키변수 생성
function set_cookie($cookie_name, $value, $expire=1)
{
	global $Server;
    $g4[server_time] = time();
	$g4[cookie_domain] = $Server;

    setcookie(md5($cookie_name), base64_encode($value), $g4[server_time] + $expire, '/', $g4[cookie_domain]);
	//setcookie(md5($cookie_name), base64_encode($value), $g4[server_time] + $expire);
	//setcookie(md5($cookie_name), base64_encode($value), $g4[server_time] + $expire, "/",$g4[cookie_domain], 1);
}


// 쿠키변수값 얻음
function get_cookie($cookie_name)
{
    return base64_decode($_COOKIE[md5($cookie_name)]);
}

function set_cookie($keys,$values){
	$rvalues = base64_encode($values);
	setcookie("USER[" . ($keys) . "]",$rvalues,0,"/");
	return $rvalues;
}

function get_cookie($keys){
	$rvalues = "";

	//global $_COOKIE;
	$server_time = time();
	$cookie_domain = $_SERVER["SERVER_NAME"];
	$expire = 1;

	$temp = $HTTP_COOKIE_VARS[USER];
	//echo $temp;
	//exit;
	if(!is_array($temp)){
		$vtemp = explode("&",$temp);

		for($j=0;$j<ecount($vtemp);$j++){
			if(strpos(" ".$vtemp[$j],$keys)){
				//echo $vtemp[$j]."/" . $vkeys[$k] . "<br>";
				$values = str_replace($keys."=","",$vtemp[$j]);
				setcookie("USER[".$keys."]",$values, $server_time + $expire, '/');
				$rvalues = base64_decode($values);
			}
		}
	}else{
		$rvalues = base64_decode($_COOKIE[USER][$keys]);
	}
	return $rvalues;
}

function convert_cookie(){
	//global $_COOKIE;
	$server_time = time();
	$cookie_domain = $_SERVER["SERVER_NAME"];
	$expire = 1;

	$skeys = "_USERID,_USEREMAIL,_USERNAME";
	$vkeys = explode(",",$skeys);

	$temp = $_COOKIE[USER];
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
*/
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


//학점은행제부분만 전담.
function QueryToCVS($objdb,$sql,$filename){
	//echo $sql;
	unset($columns);
	//echo $sql;
	//$sql = strtoupper($sql);
	$sql = str_replace("\\","",$sql);

	$sql_cnt = "select count(*) cnt from ($sql)";
	$totalcount=$objdb->sqlRowOne($sql_cnt);

	$cut_sql = substr($sql,strpos($sql,"select")+6,strpos($sql,"from")-6);
	//echo $cut_sql."<bR>";
	//$columns = explode(" , ",$cut_sql);
	//echo $columnsCount;
	$result=$objdb->sqlResult($sql); //515-3701
	

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename".$totalcount.".xls");
  //header("Content-Description: PHP4 Generated Data");
	header( "Content-Description: Gamza Excel Data" );
  header("Content-charset=utf-8" );
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
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
		//echo "<td bgcolor=#f4f4f4 align=center>".$columns[$k]."</td>";
	}
	foreach($result as $rowIdx=>$row){
		echo "<tr>";
		foreach($row as $fieldname=>$val){
			
			
			//${"var_".$fieldname}[$i] = nullbnk($val);
			echo "<td align=left  style=mso-number-format:'\@'>".nullbnk($val)."</td>";
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

//////////////////////// lms에서 회원 정보 변경시 카페 비번 변경 //////////
function updateLmsMemberInformation($userid,$pwd,$email){
	global $objdb;
	if($pwd!=''){
		require_once $_SERVER["DOCUMENT_ROOT"]."/include/config.numz.inc.php";
		$nux = new numz_class();

		$sql = "select count(*) from ash_member where id='$userid'";
		$jCount = $objdb->sqlRowOne($sql);
		if($jCount>0){
			$password = $nux->crypt_md5($pwd,$_board['crypt_word']);
			$sql = "update ash_member set password='$password',email='$email' where id='$userid'";
			$objdb->sqlExe($sql);
		}
	}
}

function insertLmsMemberInformation($id,$password,$name,$sex,$email){
	global $objdb,$mysqldb,$objfile,$client_ip;

	if($mysqldb){
		if($password!=''){
			require_once $_SERVER["DOCUMENT_ROOT"]."/include/config.numz.inc.php";
			$nux = new numz_class();

			//이메일 인증
			$authmail_val=md5(time());
			$authmail="0";

			$password = $nux->crypt_md5($password,$_board['crypt_word']);

			$sql = "select count(*) from ash_member where id='$id'";
			$jCount = $mysqldb->sqlRowOne($sql);

			$sql = "select count(*) from uzn_member where userid='$id' and member_type='manager'";
			$managerCount = $objdb->sqlRowOne($sql);
			if($managerCount>0){
				$level = 1;
				$admin_level = 1;
			}else{
				$level = 9;
				$admin_level = 9;
			}

			$no = $mysqldb->sqlSeq("ash_member"); //시퀀스에서 구해오기

			if($sex=='남자') $sex =0;
			else $sex = 1;

			$signdate=time();

			$nick_name = $name;
			if($jCount<=0){
				$sql = "insert into ash_member (no,authmail_val,id,password,name,nick_name,sex,email,signdate,ip,level,admin_level) values ";
				$sql.= "($no,'$authmail_val','$id','$password','$name','$nick_name',$sex,'$email',$signdate,'$client_ip',$level,$admin_level)";
				$mysqldb->sqlExe($sql);
				//$objfile->textLogWrite($_SERVER["DOCUMENT_ROOT"].'/upload/' . date('Ymd'). '.txt',$sql);
				//echo $sql."<br>";
				//exit;
			}else{
				$sql = "update ash_member set password='$password',email='$email',level=$level,admin_level=$admin_level where id='$id'";
				$mysqldb->sqlExe($sql);
				//$objfile->textLogWrite($_SERVER["DOCUMENT_ROOT"].'/upload/' . date('Ymd'). '.txt',$sql);
				//$objdb->sqlExe($sql);
				//echo $sql."<br>";
				//exit;

			}
		}
	}
}


//회원정보에 회원으로 가입되어 있는지 확인
function getMemberJuminCount($objdb,$in_jumin){
	$sql = "select count(*) from lms_member where jumin='$in_jumin'";
	$cnt=$objdb->sqlRowOne($sql);
	if ($cnt>0) $r='y';
	else $r = 'n';

	return $r;
}


function getMemberJuminMajorCount($objdb,$in_jumin,$in_major){
	$sql = "select count(*) from lms_member where jumin='$in_jumin' and major_idx=$in_major";
	$cnt=$objdb->sqlRowOne($sql);
	if ($cnt>0) $r='y';
	else $r = 'n';

	return $r;
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


//포인트 발급
function setPointMember($objdb,$userid,$point_code,$point_number,$contents,$regist_url){
	$r = false;
	unset($result);unset($columns);
	$sql="select point_idx,point_number point_max_number from uzn_point where point_code='$point_code' and rownum<=1";
	//echo $sql."<br>";
	$result=$objdb->sqlResult($sql);
	
	foreach($result as $rowIdx=>$row){
		foreach($row as $fieldname=>$val){
			
			
			${"".$fieldname} = nullbnk($val);
		}
	}
	if($point_number=='') $point_number = $point_max_number;

	unset($result);
	unset($columns);
	$sql="select member_idx from uzn_member where userid='$userid' and rownum<=1";
	//echo $sql."<br>";
	$result=$objdb->sqlResult($sql);
	
	foreach($result as $rowIdx=>$row){
		foreach($row as $fieldname=>$val){
			
			
			${"".$fieldname} = nullbnk($val);
		}
	}
	if($member_idx=='') $member_idx = 0;

	$sql = "select count(*) from uzn_pointmember where member_idx=$member_idx and regist_url='$regist_url' and point_number=$point_number";
	//echo $sql."<br>";
	$pointmemberCount = $objdb->sqlRowOne($sql);
	if($pointmemberCount<=3){
		$pointmember_idx = $objdb->sqlSeq("uzn_pointmember"); //시퀀스에서 구해오기

		//echo '-----------3<br>';

		if($member_idx=='') $member_idx = 0;
		if($point_idx=='') $point_idx = 0;
		if($point_number=='') $point_number = 0;
		$regist_url = left($regist_url,255);

		$sql = "insert into uzn_pointmember(pointmember_idx,member_idx,point_idx,point_number,regist_date,regist_url,userid) values($pointmember_idx,$member_idx,$point_idx,$point_number,now(),'$regist_url','$userid')";
		//echo $sql."<br>";
		$objdb -> sqlExe($sql);


		$vClobData = Array (contents=>$contents);
		$tableName = "uzn_pointmember";
		$whereQuery = "  where pointmember_idx=$pointmember_idx ";
		$updateCount = $objdb->sqlUpdate($tableName, $whereQuery,$vClobData);

		$r = true;
	}
}

function SystemConnectLog(){//$objdb,$strips,$strself,$_GET,$_POST,$_COOKIE,$_SERVER,$headers
	/*$strenvs .= "----- get ----<br>\n";
	foreach($_GET as $key => $val) {
		$strenvs.= $key." => ".$val."<br>\n";
	}

	$strenvs .= "----- post ----<br>\n";
	foreach($_POST as $key => $val) {
		$strenvs.= $key." => ".$val."<br>\n";
	}

	$strenvs .= "----- cookie ----<br>\n";
	foreach($_COOKIE as $key => $val) {
		$strenvs.= $key." => ".$val."<br>\n";
	}


	$strenvs .= "----- server ----<br>\n";
	foreach($_SERVER as $key => $val) {
		$strenvs.= $key." => ".$val."<br>\n";
	}

	$strenvs .= "----- apache header ----<br>\n";
	$headers = apache_request_headers();
	foreach ($headers as $header => $value) {
		$strenvs.= "$header: $value <br>\n";
	}
	//echo ($StatRefer);
	$sql = "insert into systemconnectlog(ndate,ip,strself,strenvs) values(now(),'$strips','$strself','$strenvs')";
	$objdb->sqlExe($sql);*/
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
//세션값가져옴(현재접속자수)
function getSessionMemberCount(){
	global $objdb;
	$sql = "select count(*)  from uzn_sessionmember";
	$sCount = $objdb->sqlRowOne($sql);
	return $sCount;
}

function getAuthLevelName($levelnum){
	global $vSystem_authlevel,$vSystem_authlevel_name,$vSystem_authlevel_count;
	$returnValue = '';
	for($k=0;$k<$vSystem_authlevel_count;$k++){
		if($levelnum==$vSystem_authlevel[$k]){
			$returnValue = $vSystem_authlevel_name[$k];
			break;
		}
	}
	return $returnValue;
}



//특정 날짜 기준으로 다음 요일인날 짜 구하기
/*
mysql용
function getNextDate($indate,$inweek){
	global $objdb;

	//if(!strpos($inweek,"요일")) $inweek.="요일";
	$inweek = getWeekEngName($inweek); //오라클에서 사용, mysql은 숫자를 넣음

	$sql = "select day1 from (
select dayofweek('$indate') week1
,'$indate' day1
union
select dayofweek(date_add('$indate',INTERVAL 1 DAY)) week1
,date_add('$indate',INTERVAL 1 DAY) day1
union
select dayofweek(date_add('$indate',INTERVAL 2 DAY)) week1
,date_add('$indate',INTERVAL 2 DAY) day1
union
select dayofweek(date_add('$indate',INTERVAL 3 DAY)) week1
,date_add('$indate',INTERVAL 3 DAY) day1
union
select dayofweek(date_add('$indate',INTERVAL 4 DAY)) week1
,date_add('$indate',INTERVAL 4 DAY) day1
union
select dayofweek(date_add('$indate',INTERVAL 5 DAY)) week1
,date_add('$indate',INTERVAL 5 DAY) day1
union
select dayofweek(date_add('$indate',INTERVAL 6 DAY)) week1
,date_add('$indate',INTERVAL 6 DAY) day1
) t where week1=7";
	//echo "다음주 구하기 ". $sql . "<br>";
	$next_days = $objdb->sqlRowOne($sql);
	return $next_days;
}
*/
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

function getFinishSatate($finishstate){

	/*if($finishstate=="0") $wname="미수료";
	elseif($finishstate=="1") $wname="1학기이수";
	elseif($finishstate=="2") $wname="2학기이수";
	elseif($finishstate=="3") $wname="3학기이수";
	elseif($finishstate=="4") $wname="수료";
	return $wname;*/
	global $vSystem_finish_state,$vSystem_finish_state_name,$vSystem_finish_state_count;
	$returnValue = '';
	for($k=0;$k<$vSystem_finish_state_count;$k++){
		if($finishstate==$vSystem_finish_state[$k]){
			$returnValue = $vSystem_finish_state_name[$k];
			break;
		}
	}
	return $returnValue;
}

function getScholarshipType($type){
	global $vSystem_scholarship_type,$vSystem_scholarship_type_name,$vSystem_scholarship_type_count;
	$returnValue = '';
	for($k=0;$k<$vSystem_scholarship_type_count;$k++){
		if($type==$vSystem_scholarship_type[$k]){
			$returnValue = $vSystem_scholarship_type_name[$k];
			break;
		}
	}
	return $returnValue;
}

function getScholarshipTargetName($type){
	global $vSystem_scholarship_target,$vSystem_scholarship_target_name;
	$returnValue = '';
	for($k=0;$k<ecount($vSystem_scholarship_target);$k++){
		if($type==$vSystem_scholarship_target[$k]){
			$returnValue = $vSystem_scholarship_target_name[$k];
			break;
		}
	}
	return $returnValue;
}

//수강접수상태(이름)
function getCoursetake_name($coursetake_state){

	if($coursetake_state=="1") $wname="접수";
	elseif($coursetake_state=="2") $wname="삭제(취소)";
	elseif($coursetake_state=="3") $wname="등록";
	elseif($coursetake_state=="4") $wname="대기";
	elseif($coursetake_state=="7") $wname="환불(취소)";
	return $wname;
}

/*
mysql용
function getWeekNum($indate){
	global $objdb;
	$sql = "select dayofweek('$indate') week1"; // 1:일, 2:월, 3:화...
	//echo "주번호 구하기 ". $sql . "<br>";
	$weeknum = $objdb->sqlRowOne($sql);
	return $weeknum;
}
*/
function getWeekNum($indate){
	global $objdb;
	$sql = "select to_char(str_to_date('$indate','YYYY-MM-DD'),'D') from dual";
	//echo "주번호 구하기 ". $sql . "<br>";
	$weeknum = $objdb->sqlRowOne($sql);
	return $weeknum;
}


function iconv_utf8_to_euckr($value){
	if (is_array($value)){
		foreach($value as $uk=>$uv) $value[$uk]=iconv("UTF-8","CP949",$uv);
		return $value;
	} else return iconv("UTF-8","CP949",$value);
}

function getCertificateType($str){
	$cstr = $str;
	global $vsystem_certificate_code,$vsystem_certificate_type,$vsystem_certificate_type_count;
	for ($i=0; $i<$vsystem_certificate_type_count;$i++) {
		if ( $vsystem_certificate_code[$i] == $str ) {
			$cstr = $vsystem_certificate_type[$i];
			break;
		}
	}
	return $cstr;
}

function getPageName() {
	return basename($_SERVER[PHP_SELF]);
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

// 환불 반환금액 적용
function refund_target($args=array()){
	if(!isset($args['start_date'])) $args['start_date'] = '';
	if(!isset($args['end_date'])) $args['end_date'] = '';
	if(!isset($args['complete_price'])) $args['complete_price'] = 0;
	if(!isset($args['target_date'])) $args['target_date'] = date("Y-m-d");
	if(!isset($args['chk_unit_yn'])) $args['chk_unit_yn'] = '';

	$result = array();
	if($args['chk_unit_yn']=='y'){

		$sdatetime = strtotime($args['start_date']); //강의시작일
		$edatetime = strtotime($args['end_date']); //강의종료일
		$rdatetime = strtotime($args['target_date']); //환불신청일
		$tdatetime = $edatetime-$sdatetime; //총강의시간
		//환불기준일

		//수업일수
		$study_date = ($rdatetime-$sdatetime)/60/60/24;
		$study_date = floor($study_date)+1;
		//전체일수
		$course_date = ($edatetime-$sdatetime)/60/60/24;
		$course_date = floor($course_date)+1;
		$one_sixth=floor($course_date/6)-1;
		$one_third=floor($course_date/3)-1;
		$half=floor($course_date/2)-1;
		//환불기준일
		$result['one_sixth']=date('Y-m-d',strtotime('+'.$one_sixth.'days',$sdatetime));	//	1/6기준일
		$result['one_third']=date('Y-m-d',strtotime('+'.$one_third.'days',$sdatetime));	//	1/3기준일
		$result['half']=date('Y-m-d',strtotime('+'.$half.'days',$sdatetime));		//	1/2기준일
		$one_sixth_gigan=$args['start_date']." ~ ".$result['one_sixth'];	//	시작일 ~ 1/6기준일
		$one_third_gigan=date('Y-m-d',strtotime('+1 days',strtotime($result['one_sixth'])))." ~ ".$result['one_third'];	//	1/6기준일 ~ 1/3기준일
		$half_gigan=date('Y-m-d',strtotime('+1 days',strtotime($result['one_third'])))." ~ ".$result['half'];	//	1/3기준일 ~ 1/2기준일
		$result['refund_date']=array('1/6'=>$one_sixth_gigan."_5/6환불",'1/3'=>$one_third_gigan."_2/3환불",'1/2'=>$half_gigan."_1/2환불");
		$add_price = 0; //남은개월의 학습비
		$result['study_term']=round(($study_date/$course_date),2)*100;
		//환불금액
		if($sdatetime>$rdatetime){ // 수업시작 전
			$result['refund_type'] = "전액환불";
			$result['refund_price'] = $args['complete_price'];
		}else if($edatetime<$rdatetime){ // 수업 끝
			$result['refund_type'] = "환불불가";
			$result['refund_price'] = 0;
		}else{
			//학위과정(학점은행제)
				if($result['target_date']<=$result['one_sixth']) {
					$result['refund_type'] = "5/6환불";
					$result['refund_price'] = (($args['complete_price'] / 6) * 5);
					$result['refund_price'] = $add_price + ceilp($result['refund_price']);
				} else if($result['target_date']<=$result['one_third']) {
					$result['refund_type'] = "2/3환불";
					$result['refund_price'] = (($args['complete_price'] / 3) * 2);
					$result['refund_price'] = $add_price + ceilp($result['refund_price']);
				} else if($result['target_date']<=$result['half']) {
					$result['refund_type'] = "1/2환불";
					$result['refund_price'] = (($args['complete_price'] / 2) * 1);
					$result['refund_price'] = $add_price + ceilp($result['refund_price']);
				} else {
					$result['refund_type'] = "환불불가";
					$result['refund_price'] = 0;
				}
		}


	}else{
		$result['refund_type'] = '환불불가';
		$result['refund_price'] = 0;
		$result['refund_price']=0;
		$result['target_date'] = $args['target_date'];
		$rdatetime = strtotime($args['target_date']);
		$sdatetime = strtotime($args['start_date']); //강의시작일
		$edatetime = strtotime($args['end_date']); //강의시작일
		$study_date = ($rdatetime-$sdatetime)/60/60/24;
		$study_date = floor($study_date)+1;
	//	$dategap = date_diff($sdatetime,$edatetime); php 버전때문에 안됨...5.3이상에서만 가능
		$total_date = ($edatetime-$sdatetime)/60/60/24;
		$total_date = floor($total_date)+1;
		$result['total_month'] = ceil($total_date/30);
		$monthly_pay = $args['complete_price']/$result['total_month'];
		$result['study_term']=round(($study_date/$total_date),2)*100;
		if($sdatetime>$rdatetime){ // 수업시작 전
			$result['refund_type'] = "전액환불";
			$result['refund_price'] = $args['complete_price'];
		}
		for($i=0;$i<$result['total_month'];$i++){
			if(!isset($result['start_date'][$i]))$result['start_date'][$i]=$sdatetime;
			$result['end_date'][$i]=strtotime('+1 months',$result['start_date'][$i]);
			$result['start_date_2'][$i]=date('Y-m-d',$result['start_date'][$i]);
			$result['months'][$i]=$i+1;

			if($result['end_date'][$i]>=$edatetime)$result['end_date'][$i]=$edatetime;
			$result['end_date_2'][$i]=date('Y-m-d',$result['end_date'][$i]);
			$course_date[$i] = ($result['end_date'][$i]-$result['start_date'][$i])/60/60/24;
			$result['course_date'][$i]=$course_date[$i];
			$add_third[$i] = floor($course_date[$i]/3)-1;
			$add_half[$i] = floor($course_date[$i]/2)-1;
			$result['one_third'][$i]=date('Y-m-d',strtotime('+'.$add_third[$i].'days',$result['start_date'][$i]));	//	1/3기준일
			$result['half'][$i]=date('Y-m-d',strtotime('+'.$add_half[$i].'days',$result['start_date'][$i]));		//	1/2기준일
			$result['one_third_price'][$i] =  number_format(floor((($monthly_pay/3*2) + ($monthly_pay*($result['total_month']-$result['months'][$i])))/100)*100);
			$result['one_third_price_type'][$i] = $result['months'][$i] . "번째달 2/3환불";
			$result['half_price'][$i] =  number_format(floor((($monthly_pay/2) + ($monthly_pay*($result['total_month']-$result['months'][$i])))/100)*100);
			$result['half_price_type'][$i] = $result['months'][$i] . "번째달 1/2환불";
			$result['over_price'][$i] =  number_format(floor(($monthly_pay*($result['total_month']-$result['months'][$i]))/100)*100);
			$result['over_price_type'][$i] = $result['months'][$i] . "번째달 1/2 기간 이후";
			
			if($result['target_date']<=$result['one_third'][$i]){
				if($rdatetime>=$result['start_date'][$i] && $rdatetime<=$result['end_date'][$i]){
					$result['refund_price']=$result['one_third_price'][$i];
					$result['refund_type']=$result['one_third_price_type'][$i];
				}
			}else if($result['one_third'][$i] < $result['target_date'] && $result['target_date']<=$result['half'][$i]){
				if($rdatetime>=$result['start_date'][$i] && $rdatetime<=$result['end_date'][$i]){
					$result['refund_price']=$result['half_price'][$i];
					$result['refund_type']=$result['half_price_type'][$i];
				}
			}else{
				if($rdatetime>=$result['start_date'][$i] && $rdatetime<=$result['end_date'][$i]){
					$result['refund_price']=$result['over_price'][$i];
					$result['refund_type']=$result['over_price_type'][$i];
				}
			}
			
			$result['start_date'][$i+1]=$result['end_date'][$i];
		}

	}
	return $result;
}

function refund_target2($args=array()){
	global $objdb;
	if(!isset($args['idx'])) $args['idx'] = 0;
	if(!isset($args['one_price'])) $args['one_price'] = 0;
	if(!isset($args['complete_price'])) $args['complete_price'] = 0;
	if(!isset($args['target_date'])) $args['target_date'] = date("Y-m-d");

	$result = array();

	$result['chul_cnt'] = 0;
	$result['deduction'] = 0;
	$result['refundPrice'] = 0;

	$sql = "select ndate from lms_class_schedule2 where courseid=(select courseid from lms2_coursetake where account_idx=".$args['idx'].")";
	//echo $sql;
	$results=$objdb->sqlResult($sql);

	$i=0;
	foreach($results as $rowIdx=>$row){
		foreach($row as $fieldname=>$val){				
			${"var_".$fieldname}[$i] = nullbnk($val);
		}
		$i++;
	}
	$vcnt = ecount($var_ndate);

	for($i=0; $i<$vcnt; $i++){
		if($var_ndate[$i] <= $args['target_date']){
			$result['chul_cnt']++;
		}	
	}
	$result['deduction'] = $args['one_price'] * $result['chul_cnt'];
	$result['refundPrice'] = $args['complete_price'] - $result['deduction'];	

	return $result;
}



function num2han($NUM){
	$aNum  = array('', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구');
	$unitF = array('', '만', '억', '조', '경');
	$unitO = array('', '십', '백', '천');
	$aRs   = array();
	$NUM = str_replace(',','',$NUM);
	$splitF = str_split(strrev((string)$NUM),4);

	for($i=0;$i<ecount($splitF);$i++){
		$aTemp  = array();
		$splitO = str_split((string)$splitF[$i], 1);

		for($j=0;$j<ecount($splitO);$j++){
			$u    = (int)$splitO[$j];
			if($u > 0) $aTemp[] = $aNum[$u].$unitO[$j];
		}
		if(ecount($aTemp) > 0) $aRs[] = implode('', array_reverse($aTemp)).$unitF[$i];
	}
	return implode('', array_reverse($aRs));
}

function formauth($args=array()){
	if(!isset($args['file'])) $args['file'] = '';
	if(!isset($args['title'])) $args['title'] = '';
	if(!isset($args['target'])) $args['target'] = '';
	if(!isset($args['idx'])) $args['idx'] = '';
	$target = explode(',',$args['target']);

	$sysMenuAuthFile = "/nGmaster/form/".$args['file']; //권한 설정 파일
	$result = array();
	$result['mode'] = '';
	$result['errnum'] = 0;
	$result['msg'] = "";
	$result['isDelete'] = true;
	$result['isWrite'] = true;
	$result['isModify'] = true;
	$result['isRead'] = true;
	$result['Deletemsg'] = '';
	$result['Writemsg'] = '';
	$result['Modifymsg'] = '';
	$result['Readmsg'] = '';
	$result['file'] = $sysMenuAuthFile;

	$result['isDelete'] = sysMenuAuth("remove");
	$result['isWrite'] = sysMenuAuth("write");
	$result['isModify'] = sysMenuAuth("modify");
	$result['isRead'] = sysMenuAuth("read");

	if($result['isDelete']==false) $result['Deletemsg'] = "삭제권한이 높아서 삭제할 수 없습니다.[".$args['title']."] " . date("Y.m.d H:i:s");
	if($result['isWrite']==false) $result['Writemsg'] = "등록권한이 없어서 등록하실 수 없습니다.[".$args['title']."]" . date("Y.m.d H:i:s");
	if($result['isModify']==false) $result['Modifymsg'] = "수정권한이 높아서 수정하실 수 없습니다.[".$args['title']."]" . date("Y.m.d H:i:s");
	if($result['isRead']==false) $result['Readmsg'] = "읽기권한이 높아서 읽을 없습니다.[".$args['title']."] " . date("Y.m.d H:i:s");

	//삭제
	if(in_array('delete',$target) && $result['isDelete']==false && $args['idx']!=''){
		$result['mode'] = "";
		$result['msg'] = $result['Deletemsg'];
		$result['errnum']++;
	}
	//등록
	if(in_array('write',$target) && $result['isWrite']==false && $args['idx']==''){
		$result['mode'] = "";
		$result['msg'] = $result['Writemsg'];
		$result['errnum']++;
	}
	//수정
	if(in_array('modify',$target) && $result['isModify']==false && $args['idx']!=''){
		$result['mode'] = "";
		$result['msg'] = $result['Modifymsg'];
		$result['errnum']++;
	}
	//읽기
	if(in_array('read',$target) && $result['isRead']==false){
		$result['mode'] = "";
		$result['msg'] = $result['Readmsg'];
		$result['errnum']++;
	}

	return $result;
}


function get_classcode($args=array()){
	global $objdb;
	$alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

	if(!isset($args['nyear'])) $args['nyear'] = date('Y');
	if(!isset($args['unit_idx'])) $args['unit_idx'] = '';
	if(!isset($args['major_idx'])) $args['major_idx'] = '';
	if($args['nyear']=='') $args['nyear']=0;

	$sql="select  cnt, type from lms2_class_code where nyear=".$args['nyear'];
	if($args['unit_idx']!='') $sql .= " and unit_idx=".$args['unit_idx'];
	if($args['major_idx']!='') $sql .= " and major_idx=".$args['major_idx'];
	$sql .= " order by class_code_idx desc";
	//echo $sql;
	$result=$objdb->sqlResult($sql);
	
	if(isset($_result)){
		foreach($_result as $rowIdx=>$row){
			foreach($row as $fieldname=>$val){
				
				
				${"vclass_".$fieldname} = nullbnk($val);
			}
		}
	}

/*
for($j=0;$j<$vsystem_class_count;$j++){
	<option value="<?=$vsystem_class_code[$j]?>"><?=$vsystem_class_name[$j]?></option>
  }
  */
	$result = array();
	if(isset($vclass_cnt)){
		for($i=0;$i<$vclass_cnt;$i++){
			if($vclass_type=='c') $result[$i] = $alphabet[$i];
			else  $result[$i] = ($i+1);
		}
	}

	return $result;
}


//전공
function get_major($args=array()){
	global $objdb;

	$major = array();
	$sql="select major_idx, major_name from lms2_major order by major_name asc";
	$result=$objdb->sqlresult($sql);
	foreach($result as $rowIdx=>$row){
		$major[nullbnk($row['MAJOR_IDX'])] = nullbnk($row['MAJOR_NAME']);
	}
	return $major;
}

//관리자 접근메뉴 (array 처리)
function getArrStr($arr){
	$str = '';
	if(!empty($arr)){//2020-09-23
	foreach ($arr as &$value) {
		$str .= "$value,";
	}
	}
	$str = left($str,strlen($str)-1);
	return $str;
}
//관리자 접근메뉴
function sysConnectLog($tasks, $updatemode, $keyfield, $keyword, $auth, $menuurl){
	global $objdb, $sess_userid, $sess_name, $client_ip;

	if($tasks=="관리자입력"){
		if($keyword!="") {// 넘어오는 데이터 한개
			$sql = "select name, member_gigwan, member_level from lms_member where userid = '$keyword'";
			$result=$objdb->sqlResult($sql);
			$i=0;
			foreach($result as $rowIdx=>$row){
				foreach($row as $fieldname=>$val){
					${"log_".$fieldname}[$i] = nullbnk($val);
				}
				$i++;
			}
			$tasks = $tasks."|id:".$keyword;
			$tasks = $tasks."|name:".$log_name[0];
			$tasks = $tasks."|dep:".$log_member_gigwan[0];
			$tasks = $tasks."|level:".$log_member_level[0];
		}
		//$tasks = $tasks."|관리자ID:".$_SESSION['_SESSION_USERID'];
		//echo $tasks."<br>";

		//exit;
	}

	$regist_url = $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];

	$regist_urls = str_replace("|*","/",$regist_url);
	$regist_urls = str_replace("&","|",$regist_urls);
	$regist_urls = str_replace("?","/",$regist_urls);
	$regist_urls = str_replace("=",":",$regist_urls);
	//$regist_urls = htmlspecialchars($regist_urls);
	$regist_urls = htmlspecialchars($regist_urls, ENT_COMPAT,'UTF-8', true);
	$regist_urls = strip_tags($regist_urls);
	$regist_urls = left($regist_urls,255);

	$tasks = $tasks."|모드:".$updatemode;

	if($keyword!="") $tasks = $tasks."|필드:".$keyfield."|검색어:".$keyword;

	if($menuurl!="") {
		$sql = "select menuname from uzn_manager_menu where menuurl='$menuurl'";
		$menuname = $objdb->sqlRowOne($sql);
		$tasks = $menuname."|".$tasks;
	}

	$tasks = str_replace("'", "", $tasks);
	$tasks = left($tasks,255);

	$sql = "select count(*) from uzn_sysconnect_log where userid='$sess_userid' and client_ip='$client_ip' and regist_url='$regist_urls' and to_days(regist_date)=to_days(now()) and tasks='$tasks'";
	$logCount = $objdb->sqlRowOne($sql);
	if($logCount<=0){
		$log_idx =  $objdb->sqlSeq("uzn_sysconnect_log");
		$sql = "insert into uzn_sysconnect_log(log_idx,userid,user_name,regist_date,client_ip,regist_url,tasks,auth) values($log_idx,'$sess_userid','$sess_name',now(),'$client_ip','$regist_urls','$tasks','$auth')";
		$objdb->sqlExe($sql);
	}

}
function sysConnectLog2($tasks, $updatemode, $keyfield, $keyword, $auth, $menuurl, $sub_menu){
	global $objdb, $sess_userid, $sess_name, $client_ip, $vsystem_menu_group;

	if($tasks=="관리자입력"){
		if($keyword!="") {// 넘어오는 데이터 한개
			$sql = "select name, member_gigwan, member_level from lms_member where userid = '$keyword'";
			$result=$objdb->sqlResult($sql);
			$i=0;
			foreach($result as $rowIdx=>$row){
				foreach($row as $fieldname=>$val){
					${"log_".$fieldname}[$i] = nullbnk($val);
				}
				$i++;
			}
			$tasks = $tasks."|id:".$keyword;
			$tasks = $tasks."|name:".$log_name[0];
			$tasks = $tasks."|dep:".$log_member_gigwan[0];
			$tasks = $tasks."|level:".$log_member_level[0];
		}
		//$tasks = $tasks."|관리자ID:".$_SESSION['_SESSION_USERID'];
		//echo $tasks."<br>";

		//exit;
	}
/*
	if($tasks=="관리자열람"){
		if($keyword!="") {// 넘어오는 데이터 한개
			$sql = "select name, userid from lms_member where userid = '$keyword'";
			$result=$objdb->sqlResult($sql);
			$i=0;
			foreach($result as $rowIdx=>$row){
				foreach($row as $fieldname=>$val){
					${"log_".$fieldname}[$i] = nullbnk($val);
				}
				$i++;
			}
			$tasks = $tasks."|idx:".$keyword;
			$tasks = $tasks."|id:".$log_userid[0];
			$tasks = $tasks."|name:".$log_nam3[0];

		}
	}
*/

	$regist_url = $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];

	$regist_urls = str_replace("|*","/",$regist_url);
	$regist_urls = str_replace("&","|",$regist_urls);
	$regist_urls = str_replace("?","/",$regist_urls);
	$regist_urls = str_replace("=",":",$regist_urls);
	//$regist_urls = htmlspecialchars($regist_urls);
	$regist_urls = htmlspecialchars($regist_urls, ENT_COMPAT,'UTF-8', true);
	$regist_urls = strip_tags($regist_urls);
	$regist_urls = left($regist_urls,255);

	$tasks = $tasks."|모드:".$updatemode;

	if($keyword!="") $tasks = $tasks."|필드:".$keyfield."|검색어:".$keyword;

	if($menuurl!="") {
		$sql = "select menuname from uzn_manager_menu where menuurl='$menuurl'";
		$menuname = $objdb->sqlRowOne($sql);
		$tasks = $menuname."|".$tasks;
		$sql = "select menugroup from uzn_manager_menu where menuurl='$menuurl'";
		$menugroup = $objdb->sqlRowOne($sql);
		foreach($vsystem_menu_group as $key => $val){
			if($menugroup == $key){
				$menugroup_name = $val;
			}		
		}
		if(!empty($sub_menu)){
			$menu_dir = $menugroup_name.' -> '.$menuname.' -> '.$sub_menu;
		}else{
			$menu_dir = $menugroup_name.' -> '.$menuname;
		}
	}

	$tasks = str_replace("'", "", $tasks);
	$tasks = left($tasks,255);

	$sql = "select count(*) from uzn_sysconnect_log where userid='$sess_userid' and client_ip='$client_ip' and regist_url='$regist_urls' and to_days(regist_date)=to_days(now()) and tasks='$tasks'";
	$logCount = $objdb->sqlRowOne($sql);
	if($logCount<=0){
		$log_idx =  $objdb->sqlSeq("uzn_sysconnect_log");
		$sql = "insert into uzn_sysconnect_log(log_idx,userid,user_name,regist_date,client_ip,regist_url,tasks,auth,menu_dir) values($log_idx,'$sess_userid','$sess_name',now(),'$client_ip','$regist_urls','$tasks','$auth','$menu_dir')";
		$objdb->sqlExe($sql);
	}

}

function set_courseSub_nclass($coursesubid){
	global $objdb;
	$sql = "select idx from lms_class_schedule2 where courseid=$coursesubid order by ndate,timetxt";
	$result=$objdb->sqlResult($sql);
	
	
	$i=0;
	if(isset($_result)){
		foreach($_result as $rowIdx=>$row){
			foreach($row as $fieldname=>$val){
				
				
				${"var_".$fieldname}[$i] = nullbnk($val);
				}
			$i++;
		}
	}

	$var_cnt = ecount($var_idx);
	for($k=0;$k<$var_cnt;$k++){
		$sql = "update lms_class_schedule2 set nclass='".($k+1)."' where courseid=$coursesubid and idx=".$var_idx[$k];
		$objdb->sqlExe($sql);
	}
}

function getAccountynName($state){
	$result = '';
	if($state=='y')$result='승인';
	else if($state=='n')$result='미승인';
	else $result='-';

	return $result;
}

function chk_consult($courseid,$userid,$user_type){
	global $objdb;
	$cnt = 0;
	$result = false;
	if($user_type=='student'){
		$sql = "select count(*) from lms2_coursetake where coursetake_state in (3) and courseid=$courseid and userid='".$userid."'";
		$cnt = $objdb->sqlRowOne($sql);
	}else{
		$sql = "select count(*) from lms_class_schedule2 where courseid=$courseid and teacherid='".$userid."'";
		$cnt = $objdb->sqlRowOne($sql);
	}
	if($cnt>0)$result = true;
	return $result;
}

function chk_coursetake($userid,$branch_idx,$major_idx){
	/*
	global $objdb;
	if(empty($branch_idx))$branch_idx=0;
	if(empty($major_idx))$major_idx=0;
	$sql = "select count(*) from lms2_coursetake where userid='".$userid."'";
	$cnt = $objdb->sqlRowOne($sql);
	if($cnt==0){
		$sql = "update lms_member set branch_idx='".$branch_idx."', major_idx='".$major_idx."' where userid='".$userid."'";
		$objdb->sqlExe($sql);
	}
	*/
}


//2021-12-28
function getDupinfoName ($str) {
	global $vsystem_chkreal_type,$vsystem_chkreal_type_name,$vsystem_chkreal_type_count;
	
	for ($i=0; $i<$vsystem_chkreal_type_count;$i++) {
		if ( $vsystem_chkreal_type[$i] == $str ) {
			$str = $vsystem_chkreal_type_name[$i];
			break;
		}
	} return $str;
}

if(!function_exists('getResultAvgLevelGrade')){
function getResultAvgLevelGrade($levelresult){
	global $objdb;

	$sql = "select grade from lms2_resultbase where level_result='" . $levelresult . "' limit 1";
	$r = $objdb->sqlRowOne($sql);
	return $r;
}
}

if(!function_exists('pagingHomepage')){
	function pagingHomepage($args=array()){
		ob_start();
		//$args['pagesize']=1;

		if(empty($args['bbsid'])) $args['bbsid'] = '';
		if(empty($args['bbsid'])) $args['bbsid'] = '';

		if(empty($args['pageno'])) $args['pageno']=1;
		if(empty($args['pagesize'])) $args['pagesize']=15;
		if(empty($args['blocksize'])) $args['blocksize'] = 10;
		if(empty($args['t_rows'])) $args['t_rows'] = 0;
		
		$qstr = $args['qstr'];

		$lastpgno = 0;
		$pageno = $args['pageno'];
		$pagesize = $args['pagesize'];
		$blocksize = $args['blocksize'];

		$keyword = $args['keyword'];
		$keyfield = $args['keyfield'];

		if($args['pagesize']>0){
			$lastpgno=ceil($args['t_rows']/$args['pagesize']);
		}

		if(empty($args['view_block'])) $args['view_block'] = false;
		
		$parameter_add = '';
		if(!empty($args['category'])){
			$parameter_add .= '&category=' . $args['category'];
		}
?>
		<?if($lastpgno!=0){?>
			<?if($args['view_block']){?>
				<?if($pageno==1){?>
					<li class="arrow first" title="처음"><a href="javascript:"></a></li>
				<?}else if($pageno>1){ ?>
					<li class="arrow first" title="처음"><a  href="<?=$_self?>?pageno=1&keyfield=<?=$keyfield?>&keyword=<?=$keyword?>&category=<?=$category?><?=$parameter_add?>"></a></li>
				<?}?>
			<?}?>
			<?if($pageno>$blocksize){
				$prevpage=floor(($pageno-1)/$blocksize)*$blocksize;
			?>
				<li class="arrow prev" title="이전"><a href="<?=$_self?>?pageno=<?=$prevpage?>&keyfield=<?=$keyfield?>&keyword=<?=$keyword?>&category=<?=$category?><?=$parameter_add?>"></a></li>

			<?}else{?>
				<li class="arrow prev" title="이전"><a href="#"></a></li>
			<?}?>
			
			<?
			$i=0;
			$startpage = floor(($pageno-1)/$blocksize)*$blocksize+1;
			while($i<$blocksize && $startpage<=$lastpgno) {
			?>
				<?if($pageno<>$startpage){?>
					<li><a href="<?=$_self?>?pageno=<?=$startpage?>&keyfield=<?=$keyfield?>&keyword=<?=$keyword?>&category=<?=$category?><?=$parameter_add?>">
					<?=$startpage?></a></li>
				<?}else{?>
					<li class="on"><a href="#none"><?=$startpage?></a></li>
				<?}?>
			<?
				$i++;
				$startpage=$startpage+1;
			}
			$nextpage=floor(($pageno-1)/$blocksize)*$blocksize+$blocksize+1;
			?>

			<?if($nextpage<=$lastpgno){?>
				<li class="arrow next" title="다음"><a   href="<?=$_self?>?pageno=<?=$nextpage?>&keyfield=<?=$keyfield?>&keyword=<?=$keyword?>&category=<?=$category?><?=$parameter_add?>"></a></li>

			<?}else{?>
				<li class="arrow next" title="다음"><a href="#"></a></li>
			<?}?>
			
			<?if($args['view_block']){?>
				<?if($lastpgno==$pageno){?>
					<li class="arrow last" title="마지막"><a href="#"></a></li>
				<?}else{?>
					<li class="arrow last" title="마지막"><a  href="<?=$_self?>?pageno=<?=$lastpgno?>&keyfield=<?=$keyfield?>&keyword=<?=$keyword?>&category=<?=$category?><?=$parameter_add?>"></a></li>
				<?}?>
			<?}?>
		<?
		}else {
		?>
					<li class="arrow prev" title="이전"><a href="#"></a></li>
					<li class="on"><a href="<?=$_self?>">1</a></li>
					<li class="arrow next" title="다음"><a href="#"></a></li>
		<?}?>
<?php
		$html = ob_get_contents();
		ob_end_clean();	
		return $html;	
	}
}

if(!function_exists('pagingTeacherpage')){
	function pagingTeacherpage($args=array()){
		ob_start();
		//$args['pagesize']=1;

		if(empty($args['bbsid'])) $args['bbsid'] = '';
		if(empty($args['bbsid'])) $args['bbsid'] = '';

		if(empty($args['pageno'])) $args['pageno']=1;
		if(empty($args['pagesize'])) $args['pagesize']=15;
		if(empty($args['blocksize'])) $args['blocksize'] = 10;
		if(empty($args['t_rows'])) $args['t_rows'] = 0;
		
		$qstr = $args['qstr'];

		$lastpgno = 0;
		$pageno = $args['pageno'];
		$pagesize = $args['pagesize'];
		$blocksize = $args['blocksize'];

		$keyword = $args['keyword'];
		$keyfield = $args['keyfield'];

		if($args['pagesize']>0){
			$lastpgno=ceil($args['t_rows']/$args['pagesize']);
		}

		if(empty($args['view_block'])) $args['view_block'] = false;
		
		$parameter_add = $args['qrystring'];
		if(!empty($args['category'])){
			$parameter_add .= '&category=' . $args['category'];
		}
?>
		<?if($lastpgno!=0){?>
			<?if($args['view_block']){?>
				<?if($pageno==1){?>
					<a href="javascript:" class="arrow first"></a>
				<?}else if($pageno>1){ ?>
					<a  href="<?=$_self?>?pageno=1&keyfield=<?=$keyfield?>&keyword=<?=$keyword?>&category=<?=$category?><?=$parameter_add?>"  class="arrow first"></a>
				<?}?>
			<?}?>
			<?if($pageno>$blocksize){
				$prevpage=floor(($pageno-1)/$blocksize)*$blocksize;
			?>
				<a class="arrow prev"  href="<?=$_self?>?pageno=<?=$prevpage?>&keyfield=<?=$keyfield?>&keyword=<?=$keyword?>&category=<?=$category?><?=$parameter_add?>"></a>

			<?}else{?>
				<a class="arrow prev" href="#"></a>
			<?}?>
			
			<?
			$i=0;
			$startpage = floor(($pageno-1)/$blocksize)*$blocksize+1;
			while($i<$blocksize && $startpage<=$lastpgno) {
			?>
				<?if($pageno<>$startpage){?>
					<a href="<?=$_self?>?pageno=<?=$startpage?>&keyfield=<?=$keyfield?>&keyword=<?=$keyword?>&category=<?=$category?><?=$parameter_add?>">
					<?=$startpage?></a></li>
				<?}else{?>
					<a class="active" href="#none"><?=$startpage?></a></li>
				<?}?>
			<?
				$i++;
				$startpage=$startpage+1;
			}
			$nextpage=floor(($pageno-1)/$blocksize)*$blocksize+$blocksize+1;
			?>

			<?if($nextpage<=$lastpgno){?>
				<a  class="arrow next"   href="<?=$_self?>?pageno=<?=$nextpage?>&keyfield=<?=$keyfield?>&keyword=<?=$keyword?>&category=<?=$category?><?=$parameter_add?>"></a>

			<?}else{?>
				<a class="arrow next" href="#"></a>
			<?}?>
			
			<?if($args['view_block']){?>
				<?if($lastpgno==$pageno){?>
					<a class="arrow last" href="#"></a>
				<?}else{?>
					<a class="arrow last"  href="<?=$_self?>?pageno=<?=$lastpgno?>&keyfield=<?=$keyfield?>&keyword=<?=$keyword?>&category=<?=$category?><?=$parameter_add?>"></a>
				<?}?>
			<?}?>
		<?
		}else {
		?>
					<a class="arrow prev" href="#"></a>
					<a class="active" href="<?=$_self?>">1</a>
					<a class="arrow next" href="#"></a>
		<?}?>
<?php
		$html = ob_get_contents();
		ob_end_clean();	
		return $html;	
	}
}

//홈페이지 접근시 비회원 회원 카운트
if(!function_exists('addaccesslog')){
	function addaccesslog($g_user_ip,$sess_userid){
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
//이수확인증등 이수여부 체크
function getFinishStateName($infinish_yn,$infinishstate,$inchk_unit){
	$r_value = "";
	if ($inchk_unit=="y"){
		if ($infinishstate=="0" || empty($infinishstate)){
			if ($infinish_yn=="y" || empty($infinish_yn)) $r_value="이수가능";
			else $r_value="이수불가능";
		}else{
			$r_value="이수";
		}
	}else{
		if ($infinishstate=="0" || empty($infinishstate)){
			if ($infinish_yn=="y" || empty($infinish_yn)) $r_value="수료가능";
			else $r_value="수료불가능";
		}else{
			$r_value="수료";
		}
	}
	return $r_value;
}

//이수확인증등 이수여부 체크
//수료 사용하지 않고 이수만 사용한다고 해서 inchk_unit값 제외하고 사용하도록 설정
function getFinishStateName2($infinish_yn,$infinishstate){
	$r_value = "";
	if ($infinishstate=="0" || empty($infinishstate)){
		if ($infinish_yn=="y" || empty($infinish_yn)) $r_value="이수가능";
		else $r_value="이수불가능";
	}else{
		$r_value="이수";
	}
	return $r_value;
}

function getadminauth($userid){
	global $objdb;

	$sql = "select member_level from lms_member where userid='".$userid."' and user_type='manager'";
	$member_level = $objdb->sqlRowOne($sql);

	$sql = "select authlevel_name from uzn_authlevel where authlevel=".$member_level;
	$AuthLevelName = $objdb->sqlRowOne($sql);

	return $AuthLevelName;
}

function getGigwanName($gigwan_idx){
	global $objdb;

	$sql = "select systemcode_value from uzn_systemcode where systemcode_code='GIGWAN_MANAGEMENT' and systemcode_idx=".$gigwan_idx;
	$member_gigwan = $objdb->sqlRowOne($sql);

	return $member_gigwan;

}