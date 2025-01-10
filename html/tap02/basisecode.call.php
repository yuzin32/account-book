<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?php

$smode= $_POST['smode'];
//지출분야 생성변수
if(!empty($_POST['add_acount_category_name']))$add_acount_category_name=$_POST['add_acount_category_name'];
if(!empty($_POST['add_statistics_use']))$add_statistics_use=$_POST['add_statistics_use'];
//지출분야 삭제 및 수정변수
if(!empty($_POST['acount_category_idx']))$acount_category_idx=$_POST['acount_category_idx'];
if(!empty($_POST['acount_category_name']))$acount_category_name=$_POST['acount_category_name'];
if(!empty($_POST['statistics_use']))$statistics_use=$_POST['statistics_use'];

//은행 생성 변수
if(!empty($_POST['add_systemcode_key']))$add_systemcode_key=$_POST['add_systemcode_key'];
if(!empty($_POST['add_systemcode_value']))$add_systemcode_value=$_POST['add_systemcode_value'];
if(!empty($_POST['add_systemcode_name']))$add_systemcode_name=$_POST['add_systemcode_name'];
//은행삭제 및 수정변수
if(!empty($_POST['systemcode_idx']))$systemcode_idx=$_POST['systemcode_idx'];
if(!empty($_POST['systemcode_key']))$systemcode_key=$_POST['systemcode_key'];
if(!empty($_POST['systemcode_value']))$systemcode_value=$_POST['systemcode_value'];
if(!empty($_POST['systemcode_name']))$systemcode_name=$_POST['systemcode_name'];




if(!empty($_POST['payment_idx']))$payment_idx=$_POST['payment_idx'];
if(!empty($_POST['payment_name']))$payment_name=$_POST['payment_name'];
if(!empty($_POST['bank_idx']))$systemcode_value=$_POST['bank_idx'];
if(!empty($_POST['payment_type']))$systemcode_name=$_POST['payment_type'];
if(!empty($_POST['use_yn']))$systemcode_name=$_POST['use_yn'];


print_r($_POST);

if($smode =='ac_save'){//지출분야

	if(!empty($acount_category_idx)){//업데이트
		$i=0;
			foreach ($acount_category_idx as $a_c_idx) {
					$objdb->updateRow(
					'acbook_account_category',
					array(
						'acount_category_name' => $acount_category_name[$i],
						'statistics_use' => $statistics_use[$i]
						),
					'acount_category_idx='.$a_c_idx
				);
					$i++;
			}
	}else{//생성 
		$sql = "select ifnull(max(acount_category_idx),0)+1 max_acount_category_idx from acbook_account_category";
		$row = $objdb->fetchRow($sql);
		$objdb->insertRow(
			'acbook_account_category',
			array(
				'acount_category_idx' =>  $row['max_acount_category_idx'],
				'acount_category_name' => $add_acount_category_name,
				'statistics_use' => $add_statistics_use
				)
		);
	}

} else if($smode=='ac_dle'){

	$ac_idxs= implode($acount_category_idx);

	//지출분야삭제 
	$rowsDeleted = $objdb->deleteRow('acbook_account_category', 'acount_category_idx in ('.$ac_idxs.')');

} else if($smode =='bank_save'){
	//은행
	$sql = "select ifnull(max(systemcode_idx),0)+1 max_systemcode_idx from acbook_systemcode";
	$row = $objdb->fetchRow($sql);
	//echo $row['max_systemcode_idx'].'/'.$systemcode_key.'/'.$systemcode_value.'/'.$systemcode_name;

	$objdb->insertRow(
		'acbook_systemcode',
		 array(
			'systemcode_idx' =>  $row['max_systemcode_idx'],
			'systemcode_key' => $systemcode_key,
			'systemcode_value' => $systemcode_value,
			'systemcode_name' => $systemcode_name
		)
	);
}else if($smode=='bank_del'){
	$b_idxs= implode($systemcode_idx);
	//echo $b_idxs;

	//은행삭제 
	$rowsDeleted = $objdb->deleteRow('acbook_systemcode', 'systemcode_idx in ('.$b_idxs.')');

}else if($smode =='p_save'){
	//은행
	$sql = "select ifnull(max(payment_idx),0)+1 max_payment_idx from acbook_payment";
	$row = $objdb->fetchRow($sql);
	//echo $row['max_systemcode_idx'].'/'.$systemcode_key.'/'.$systemcode_value.'/'.$systemcode_name;

	$objdb->insertRow(
		'acbook_payment',
		 array(
			'payment_idx' =>  $row['max_payment_idx'],
			'payment_name' => $payment_name,
			'bank_idx' => $bank_idx,
			'payment_type' => $payment_type,
			'use_yn'=>$use_yn
		)
	);
}else if($smode=='p_del'){
	$p_idxs= implode($payment_idx);
	//echo $b_idxs;

	//은행삭제 
	$rowsDeleted = $objdb->deleteRow('acbook_payment', 'payment_idx in ('.$p_idxs.')');

}



    //header("Location: ./basisecode.main.php");
	$pdo = null; //DB작업종료
    exit();
?>