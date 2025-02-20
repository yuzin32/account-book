<?
include_once "/demoyujin/www/account_book/html/include/head.php";  

$wherey='';
if(!empty($search_nyaer))$wherey .=" and nyear=".$search_nyaer;
if(!empty($search_month))$wherey .=" and month=".$search_month;
if(!empty($search_day))$wherey .=" and account_date=".$account_date;
if(!empty($search_account_type))$wherey .=" and account_type=".$search_account_type;
if(!empty($search_payment_idx))$wherey .=" and payment_idx=".$search_payment_idx;
if(!empty($search_account_category_idx))$wherey .=" and account_category_idx=".$search_account_category_idx;

//지출내역
$sql ="select account_idx,account_type,account_category_idx,title,price,savings_idx,savings_yn,loan_yn,loan_type,loan_complete,payment_idx,DATE_FORMAT(account_date,'%Y-%m-%d') account_date,memo
from acbook_account where account_idx >= 0".$wherey." order by account_date desc";
echo $sql;
$acount_rows = $objdb->fetchAllRows($sql);

/*적금 ,  채무 관련 코딩 필요*/

?>
<script>
</script>
        <form name="a_form" action="/account_book/html/tap01/account.call.php"  method="POST" >
		<input type='hidden' name="smode" id='smode' value="">		
           <table>
                <thead>
                    <tr>
                        <th><input type='checkbox'></th></th>
						<th>날짜</th>
                        <th>지출분야</th>
						<th>사유</th>
						<th>기본금액</th>
						<th>지출수단</th>
						<th>적금</th>
						<th>채무</th>
                        <th>메모</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($acount_rows as $a_row) { ?>
                    <tr>
                        <td> <input type='checkbox' name="account_idx[]" value="<?echo $a_row['account_idx'];?>" > </td>
						<td><?echo $a_row['account_date'];?></td>
						 <td>
                            <? foreach ($ac_rows as $ac_row) { 
								if($ac_row['account_category_idx']== $a_row['account_category_idx']) echo $ac_row['account_category_name'];
							}?>
                        </td>
                        <td><?echo $a_row['title'];?></td>
						<td><?echo $a_row['price'];?>원</td>
						 <td>
                            <? foreach ($pay_rows as $p_row) { 
								if($p_row['payment_idx']== $a_row['payment_idx']) echo $p_row['payment_name'];
							}?>
                        </td>
						<td><? echo $a_row['savings_yn'];?></td>
						<td><? echo $a_row['loan_yn'];?></td>
                        <td><?echo $a_row['memo'];?></td>
                    </tr>
                    <?}?>
                </tbody>
            </table>
			<a href="javascript://" onclick="data_del('a_form','a_del')">삭제</a>
        </form>
		<script>
function data_save(formName) {
    const form = document.forms[formName]; // 폼 이름으로 선택
        form.submit(); // submit 함수 호출
}
</script>