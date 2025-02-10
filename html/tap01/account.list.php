<?
include_once "/demoyujin/www/account_book/html/include/head.php";  

//지출분야
$sql = "select account_category_idx,account_category_name,statistics_use from acbook_account_category";
$ac_rows = $objdb->fetchAllRows($sql);
//은행
$sql ="select systemcode_idx,systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='bank'";
$bank_rows = $objdb->fetchAllRows($sql);
//지불수단
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn from acbook_payment";
$pay_rows = $objdb->fetchAllRows($sql);

$wherey='';
if(isset($serch_month))$wherey =" and month=".$serch_month;
if(isset($search_date))$wherey =" and account_date=".$search_date;
if(isset($account_type))$wherey=" and account_type=".$account_type;

//지출내역
$sql ="select account_idx,account_type,account_category_idx,title,price,savings_idx,savings_yn,loan_yn,loan_type,loan_complete,payment_idx,DATE_FORMAT(account_date,'%Y-%m-%d') account_date,memo
from acbook_account where account_idx >= 0".$wherey;
$acount_rows = $objdb->fetchAllRows($sql);

/*적금 ,  채무 관련 코딩 필요*/

?>
<script>
function on_update(row){
	 const tr = row.closest('tr');
	 const inputs = tr.querySelectorAll('input');
	 const selects = tr.querySelectorAll('select');
	 
     var check_yn='y'

        // readonly 속성 제거
 inputs.forEach(input => {
        // 체크박스인 경우 체크 상태로 변경
       /* if (input.type === 'checkbox' && input.name.slice(-5)=='idx[]'){
			if(input.checked == false){
				input.checked = true;
                check_yn='n';
			}else{
                input.checked = false;
            }
        }*/
      });
      inputs.forEach(input => {
          if( check_yn=='n'){
              input.removeAttribute('disabled');
          }else if(check_yn=='y'){
              input.setAttribute('disabled', 'true');
          }
      });
	  selects.forEach(select => {
          if( check_yn=='n'){
              select.removeAttribute('disabled');
          }else if(check_yn=='y'){
              select.setAttribute('disabled', 'true');
          }
      });
}
</script>
        <form name="c_s_form" action="/account_book/html/tap02/checklist.call.php"  method="POST" >
        <input type='hidden' name="month" value="<?echo $month;?>">	
		<input type='hidden' name="nyear" value="<?echo $nyear;?>">		
		<input type='hidden' name="smode" id='smode'value="c_s_update">		
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
                        <td> <input type='checkbox' name="account_idx[]" value="<?echo $a_row['account_idx'];?>" onclick="on_update(this)" > </td>
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
                        <td><input type='text' name="memo[]" value="<?echo $a_row['memo'];?>"></td>
                    </tr>
                    <?}?>
                </tbody>
            </table>
            <a href="javascript://" onclick="data_save('c_s_form')">저장</a>
        </form>