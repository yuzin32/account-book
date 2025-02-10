<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?

/*---검색값 없을 시 현재 년도와 월 가져오기---*/
$account_date = isset($search_date) ? $search_date :date('Y-m-d');
if(!empty($account_date)){
	$search_date_tmp = explode('-',$account_date);
	$main_year=$search_date_tmp[0]; 
	$main_month=$search_date_tmp[1]; 
	$main_day=$search_date_tmp[2]; 
}
/*-------------------------------*/

// 해당 월의 첫날과 마지막 날
$firstDayOfMonth = strtotime("$main_year-$main_month-01");
$lastDayOfMonth = date('t', $firstDayOfMonth);

// 첫날의 요일 (0: 일요일, 6: 토요일)
$startDayOfWeek = date('w', $firstDayOfMonth);
//지출수입 구분값 
if(empty($account_type))$account_type=0;
$serch_month=$main_month
?>
<script>
function data_save(formName) {
    const form = document.forms[formName]; // 폼 이름으로 선택
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

		<!--캘린더 -->
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

		</div>
		<!-- 작성폼 --> 
		<div class="cal-box">
			<?include "/demoyujin/www/account_book/html/tap01/account.write.php"?>
		</div>
		<!-- 지출리스트  --> 
		<div class="cal-box2">
			<!-- 검색 -->
			<form name="serch_form" method="POST" >
			<!-- 월검색 클릭하면 날짜검색이 안되야 하고 날짜 검색 클릭하면 월검색이 안되어야 함 해당 javascript넣기 -->
			월 검색:
				<select name="serch_month">
				<option value="" >검색 월을 선택하세요</option>
				<?for($m=1; $m<=12; $m++){?>
					<option value="<?echo $m;?>" <?selected_on($main_month,$m);?>><?echo $m;?>월
					<?}?>
				</select>
				날짜검색:
				<input type="date" id="search_date" name="search_date" value="<?echo $search_date?>">
                    <select name="account_type" id="account_type">
						<option value="0" <? selected_on(0,$account_type);?>>지출</option>
                        <option value="1" <? selected_on(1,$account_type);?>>수입</option>
                    </select>
				<a href="javascript://" onclick="data_save('serch_form')">검색</a>
			</form>
			<!-- 검색 끝 -->
			<div class="cal_list_box">
			<?$serch_mode='today'?>
			<?include "/demoyujin/www/account_book/html/tap01/account.list.php"?>
			</div>
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

