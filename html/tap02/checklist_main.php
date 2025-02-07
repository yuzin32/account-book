<?php  include_once "/demoyujin/www/account_book/html/include/head.php";


//지출분야
$sql = "select account_category_idx,account_category_name,statistics_use from acbook_account_category";
$ac_rows = $objdb->fetchAllRows($sql);

if(empty($serch_nyear)){$nyear=date("Y");}else{$nyear=$serch_nyear;}
if(empty($serch_month)){$month=date("m");}else{$month=$serch_month;}


//echo $serch_nyear .'//'.$serch_month;

//체크리스트_데이터
$sql ="select t.check_sub_idx,t.complete,t.month,t.nyear,t.check_idx,t.check_date,t.memo,t2.title,t2.account_category_idx,t2.default_price
from acbook_checklist_sub t left join acbook_checklist t2 on t2.check_idx=t.check_idx where t.nyear=".$nyear." and t.month=".$month;
$check_sub_rows = $objdb->fetchAllRows($sql);


$start_nyear = 1999;
$end_nyear = date("Y")+1;
?>
<script>
function set_new_check(formName){
	document.getElementById('smode').value = 'c_s_save';
	data_save(formName)
}
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
		
        <!-- 체크리스트 데이터(sub)저장폼 시작  -->
        <div class="code_box" >
		<form name="serch_form" method="POST" >
			<input type='hidden' name="smode" value="serch">
				<h1>체크리스트</h1>
				<select name="serch_nyear">
					<?for($y=$start_nyear; $y<=$end_nyear; $y++){?>
					<option value="<?echo $y?>" <?if($nyear==$y)echo 'selected';?> ><?echo $y?>
					<?}?>
				</select>
			
			<select name="serch_month">
			<?for($m=1; $m<=12; $m++){?>
				<option value="<?echo $m;?>" <?if($month==$m)echo 'selected';?> ><?echo $m;?>
				<?}?>
			</select>
			<a href="javascript://" onclick="data_save('serch_form')">검색</a>
		</form>
        <form name="c_s_form" action="/account_book/html/tap02/checklist.call.php"  method="POST" >
        <input type='hidden' name="month" value="<?echo $month;?>">	
		<input type='hidden' name="nyear" value="<?echo $nyear;?>">		
		<input type='hidden' name="smode" id='smode'value="c_s_update">		
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
                    <? foreach ($check_sub_rows as $c_row) { ?>
                    <tr>
                        <td>
						<input type='checkbox' name="complete[]" value="y" <?checked_on('y',$c_row['complete'])?>>
						<input type='hidden' name="check_sub_idx[]" value="<?echo $c_row['check_sub_idx'];?>">
						</td>
                        <td><?echo $c_row['title'];?></td>
                        <td>
                            <? foreach ($ac_rows as $ac_row) { 
								if($ac_row['account_category_idx']== $c_row['account_category_idx']) echo $ac_row['account_category_name'];
							}?>
                        </td>
						<td><?echo $c_row['default_price'];?>원</td>
                        <td><input type='text' name="memo[]" value="<?echo $c_row['memo'];?>"></td>
                    </tr>
                    <?}?>
                </tbody>
            </table>
			 <a href="javascript://" onclick="set_new_check('c_s_form')">초기생성</a>
            <a href="javascript://" onclick="data_save('c_s_form')">저장</a>
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
