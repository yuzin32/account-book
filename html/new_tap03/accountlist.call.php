<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?php

$check_date = date('Y-m-d H:i:s');


print_r($_POST);
if($add_savings_idx=="n"){$savings_yn ='n'}else{$savings_yn="y"}
if($add_loan_idx=="n"){$loan_yn='n'}else{$loan_yn='y'}
//echo $smode;exit;
if($smode =='a_save'){//����о�
	if(!empty($account_idx)){//������Ʈ
		$i=0;
		$sql=$objdb->updateRow(
		'acbook_account',
		array(
			'account_type' => $account_type,//�������ⱸ��
			'account_category_idx' => $account_category_idx,//����о�
			'title' => $title,//����
			'price' => $price,//�ݾ�
			'payment_idx' => $payment_idx,//�������
			'month' => $month,//��
			'nyear' => $nyear,//��
			'account_date' => $account_date,//������
			'loan_yn' => $loan_yn
			),
		'account_idx='.$account_idx
		);
		//echo $sql;exit;
	}else{//생성
		$sql = "select ifnull(max(account_idx),0)+1 max_account_idx from acbook_account";
		$row = $objdb->fetchRow($sql);

		$insert_into = array(
			'account_idx' =>  $row['max_account_idx'],
			'account_type' => $add_account_type,
			'account_category_idx' => $add_account_category_idx,
			'title' => $add_title,
			'price' => $add_price,
			'payment_idx' => $add_payment_idx,
			'month' => $month,//��
			'nyear' => $nyear,//��
			'account_date' => $account_date,//������
			'savings_yn' => $savings_yn
            'loan_yn' => $loan_yn
			);
		if($memo!=''){
			$insert_into['memo'] = $memo;
		}


		$objdb->insertRow('acbook_account',$insert_into	);
	}
}else if($smode == 'a_del'){
	$a_idxs= implode(',',$account_idx);
	//echo $a_idxs;exit;
	$rowsDeleted = $objdb->deleteRow('acbook_account', 'account_idx in ('.$a_idxs.')');

}
   //header("Location: ./accountlist.php");
	$pdo = null; //DB작업종료
    exit();
?>
