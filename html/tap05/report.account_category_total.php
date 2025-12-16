<?
print_r($_POST);
if(empty($search_nyear))$search_nyear=date('Y');
if(empty($search_month))$search_month=date('m');
$wherey="";
if(isset($search_nyear)||!empty($search_nyear))$wherey.=" and a.nyear=".$search_nyear;
if(isset($search_month)||!empty($search_month))$wherey.=" and a.month=".$search_month;
/*if(isset($search_payment_idx)||!empty($search_payment_idx))$wherey.=" and payment_idx=".$search_payment_idx;*/
//월별 지출합계
$sql ="select sum(price) ac_price,c.account_category_name category_name
from acbook_account a LEFT JOIN acbook_account_category c ON a.account_category_idx = c.account_category_idx
where a.account_type = 0 ".$wherey." group by a.account_category_idx order by ac_price desc";
$ac_total_rows = $objdb->fetchAllRows($sql);
echo $sql;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>막대그래프 비교</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <canvas id="barChart"></canvas>

    <script>
        // PHP 데이터를 JavaScript 배열로 변환
        const categories = [];
        const prices = [];

        <?php foreach ($ac_total_rows as $ac) { ?>
            categories.push("<?php echo $ac['category_name']; ?>");
            prices.push(<?php echo $ac['ac_price']; ?>);
        <?php } ?>

        // Chart.js를 사용하여 막대그래프 생성
        const ctx = document.getElementById('barChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [{
                    label: '지출카테고리',
                    data: prices,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>
</html>
