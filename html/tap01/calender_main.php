<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?
//지출수입 구분값 
if(empty($account_type))$account_type=0;
//지출수단 리스트
$sql = "select account_category_idx,account_category_name,statistics_use from acbook_account_category where account_type=".$account_type;
$ac_rows = $objdb->fetchAllRows($sql);
//은행 리스트
$sql ="select systemcode_idx,systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='bank'";
$bank_rows = $objdb->fetchAllRows($sql);

//지불수단 리스트
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn,price  from acbook_payment";
$pay_rows = $objdb->fetchAllRows($sql);

//적금 리스트
$sql =" select savings_idx,savings_name,total_price  from acbook_savings";
$s_rows = $objdb->fetchAllRows($sql);

/*---검색값 없을 시 현재 년도와 월 가져오기---*/
if(!isset($search_nyaer))$search_nyaer='';
if(!isset($search_month))$search_month='';
if(!isset($search_day))$search_day='';
if(!empty($search_nyaer)){ $main_year=$search_nyaer; }else{$main_year=date('Y'); $search_nyaer=date('Y'); }
if(!empty($search_month)){ $main_month=$search_month; }else{$main_month=date('m'); }
if(!empty($search_day)){ $main_day=$search_day; }else{$main_day=date('d'); }
echo $search_nyaer.'/'.$search_month.'/'.$search_day;

$account_date=$main_year.'-'.$main_month.'-'.$main_day;
/*-------------------------------*/

// 해당 월의 첫날과 마지막 날
$firstDayOfMonth = strtotime("$main_year-$main_month-01");
$lastDayOfMonth = date('t', $firstDayOfMonth);

// 첫날의 요일 (0: 일요일, 6: 토요일)
$startDayOfWeek = date('w', $firstDayOfMonth);

?>
<script>
function data_save(formName) {
    const form = document.forms[formName]; // 폼 이름으로 선택
        form.submit(); // submit 함수 호출
}
function data_del(formName,smode) {
    const form = document.forms[formName]; // 폼 이름으로 선택
	form["smode"].value = smode;
    form.submit(); // submit 함수 호출
}
</script>
<body>
	<header>
	</header>
<div class="page-wrapper">

<div class="tab-wrapper">
    <!-- 탭 버튼 -->
	<?include "/demoyujin/www/account_book/html/include/tap_tmep.php"?>
    <!-- 탭 내용 -->
    <div class="tab-content">
	<div class="cal-part">
		<div class="cal-box2">
			<?include "/demoyujin/www/account_book/html/tap01/search_tmp.php"?>
		</div>
<!-- 		캘린더
		<div class="cal-box">
			<table class="ac_write" border='1' cellspacing='0' cellpadding='5'>
				<?php
				echo "<tr><th colspan='7'>{$main_year}년 {$main_month}월</th></tr>";
				echo "<tr><th>일</th><th>월</th><th>화</th><th>수</th><th>목</th><th>금</th><th>토</th></tr>";
				?>
				<tr>
					<?php
					// 첫 주 빈 칸 채우기
					for ($i = 0; $i < $startDayOfWeek; $i++) {
						echo "<td></td>";
					}
		
					// 날짜 채우기
					for ($day = 1; $day <= $lastDayOfMonth; $day++) {
						// 해당 날짜 출력
						echo "<td><a href='calender.write.php?day=$day'>{$day}</a></td>";
						
						// 토요일마다 줄 바꿈
						if (($day + $startDayOfWeek) % 7 == 0) {
							echo "</tr><tr>";
						}
					}
		
					// 마지막 주 빈 칸 채우기
					$endDayOfWeek = ($startDayOfWeek + $lastDayOfMonth) % 7;
					if ($endDayOfWeek != 0) {
						for ($i = $endDayOfWeek; $i < 7; $i++) {
							echo "<td></td>";
						}
					}?>
				</tr>
			</table>
		</div> -->
		<div class="cal-box">현재 재정상태
		<?include "/demoyujin/www/account_book/html/tap01/payment_total.php"?>
		</div>
		<!-- 작성폼 --> 
		<div class="cal-box cal_list2">
			<?include "/demoyujin/www/account_book/html/tap01/account.write.php"?>
		</div>
		<!-- 지출리스트  --> 
		<div class="cal-box2 cal_list">
			<?$search_mode='today'?>
			<?include "/demoyujin/www/account_book/html/tap01/account.list.php"?>

		</div>


	</div>
    </div><!-- 탭 내용 -->
</div>
</div>
<!-- 	<footer>
		<p>&copy; 2024 Your Website. All rights reserved.</p>
	</footer> -->
</body>
</html>

