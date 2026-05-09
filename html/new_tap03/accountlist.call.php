<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?


//print_r($_POST);exit;

//echo $smode;exit;

if($smode =='up_a_save'){//����о�

	if(!empty($add_account_idx)){
		list($add_year, $add_month, $add_day) = explode('-', $add_account_date);
		$add_savings_yn = (!empty(trim($add_savings_idx))) ? 'y' : 'n';
		$add_loan_yn    = (!empty(trim($add_loan_idx))) ? 'y' : 'n';

		if(!empty(trim($add_title))&& !empty(trim($add_price))&& !empty(trim($add_account_category_idx))&& !empty(trim($add_payment_idx))
			&& !empty(trim($add_month))&& !empty(trim($add_year))&& !empty(trim($add_day)&& !empty(trim($add_account_date)))){
				$update_into = array(
				'account_type' => $add_account_type,
				'account_category_idx' => $add_account_category_idx,
				'title' => $add_title,
				'price' => $add_price,
				'payment_idx' => $add_payment_idx,
				'month' => $add_month,
				'nyear' => $add_year,
				'day' => $add_day,
				'account_date' => $add_account_date,
				'loan_yn' => $add_loan_yn,
				'savings_yn' => $add_savings_yn
				);
				if($add_savings_yn=='y'){
					$update_into['savings_idx'] = $add_savings_idx; 
				}
				if($add_loan_yn=='y'){
					$update_into['savings_idx'] = $add_loan_idx;
				}
				if($add_memo!=''){
					$update_into['memo'] = $add_memo;
				}
				$objdb->updateRow('acbook_account',$update_into,'account_idx='.$add_account_idx);
		}
	}
}else if($smode=='a_save'){
		list($add_year, $add_month, $add_day) = explode('-', $add_account_date);
		$add_savings_yn = (!empty(trim($add_savings_idx))) ? 'y' : 'n';
		$add_loan_yn    = (!empty(trim($add_loan_idx))) ? 'y' : 'n';
		
		$sql = "select ifnull(max(account_idx),0)+1 max_account_idx from acbook_account";
		$row = $objdb->fetchRow($sql);
		
		if(!empty(trim($add_title))&& !empty(trim($add_price))&& !empty(trim($add_account_category_idx))&& !empty(trim($add_payment_idx))
			&& !empty(trim($add_month))&& !empty(trim($add_year))&& !empty(trim($add_day)&& !empty(trim($add_account_date)))){
		
			$insert_into = array(
				'account_idx' =>  $row['max_account_idx'],
				'userid' => $_SESSION['userid'],
				'account_type' => $add_account_type,
				'account_category_idx' => $add_account_category_idx,
				'title' => $add_title,
				'price' => $add_price,
				'payment_idx' => $add_payment_idx,
				'month' => $add_month,
				'nyear' => $add_year,
				'day' => $add_day,
				'account_date' => $add_account_date,
				'loan_yn' => $add_loan_yn,
				'savings_yn' => $add_savings_yn
				);
			if($add_savings_yn=='y'){
				$insert_into['savings_idx'] = $add_savings_idx;
				//적금금액 업데이트 
				$sql = "select total_price from acbook_savings where savings_idx=".$add_savings_idx;
				$s_row = $objdb->fetchRow($sql);
				$up_total_price =$s_row['total_price']+$add_price;
				$objdb->updateRow('acbook_savings',array('total_price' => $up_total_price),'savings_idx='.$add_savings_idx);

			}
			if($add_loan_yn=='y'){
				$insert_into['loan_idx'] = $add_loan_idx;
				$insert_into['loan_action'] = $add_loan_action;

				//대출금액 업데이트 
				$sql = "select total_amount from acbook_loan where loan_idx=".$add_loan_idx;
				$l_row = $objdb->fetchRow($sql);
				if($add_loan_action=='addpay'){//증액
					$objdb->updateRow('acbook_loan',array('total_amount' => $l_row['total_amount']+$add_price),'loan_idx='.$add_loan_idx);
				}else if($add_loan_action=='repay'){//상환
					$objdb->updateRow('acbook_loan',array('total_amount' => $l_row['total_amount']-$add_price),'loan_idx='.$add_loan_idx);
				}
			}
			if($add_memo!=''){
				$insert_into['memo'] = $add_memo;
			}
			$objdb->insertRow('acbook_account',$insert_into	);
		}
	//�� �������� �ܾ� ����
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
	//���� �ܾ� ����
	$sql="select total_price from acbook_savings where savings_idx=".$savings_idx;
	$row = $objdb->fetchRow($sql);
	$total_price = $row['total_price']+$price;
		$objdb->updateRow(
		'acbook_savings', array( 'total_price' => $total_price),
		'savings_idx='.$savings_idx
		);
	}*/
}else if($smode == 'a_del'){//����
	$a_idxs= implode(',',$account_idx);
	//echo $a_idxs;exit;
	$rowsDeleted = $objdb->deleteRow('acbook_account', 'account_idx in ('.$a_idxs.')');

}
//header("Location:./accountlist.php?account_date=".$account_date);
$pdo = null;
exit();
?>