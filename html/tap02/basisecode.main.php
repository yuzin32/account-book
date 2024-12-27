<?php  include_once "/demoyujin/www/account_book/html/include/head.php";  ?>

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
    <div class="tab-buttons">
        <a class="tab-link "  href="/account_book/html/tap01/calender_main.php" >메인</a>
        <a class="tab-link active"  >기초코드관리</a>
        <a class="tab-link ">Tab 3</a>
		</div >  
    <!-- 탭 내용 -->
    <div class="tab-content">
	
		<div class="code_box">
		<form name="ac_form" action="/account_book/html/tap02/basisecode.call.php"  method="POST">
		<input type='text' name="smode" value="ac_save">

			<h1>지출분야</h1>
		   <table>
				<thead>
					<tr>
						<th><input type='checkbox'></th>
						<th>지출분야</th>
						<th>통계사용여부</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type='checkbox' name="acount_category_idx[]" value=""></td>
						<td>지출분야</td>
						<td>통계사용여부</td>
					</tr>
				</tbody>
			</table>
			지출분야: <input type='text' name="acount_category_name" value="">
			통계사용여부: <input type='checkbox' name="statistics_use" value="Y">
			<a href="javascript://" onclick="data_save('ac_form')">저장</a>
			</form>
		</div>
		

		<div class="code_box" >
		<form name="p_form" action="/account_book/html/tap02/basisecode.call.php"  method="POST" >
		<input type='text' name="smode" value="p_save">
			<h1>결제수단</h1>
		   <table>
				<thead>
					<tr>
						<th><input type='checkbox'></th></th>
						<th>결제수단</th>
						<th>은행명</th>
						<th>매개</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<th><input type='checkbox' name="acount_category_idx[]" value=""></th></th>
						<td>결제수단</td>
						<td>은행명</td>
						<td>매개</td>
					</tr>
				</tbody>
			</table>
			결제수단명 : <input type='text' name="payment_name" value="Y">
			은행명:
			<select name="bank_idx" ></select>
			매개 :
			<select name="payment_type" ></select>
			<a href="javascript://" onclick="data_save('p_form')">저장</a>
		</form>
		</div>

    </div><!-- 탭 내용 -->
</div>
</div>
<!-- 	<footer>
		<p>&copy; 2024 Your Website. All rights reserved.</p>
	</footer> -->
</body>
</html>

