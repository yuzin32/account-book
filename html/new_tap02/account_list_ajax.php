<?
include_once  "/demoyujin/www/account_book/Setting/config.inc.php";
$limit = 8;
$offset = ($page - 1) * $limit;
$wherey="nyear=$main_year and  month = $main_month and userid='".$_SESSION['userid']."'";
if($list_type=="in_list"){
  $wherey .= " and account_type = 1";
}else if($list_type=="out_list"){
  $wherey .= " and account_type = 0";
}else if($list_type=="save_list"){
  $wherey .= " and savings_yn = 'y'";
}else if($list_type=="loan_list"){
  $wherey .= " and loan_yn = 'y'";
}
if(!empty($search_ac)){ $wherey .=" and account_category_idx=".$search_ac; }
if(!empty($search_p)){ $wherey .=" and payment_idx=".$search_p; }
//지불수단 리스트
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn,price  from acbook_payment";
$pay_rows = $objdb->fetchAllRows($sql);
$p_map = [];
foreach ($pay_rows as $p_row) {
    $p_map[$p_row['payment_idx']] = $p_row['payment_name'];
}

//지출내역
$sql ="select account_idx,account_type,account_category_idx,title,price,savings_idx,savings_yn,loan_yn,loan_type,loan_complete,payment_idx,DATE_FORMAT(account_date,'%Y-%m-%d') account_date,memo
from acbook_account where account_idx >= 0 and ".$wherey." order by account_date asc ";//limit ".$pagesize."  ".$page_no
$acount_list_rows = $objdb->fetchAllRows($sql);

$total_count = count($acount_list_rows);
$total_page = ceil($total_count / $limit);

$paged_rows = array_slice($acount_list_rows, $offset, $limit);
// 테이블 HTML
$rows_html = '';

$no=0+$offset;
foreach ($paged_rows as $a_row) {
  $no++;
  $category_name = select_account_category_name($a_row['account_category_idx']);
  $payment_name = select_payment_name($a_row['payment_idx']);
  $savings_name = select_savings_name($a_row['savings_idx']);
  
  $rows_html .= "<tr>
      <td>{$no}</td>
      <td>{$a_row['account_date']}</td>
      <td>{$category_name}</td>
      <td>{$a_row['title']}</td>
      <td>".number_format($a_row['price'])."</td>
      <td>{$payment_name}</td>
      <td>{$savings_name}</td>
      <td>loan_IDX추가하기</td>
      <td>{$a_row['memo']}</td>
    </tr>";
}

$pagination_html ='';
$active ='';
$pagination_html .= "<li class='arrow prev'><a href='#none' title='이전'></a></li>";
for ($i = 1; $i <= $total_page; $i++) {
    if($i == $page) $active ="class='on'";
    $pagination_html .= "<li><a ".$active." href='#none' onclick='loadPage(".$i.")'>$i</a></li> ";
}
$pagination_html .='<li class="arrow next"><a href="#none" title="다음"></a></li>';

//header('Content-Type: application/json');
echo json_encode([
  'rows_html' => $rows_html,
  'pagination_html' => $pagination_html
]);

//exit;
?>