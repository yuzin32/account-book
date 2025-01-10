<?php  include_once "/demoyujin/www/account_book/html/include/head.php";  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//지출수단
$sql = "select acount_category_idx,acount_category_name,statistics_use from acbook_account_category";
$ac_rows = $objdb->fetchAllRows($sql);
//은행
$sql ="select systemcode_idx,systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='bank'";
$bank_rows = $objdb->fetchAllRows($sql);

//은행
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn from acbook_payment";
$pay_rows = $objdb->fetchAllRows($sql);

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
function on_update(row){
	 const tr = row.closest('tr');
	 const inputs = tr.querySelectorAll('input');

	 inputs.forEach(input => {
        // readonly 속성 제거
        
		input.removeAttribute('disabled');
        // 체크박스인 경우 체크 상태로 변경
        if (input.type === 'checkbox' && input.name=='acount_category_idx[]') {
			if(input.checked == false){
				
				input.checked = true;
				const input_news = document.querySelectorAll('.input-new');
				 input_news.forEach(input_new => {
					// readoinput_newly 속성 추가
					input_new.setAttribute('disabled', true);
				  });
			}else{
				input.setAttribute('disabled');
				input.checked = false;
				const input_news = document.querySelectorAll('.input-new');
				 input_news.forEach(input_new => {
					// readoinput_newly 속성 추가
					input_new.setAttribute('disabled', false);
				  });
			
			}
        }
      });




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

		<!-- 지출분야 시스템코드 저장폼 시작  -->
		<div class="code_box">
		<form name="ac_form" action="/account_book/html/tap02/basisecode.call.php"  method="POST">
		<input type='hidden' name="smode" value="ac_save">

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
				<? foreach ($ac_rows as $ac_row) { ?>
					<tr>
						<td><input type='checkbox' name="acount_category_idx[]" value="<?echo $ac_row['acount_category_idx'];?>"></td>

						<td > <input type='text' name="acount_category_name[]" value="<?echo $ac_row['acount_category_name'];?>" disabled>
						<a href="javascript://" onclick="on_update(this)">수정</a>
						</td>
						<td><input type='checkbox' name="statistics_use[]" value="y" <?if($ac_row['statistics_use']=='y')echo 'checked'?> disabled></td>
					</tr>
					<?}?>
						
				</tbody>
			</table>
			<div class="input-new">
				지출분야: <input type='text' name="add_acount_category_name" value="" class="put">
				통계반영여부: <input type='checkbox' name="add_statistics_use" value="y"  class="put">
				<a href="javascript://" onclick="data_save('ac_form')">저장</a>
				<a href="javascript://" onclick="data_del('ac_form','ac_del')">삭제</a>
			<div>
			</form>
		</div>
		<!-- 지출분야 시스템코드 저장폼 끝  -->
		
		<!-- 결제수단 시스템코드 저장폼 시작  -->
		<div class="code_box" >
		<form name="p_form" action="/account_book/html/tap02/basisecode.call.php"  method="POST" >
		<input type='hidden' name="smode" value="p_save">
			<h1>결제수단</h1>
		   <table>
				<thead>
					<tr>
						<th><input type='checkbox'></th></th>
						<th>결제수단</th>
						<th>은행명</th>
						<th>매개</th>
						<th>사용여부</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<th><input type='checkbox' name="acount_category_idx[]" value=""></th></th>
					<? foreach ($pay_rows as $p_row) { ?>
						<td><? echo $p_row['payment_name']; ?></td>
						<td><? echo $p_row['bank_idx']; ?></td>
						<td><? echo $p_row['payment_type']; ?></td>
						<td><input type='checkbox' name="use_yn" value="y" <?if($p_row['use_yn']=='y')echo 'checked'?> disabled></td>
					<?}?>
					</tr>
				</tbody>
			</table>
			결제수단명 : <input type='text' name="payment_name" >
			은행명:
			<select name="bank_idx" >
			<? foreach ($bank_rows as $b_row) { ?>
			<option value="<?echo $b_row['systemcode_idx'];?>"><?echo $b_row['systemcode_name'];?></option>
			<?}?>
			</select>
			매개 :
			<select name="payment_type" >
			<?foreach($system_payment_type as $p_k => $p_v){?>
			<option value="<?echo $p_k;?>"><?echo $p_v;?></option>
			<?}?>
			</select>
			사용여부: <input type='checkbox' name="use_yn" value="y"  class="put">
			<a href="javascript://" onclick="data_save('p_form')">저장</a>
			<a href="javascript://" onclick="data_del('p_form','p_del')">삭제</a>
		</form>
		</div>
		<!-- 결제수단 시스템코드 저장폼 끝  -->

		<!-- 은행 시스템코드 저장폼 시작  -->
		<div class="code_box" >
		<form name="bank_form" action="/account_book/html/tap02/basisecode.call.php"  method="POST" >
		<input type='hidden' name="smode" value="bank_save">
			<h1>은행</h1>
		   <table>
				<thead>
					<tr>
						<th><input type='checkbox'></th></th>
						<th>은행코드</th>
						<th>은행명</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($bank_rows as $b_row) { ?>
					<tr>
						<td><input type='checkbox' name="systemcode_idx[]" value="<?echo $b_row['systemcode_idx'];?>"></td>
						<td><?echo $b_row['systemcode_value'];?></td>
						<td><?echo $b_row['systemcode_name'];?></td>
					</tr>
					<?}?>
				</tbody>
			</table>
			<input type='hidden' name="systemcode_key" value="bank" >
			은행코드 :<input type='text' name="systemcode_value" >
			은행명:<input type='text' name="systemcode_name" >
			
			<a href="javascript://" onclick="data_save('bank_form')">저장</a>
			<a href="javascript://" onclick="data_del('bank_form','bank_del')">삭제</a>
		</form>
		</div>
		<!-- 은행 시스템코드 저장폼 종료  -->

    </div><!-- 탭 내용 -->
</div>
</div>
<!-- 	<footer>
		<p>&copy; 2024 Your Website. All rights reserved.</p>
	</footer> -->
</body>
</html>
<? $pdo = null; //DB작업종료?>

