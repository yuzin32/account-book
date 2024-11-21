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
<style>
    /* 기본 스타일 */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff;
        display: block;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .tabs {
        width: 100%;
        max-width: 600px;
    }

    .tab-buttons {
        display: flex;
        background-color: #e0f7ff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .tab-buttons button {
        flex: 1;
        padding: 12px 16px;
        background-color: #e0f7ff;
        border: none;
        cursor: pointer;
        color: #0077cc;
        font-weight: bold;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .tab-buttons button.active,
    .tab-buttons button:hover {
        background-color: #b3e5ff;
        color: #005a99;
    }

    .tab-content {
        padding: 16px;
        border: 1px solid #b3e5ff;
        border-top: none;
        background-color: #ffffff;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

</style>
<div class="tabs">
    <!-- 탭 버튼 -->
    <div class="tab-buttons">
        <button class="tab-link <?php echo $p_active1;?>">Tab 1</button>
        <button class="tab-link <?php echo $p_active2;?>">Tab 2</button>
        <button class="tab-link <?php echo $p_active3;?>">Tab 3</button>
    </div>
    <!-- 탭 내용 -->
    <div class="tab-content">

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

    </div>
</div>
