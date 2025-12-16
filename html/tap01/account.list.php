<?
include_once "/demoyujin/www/account_book/html/include/head.php";  

if(empty($page_no))$page_no=0;//현재페이지번호 
if(empty($page_no_size))$page_no_size=5;//한화면에 나오는 페이지 갯수
if(empty($page_size))$pagesize=30;//한화면에나오는 데이터갯수
if(empty($page_box))$page_box=0;
$wherey='';
if(!empty($search_nyaer)){$wherey .=" and nyear=".$search_nyaer;}else{ $search_nyaer =""; }
if(!empty($search_month)){$wherey .=" and month=".$search_month;}else{ $search_month =""; }
if(!empty($search_day)){$wherey .=" and account_date='".$account_date."'";}else{$account_date =""; }
if(isset($account_type)){$wherey .=" and account_type=".$account_type;}else{$account_type ="";}
if(!empty($search_payment_idx)){$wherey .=" and payment_idx=".$search_payment_idx;}else{$search_payment_idx ="";}
if(!empty($search_account_category_idx)){$wherey .=" and account_category_idx=".$search_account_category_idx;}else{$search_account_category_idx ="";}

//지출내역
$sql ="select account_idx,account_type,account_category_idx,title,price,savings_idx,savings_yn,loan_yn,loan_type,loan_complete,payment_idx,DATE_FORMAT(account_date,'%Y-%m-%d') account_date,memo
from acbook_account where account_idx >= 0 and account_category_idx!=12 ".$wherey." order by account_date desc ";//limit ".$pagesize." OFFSET ".$page_no
echo $sql;
$acount_list_rows = $objdb->fetchAllRows($sql);

$sql="select count(*) cnt from acbook_account where account_idx >= 0".$wherey;
$acount =  $objdb-> fetchRow($sql);

$page_cnt=$acount['cnt']/$pagesize;//실질적 페이지 갯수 
$page_box_cnt=$page_cnt/$page_no_size;//페이지박스의갯수
$qarydata="";
$qarydata="&search_nyaer=".$search_nyaer."& search_month=".$search_month."&search_payment_idx=".$search_payment_idx."&search_account_category_idx=".$search_account_category_idx."&account_type=".$account_type."&account_date".$account_date;

if($page_box>0){
echo "<a href='".$_self."?&page_box=".($page_box-1)."&page_no=".($page_no_size*$page_box).$qarydata."' >&nbsp;이전&nbsp;</a>";
}
for($p=0;$p<$page_no_size; $p++){
	$p_num= $p+($page_no_size*$page_box);
	echo "<a href='".$_self."?&page_box=".$page_box."&page_no=".$p_num.$qarydata."' >&nbsp;".$p_num."&nbsp;</a>";
}
if($page_box<$page_box_cnt){
echo "<a href='".$_self."?&page_box=".($page_box+1)."&page_no=".(($page_no_size*$page_box)+1).$qarydata."' >&nbsp;다음&nbsp;</a>";
}
/*적금 ,  채무 관련 코딩 필요*/
?>

        <form name="a_form" action="/account_book/html/tap01/account.call.php"  method="POST" >
		<input type='hidden' name="smode" id='smode' value="">
		<a href="javascript://" onclick="data_del('a_form','a_del')">삭제</a>
		<a href="javascript://" onclick="data_up('a_form','a_upda')">수정</a>
           <table>
                <thead>
                    <tr>
                        <th><input type='checkbox'></th></th>
						<th>no</th>
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

                    <? $no=1;
						$no=$no+($page_no*$pagesize);
						foreach ($acount_list_rows as $a_row) { 
							?>
                    <tr>account_type : <?echo$a_row['account_type']?>
                        <td> <input type='checkbox' name="account_idx[]" value="<?echo $a_row['account_idx'];?>" > </td>
						<td><? echo $no?> </td>
						<td><?echo $a_row['account_date'];?></td>
						 <td>
                            <? foreach ($ac_rows as $ac_row) { 
								if($ac_row['account_category_idx']== $a_row['account_category_idx']) echo $ac_row['account_category_name'];
							}?>
                        </td>
                        <td><a href="./calender_main.php?smode=updatemode&account_idx=<?echo $a_row['account_idx'];?>">
								<?echo $a_row['title'];?></a></td>
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
                    <? $no++;
					}?>
                </tbody>
            </table>
			
        </form>