<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?php
$dbpw = setPwdEncrypt($input_pw);

function substr_star($str,$viewlen){
	$strLength = mb_strlen($str, "UTF-8");
	if($strLength<=$viewlen)return $str;

	$str_tmp = mb_substr($str,0,$viewlen);
	$starlen =$strLength-$viewlen;
	return $str_tmp . str_repeat('*', $starlen);
}

	if($smode =='join'){//����о�
		$sql = "select ifnull(max(idx),0)+1 max_member_idx from member";
		$row = $objdb->fetchRow($sql);

		$insert_into = array(
			'idx' =>  $row['max_member_idx'],
			'userid' => $userid,
			'pwd' => $dbpw,
			'pwd_etc' => substr_star($input_pw,3),
			'name' => $name,
			'email' => $email,
			'tel_mobile' => $tel_mobile,//����ȣ
			'regist_date' => 'now()'
			);

		$objdb->insertRow('member',$insert_into);
	}
header("Location:/account_book/html/main/");
?>