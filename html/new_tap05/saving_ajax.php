<?
include_once  "/demoyujin/www/account_book/Setting/config.inc.php";
if($modal=="saveing-new"){
    //지출내역
    $sql ="select savings_idx,savings_name,bank_idx,DATE_FORMAT(start_date, '%Y-%m-%d') start_date,DATE_FORMAT(end_date, '%Y-%m-%d') end_date,use_yn,one_price,total_price 
    ,(select systemcode_name from acbook_systemcode where systemcode_key='bank' and systemcode_idx=s.bank_idx) bank_name
    from acbook_savings s where savings_idx>=0 and savings_idx=".$this_saving_idx;//limit ".$pagesize."  ".$page_no
    $row = $objdb->fetchRow($sql);

    $result = [
        'modal'             =>$modal,
        'savings_idx'          =>$row['savings_idx']?? null,
        'savings_name'          => $row['savings_name'] ?? null,
        'bank_idx'          => $row['bank_idx'] ?? null,
        'start_date'         => $row['start_date'] ?? null,
        'end_date'         => $row['end_date'] ?? null,
        'use_yn' => $row['use_yn'] ?? null,
        'one_price'                => $row['one_price'] ?? 0,
        'total_price'                => $row['total_price'] ?? 0
    ];
}else if($modal=="saveing-list"){
        //지출내역
    $sql ="select savings_name ,(select systemcode_name from acbook_systemcode where systemcode_key='bank' and systemcode_idx=s.bank_idx) bank_name FROM acbook_savings s where savings_idx = {$this_saving_idx}";
    $row = $objdb->fetchRow($sql);

    $limit = 8;
    $offset = ($page - 1) * $limit;
    $sql ="select count(*) cnt FROM acbook_account where savings_yn='y' and savings_idx={$this_saving_idx}";
    $total_count = $objdb->fetchRow($sql);
    $total_page = ceil($total_count['cnt'] / $limit);

    $sql ="select s.savings_idx,a.savings_yn,a.title,a.account_date,a.price
    FROM acbook_account a left join acbook_savings s on s.savings_idx=a.savings_idx where a.savings_yn='y' and a.savings_idx={$this_saving_idx} limit {$offset}, {$limit}";
    $saving_list_row = $objdb->fetchAllRows($sql);


    // 테이블 HTML
    $rows_html = '';
    $no=0+$offset;
    foreach ($saving_list_row as $s_row) {
    $no++;
    $rows_html .= "<tr>
        <td>{$no}</td>
        <td>{$s_row['title']}</td>
        <td>{$s_row['account_date']}</td>
        <td>".number_format($s_row['price'])."</td>
        </tr>";
    }

    $pagination_html ='';
    if($total_page > 1){

        // 이전 버튼
        if($page > 1){
            $prev_page = $page - 1;
            $pagination_html .= "<li class='arrow prev'>
                <a href='#none' onclick=\"dataload({$this_saving_idx}, '{$modal}', {$prev_page})\" title='이전'></a>
            </li>";
        }

        // 페이지 번호
        for ($i = 1; $i <= $total_page; $i++) {
            $active = ($i == $page) ? "class='on'" : "";

            $pagination_html .= "<li {$active}>
                <a  href='#none' onclick=\"dataload({$this_saving_idx}, '{$modal}', {$i})\">{$i}</a>
            </li>";
        }

        // 다음 버튼
        if($page < $total_page){
            $next_page = $page + 1;
            $pagination_html .= "<li class='arrow next'>
                <a href='#none' onclick=\"dataload({$this_saving_idx}, '{$modal}', {$next_page})\" title='다음'></a>
            </li>";
        }
    }

    
    $result = [
    'savings_name'  => !empty($row['bank_name']) ? $row['bank_name'] : $row['savings_name'],
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