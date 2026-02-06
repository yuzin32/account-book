<?
include_once  "/demoyujin/www/account_book/Setting/config.inc.php";

//지출내역
$sql ="select loan_idx,loan_type,counterparty_name,loan_reason,loan_date,total_amount,bank_idx
,(select systemcode_name from acbook_systemcode where systemcode_key='bank' and systemcode_idx=l.bank_idx) bank_name
,(select systemcode_name from acbook_systemcode where systemcode_key='loan_type' and systemcode_value=l.loan_type) loan_type_name
FROM acbook_loan l where loan_idx = {$this_loan_idx}";//limit ".$pagesize."  ".$page_no
$row = $objdb->fetchRow($sql);

$result = [
    'loan_idx'          =>$row['loan_idx']?? null,
    'loan_type'          => $row['loan_type'] ?? null,
    'loan_type_name'          => $row['loan_type_name'] ?? null,
    'counterparty_name'         => $row['counterparty_name'] ?? null,
    'loan_reason'         => $row['loan_reason'] ?? null,
    'loan_date' => $row['loan_date'] ?? null,
    'total_amount'                => $row['total_amount'] ?? 0,
    'bank_idx'                => $row['bank_idx'] ?? '',
    'bank_name'         => $row['bank_name'] ?? '',
];

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit;
?>