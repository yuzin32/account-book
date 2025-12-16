<? /* 한글 */ ?>
<?
/**************************************************/
// 공통 변수, 상수, 코드
/**************************************************/
//캐릭터셋
$charset = 'utf8';
$charsetajax = 'utf-8';

$start_year = 1999;
$end_year = date("Y")+1;

//짧은 환경변수를 지원하지 않는다면
if (isset($HTTP_POST_VARS) && !isset($_POST))
{
	$_POST   = &$HTTP_POST_VARS;
	$_GET    = &$HTTP_GET_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	$_COOKIE = &$HTTP_COOKIE_VARS;
	$_ENV    = &$HTTP_ENV_VARS;
	$_FILES  = &$HTTP_POST_FILES;

    if (!isset($_SESSION)) $_SESSION = &$HTTP_SESSION_VARS;
}
//인젝션 방지
function getSQL($str){
	//$str = str_replace(' aqqqq ',' and ',$str);
	$str = str_replace('PERCENTIN','%',$str);
	$str = str_replace('WHIN',' where ',$str);
	$str = str_replace('ANIN',' and ',$str);
	$str = str_replace('OOIN','or',$str);
	$str = str_replace('LIIN',' like ',$str);
	$str = str_replace('EQIN','=',$str);
	$str = str_replace('ODDIN',' order ',$str);
	$str = str_replace('GROIN',' group ',$str);
	$str = str_replace('BIIN',' by ',$str);
	$str = str_replace('HAIN',' having ',$str);
	$str = str_replace('SELIN','select ',$str);
	$str = str_replace('FROIN',' from ',$str);

	$str = str_replace('GTIN','>',$str);
	$str = str_replace('LTIN','<',$str);

	$str = str_replace('&lt;','<',$str);
	$str = str_replace('&gt;','>',$str);
	$str = str_replace('STYIN','style',$str);

	$str = str_replace("&quot;","'",$str);
	$str = str_replace("&amp;","&",$str);

	//echo $str. '<br>';
	return $str;
}

function anti($args){
	//%3Cscript%3Ealert(2)%3C/script%3E
	//$args = str_replace("\\","",$args);
	$args = str_replace("&lt;","<",$args);
	$args = str_replace("&gt;",">",$args);
	$args = str_replace("&amp;","&",$args);
	$args = str_replace("&quot;",'"',$args);
	$args = str_replace("&#39;","'",$args);

	$args=preg_replace("!<script(.*?)<\/script>!is","",$args); 
 	$args=preg_replace("!<embed(.*?)<\/embed>!is","",$args); 
	$args=preg_replace("!<object(.*?)<\/object>!is","",$args); 
	$args=preg_replace("!<applet(.*?)<\/applet>!is","",$args); 
	//$args=preg_replace("!<iframe(.*?)<\/iframe>!is","",$args); 
	
	//style 미사용시 코드 넣음(팝업창에서 사용하여 지움)
	$args = preg_replace('@<(\/?(?:html|body|head|title|meta|base|link|script|applet)(/*).*?>)@i', '&lt;$1', $args);

	$args = preg_replace('@<(/?)([a-z]+[0-9]?)((?>"[^"]*"|\'[^\']*\'|[^>])*?\b(?:on[a-z]+|data|(?:dyn|low))\s*=[\s\S]*?)(/?)($|>|<)@i', '', $args);

 	return $args;
}
function sql_special_enc($args){
	$args = str_replace("&","&amp;",$args);
	$args = str_replace('"',"&quot;",$args);
	$args = str_replace("'","&#39;",$args);
	return $args;
}

 function clear($filter){
	$filter=getSQL($filter);
	$filter=anti($filter);
	$filter=sql_special_enc($filter);
	return $filter;
}

	if( is_array($_GET) )
	{
		foreach ($_GET as $k => $v) 
		{
			if( is_array($_GET[$k]) )
			{
				foreach ($_GET[$k] as $k2 => $v2) 
				{
					$_GET[$k][$k2] = clear($v2);
				}
				reset($_GET[$k]);
			}
			else
			{
				$_GET[$k] = clear($v);
				${$k} = clear($v);
			}
		}
		reset($_GET);
	}

	if( is_array($_POST) )
	{
		foreach ($_POST as $k => $v) 
		{
			if( is_array($_POST[$k]) )
			{
				foreach ($_POST[$k] as $k2 => $v2) 
				{
					$_POST[$k][$k2] = clear($v2);
				}
				reset($_POST[$k]);
			}
			else
			{
				$_POST[$k] = clear($v);
				${$k} = clear($v);
			}
		}
		reset($_POST);
	}

	if( is_array($_COOKIE) )
	{
		foreach ($_COOKIE as $k => $v) 
		{
			if( is_array($_COOKIE[$k]) )
			{
					foreach ($_COOKIE[$k] as $k2 => $v2) 

				{
					$_COOKIE[$k][$k2] = clear($v2);
				}
				reset($_COOKIE[$k]);
			}
			else
			{
				$_COOKIE[$k] = clear($v);
			}
		}
		reset($_COOKIE);
	}

// PHP 4.1.0 부터 지원됨
// php.ini 의 register_globals=off 일 경우
// extract 배열의 키를 변수명으로, 값을 변수의 값으로 변환
extract($_GET);
extract($_POST);
extract($_SERVER);

/**************************************************/
// 세션 정의
/**************************************************/
$sess_userid = (isset($_SESSION["_SESSION_USERID"]))?$_SESSION["_SESSION_USERID"]:''; //아이디
$sess_usertype = (isset($_SESSION["_SESSION_USERTYPE"]))?$_SESSION["_SESSION_USERTYPE"]:''; //회원구분
$sess_name = (isset($_SESSION["_SESSION_USERNAME"]))?$_SESSION["_SESSION_USERNAME"]:''; //이름
$sess_email = (isset($_SESSION["_SESSION_USEREMAIL"]))?$_SESSION["_SESSION_USEREMAIL"]:''; //메일
$sess_memberlevel = (isset($_SESSION["_SESSION_MEMBERLEVEL"]))?$_SESSION["_SESSION_MEMBERLEVEL"]:''; //회원등급

$client_ip = $_SERVER["REMOTE_ADDR"]; //아이피
$browser = substr($_SERVER["HTTP_USER_AGENT"],0,250); //브라우저 정보

/**************************************************/
// 공통 변수, 상수, 코드
/**************************************************/

//현재 페이지 정보
$_SELF = $_SERVER["PHP_SELF"];
$_self = $_SERVER["PHP_SELF"];
$_SELFQ = $_SERVER["REQUEST_URI"];
$_selfq = $_SERVER["REQUEST_URI"];
$self_urlstr = $_SERVER["QUERY_STRING"];
//$_req_url = $_SERVER["REQUEST_URI"];
$_req_url = $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];
$_self_name = basename($_SERVER['PHP_SELF']);
$_self_gname= substr($_self_name, 0, 2);

//phpinfo
if (!empty($phpinfo)) echo phpinfo();

//edit
$Server = $_SERVER["SERVER_NAME"];
$Port   = $_SERVER["SERVER_PORT"];
$UploadPage = "js/upload.php";
$Replacepath = "http://".$Server. ":$Port/upload/";
$save_dir = $_syspath."/upload/";
$LimitSize=0;

$_urlpath = "http://";
if(!empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"]=='on') $_urlpath = "https://";
$_urlpath .= $_SERVER["SERVER_NAME"];
if ($_SERVER["SERVER_PORT"]!='80') $_urlpath.=":".$_SERVER["SERVER_PORT"];

if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))
    $referer=$_SERVER['HTTP_REFERER'];
else
    $referer="";

//게시판 파일업로드 폴더
$_file_upload_folder = $_syspath . "/upload"; // 파일업로드 루트(숨김폴더)
$_bbs_fileupload_folder = $_file_upload_folder. "/bbs/"; // 게시판 업로드
$_member_fileupload_folder = $_file_upload_folder . "/member/"; //회원정보 업로드
$_popup_fileupload_folder = $_file_upload_folder . "/popup/"; //팝업파일 폴더
$_htmlarea_fileupload_folder = $_file_upload_folder . "/htmlarea/"; //웹에디터 업로드
$_excel_fileupload_folder = $_file_upload_folder . "/excel/"; //엑셀 업로드

$_open_upload_url = "/upload/";
$_htmlarea_fileupload_url = $_open_upload_url."/htmlarea/"; //웹에디터 주소
$_member_upload_url = $_open_upload_url."/member/"; //회원정보 폴더
$_popup_upload_url = $_open_upload_url."popup/"; //팝업파일 폴더
$_excel_upload_url = $_open_upload_url . "/excel/"; //엑셀 폴더
$_popup_html_url = $_popup_upload_url; 
//게시판소스 폴더
$_bbs_syspath = $_syspath."/lms_bbs/";
$_bbs_urlpath = "/lms_bbs/";
$skindir = "skin";
if(!isset($PageSize) || $PageSize=='') $PageSize = 10;	//페이지수

//회원구분
$vSystem_member_type[] = "student";
$vSystem_member_type[] = "jae";
$vSystem_member_type[] = "normal";
$vSystem_member_type[] = "study";
$vSystem_member_type[] = "auditor";
$vSystem_member_type[] = "teacher";
$vSystem_member_type[] = "manager";

//결제코드지원
//$str_account_type = "card,cash,nbank,dbank2,dbank3,abank,online,phone";
//$str_account_type_name = "카드,현금,무통장,분할2개월,분할3개월,가상계좌,온라인예약,핸드폰결제";
$vSystem_account_type = array(
	0=>'지출',
	1=>'수입',
	);

// 이메일뒷자리
$vSystem_email_back = array(
	"naver.com",
	"daum.net",
	"hanmail.net",
	"gmail.com",
	"hotmail.com",
	"dreamwiz.com",
	"freechal.com",
	"hanmir.com"
);

$system_langs['kor'] = '한국어';
$system_langs['eng'] = '영어';
$system_langs_cnt = count($system_langs);

function getNationlist($isEn) {
	if(!isset($isEn)) $isEn = false;

	if($isEn) {
		return array(
			"KR" => "Korea", "AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AA" => "American Samoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AG" => "Antigua and Barbuda", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AC" => "Ascension Island", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "Bosnia and Herzegovina", "BW" => "Botswana", "BV" => "Bouvet Island", "BR" => "Brazil", "IO" => "British Indian Ocean Territory", "BN" => "Brunei", "BG" => "Bulgaria", "BF" => "Burkina Faso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "Cape Verde", "KY" => "Cayman Islands", "CF" => "Central African Republic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "Christmas Island", "CC" => "Cocos (Keeling) Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo (DRC)", "CK" => "Cook Islands", "CR" => "Costa Rica", "CI" => "Cote d'Ivoire", "HR" => "Croatia", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "Czech Republic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DR" => "Dominican Republic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "El Salvador", "GQ" => "Equatorial Guinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "Falkland Islands (Islas Malvinas)", "FO" => "Faroe Islands", "FJ" => "Fiji Islands", "FI" => "Finland", "FR" => "France", "GF" => "French Guiana", "PF" => "French Polynesia", "TF" => "French Southern and Antarctic Lands", "GA" => "Gabon", "GM" => "Gambia, The", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GG" => "Guernsey", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "Heard Island and McDonald Islands", "HN" => "Honduras", "HK" => "Hong Kong SAR", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran", "IQ" => "Iraq", "IE" => "Ireland", "IM" => "Isle of Man", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JE" => "Jersey", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "Laos", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "Libya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macao SAR", "MK" => "Macedonia, Former Yugoslav Republic of", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "Marshall Islands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia", "MD" => "Moldova", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "Netherlands Antilles", "NC" => "New Caledonia", "NZ" => "New Zealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "Norfolk Island", "KP" => "North Korea", "MP" => "Northern Mariana Islands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PS" => "Palestinian Authority", "PA" => "Panama", "PG" => "Papua New Guinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn Islands", "PL" => "Poland", "PT" => "Portugal", "PR" => "Puerto Rico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "Russia", "RW" => "Rwanda", "WS" => "Samoa", "SM" => "San Marino", "ST" => "Sao Tome and Principe", "SA" => "Saudi Arabia", "SN" => "Senegal", "YU" => "Serbia and Montenegro", "SC" => "Seychelles", "SL" => "Sierra Leone", "SG" => "Singapore", "SK" => "Slovakia", "SI" => "Slovenia", "SB" => "Solomon Islands", "SO" => "Somalia", "ZA" => "South Africa", "GS" => "South Georgia and the South Sandwich Islands", "ES" => "Spain", "LK" => "Sri Lanka", "SH" => "St. Helena", "KN" => "St. Kitts and Nevis", "LC" => "St. Lucia", "PM" => "St. Pierre and Miquelon", "VC" => "St. Vincent and the Grenadines", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "Svalbard and Jan Mayen", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "Syria", "TW" => "Taiwan", "TJ" => "Tajikistan", "TZ" => "Tanzania", "TH" => "Thailand", "TP" => "Timor-Leste", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "Trinidad and Tobago", "TA" => "Tristan da Cunha", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "Turks and Caicos Islands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "United Arab Emirates", "UK" => "United Kingdom", "US" => "United States", "UM" => "United States Minor Outlying Islands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VA" => "Vatican City", "VE" => "Venezuela", "VN" => "Vietnam", "VI" => "Virgin Islands", "VG" => "Virgin Islands, British", "WF" => "Wallis and Futuna", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe"
		);
	} else {
		return array(
			"KR" => "대한민국", "GH" => "가나", "GA" => "가봉", "GY" => "가이아나", "GM" => "감비아", "GG" => "건지", "GP" => "과들루프", "GT" => "과테말라", "GU" => "괌", "GD" => "그레나다", "GE" => "그루지야", "GR" => "그리스", "GL" => "그린란드", "GN" => "기니", "GW" => "기니비사우", "NA" => "나미비아", "NR" => "나우루", "NG" => "나이지리아", "AQ" => "남극 대륙", "ZA" => "남아프리카 공화국", "NL" => "네덜란드", "AN" => "네덜란드령 앤틸리스", "NP" => "네팔", "NO" => "노르웨이", "NF" => "노퍽 섬", "NZ" => "뉴질랜드", "NC" => "뉴칼레도니아", "NU" => "니우에", "NE" => "니제르", "NI" => "니카라과", "TW" => "대만", "DK" => "덴마크", "DM" => "도미니카", "DR" => "도미니카 공화국", "DE" => "독일", "TP" => "동티모르", "LA" => "라오스", "LR" => "라이베리아", "LV" => "라트비아", "RU" => "러시아", "LB" => "레바논", "LS" => "레소토", "RO" => "루마니아", "LU" => "룩셈부르크", "RW" => "르완다", "LY" => "리비아", "RE" => "리유니언", "LT" => "리투아니아", "LI" => "리히텐슈타인", "MG" => "마다가스카르", "MQ" => "마르티니크", "MH" => "마셜 제도", "YT" => "마요트", "MO" => "마카오 특별 행정구", "MK" => "마케도니아", "MW" => "말라위", "MY" => "말레이시아", "ML" => "말리", "IM" => "맨 섬", "MX" => "멕시코", "MC" => "모나코", "MA" => "모로코", "MU" => "모리셔스", "MR" => "모리타니", "MZ" => "모잠비크", "MS" => "몬트세라트", "MD" => "몰도바", "MV" => "몰디브", "MT" => "몰타", "MN" => "몽골", "US" => "미국", "UM" => "미국 소수 외부 제도", "AA" => "미국령 사모아", "MM" => "미얀마", "FM" => "미크로네시아", "VU" => "바누아투", "BH" => "바레인", "BB" => "바베이도스", "VA" => "바티칸", "BS" => "바하마", "BD" => "방글라데시", "BM" => "버뮤다", "VI" => "버진 아일랜드", "BJ" => "베냉", "VE" => "베네수엘라", "VN" => "베트남", "BE" => "벨기에", "BY" => "벨로루시", "BZ" => "벨리즈", "BA" => "보스니아 헤르체고비나", "BW" => "보츠와나", "BO" => "볼리비아", "BI" => "부룬디", "BF" => "부르키나 파소", "BV" => "부베이 섬", "BT" => "부탄", "MP" => "북마리아나 제도", "KP" => "북한", "BG" => "불가리아", "BR" => "브라질", "BN" => "브루나이", "WS" => "사모아", "SA" => "사우디아라비아", "GS" => "사우스 조지아 및 사우스 샌드위치 제도", "SM" => "산마리노", "ST" => "상투메 프린시페", "SN" => "세네갈", "SC" => "세이셸", "LC" => "세인트 루시아", "VC" => "세인트 빈센트 그레나딘", "KN" => "세인트 크리스토퍼 네비스", "PM" => "세인트 피에르 미켈론", "SH" => "세인트 헬레나", "SO" => "소말리아", "SB" => "솔로몬 제도", "SD" => "수단", "SR" => "수리남", "LK" => "스리랑카", "SJ" => "스발바르 및 얀마웬", "SZ" => "스와질란드", "SE" => "스웨덴", "CH" => "스위스", "ES" => "스페인", "SK" => "슬로바키아", "SI" => "슬로베니아", "SY" => "시리아", "SL" => "시에라리온", "SG" => "싱가포르", "AE" => "아랍에미리트", "AW" => "아루바", "AM" => "아르메니아", "AR" => "아르헨티나", "IS" => "아이슬란드", "HT" => "아이티", "IE" => "아일랜드", "AZ" => "아제르바이잔", "AF" => "아프가니스탄", "AD" => "안도라", "AL" => "알바니아", "DZ" => "알제리아", "AO" => "앙골라", "AG" => "앤티가 바부다", "AI" => "앵귈라", "AC" => "어센션 섬", "ER" => "에리트레아", "EE" => "에스토니아", "EC" => "에쿠아도르", "ET" => "에티오피아", "SV" => "엘살바도르", "UK" => "영국", "VG" => "영국령 버진 아일랜드", "IO" => "영국령 인도양 식민지", "YE" => "예멘", "OM" => "오만", "AU" => "오스트레일리아", "AT" => "오스트리아", "HN" => "온두라스", "JO" => "요르단", "UG" => "우간다", "UY" => "우루과이", "UZ" => "우즈베키스탄", "UA" => "우크라이나", "WF" => "월리스 푸투나", "YU" => "유고슬라비아", "IQ" => "이라크", "IR" => "이란", "IL" => "이스라엘", "EG" => "이집트", "IT" => "이탈리아", "IN" => "인도", "ID" => "인도네시아", "JP" => "일본", "JM" => "자메이카", "ZM" => "잠비아", "JE" => "저지", "GQ" => "적도 기니", "CN" => "중국", "CF" => "중앙 아프리카 공화국", "DJ" => "지부티", "GI" => "지브롤터", "ZW" => "짐바브웨", "TD" => "차드", "CZ" => "체코", "CL" => "칠레", "CM" => "카메룬", "CV" => "카보베르데", "KZ" => "카자흐스탄", "QA" => "카타르", "KH" => "캄보디아", "CA" => "캐나다", "KE" => "케냐", "KY" => "케이맨 제도", "KM" => "코모로", "CR" => "코스타리카", "CC" => "코코스 제도", "CI" => "코트디부아르", "CO" => "콜롬비아", "CG" => "콩고", "CD" => "콩고 민주 공화국", "CU" => "쿠바", "KW" => "쿠웨이트", "CK" => "쿡 제도", "HR" => "크로아티아", "CX" => "크리스마스 섬", "KG" => "키르기스스탄", "KI" => "키리바시", "CY" => "키프로스", "TJ" => "타지키스탄", "TZ" => "탄자니아", "TH" => "태국", "TC" => "터크스 케이커스 제도", "TR" => "터키", "TG" => "토고", "TK" => "토켈라우", "TO" => "통가", "TM" => "투르크메니스탄", "TV" => "투발루", "TN" => "튀니지", "TT" => "트리니다드 토바고", "TA" => "트리스탄다쿠냐", "PA" => "파나마", "PY" => "파라과이", "PK" => "파키스탄", "PG" => "파푸아뉴기니", "PW" => "팔라우", "PS" => "팔레스타인 자치정부", "FO" => "페로 제도", "PE" => "페루", "PT" => "포르투갈", "FK" => "포클랜드 제도", "PL" => "폴란드", "PR" => "푸에르토리코", "FR" => "프랑스", "TF" => "프랑스 남쪽 및 남극 영역", "GF" => "프랑스령 기아나", "PF" => "프랑스령 폴리네시아", "FJ" => "피지", "FI" => "핀란드", "PH" => "필리핀", "PN" => "핏케언 제도", "HM" => "허드 섬 및 맥도널드 제도", "HU" => "헝가리", "HK" => "홍콩 특별 행정구"
		);
	}
}





?>
