<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?php

$smode= $_POST['smode'];

print_r($_POST);

if($smode =='s_save'){//지출분야

	if(!empty($savings_idx)){//업데이트
		$i=0;
			foreach ($savings_idx as $s_idx) {
					$objdb->updateRow(
					'acbook_savings',
					array(
						'savings_name' => $savings_name[$i],
						'bank_idx' => $bank_idx[$i],
						'start_date' => $start_date[$i],
						'end_date' => $end_date[$i],
						'one_price' => $one_price[$i],
						'use_yn' => $use_yn[$i]
						),
					'savings_idx='.$s_idx
				);
					$i++;
			}
	}else{//생성
		$sql = "select ifnull(max(savings_idx),0)+1 max_savings_idx from acbook_savings";
		$row = $objdb->fetchRow($sql);
		$objdb->insertRow(
			'acbook_savings',
			array(
				'savings_idx' =>  $row['max_savings_idx'],
				'savings_name' => $add_savings_name,
				'bank_idx' => $add_bank_idx,
				'start_date' => $add_start_date,
				'end_date' => $add_end_date,
				'one_price' => $add_one_price,
				'use_yn' => $add_use_yn
				)
		);
	}
} else if($smode=='s_del'){

	$s_idxs= implode($savings_idx);
	//지출분야삭제
	$rowsDeleted = $objdb->deleteRow('acbook_savings', 'savings_idx in ('.$s_idxs.')');

}
    header("Location: ./saving_main.php");
	$pdo = null; //DB작업종료
    exit();
?>
