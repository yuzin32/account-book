<?php
/*
$sql = "SELECT systemcode_key, systemcode_name, systemcode_value FROM acbook_systemcode";
$rows = $objdb->fetchAllRows($sql);
foreach($rows as $row){
	foreach($rows as $val){
	
	}
}*/
//카테고리
function select_account_category_name($idx){
    global $objdb;
    static $ac_map = null;
    if ($ac_map === null) {
        $sql = "SELECT account_category_idx, account_category_name FROM acbook_account_category";
        $ac_rows = $objdb->fetchAllRows($sql);
        $ac_map = [];
        foreach ($ac_rows as $ac_row) {
            $ac_map[$ac_row['account_category_idx']] = $ac_row['account_category_name'];
        }
    }
    if($idx=='all'){
		return $ac_map?? null;
	}else{
		 return $ac_map[$idx] ?? null;
	}
}

//지불수단 리스트
function select_payment_name($idx = null){
    global $objdb;
    static $p_map = null;
    if ($p_map === null) {
        $sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn,price  from acbook_payment";
        $pay_rows = $objdb->fetchAllRows($sql);
        $p_map = [];
        foreach ($pay_rows as $p_row) {
            $p_map[$p_row['payment_idx']] = $p_row['payment_name'];
        }
    }
	if($idx=='all'){
		return $p_map?? null;
	}else{
		return $p_map[$idx] ?? null;
	}
    
}

//적금 리스트
function select_savings_name($idx){
    global $objdb;
    static $s_map = null;
    if ($s_map === null) {
        $sql =" select savings_idx,savings_name,total_price  from acbook_savings";
        $saving_rows = $objdb->fetchAllRows($sql);
        $s_map = [];
        foreach ($saving_rows as $s_row) {
            $s_map[$s_row['savings_idx']] = $s_row['savings_name'];
        }
    }
    if($idx=='all'){
		return $s_map?? null;
	}else{
		 return $s_map[$idx] ?? null;
	}
}

?>