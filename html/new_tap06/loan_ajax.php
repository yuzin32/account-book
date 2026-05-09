<?
include_once  "/demoyujin/www/account_book/Setting/config.inc.php";
if($modal=="debt-new"){
    //지출내역
    $sql ="select loan_idx,loan_type,counterparty_name,loan_reason,loan_date,total_amount,bank_idx
    ,(select systemcode_name from acbook_systemcode where systemcode_key='bank' and systemcode_idx=l.bank_idx) bank_name
    ,(select systemcode_name from acbook_systemcode where systemcode_key='loan_type' and systemcode_value=l.loan_type) loan_type_name
    FROM acbook_loan l where loan_idx = {$this_loan_idx}";//limit ".$pagesize."  ".$page_no
    $row = $objdb->fetchRow($sql);

    $result = [
        'modal'          =>$modal,
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
    

}else if($modal=="debt-list"){
        //지출내역
    $sql ="select counterparty_name,(select systemcode_name from acbook_systemcode where systemcode_key='bank' and systemcode_idx=l.bank_idx) bank_name FROM acbook_loan l where loan_idx = {$this_loan_idx}";
    $row = $objdb->fetchRow($sql);

    $limit = 8;
    $offset = ($page - 1) * $limit;
    $sql ="select count(*) cnt FROM acbook_account where loan_yn='y' and loan_idx={$this_loan_idx}";
    $total_count = $objdb->fetchRow($sql);
    $total_page = ceil($total_count['cnt'] / $limit);

    $sql ="select l.loan_idx,a.loan_yn,l.loan_type,a.title,a.account_date,a.price,
    (select systemcode_name from acbook_systemcode where systemcode_key='loan_type' and systemcode_value=l.loan_type) loan_type_name
    FROM acbook_account a left join acbook_loan l on l.loan_idx=a.loan_idx where a.loan_yn='y' and a.loan_idx={$this_loan_idx} limit {$offset}, {$limit}";
    $loan_list_row = $objdb->fetchAllRows($sql);


    // 테이블 HTML
    $rows_html = '';
    $no=0+$offset;
    foreach ($loan_list_row as $l_row) {
    $no++;
    $rows_html .= "<tr>
        <td>{$no}</td>
        <td>{$l_row['loan_type_name']}</td>
        <td>{$l_row['title']}</td>
        <td>{$l_row['account_date']}</td>
        <td>".number_format($l_row['price'])."</td>
        </tr>";
    }

    $pagination_html ='';
    if($total_page > 1){

        // 이전 버튼
        if($page > 1){
            $prev_page = $page - 1;
            $pagination_html .= "<li class='arrow prev'>
                <a href='#none' onclick=\"dataload({$this_loan_idx}, '{$modal}', {$prev_page})\" title='이전'></a>
            </li>";
        }

        // 페이지 번호
        for ($i = 1; $i <= $total_page; $i++) {
            $active = ($i == $page) ? "class='on'" : "";

            $pagination_html .= "<li {$active}>
                <a  href='#none' onclick=\"dataload({$this_loan_idx}, '{$modal}', {$i})\">{$i}</a>
            </li>";
        }

        // 다음 버튼
        if($page < $total_page){
            $next_page = $page + 1;
            $pagination_html .= "<li class='arrow next'>
                <a href='#none' onclick=\"dataload({$this_loan_idx}, '{$modal}', {$next_page})\" title='다음'></a>
            </li>";
        }
    }

    
    $result = [
    'counterparty_name'  => !empty($row['bank_name']) ? $row['bank_name'] : $row['counterparty_name'],
    'total_count'  => $total_count['cnt'],
    'modal'          =>$modal,
    'rows_html' => $rows_html,
    'pagination_html' => $pagination_html
    ];

}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit;
?>