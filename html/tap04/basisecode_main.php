<?php  include_once "/demoyujin/www/account_book/html/include/head.php";
$tap_code=04;

//지출수단
$sql = "select account_category_idx,account_category_name,statistics_use from acbook_account_category";
$ac_rows = $objdb->fetchAllRows($sql);
//은행
$sql ="select systemcode_idx,systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='bank'";
$bank_rows = $objdb->fetchAllRows($sql);

//은행
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn from acbook_payment";
$pay_rows = $objdb->fetchAllRows($sql);

//체크리스트
$sql ="select check_idx,account_category_idx,title,memo,write_date,default_price from acbook_checklist";
$check_rows = $objdb->fetchAllRows($sql);


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

		<!-- 지출분야 시스템코드 저장폼 시작  -->
		<div class="code_box">
		<form name="ac_form" action="/account_book/html/tap04/basisecode.call.php"  method="POST">
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
						<td><input type='checkbox' name="account_category_idx[]" value="<?echo $ac_row['account_category_idx'];?>"></td>

						<td > <input type='text' name="account_category_name[]" value="<?echo $ac_row['account_category_name'];?>" disabled>
						<a href="javascript://" onclick="on_update(this)">수정</a>
						</td>
						<td><input type='checkbox' name="statistics_use[]" value="y" <?if($ac_row['statistics_use']=='y')echo 'checked'?> disabled></td>
					</tr>
					<?}?>

				</tbody>
			</table>
			<div class="input-new">
				지출분야: <input type='text' name="add_account_category_name" value="" class="put">
				통계반영여부: <input type='checkbox' name="add_statistics_use" value="y"  class="put">
				<a href="javascript://" onclick="data_save('ac_form')">저장</a>
				<a href="javascript://" onclick="data_del('ac_form','ac_del')">삭제</a>
			<div>
			</form>
		</div>
		<!-- 지출분야 시스템코드 저장폼 끝  -->


		<!-- 결제수단 시스템코드 저장폼 시작  -->
		<div class="code_box" >
		<form name="p_form" action="/account_book/html/tap04/basisecode.call.php"  method="POST" >
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
					
					<? foreach ($pay_rows as $p_row) { ?>
						<tr>
						<td><input type='checkbox' name="payment_idx[]" value="<? echo $p_row['payment_idx']; ?>" ></td>
						<td><input type='text' name="payment_name[]" value="<? echo $p_row['payment_name']; ?>" disabled>
                            <a href="javascript://" onclick="on_update(this)">수정</a>
                        </td>
						<td>
                            <select name="bank_idx[]" disabled >
                            <? foreach ($bank_rows as $b_row) { ?>
                            <option value="<?echo $b_row['systemcode_idx'];?>" <?selected_on($b_row['systemcode_idx'],$p_row['bank_idx']);?>><?echo $b_row['systemcode_name'];?></option>
                            <?}?>
                            </select>
                        </td>
						<td>
                            <select name="payment_type[]" disabled >
                			<?foreach($system_payment_type as $p_k => $p_v){?>
                			<option value="<?echo $p_k;?>" <?selected_on($p_k,$p_row['payment_type']);?> ><?echo $p_v;?></option>
                			<?}?>
                        </td>
						<td><input type='checkbox' name="use_yn[]" value="y" <?if($p_row['use_yn']=='y')echo 'checked'?> disabled></td>
						</tr>
					<?}?>
					
				</tbody>
			</table>
			결제수단명 : <input type='text' name="add_payment_name" >
			은행명:
			<select name="add_bank_idx" >
			<option value="">은행을 선택하세요</option>
			<? foreach ($bank_rows as $b_row) { ?>
			<option value="<?echo $b_row['systemcode_idx'];?>"><?echo $b_row['systemcode_name'];?></option>
			<?}?>
			</select>
			매개 :
			<select name="add_payment_type" >
			<option value="">매개를 선택하세요</option>
			<?foreach($system_payment_type as $p_k => $p_v){?>
			<option value="<?echo $p_k;?>"><?echo $p_v;?></option>
			<?}?>
			</select>
			사용여부: <input type='checkbox' name="add_use_yn" value="y"  class="put">
			<a href="javascript://" onclick="data_save('p_form')">저장</a>
			<a href="javascript://" onclick="data_del('p_form','p_del')">삭제</a>
		</form>
		</div>
		<!-- 결제수단 시스템코드 저장폼 끝  -->

		<!-- 은행 시스템코드 저장폼 시작  -->
		<div class="code_box" >
		<form name="bank_form" action="/account_book/html/tap04/basisecode.call.php"  method="POST" >
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
						<td><input type='checkbox' name="systemcode_idx[]" value="<?echo $b_row['systemcode_idx'];?>" ></td>
						<td><input type='text' name="systemcode_name[]" value="<?echo $b_row['systemcode_name'];?>" disabled>
                            <a href="javascript://" onclick="on_update(this)">수정</a>
                        </td>
						<td><input type='text' name="systemcode_value[]" value="<?echo $b_row['systemcode_value'];?>" disabled></td>


                        </td>
					</tr>
					<?}?>
				</tbody>
			</table>
			<input type='hidden' name="add_systemcode_key" value="bank" >
			은행코드 :<input type='text' name="add_systemcode_value" >
			은행명:<input type='text' name="add_systemcode_name" >

			<a href="javascript://" onclick="data_save('bank_form')">저장</a>
			<a href="javascript://" onclick="data_del('bank_form','bank_del')">삭제</a>
		</form>
		</div>
		<!-- 은행 시스템코드 저장폼 종료  -->
        <!-- 체크리스트 저장폼 시작  -->
        <div class="code_box" >
        <form name="check_form" action="/account_book/html/tap04/basisecode.call.php"  method="POST" >
        <input type='hidden' name="smode" value="check_save">
            <h1>체크리스트</h1>
           <table>
                <thead>
                    <tr>
                        <th><input type='checkbox'></th></th>
                        <th>내용</th>
                        <th>지출분야</th>
						<th>기본금액</th>
                        <th>메모</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($check_rows as $c_row) { ?>
                    <tr>
                        <td><input type='checkbox' name="check_idx[]" value="<?echo $c_row['check_idx'];?>"></td>
                        <td><input type='text' name="title" value="<?echo $c_row['title'];?>" disabled> 
						<a href="javascript://" onclick="on_update(this)">수정</a>
						</td>
                        <td><select name="account_category_idx" id="account_category_idx" disabled>
                            <option value="">지출분야를 선택하세요</option>
                            <? foreach ($ac_rows as $ac_row) { ?>
                            <option value="<?echo $ac_row['account_category_idx']?>" <?selected_on($ac_row['account_category_idx'],$c_row['account_category_idx']);?>><?echo $ac_row['account_category_name']?></option>
                            <?}?>
                            </select>
                        </td>
						<td><input type='text' name="default_price" value="<?echo $c_row['default_price'];?>" disabled></td>
                        <td><input type='text' name="memo" value="<?echo $c_row['memo'];?>" disabled></td>
                    </tr>
                    <?}?>
                </tbody>
            </table>
            내용 : <input type='text' name="add_title" >
            지출분야 : <select name="add_account_category_idx" id="add_account_category_idx">
                <option value="">지출분야를 선택하세요</option>
                <? foreach ($ac_rows as $ac_row) { ?>
                <option value="<?echo $ac_row['account_category_idx']?>"><?echo $ac_row['account_category_name']?></option>
                <?}?>
            </select>
			기본금액 :  <input type='text' name="add_default_price" >
            메모 :  <input type='text' name="add_memo" >
            <a href="javascript://" onclick="data_save('check_form')">저장</a>
            <a href="javascript://" onclick="data_del('check_form','check_del')">삭제</a>
        </form>
        </div>
        <!-- 체크리스트 저장폼 종료  -->
    </div><!-- 탭 내용 -->
</div>
</div>
<!-- 	<footer>
		<p>&copy; 2024 Your Website. All rights reserved.</p>
	</footer> -->
</body>
</html>
<? $pdo = null; //DB작업종료?>
