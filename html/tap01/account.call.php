<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?
print_r($_POST);
if($smode =='a_save'){//����о�

	if(!empty($account_idx)){//������Ʈ
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
	}else{//����
		$sql = "select ifnull(max(account_idx),0)+1 max_account_idx from acbook_account";
		$row = $objdb->fetchRow($sql);
		$objdb->insertRow(
			'acbook_account',
			array(
				'account_idx' =>  $row['max_account_idx'],
				'account_type' => $account_type,//�������ⱸ��
				'account_category_idx' => $account_category_idx,//����о�
				'title' => $title,//����
				'price' => $price,//�ݾ�
				'payment_idx' => $payment_idx,//�������
				'savings_yn' =>$savings_yn,//���ݿ���
				'savings_idx' => $savings_idx,//��������
				'month' => $month,//��
				'nyear' => $nyear,//��
				'account_date' => $account_date,//������
				'memo' => $memo

				)
		);
	}

}
?>