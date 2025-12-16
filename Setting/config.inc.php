<?php
$isDebug = false;//TRUE; //오류표시여부
/********** 세션 **********/
session_start();
//if (!isset($set_time_limit)) $set_time_limit = 0; // set_time_limit 는 세션이 아닌 현재 php 스크립트의 실행(지연) 시간
//set_time_limit($set_time_limit);

/*
// 세션 타임아웃 초
$vsystem_login_timeout_sec = "3600";
// 로그인세션 체크 주기 밀리초
$vsystem_check_login_interval_msec = "4000";*/

/********** 캐시 제거 **********/
header('Cache-Control: no-cache, must-revalidate');
header("Pragma:no-cache");
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header("Content-Type: text/html; charset=utf-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"'); // 보안설정이나 프레임이 달라도 쿠키가 통하도록 설정

/********** 에러 표시 **********/
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', $isDebug);
ini_set('display_startup_errors', TRUE);

/********** 서버 환경설정 **********/
ini_set('memory_limit', '-1');
ini_set('register_globals','0');
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');
date_default_timezone_set('Asia/Seoul');
ini_alter("magic_quotes_sybase",1);

$branch=0;//사이트구분값:가계부사이트 0 , 갠홈 1



if (!empty($_POST)) {
    /*if (is_array($_POST)) {
        foreach ($_POST as $key => $value) {
            // 배열인 경우 재귀적으로 cleanXSS 적용
            $_POST[$key] = cleanXSS($value);
        }
    }*/
	extract($_POST);
}

$_syspath = $_SERVER["DOCUMENT_ROOT"]."/account_book";
$path_setting =$_syspath.'/Setting/';
//DB커넥트
include_once $path_setting."db_connect.php";

$objdb = new MySQLPDOClass(); // DB

//시스템 기본 변수 및 데이터 셋팅
include_once  $path_setting."config.setting.inc.php";

//쿼리결과 기본변수 
include_once  $path_setting."lib/config.query.inc.php";

//쿼리결과 기본변수 
include_once  $path_setting."lib/config.func.inc.php";

require_once($path_setting . "lib/fileclass.lib.php"); //파일관련 클래스
$objfile=new FILE_CLASS(); //파일

//함수
include_once  $path_setting."lib/config.function.inc.php";
/*로그인 세션
$sess_userid = trim(get_session("_SESSION_USERID"));
$sess_name = trim(get_session("_SESSION_USERNAME"));
$sess_email = trim(get_session("_SESSION_USEREMAIL"));
$sess_usertype = get_session("_SESSION_USERTYPE");
$isLogin = false;
if(!empty($sess_userid)) $isLogin = true;
*/
?>