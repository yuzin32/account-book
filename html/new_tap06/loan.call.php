<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?php

$smode= $_POST['smode'];

print_r($_POST);
//exit;
if($smode =='l_save'){//지출분야

	if(!empty($loan_idx)){//업데이트
		$i=0;
			/*foreach ($savings_idx as $s_idx) {
					$objdb->updateRow(
					'acbook_savings',
					array(
						'savings_name' => $savings_name[$i],
						'bank_idx' => $bank_idx[$i],
						'start_date' => $start_date[$i],
						'end_date' => $end_date[$i],
						'one_price' => $one_price[$i],
						'total_price' =>$total_price[$i],
						'use_yn' => $use_yn[$i]
						),
					'savings_idx='.$s_idx
				);
					$i++;
			}*/
	}else{//생성
		$sql = "select ifnull(max(loan_idx),0)+1 max_loan_idx from acbook_loan";
		$row = $objdb->fetchRow($sql);
		if((isset($add_counterparty_name)||isset($add_bank_idx)) && !empty($add_total_amount)&& !empty(trim($add_loan_reason))&& !empty($add_loan_date)){
			$insert_into = array(
					'loan_idx' =>  $row['max_loan_idx'],
					'loan_date' => $add_loan_date,
					'loan_type' => $add_loan_type,
					'total_amount' => $add_total_amount,
					'loan_reason' => $add_loan_reason,
					);
			if (isset($add_counterparty_name) && !empty(trim($add_counterparty_name))) {	$insert_into['counterparty_name'] = $add_counterparty_name; }
			if(isset($add_bank_idx) && !empty(trim($add_bank_idx))){	$insert_into['bank_idx'] = $add_bank_idx; }

			$objdb->insertRow('acbook_loan',$insert_into);
		}
	}
} else if($smode=='l_del'){

	$l_idxs= implode(',',$loan_idx); 
	//지출분야삭제
	$rowsDeleted = $objdb->deleteRow('acbook_loan', 'loan_idx in ('.$l_idxs.')');

}
    //header("Location: ./loan.php");
	$pdo = null; //DB작업종료
    exit();
?>
