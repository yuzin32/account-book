<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?php

$smode= $_POST['smode'];
$tapmode= $_POST['tapmode'];
print_r($_POST);
//exit;

if($smode =='ac_save'){//지출분야
	if(!empty($account_category_idx)){//업데이트\
		foreach ($account_category_idx as $ac_idx) {
			//필수값없으면 업데이트 안함
			if(!empty(trim($account_category_name[$ac_idx]))&&!empty($account_type[$ac_idx])){
					$objdb->updateRow(
					'acbook_account_category',
					array(
						'account_type' => $account_type[$ac_idx],
						'account_category_name' => $account_category_name[$ac_idx],
						'statistics_use' => $statistics_use[$ac_idx] ??'n'
						),
					'account_category_idx='.$ac_idx
				);
			}
		}
	}else{//생성
		$sql = "select ifnull(max(account_category_idx),0)+1 max_account_category_idx from acbook_account_category";
		$row = $objdb->fetchRow($sql);
		if(!empty(trim($add_account_type))&&!empty($add_account_category_name)){
			$objdb->insertRow(
				'acbook_account_category',
				array(
					'account_category_idx' =>  $row['max_account_category_idx'],
					'account_type' => $add_account_type,
					'account_category_name' => $add_account_category_name,
					'statistics_use' => $add_statistics_use ?? 'n'
					)
			);
		}
	}
}else if($smode=='ac_del'){

	$ac_idxs= implode(',',$account_category_idx);
	//지출분야삭제
	$rowsDeleted = $objdb->deleteRow('acbook_account_category', 'account_category_idx in ('.$ac_idxs.')');

}else if($smode =='pay_save'){
	if(!empty($payment_idx)){//업데이트
		foreach ($payment_idx as $pay_idx) {
			//필수값없으면 업데이트 안함
			if(!empty(trim($payment_name[$pay_idx]))&& !empty($bank_idx[$pay_idx])&& !empty($payment_type[$pay_idx])){
				$objdb->updateRow(
					'acbook_payment',
					array(
						'payment_name' => $payment_name[$pay_idx],
						'bank_idx' => $bank_idx[$pay_idx],
						'payment_type' => $payment_type[$pay_idx],
						'use_yn'=>$use_yn[$pay_idx] ?? 'n',
						'price'=>$price[$pay_idx] ?? 0
					),
					'payment_idx='.$pay_idx
				);
			}
		}

	}else{//생성
		$i=0;
		//결제수단
		$sql = "select ifnull(max(payment_idx),0)+1 max_payment_idx from acbook_payment";
		$row = $objdb->fetchRow($sql);
		//echo $row['max_systemcode_idx'].'/'.$systemcode_key.'/'.$systemcode_value.'/'.$systemcode_name;
		if(!empty(trim($add_payment_name))&&!empty($add_bank_idx)&&!empty($add_payment_type)){
			$objdb->insertRow(
				'acbook_payment',
				array(
					'payment_idx' =>  $row['max_payment_idx'],
					'payment_name' => $add_payment_name,
					'bank_idx' => $add_bank_idx,
					'payment_type' => $add_payment_type,
					//'price'=>$add_price,
					'use_yn'=>$add_use_yn ?? 'n'
				)
			);
		}
		
	}
}else if($smode=='pay_del'){
	$pay_idxs= implode(',',$payment_idx);
	$rowsDeleted = $objdb->deleteRow('acbook_payment', 'payment_idx in ('.$pay_idxs.')');

} else if($smode =='bank_save'){
	if(!empty($systemcode_idx)){//업데이트
		foreach ($systemcode_idx as $s_idx) {
			//필수값없으면 업데이트 안함
			if(!empty(trim($systemcode_name[$s_idx]))&& !empty($systemcode_value[$s_idx])){
					$objdb->updateRow(
					'acbook_systemcode',
					array(
						'systemcode_value' => $systemcode_value[$s_idx],
						'systemcode_name' => $systemcode_name[$s_idx]
						),
					'systemcode_idx='.$s_idx
				);
			}
		}
	}else{//생성
		//은행
		$sql = "select ifnull(max(systemcode_idx),0)+1 max_systemcode_idx from acbook_systemcode";
		$row = $objdb->fetchRow($sql);
		if(!empty(trim($add_systemcode_name))&&!empty($add_systemcode_value)){
			$objdb->insertRow(
				'acbook_systemcode',
				array(
					'systemcode_idx' => $row['max_systemcode_idx'],
					'systemcode_key' => 'bank',
					'systemcode_value' => $add_systemcode_value,
					'systemcode_name' => $add_systemcode_name
				)
			);
		}
	}
}else if($smode=='bank_del'){
	$b_idxs= implode(',',$systemcode_idx);
	//은행삭제
	$rowsDeleted = $objdb->deleteRow('acbook_systemcode', 'systemcode_idx in ('.$b_idxs.')');

}else if($smode =='check_save'){
	if(!empty($check_idx)){//업데이트
		$write_date = date('Y-m-d H:i:s');
		
		foreach($check_idx as $c_idx){
		if(!empty(trim($title[$c_idx]))&&!empty($account_category_idx[$c_idx])){
			$objdb->updateRow(
				'acbook_checklist',
				 array(
					'account_category_idx' => $account_category_idx[$c_idx],
					'title' => $title[$c_idx],
					'memo' => $memo[$c_idx] ?? '',
					'default_price' => $default_price[$c_idx] ?? 0,
					'write_date'=>$write_date,
					'use_yn'=>$use_yn[$c_idx] ?? 'n'
				),
				'check_idx='.$c_idx
			);
		}
		}
	}else{//생성
		//은행
		$sql = "select ifnull(max(check_idx),0)+1 max_check_idx from acbook_checklist";
		$row = $objdb->fetchRow($sql);
		//echo $row['max_systemcode_idx'].'/'.$systemcode_key.'/'.$systemcode_value.'/'.$systemcode_name;
		$write_date = date('Y-m-d H:i:s');
		if(!empty(trim($add_title))&&!empty($add_account_category_idx)){
			$objdb->insertRow(
				'acbook_checklist',
				array(
					'check_idx' =>  $row['max_check_idx'],
					'account_category_idx' => $add_account_category_idx,
					'title' => $add_title,
					'memo' => $add_memo??'',
					'default_price' => $add_default_price??0,
					'write_date'=>$write_date
				)
			);
		}
	}
}else if($smode=='check_del'){
	$c_idxs= implode(',',$check_idx);
	//삭제
	$rowsDeleted = $objdb->deleteRow('acbook_checklist', 'check_idx in ('.$c_idxs.')');

}

    header("Location: ./basisecode.php?tapmode=".$tapmode);
	$pdo = null; //DB작업종료
    exit();
?>
