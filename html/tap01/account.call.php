<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?
//print_r($_POST);
$savings_yn = isset($savings_yn) ? $savings_yn : 'n'; // 기본값 'n' 설정

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

		$insert_into = array(
			'account_idx' =>  $row['max_account_idx'],
			'account_type' => $account_type,//수입지출구분
			'account_category_idx' => $account_category_idx,//지출분야
			'title' => $title,//사유
			'price' => $price,//금액
			'payment_idx' => $payment_idx,//지출수단
			'month' => $month,//달
			'nyear' => $nyear,//년
			'account_date' => $account_date,//결제일
			'loan_yn' => $loan_yn
			);
		if($savings_yn=='y'){
			$insert_into['savings_yn'] = $savings_yn;
			$insert_into['savings_idx'] = $savings_idx;//적금종류;
		}
		if($memo!=''){
			$insert_into['memo'] = $memo;
		}


		$objdb->insertRow('acbook_account',$insert_into	);
	}
	//각 결제수단 잔액 갱신
	/*$sql="select price from acbook_payment where payment_idx=".$payment_idx;
	$row = $objdb->fetchRow($sql);
	echo $sql.'<br>';
	if($account_type==0){ $total_price=$row['payment_price']-$price; }else{ $total_price=$row['payment_price']+$price; }
	echo $total_price;
	$objdb->updateRow(
	'acbook_payment', array( 'price' => $total_price),
	'payment_idx='.$payment_idx
	);
	if($savings_yn=='y'){
	//적금 잔액 갱신
	$sql="select total_price from acbook_savings where savings_idx=".$savings_idx;
	$row = $objdb->fetchRow($sql);
	$total_price = $row['total_price']+$price;
		$objdb->updateRow(
		'acbook_savings', array( 'total_price' => $total_price),
		'savings_idx='.$savings_idx
		);
	}*/
}else if($smode == 'a_del'){//삭제
	$a_idxs= implode(',',$account_idx);
	//echo $a_idxs;exit;
	$rowsDeleted = $objdb->deleteRow('acbook_account', 'account_idx in ('.$a_idxs.')');

}

header("Location:./calender_main.php?account_date=".$account_date);
$pdo = null; //DB작업종료
exit();
?>