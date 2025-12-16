<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?php

$sql="select name,userid,pwd,email,login_fail_times,timestampdiff(minute, login_fail_date, now()) login_fail_period from member where userid='$userid' ";
$row = $objdb->fetchRow($sql);
if(!empty( $row['pwd'])){$dbpwd = $row['pwd'];
}else{$dbpwd = "";
	$login_success='N1';
	$msg = "등록되지 않은 아이디입니다.";
}


$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
    $path = $_SERVER['HTTP_REFERER'];
	$path = substr($path, strpos($path, "/", strpos($path, "//") + 2));
}else{
	$path="";
}
if(!empty($dbpwd)){
if ($dbpwd!=setPwdEncrypt($input_pwd)||empty($input_pwd)){ 
	$login_success='N2';
	$msg = "비밀번호가 틀렸습니다.";

	$sql = "select ifnull(login_fail_times,0)+1 max_login_fail_times from member";
	$row = $objdb->fetchRow($sql);

	$sql=$objdb->updateRow( 'member'
	, array( 'login_fail_times' => $row['max_login_fail_times']
			,'login_fail_date' =>  date('Y-m-d H:i:s') )
	, "userid='".$userid."'"
	);
}else if($row['login_fail_times']>5 && $row['login_fail_period']<=60){
	$msg = "비밀번호 오류 5회초과 1시간 이후 다시 로그인 시도 하십시오";
}else if($dbpwd==setPwdEncrypt($input_pwd)) {
	$login_success='Y';
	$sql=$objdb->updateRow( 'member'
	, array( 'login_fail_times' => 0)
	, "userid='".$userid."'"
	);
	$_SESSION['userid'] = $row['userid'];
	$_SESSION['name'] = $row['name'];
	$_SESSION['email'] = $row['email'];

	$msg = "로그인성공";
}
}
/**************로그저장*******************/
$sql = "select ifnull(max(login_member_idx),0)+1 max_login_member_idx from login_member_log";
$row = $objdb->fetchRow($sql);

$insert_into = array(
	'login_member_idx' => $row['max_login_member_idx'],
	'userid' => $userid,
	'login_date' => date('Y-m-d H:i:s'),
	'client_ip' => $ip,
	'browser' => $user_agent,
	'login_success' => $login_success,
	'msg' => $msg,
	'path' => $path,
	'branch' => $branch
	);
$objdb->insertRow('login_member_log',$insert_into);
/**************로그저장*******************/
$url="/account_book/html/main/?log_f=$login_success";
if($login_success=='Y'){
	$url="/account_book/html/new_tap01/home.php?login_s=$login_success";
}

echo "<script>
    <!--alert('".$msg."');-->
    window.location.href = '$url';
</script>";
?>