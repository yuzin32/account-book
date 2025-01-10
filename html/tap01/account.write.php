<?
include_once "/demoyujin/www/account_book/html/include/head.php";  

//지출수단
$sql = "select acount_category_idx,acount_category_name,statistics_use from acbook_account_category";
$ac_rows = $objdb->fetchAllRows($sql);
//은행
$sql ="select systemcode_idx,systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='bank'";
$bank_rows = $objdb->fetchAllRows($sql);

//은행
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn from acbook_payment";
$pay_rows = $objdb->fetchAllRows($sql);

?>
<form action="account.call.php" method="POST">
    <table class="ac_write">
        <tbody>
            <tr>
                <th><label for="type">지출/수입:</label></th>
                <td>
                    <select name="type" id="account_type">
                        <option value="1">수입</option>
                        <option value="0">지출</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <th><label for="account_category_idx">지출 분야:</label></th>
                <td>
                    <select name="account_category_idx" id="account_category_idx">
					<option value="">지출분야를 선택하세요</option>
					<? foreach ($ac_rows as $ac_row) { ?>
					<option value="<?echo $ac_row['acount_category_idx']?>"><?echo $ac_row['acount_category_name']?></option>
					<?}?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="date">결제일:</label></th>
                <td><input type="date" name="date" id="date" required></td>
            </tr>

            <tr>
                <th><label for="title">내용:</label></th>
                <td><input type="text" name="title" id="title" placeholder="지출/수입 내용" required></td>
            </tr>
            
            <tr>
                <th><label for="price">금액:</label></th>
                <td><input type="number" name="price" id="price" placeholder="금액을 입력하세요" required></td>
            </tr>

            <tr>
                <th><label for="method">결제수단:</label></th>
                <td>
                    <select name="method" id="method">
                        <option value="">결제수단을 선택하세요</option>
						<? foreach ($pay_rows as $p_row) { ?>
							<option value="<?echo $p_row['payment_idx']?>"><?echo $p_row['payment_name']?></option>
						<?}?>
                    </select>
                </td>
            </tr>
			<tr>
                <th><label for="savings_yn">적금</label></th>
                <td><input type='checkbox' name='savings_yn' value></td>
                <td>
                    <select name="savings_idx" id="savings_idx">
                        <option value="현금">적금을 선택하세요</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><label for="memo">메모:</label></th>
                <td><textarea name="memo" id="memo" placeholder="메모를 입력하세요"></textarea></td>
            </tr>

        </tbody>
    </table>
    
    <!-- 제출 버튼 -->
    <button type="submit">저장</button>
	<a href="/account book/html/main/"> 홈으로 </a>
</form>

