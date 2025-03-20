
	<!-- 탭 버튼 -->
    <div class="tab-buttons">
        <a class="tab-link <?if($tap_code=='01')echo 'active'?>" href="/account_book/html/tap01/calender_main.php" >캘린더</a>
		<a class="tab-link <?if($tap_code=='02')echo 'active'?>" href="/account_book/html/tap02/checklist_main.php">체크리스트</a>
		<a class="tab-link <?if($tap_code=='03')echo 'active'?>" href="/account_book/html/tap03/saving_main.php">적금/채무</a>
        <a class="tab-link <?if($tap_code=='04')echo 'active'?>" href="/account_book/html/tap04/basisecode_main.php">기초코드관리</a>
		<a class="tab-link <?if($tap_code=='05')echo 'active'?>" href="/account_book/html/tap05/report_main.php" >통계</a>
    </div>