<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";?>
<?php

$check_date = date('Y-m-d H:i:s');

//체크리스트
$sql ="select check_idx,account_category_idx,title,default_price,memo  from acbook_checklist where ifnull(use_yn,'y') != 'n'";
$check_rows = $objdb->fetchAllRows($sql);

print_r($_POST);

if($smode =='c_s_update'){
	if(isset($new_num)){
		foreach($new_num as $num){
			$sql = "select ifnull(max(check_sub_idx),0)+1 max_check_sub_idx from acbook_checklist_sub";
			$row = $objdb->fetchRow($sql);
			$objdb->insertRow(
				'acbook_checklist_sub',
				array(
				'check_sub_idx' =>  $row['max_check_sub_idx'],
				'complete' => 'n',
				'nmonth' => $nmonth,
				'nyear' => $nyear,
				'check_date'=>$check_date,
				'title'=>$new_title[$num],
				'default_price'=>$new_default_price[$num],
				'memo'=>$new_memo[$num]
				)
			);
		}
	}
	if($check_sub_idx){
		foreach($check_sub_idx as $c_s_idx){	
		$memo_value = isset($memo[$c_s_idx]) ? $memo[$c_s_idx] : '';
		if(!isset($check_cp_idx)){ $complete = 'n';
		}else{  if(in_array($c_s_idx, $check_cp_idx)){ $complete = 'y'; }else{ $complete = 'n';}}
		
		$sql=$objdb->updateRow(
			'acbook_checklist_sub',
				array(
				'complete' => $complete,
				'memo' => $memo_value,
				'check_date'=>$check_date
			),
			'check_sub_idx='.$c_s_idx
		);
		}
	}
}else if($smode =='c_s_save'){//생성
		foreach($check_rows as $c_row){
			$sql = "select count(check_sub_idx) c_cnt from acbook_checklist_sub where nmonth=$nmonth and nyear=$nyear and check_idx=".$c_row['check_idx'];
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
						'nmonth' => $nmonth,
						'nyear' => $nyear,
						'check_date'=>$check_date,
						'title'=>$c_row['title'],
						'default_price'=>$c_row['default_price'],
						'memo'=>$c_row['memo']
					)
				);
			}
		}//foreach complete
	}else if($smode =='c_s_del'){//생성
		$c_s_idxs= implode(',',$check_cp_idx);
		//echo $a_idxs;exit;
		$rowsDeleted = $objdb->deleteRow('acbook_checklist_sub', 'check_sub_idx in ('.$c_s_idxs.')');
	}
   header("Location: ./checklist.php?search_month=9");
	$pdo = null; //DB작업종료
    exit();
?>
