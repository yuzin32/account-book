<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?
print_r($_POST);
if($smode =='a_save'){//지출분야

	if(!empty($account_idx)){//업데이트
		$i=0;
			/*foreach ($account_idx as $a_c_idx) {
					$objdb->updateRow(
					'acbook_account_category',
					array(
						'account_category_name' => $account_category_name[$i],
						'statistics_use' => $statistics_use[$i]
						),
					'account_category_idx='.$a_c_idx
				);
					$i++;
			}*/
	}else{//생성
		$sql = "select ifnull(max(account_idx),0)+1 max_account_idx from acbook_account";
		$row = $objdb->fetchRow($sql);
		$objdb->insertRow(
			'acbook_account',
			array(
				'account_idx' =>  $row['max_account_idx'],
				'account_type' => $account_type,//수입지출구분
				'account_category_idx' => $account_category_idx,//지출분야
				'title' => $title,//사유
				'price' => $price,//금액
				'payment_idx' => $payment_idx,//지출수단
				'savings_yn' =>$savings_yn,//적금여부
				'savings_idx' => $savings_idx,//적금종류
				'month' => $month,//달
				'nyear' => $nyear,//년
				'account_date' => $account_date,//결제일
				'memo' => $memo

				)
		);
	}

}
?>