<?
include_once "/demoyujin/www/account_book/html/include/head.php"; 

//지출수단 리스트
$sql = "select account_category_idx,account_category_name,statistics_use from acbook_account_category";
$ac_rows = $objdb->fetchAllRows($sql);
//지불수단 리스트
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn,price  from acbook_payment";
$pay_rows = $objdb->fetchAllRows($sql);
//적금 리스트
$sql =" select savings_idx,savings_name,total_price  from acbook_savings";
$s_rows = $objdb->fetchAllRows($sql);

if(!isset($check3)) $check3 = '';
if($updatemode=='upload'){

		//지출/수입 , 지불분야 , 내용 , 금약 , 결제수단 , 적금명 ,날짜  
		$excel_field = "account_type_name,account_category_name,title,price,payment_name,savings_name, account_date";//DATE_FORMAT(account_date,'%Y-%m-%d')

		$excel_add_field = "";
		$excel_add_field2 = "";
		require_once ("/demoyujin/www/account_book/Setting/lib/ExcelReader/reader.php");
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('UTF-8');

		$savedir = $_excel_fileupload_folder;

		$fname1 = $_FILES['fname1']['name'];
		$file_type = $_FILES['fname1']['type'];
		$tmp = $_FILES['fname1']['tmp_name'];

		if(!$fname1) $fname1='null';
		else {
			$fname1_var = $objfile -> fileUp($tmp, $fname1, $savedir, $file_type);
			$fname1_name = $fname1_var[0];
		}

		//echo '-'.$fname1_name.'--<br>';
		if ($fname1_name=='') $msg .= '파일업로드 에러\n';

		$isSuccess = false;
		if ($fname1_name!=''){
			$filepath = $savedir.$fname1_name;

			$excelcolumns=explode(",",$excel_field);
			$excelcolumnsCount = ecount($excelcolumns);
			$data->read($savedir.$fname1_name);
			$j=0;
			for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
				if ($data->sheets[0]['cells'][$i][1]!='' && !empty($data->sheets[0]['cells'][$i][1])){
					for($k=0; $k<$excelcolumnsCount; $k++){
						$excelcolumns[$k] = strtolower($excelcolumns[$k]);
						$fieldname = $excelcolumns[$k];
						
						if(!isset($data->sheets[0]['cells'][$i][$k+1])) $data->sheets[0]['cells'][$i][$k+1] = '';
						//$varfText= conv(($data->sheets[0]['cells'][$i][$k+1]),"utf8");
						$varfText= $data->sheets[0]['cells'][$i][$k+1];
						${"var_".$fieldname}[$j] = $varfText;
					}
					$isSuccess = true;
					$j++;
				}
			}
			//$objfile->fileDel($savedir.$fname1_name);
			print_r($var_account_category_idx);

			$vCount=ecount($var_account_category_idx);

			//엑셀 입력데이터 가공 
			for($j=0;$j<$vCount;$j++){
				//지출분야
               foreach ($ac_rows as $ac_row) { 
				   if($ac_row['account_category_name']== $var_account_category_name[$j]) {
					   $var_account_category_idx[$j]=$ac_row['account_category_idx'];
				   }
				}
				//수입지출
				if($var_account_type_name[$j]=='지출'){$var_account_type[$j]=0; 
				}else{$var_account_type_name[$j]=1; }
				//결제 수단
				foreach ($pay_rows as $p_row) { 
				   if($p_row['payment_name']== $var_payment_name[$j]) {
					   $var_payment_idx[$j]=$p_row['payment_idx'];
				   }
				}
				foreach ($s_rows as $s_row) { 
				   if($s_row['savings_name']== $savings_name[$j]) {
					   $var_savings_idx[$j]=$s_row['savings_idx'];
				   }
				}
				if(!empty($var_savings_idx[$j]))$var_savings_yn[$j];
			}

			if ($check3!='') {
				echo "<meta charset='utf-8'><script>alert('인식되지 않은 자료가 있습니다.......');</script>";
			}
		}
	
}
if(empty($vCount)) $vCount = 0;
?>
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
<form name="a_e_form" action="<?=$_self?>"  method="POST" enctype="multipart/form-data">
<input type="text" name="updatemode" value="upload">
<input type="file" name="fname1" value="" size=20 <?if($updatemode=="upload"){?>disabled<?}?>>
<input type="submit" value="① 엑셀 업로드">
.xls 파일만 업로드 해주세요 
</form>
<div class="cal-box2 cal_list">
<form name="a_form" action="/account_book/html/tap01/account.call.php"  method="POST" enctype="multipart/form-data" >
<input type='hidden' name="smode" id='smode' value="">
   <table>
		<thead>
			<tr>
				<th>지출/수입</th>
				<th>날짜</th>
				<th>지출분야</th>
				<th>사유</th>
				<th>기본금액</th>
				<th>지출수단</th>
				<th>적금</th>
			</tr>
		</thead>
		<tbody>
			<?for($j=0;$j<$vCount;$j++){ //hidden ?>
			<tr>
				<td><input type="text" name="vform_account_type[]" value="<?=$var_account_type[$j]?>"><?=$var_account_type_name[$j]?></td>
				<td><input type="text" name="vform_account_date[]" value="<?=$var_account_date[$j]?>"></td>
				<td><input type="text" name="vform_account_category_idx[]" value="<?=$var_account_category_idx[$j]?>"><?=$var_account_category_name[$j]?></td>
				<td><input type="text" name="vform_title[]" value="<?=$var_title[$j]?>"></td>
				<td><input type="text" name="vform_price[]" value="<?=$var_price[$j]?>"></td>
				<td><input type="text" name="vform_payment_idx[]" value="<?=$var_payment_idx[$j]?>"><?=$var_payment_name[$j]?></td>
				<td><input type="text" name="vform_savings_idx[]" value="<?=$var_savings_idx[$j]?>"><?=$var_savings_name[$j]?></td>
			</tr>
			<?}?>
		</tbody>
	</table>
	
</form>

		</div>


	</div>
    </div><!-- 탭 내용 -->
</div>
</div>