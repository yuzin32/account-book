<?php
// 현재 년도와 월 가져오기
$year = date('Y');
$month = date('m');

// 해당 월의 첫날과 마지막 날
$firstDayOfMonth = strtotime("$year-$month-01");
$lastDayOfMonth = date('t', $firstDayOfMonth);

// 첫날의 요일 (0: 일요일, 6: 토요일)
$startDayOfWeek = date('w', $firstDayOfMonth);

?>

<!-- // 캘린더 출력 -->
<table border='1' cellspacing='0' cellpadding='5'>
	<?php
	echo "<tr><th colspan='7'>{$year}년 {$month}월</th></tr>";
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

