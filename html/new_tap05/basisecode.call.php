<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?php

$smode= $_POST['smode'];



print_r($_POST);

if($smode =='ac_save'){//지출분야

	if(!empty($account_category_idx)){//업데이트
		$i=0;
			foreach ($account_category_idx as $a_c_idx) {
					$objdb->updateRow(
					'acbook_account_category',
					array(
						'account_type' => $account_type[$i],
						'account_category_name' => $account_category_name[$i],
						'statistics_use' => $statistics_use[$i]
						),
					'account_category_idx='.$a_c_idx
				);
					$i++;
			}
	}else{//생성
		$sql = "select ifnull(max(account_category_idx),0)+1 max_account_category_idx from acbook_account_category";
		$row = $objdb->fetchRow($sql);
		$objdb->insertRow(
			'acbook_account_category',
			array(
				'account_category_idx' =>  $row['max_account_category_idx'],
				'account_type' => $add_account_type,
				'account_category_name' => $add_account_category_name,
				'statistics_use' => $add_statistics_use
				)
		);
	}

} else if($smode=='ac_del'){

	$ac_idxs= implode(',',$account_category_idx);
	//지출분야삭제
	$rowsDeleted = $objdb->deleteRow('acbook_account_category', 'account_category_idx in ('.$ac_idxs.')');

} else if($smode =='bank_save'){
	if(!empty($systemcode_idx)){//업데이트
		$i=0;
			foreach ($systemcode_idx as $s_idx) {
					$objdb->updateRow(
					'acbook_systemcode',
					array(
						'systemcode_value' => $systemcode_value[$i],
						'systemcode_name' => $systemcode_name[$i]
						),
					'systemcode_idx='.$s_idx
				);
					$i++;
			}
	}else{//생성
		//은행
		$sql = "select ifnull(max(systemcode_idx),0)+1 max_systemcode_idx from acbook_systemcode";
		$row = $objdb->fetchRow($sql);
		//echo $row['max_systemcode_idx'].'/'.$systemcode_key.'/'.$systemcode_value.'/'.$systemcode_name;

		$objdb->insertRow(
			'acbook_systemcode',
			 array(
				'systemcode_idx' => $row['max_systemcode_idx'],
				'systemcode_key' => $add_systemcode_key,
				'systemcode_value' => $add_systemcode_value,
				'systemcode_name' => $add_systemcode_name
			)
		);
	}
}else if($smode=='bank_del'){
	$b_idxs= implode(',',$systemcode_idx);
	//echo $b_idxs;

	//은행삭제
	$rowsDeleted = $objdb->deleteRow('acbook_systemcode', 'systemcode_idx in ('.$b_idxs.')');

}else if($smode =='p_save'){
	if(!empty($payment_idx)){//업데이트
		$i=0;
		foreach ($payment_idx as $p_idx) {
			$objdb->updateRow(
				'acbook_payment',
				 array(
					'payment_name' => $payment_name[$i],
					'bank_idx' => $bank_idx[$i],
					'payment_type' => $payment_type[$i],
					'use_yn'=>$use_yn[$i],
				'price'=>$price[$i]
				),
				'payment_idx='.$p_idx
			);
			$i++;
		}

	}else{//생성
		$i=0;
		//결제수단
		$sql = "select ifnull(max(payment_idx),0)+1 max_payment_idx from acbook_payment";
		$row = $objdb->fetchRow($sql);
		//echo $row['max_systemcode_idx'].'/'.$systemcode_key.'/'.$systemcode_value.'/'.$systemcode_name;

		$objdb->insertRow(
			'acbook_payment',
			 array(
				'payment_idx' =>  $row['max_payment_idx'],
				'payment_name' => $add_payment_name,
				'bank_idx' => $add_bank_idx,
				'payment_type' => $add_payment_type,
			'price'=>$add_price,
				'use_yn'=>$add_use_yn
			)
		);
	}
}else if($smode=='p_del'){
	$p_idxs= implode(',',$payment_idx);
	//echo $b_idxs;

	//은행삭제
	$rowsDeleted = $objdb->deleteRow('acbook_payment', 'payment_idx in ('.$p_idxs.')');

}else if($smode =='check_save'){
	if(!empty($check_idx)){//업데이트
		$write_date = date('Y-m-d H:i:s');
		
		$i=0;
		foreach($check_idx as $c_idx){
			if($use_yn[$i]!='n')$use_yn[$i]='y';//2025-03-11추가 :안쓰는 체크리스트 숨김처리
			$objdb->updateRow(
				'acbook_checklist',
				 array(
					'account_category_idx' => $account_category_idx[$i],
					'title' => $title[$i],
					'memo' => $memo[$i],
					'default_price' => $default_price[$i],
					'write_date'=>$write_date,
					'use_yn'=>$use_yn[$i]
				),
				'check_idx='.$c_idx
			);
			$i++;
		}
	}else{//생성
		//은행
		$sql = "select ifnull(max(check_idx),0)+1 max_check_idx from acbook_checklist";
		$row = $objdb->fetchRow($sql);
		//echo $row['max_systemcode_idx'].'/'.$systemcode_key.'/'.$systemcode_value.'/'.$systemcode_name;
		$write_date = date('Y-m-d H:i:s');

		$objdb->insertRow(
			'acbook_checklist',
			 array(
				'check_idx' =>  $row['max_check_idx'],
				'account_category_idx' => $add_account_category_idx,
				'title' => $add_title,
				'memo' => $add_memo,
				'default_price' => $add_default_price,
				'write_date'=>$write_date
			)
		);
	}
}else if($smode=='check_del'){
	$c_idxs= implode(',',$check_idx);
	//echo $b_idxs;

	//삭제
	$rowsDeleted = $objdb->deleteRow('acbook_checklist', 'check_idx in ('.$c_idxs.')');

}



    header("Location: ./basisecode_main.php");
	$pdo = null; //DB작업종료
    exit();
?>
