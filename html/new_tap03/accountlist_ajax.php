<?
include_once  "/demoyujin/www/account_book/Setting/config.inc.php";

//지출내역
$sql ="select account_idx,account_type,account_category_idx,title,price,savings_idx,savings_yn,loan_yn,
loan_type,loan_complete,payment_idx,DATE_FORMAT(account_date,'%Y-%m-%d') account_date,memo
from acbook_account where account_idx = {$this_account_idx}";//limit ".$pagesize."  ".$page_no
$row = $objdb->fetchRow($sql);

$result = [
    'account_idx'          => $row['account_idx'] ?? null,
    'account_type'         => $row['account_type'] ?? null,
    'payment_idx'         => $row['payment_idx'] ?? null,
    'account_category_idx' => $row['account_category_idx'] ?? null,
    'title'                => $row['title'] ?? '',
    'price'                => $row['price'] ?? 0,
    'account_date'         => $row['account_date'] ?? '',
    'savings_idx'         => $row['savings_idx'] ?? '',
    'memo'                 => $row['memo'] ?? ''
    
];

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit;
?>