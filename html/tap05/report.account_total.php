<?
include_once "/demoyujin/www/account_book/html/include/head.php";  

$wherey='';
if(!empty($search_nyaer))$wherey .=" and nyear=".$search_nyaer;
/*if(!empty($search_month))$wherey .=" and month=".$search_month;
if(!empty($search_day))$wherey .=" and account_date=".$account_date;
if(!empty($search_account_type))$wherey .=" and account_type=".$search_account_type;
if(!empty($search_payment_idx))$wherey .=" and payment_idx=".$search_payment_idx;
if(!empty($search_account_category_idx))$wherey .=" and account_category_idx=".$search_account_category_idx;*/

//월별 지출합계
$sql ="select sum(price) m_price,month
from acbook_account a where account_idx >= 0".$wherey." and a.account_type = 0 group by month order by account_date desc";
$acount_m_rows = $objdb->fetchAllRows($sql);
/*적금 ,  채무 관련 코딩 필요*/
?>
		     <table class="cal_list">
                <thead>
                    <tr>
					<? foreach ($acount_m_rows as $a_m_row) { ?>
                        <th><?echo $a_m_row['month'];?>월</th>
					<?}?>
                    </tr>
                </thead>
                <tbody>
					 <tr>
                    <? foreach ($acount_m_rows as $a_m_row) { ?>
                        <td> <?echo $a_m_row['m_price'];?></td>
                    <?}?>
					</tr>
                </tbody>
            </table>