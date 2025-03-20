<? include_once "/demoyujin/www/account_book/html/include/head.php";
$tap_code=03;
//적금
$sql = "select savings_idx,savings_name,bank_idx,DATE_FORMAT(start_date, '%Y-%m-%d') start_date,DATE_FORMAT(end_date, '%Y-%m-%d') end_date,use_yn,one_price,total_price from acbook_savings";
$saving_rows = $objdb->fetchAllRows($sql);

//은행
$sql ="select systemcode_idx,systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='bank'";
$bank_rows = $objdb->fetchAllRows($sql);
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
	 const selects = tr.querySelectorAll('select');
	 
     var check_yn='y'

        // readonly 속성 제거
 inputs.forEach(input => {
        // 체크박스인 경우 체크 상태로 변경
        if (input.type === 'checkbox' && input.name.slice(-5)=='idx[]'){
			if(input.checked == false){
				input.checked = true;
                check_yn='n';
			}else{
                input.checked = false;
            }
        }
      });
      inputs.forEach(input => {
          if( check_yn=='n'){
              input.removeAttribute('disabled');
          }else if(check_yn=='y'){
              input.setAttribute('disabled', 'true');
          }
      });
	  selects.forEach(select => {
          if( check_yn=='n'){
              select.removeAttribute('disabled');
          }else if(check_yn=='y'){
              select.setAttribute('disabled', 'true');
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
	<?include "/demoyujin/www/account_book/html/include/tap_tmep.php"?>
    <!-- 탭 내용 -->
    <div class="tab-content">

		<!-- 적금 저장폼 시작  -->
		<div class="code_box">
		<form name="s_form" action="/account_book/html/tap03/saving.call.php"  method="POST">
		<input type='hidden' name="smode" value="s_save">

			<h1>적금</h1>
		   <table>
				<thead>
					<tr>
						<th><input type='checkbox'></th>
						<th>적금이름</th>
						<th>1회 적금액</th>
						<th>총적금액</th>
						<th>시작일</th>
						<th>종료일</th>
						<th>사용여부</th>

					</tr>
				</thead>
				<tbody>
				<? foreach ($saving_rows as $s_row) { ?>
					<tr>
						<td><input type='checkbox' name="savings_idx[]" value="<?echo $s_row['savings_idx'];?>"></td>
                        <td>
						<input type='text' name="savings_name[]" value="<?echo $s_row['savings_name'];?>" disabled>
						<a href="javascript://" onclick="on_update(this)">수정</a>
						</td>
                        <td><input type='text' name="one_price[]" value="<?echo $s_row['one_price'];?>" disabled></td>
                        <td><input type='text' name="total_price[]" value="<?echo $s_row['total_price'];?>" disabled></td>
                        <td><input type='date' name="start_date[]" value="<?echo $s_row['start_date'];?>" disabled></td>
                        <td><input type='date' name="end_date[]" value="<?echo $s_row['end_date'];?>" disabled></td>
                        <td><input type='checkbox' name="use_yn[]" value="<?echo $s_row['use_yn'];?>"disabled <?checked_on('y',$s_row['use_yn']);?>></td>
                    </tr>
					<?}?>

				</tbody>
			</table>
			<div class="input-new">
				적금이름 : <input type='text' name="add_savings_name" value="" class="put">
				은행명:
				<select name="add_bank_idx" >
				<? foreach ($bank_rows as $b_row) { ?>
				<option value="<?echo $b_row['systemcode_idx'];?>"><?echo $b_row['systemcode_name'];?></option>
				<?}?>
				</select>
				<br>
				1회 적금액 : <input type='text' name="add_one_price" value="" class="put">
				총적금액 : <input type='text' name="add_total_price" value="" class="put">
				<br>
				시작일 : <input type="date" name="add_start_date" id="start_date" required>
				종료일 : <input type="date" name="add_end_date" id="end_date" required>
				사용여부 : <input type='checkbox' name="add_use_yn" value="y"  class="put">
				<a href="javascript://" onclick="data_save('s_form')">저장</a>
				<a href="javascript://" onclick="data_del('s_form','s_del')">삭제</a>
			<div>
			</form>
		</div>
		<!-- 지출분야 시스템코드 저장폼 끝  -->


    </div><!-- 탭 내용 -->
</div>
</div>
<!-- 	<footer>
		<p>&copy; 2024 Your Website. All rights reserved.</p>
	</footer> -->
</body>
</html>
<? $pdo = null; //DB작업종료?>
