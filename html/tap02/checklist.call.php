<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?php

$check_date = date('Y-m-d H:i:s');

//체크리스트
$sql ="select check_idx,account_category_idx,title,default_price from acbook_checklist ";
$check_rows = $objdb->fetchAllRows($sql);

print_r($_POST);

if($smode =='c_s_update'){
		$i=0;
		foreach($check_sub_idx as $c_s_idx){
		$complete_value = isset($complete[$i]) ? $complete[$i] : ''; 
		$memo_value = isset($memo[$i]) ? $memo[$i] : '';
			$sql=$objdb->updateRow(
				'acbook_checklist_sub',
				 array(
					'complete' => $complete_value,
					'memo' => $memo_value,
					'check_date'=>$check_date
				),
				'check_sub_idx='.$c_s_idx
			);
			$i++;
			
		}
}else if($smode =='c_s_save'){//생성
		foreach($check_rows as $c_row){
			$sql = "select count(check_sub_idx) c_cnt from acbook_checklist_sub where month=$month and nyear=$nyear and check_idx=".$c_row['check_idx'];
			$c_cnt = $objdb->fetchRow($sql);

			if($c_cnt!=0){
				$sql = "select ifnull(max(check_sub_idx),0)+1 max_check_sub_idx from acbook_checklist_sub";
				$row = $objdb->fetchRow($sql);
						
				$objdb->insertRow(
					'acbook_checklist_sub',
					 array(
						'check_sub_idx' =>  $row['max_check_sub_idx'],
						'check_idx' => $c_row['check_idx'],
						'complete' => 'n',
						'month' => $month,
						'nyear' => $nyear,
						'check_date'=>$check_date
					)
				);
			}
		}//foreach complete
	}
   //header("Location: ./checklist_main.php");
	$pdo = null; //DB작업종료
    exit();
?>
