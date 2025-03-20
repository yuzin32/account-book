<?
//월별 지출합계
$sql ="select sum(price) ac_price,(select account_category_name from acbook_account_category where account_category_idx= a.account_category_idx ) category_name
from acbook_account a where account_idx >= 0 group by account_category_idx order by ac_price desc";
$ac_total_rows = $objdb->fetchAllRows($sql);
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
