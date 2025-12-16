<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?
//지출종류리스트
$sql = "select account_category_idx,account_category_name,statistics_use from acbook_account_category where account_type=0";
$ac_rows = $objdb->fetchAllRows($sql);
//지불수단 리스트
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn,price from acbook_payment";
$pay_rows = $objdb->fetchAllRows($sql);

//적금 리스트
$sql =" select savings_idx,savings_name,total_price from acbook_savings";
$s_rows = $objdb->fetchAllRows($sql);

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
		<!-- 검색폼 --> 
		<div class="cal-box2">
		<?include "/demoyujin/www/account_book/html/tap05/search_tmp.php"?>
		</div>
		<div class="cal-box">현재 재정상태
		<?include "/demoyujin/www/account_book/html/tap05/report.payment_total.php"?>
		</div>
		<div class="cal-box"> </div>
		<div class="cal-box2">
		월별 총지출
			<?include "/demoyujin/www/account_book/html/tap05/report.account_total.php"?>
		</div>
		<div class="cal-box2">
			<?include "/demoyujin/www/account_book/html/tap05/report.account_category_total.php"?>
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

