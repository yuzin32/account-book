
					<!-- 검색 -->
		<form name="search_form" method="POST" action="calender_main.php">
		<!-- 월검색 클릭하면 날짜검색이 안되야 하고 날짜 검색 클릭하면 월검색이 안되어야 함 해당 javascript넣기 -->
			<select name="search_nyaer">
				<?for($y=$start_year; $y<=$end_year; $y++){?>
				<option value="<?echo $y?>" <?if($search_nyaer==$y)echo 'selected';?> ><?echo $y?>
				<?}?>
			</select>
			<select name="search_month">
			<option value="" >전체</option>
			<?for($m=1; $m<=12; $m++){?>
				<option value="<?echo $m;?>" <?selected_on($search_month,sprintf('%02d', $m));?>><?echo sprintf('%02d', $m);?>월
				<?}?>
			</select>
			<select name="search_day">
			<option value="" >전체</option>
				<?for($d=1; $d<=30; $d++){?>
				<option value="<?echo $d?>" <?selected_on($search_day,sprintf('%02d', $d));?> ><?echo sprintf('%02d', $d)?>
				<?}?>
			</select>
			<select name="account_type" id="account_type">
				<option value="0" <? selected_on(0,$account_type);?>>지출</option>
				<option value="1" <? selected_on(1,$account_type);?>>수입</option>
			</select>
			<select name="search_payment_idx" id="search_payment_idx">
				<option value="">결제수단</option>
				<? foreach ($pay_rows as $p_row) { ?>
					<option value="<?echo $p_row['payment_idx']?>" <?selected_on($p_row['payment_idx'],$search_payment_idx)?>><?echo $p_row['payment_name']?></option>
				<?}?>
			</select>
			<select name="search_account_category_idx" id="search_account_category_idx">
			<option value="">지출분야</option>
			<? foreach ($ac_rows as $ac_row) { ?>
			<option value="<?echo $ac_row['account_category_idx']?>" <? selected_on($ac_row['account_category_idx'],$search_account_category_idx);?>><?echo $ac_row['account_category_name']?></option>
			<?}?>
			</select>
			<a href="javascript://" onclick="data_save('search_form')">검색</a>
			<!-- 검색 끝 -->
			</form>