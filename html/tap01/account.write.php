<?
include_once "/demoyujin/www/account_book/html/include/head.php";
if(empty($smode)){$smode='search';}
if($smode=='updatemode'){
	$sql="select account_idx,account_type,account_category_idx,title,price,savings_idx,savings_yn,loan_yn,loan_type,loan_complete,payment_idx,
	DATE_FORMAT(account_date,'%Y-%m-%d') account_date,memo,month,nyear
	from acbook_account where account_idx =".$account_idx;
	$a_row = $objdb->fetchRow($sql);
	$main_month=$a_row['month'];
	$main_year=$a_row['nyear'];
	$account_type=$a_row['account_type'];
	$account_date=$a_row['account_date'];
}
//지불수단 리스트
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn from acbook_payment";
$pay_rows = $objdb->fetchAllRows($sql);
?>
<script>
function get_save_month(){
	var dateValue = document.getElementById("account_date").value;


	if(dateValue){
		var nyear = new Date(dateValue).getFullYear();
		var month = new Date(dateValue).getMonth()+1;
		document.getElementById("month").value = month;
		document.getElementById("nyear").value = nyear;
	
	}

}
</script>

<form name="a_w_form" action="account.call.php" method="POST">
<input type='hidden' name='smode' id="smode" value='<?=$smode?>' >
<input type='hidden' name="month" id='month'value="<?echo $main_month;?>">	
<input type='hidden' name="nyear" id='nyear' value="<?echo $main_year;?>">
<input type='hidden' name="account_idx" id='account_idx' value="<?=isset($a_row['account_idx'])?$a_row['account_idx']:''?>">
<input type='hidden' name="account_type" id='account_type' value="<?echo $account_type?>"><?echo $vSystem_account_type[$account_type]?>
    <table >
        <tbody>
            <tr>
                <th><label for="type">지출/수입:</label></th>
                <td><?echo $vSystem_account_type[$account_type]?></td>
            </tr>
            <input type="date" id="account_date" name="account_date" value="<?echo $account_date?>" onchange="get_save_month()">
            <tr>
                <th><label for="account_category_idx">지출 분야:</label></th>
                <td>
                    <select name="account_category_idx" id="account_category_idx">
					<option value="">지출분야를 선택하세요</option>
					<? foreach ($ac_rows as $ac_row) { ?>
					<option value="<?echo $ac_row['account_category_idx']?>" <?selected_on($a_row['account_category_idx'],$ac_row['account_category_idx'])?>><?echo $ac_row['account_category_name']?></option>
					<?}?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><label for="title">내용:</label></th>
                <td><input type="text" name="title" id="title" value="<?=isset($a_row['title'])?$a_row['title']:''?>" placeholder="지출/수입 내용" required ></td>
            </tr>
            
            <tr>
                <th><label for="price">금액:</label></th>
                <td><input type="number" name="price" id="price" value="<?=isset($a_row['price'])?$a_row['price']:''?>" placeholder="금액을 입력하세요" required></td>
            </tr>

            <tr>
                <th><label for="payment_idx">결제수단:</label></th>
                <td>
                    <select name="payment_idx" id="payment_idx">
                        <option value="">결제수단을 선택하세요</option>
						<? foreach ($pay_rows as $p_row) { ?>
							<option value="<?echo $p_row['payment_idx']?>" <?selected_on($a_row['payment_idx'],$p_row['payment_idx'])?>><?echo $p_row['payment_name']?></option>
						<?}?>
                    </select>
                </td>
            </tr>
			<tr>
                <th><label for="savings_yn">적금</label></th>
                <td><input type='checkbox' name='savings_yn' value='y'>
                    <select name="savings_idx" id="savings_idx">
						<option value="">적금을 선택하세요</option>
						<? foreach ($s_rows as $s_row) { ?>
						<option value="<?echo $s_row['savings_idx']?>" <?selected_on($a_row['savings_idx'],$s_row['savings_idx'])?>><?echo $s_row['savings_name']?></option>
						<?}?>
                    </select>
                </td>
            </tr>
			<tr>
                <th><label for="loan_yn">채무</label></th>
                <td><input type='checkbox' name='loan_yn' value='y' <?checked_on($a_row['loan_yn'],'y')?>>
<!--                     <select name="savings_idx" id="savings_idx">
                    						<option value="">적금을 선택하세요</option>
                    						<? foreach ($s_rows as $s_row) { ?>
                    						<option value="<?echo $s_row['savings_idx']?>"><?echo $s_row['savings_name']?></option>
                    						<?}?>-->
                </td>
            </tr>

            <tr>
                <th><label for="memo">메모:</label></th>
                <td><textarea name="memo" id="memo" placeholder="메모를 입력하세요"><?=isset($a_row['memo'])?$a_row['memo']:''?></textarea></td>
            </tr>

        </tbody>
    </table>
    
    <!-- 제출 버튼 -->
    <a href="javascript://" onclick="data_save('a_w_form');">저장<a/>
</form>

