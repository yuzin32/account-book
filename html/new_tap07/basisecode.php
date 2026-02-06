<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?
if(!isset($tapmode))$tapmode='ac'; //echo "tapmode:".$tapmode;
//지출/수입 카테고리 
$sql = "select account_category_idx,account_type,account_category_name,statistics_use from acbook_account_category order by account_category_idx desc";
$ac_rows = $objdb->fetchAllRows($sql);
//결제수단
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn,price from acbook_payment order by payment_idx desc";
$pay_rows = $objdb->fetchAllRows($sql);
//은행
$sql ="select systemcode_idx,systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='bank' order by systemcode_idx desc";
$bank_rows = $objdb->fetchAllRows($sql);
//체크리스트
$sql ="select check_idx,account_category_idx,title,memo,write_date,default_price,use_yn  from acbook_checklist order by check_idx desc";
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
          //if (input.type !== 'text') return;텍스트만 조건
          if( check_yn=='n' ){
              input.removeAttribute('disabled');
          }else if(check_yn=='y'&& input.name.slice(-5) !='idx[]'){
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
function ondisplay(row){
	var row = document.getElementById(row);
    if (row.style.display === "none" || row.style.display === "") {
        row.style.display = "table-row"; // 보이기
    } else {
        row.style.display = "none"; // 숨기기
    }
}
</script>
<body>
    <div class="wrap">
        <!-- ***** 다이어리 레이아웃 START ***** -->
        <div class="diary-wrap">
            <div class="outer-bg"></div>
            <!-- 내지갑 --><? include_once "/demoyujin/www/account_book/html/include/mywellet.php"; ?>
            <div class="inner-box">
            <!-- 메뉴--><? include_once "/demoyujin/www/account_book/html/include/menu.php"; ?> 
                    <div class="content-box">
                    <!-- *** 내부영역 START *** -->
                    <div class="setting-wrap">
                        <ul class="tab-list">
                            <li <?if($tapmode=='ac'){?>class="on"<?}?>><a href="basisecode.php?tapmode=ac"><span class="ico"><img src="/account_book/html/skin/img/ico_setting_menu01.svg" alt="지출/수입"></span> 지출/수입</a></li>
                            <li <?if($tapmode=='pay'){?>class="on"<?}?>><a href="basisecode.php?tapmode=pay"><span class="ico"><img src="/account_book/html/skin/img/ico_setting_menu02.svg" alt="결제수단"></span> 결제수단</a></li>
                            <li <?if($tapmode=='bank'){?>class="on"<?}?>><a href="basisecode.php?tapmode=bank"><span class="ico"><img src="/account_book/html/skin/img/ico_setting_menu03.svg" alt="은행"></span> 은행</a></li>
                            <li <?if($tapmode=='check'){?>class="on"<?}?>><a href="basisecode.php?tapmode=check"><span class="ico"><img src="/account_book/html/skin/img/ico_setting_menu04.svg" alt="체크리스트"></span> 체크리스트</a></li>
                        </ul>
                        <br><br>

                        <div class="tab-con-wrap">
                            <form name="basise_form" action="/account_book/html/new_tap07/basisecode.call.php"  method="POST">
                                <input type='hidden' name="smode" value="<?=$tapmode?>_save">
                                <input type='hidden' name="tapmode" value="<?=$tapmode?>">
                                <div class="tc tc01">
                                    <div class="table-util">
                                        <div class="left">
                                            <a href="#javascript://" onclick="data_del('basise_form','<?=$tapmode?>_del')" class="r-btn delete">삭제</a>
                                            <a href="javascript://" onclick="data_save('basise_form')" class="r-btn save">저장</a>
                                        </div>
                                        <div class="right">
                                            <a href="#none" class="r-btn save modal-open" data-modal="new-code">신규</a>
                                        </div>
                                    </div>
                                    <?if($tapmode=='ac'){?>
                                    <table class="c-table">
                                        <!--지출수입카테고리-->
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="single"></th>
                                                <th>지출/수입</th>
                                                <th>타이틀</th>
                                                <th>통계사용여부</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <? foreach ($ac_rows as $ac_row) { 
                                                $ac_idx = $ac_row['account_category_idx']; ?>
                                            <tr>
                                                <td><input type="checkbox" class="single"name="account_category_idx[]" value="<?echo $ac_idx;?>" ></td>
                                                <td>
                                                    <select name="account_type[<?=$ac_idx?>]" id="account_type" disabled>
                                                        <option value="0" <?selected_on(0,$ac_row['account_type']);?>>지출</option>
                                                        <option value="1" <?selected_on(1,$ac_row['account_type']);?>>수입</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="account_category_name[<?=$ac_idx?>]" value="<?echo $ac_row['account_category_name'];?>" disabled>
                                                <a href="javascript://" onclick="on_update(this)" class="r-btn modify">수정</a></td>
                                                <td><input type="checkbox" class="single" name="statistics_use[<?=$ac_idx?>]" value="y" <?checked_on('y',$ac_row['statistics_use'])?> disabled></td>
                                            </tr>
                                            <?}?>
                                        </tbody>
                                        <!--지출수입카테고리end-->
                                    </table>
                                    <?}?>
                                    <?if($tapmode=='pay'){?>
                                        <table class="c-table">
                                            <!--결제수단-->
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="single"></th>
                                                    <th>은행명</th>
                                                    <th>결제수단명</th>
                                                    <th>결제 타입</th>
                                                    <th>잔액</th>
                                                    <th>통계사용여부</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? foreach ($pay_rows as $p_row) { 
                                                    $pay_idx= $p_row['payment_idx'];?>
                                                <tr>
                                                    <td><input type="checkbox" class="single" name="payment_idx[]" value="<?=$p_row['payment_idx'];?>"></td>
                                                    <td>
                                                        <select  name="bank_idx[<?=$pay_idx?>]" disabled>
                                                            <? foreach ($bank_rows as $b_row) { ?>
                                                                <option value="<?echo $b_row['systemcode_idx'];?>" <?selected_on($b_row['systemcode_idx'],$p_row['bank_idx']);?>><?echo $b_row['systemcode_name'];?></option>
                                                            <?}?>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" name="payment_name[<?=$pay_idx?>]" value="<? echo $p_row['payment_name']; ?>" disabled>
                                                    <a href="javascript://" onclick="on_update(this)" class="r-btn modify">수정</a>
                                                    </td>
                                                    <td>
                                                        <select name="payment_type[<?=$pay_idx?>]" disabled >
                                                            <option value="card" <?selected_on('card',$p_row['payment_type']);?> >card</option>
                                                            <option value="pay" <?selected_on('pay',$p_row['payment_type']);?> >pay</option>
                                                        </select>
                                                    </td>
                                                    <td><input type='text' name="price[<?=$pay_idx?>]" value="<? echo $p_row['price']; ?>" disabled>
                                                    <td><input type="checkbox" class="single" name="statistics_use[<?=$pay_idx?>]" value="y" <?checked_on('y',$ac_row['statistics_use'])?> disabled></td>
                                                </tr>
                                                <?}?>
                                            </tbody>
                                            <!--결제수단end-->
                                        </table>
                                    <?}?>
                                    <?if($tapmode=='bank'){?>
                                    <table class="c-table">
                                        <!--은행-->
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="single"></th>
                                                <th>은행코드</th>
                                                <th>은행명</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <? foreach ($bank_rows as $b_row) { 
                                                $s_idx= $b_row['systemcode_idx'];?>
                                            <tr>
                                                <td><input type='checkbox' class="single" name="systemcode_idx[]" value="<?= $b_row['systemcode_idx'];?>" ></td>
                                                <td><input type='text' name="systemcode_name[<?=$s_idx?>]" value="<?echo $b_row['systemcode_name'];?>" disabled>
                                                <a href="javascript://" onclick="on_update(this)" class="r-btn modify">수정</a></td>
                                                <td><input type='text' name="systemcode_value[<?=$s_idx?>]" value="<?echo $b_row['systemcode_value'];?>" disabled></td>
                                            </tr>
                                            <?}?>
                                        </tbody>
                                        <!--은행end-->
                                    </table>
                                    <?}?>
                                    <?if($tapmode=='check'){?>
                                    <table class="c-table">
                                        <!--체크리스트-->
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="single"></th>
                                                <th>내용</th>
                                                <th>지출분야</th>
                                                <th>기본금액</th>
                                                <th>메모</th>
                                                <th>사용안함</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <? foreach ($check_rows as $c_row) { 
                                            $c_idx =$c_row['check_idx'];?>
                                            <tr>
                                                <td><input type='checkbox' name="check_idx[]" value="<?= $c_row['check_idx'];?>"></td>
                                                <td><input type='text' name="title[<?=$c_idx?>]" value="<?= $c_row['title'];?>" disabled> 
                                                <a href="javascript://" onclick="on_update(this)" class="r-btn modify">수정</a>
                                                </td>
                                                <td><select name="account_category_idx[<?=$c_idx?>]" id="account_category_idx" disabled>
                                                    <? foreach ($ac_rows as $ac_row) { ?>
                                                    <option value="<?= $ac_row['account_category_idx']?>" <?selected_on($ac_row['account_category_idx'],$c_row['account_category_idx']);?>><?echo $ac_row['account_category_name']?></option>
                                                    <?}?>
                                                    </select>
                                                </td>
                                                <td><input type='text' name="default_price[<?=$c_idx?>]" value="<?= $c_row['default_price'];?>" disabled></td>
                                                <td><input type='text' name="memo[<?=$c_idx?>]" value="<?= $c_row['memo'];?>" disabled></td>
                                            </tr>
                                            <?}?>
                                        </tbody>
                                        <!--지출수입카테고리end-->
                                    </table>
                                    <?}?>                       
                                </div>
                           </form>
                        </div>
                    </div>
                    <!-- *** 내부영역 END *** -->
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>
   <!-- ***** 신규등록 모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap new-code" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label">
                    [신규] 기초코드관리
                </p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <div class="m-body">
                <form name="basise_saveform" action="/account_book/html/new_tap07/basisecode.call.php"  method="POST">
                <input type='hidden' name="smode" value="<?=$tapmode?>_save">
                <input type='hidden' name="tapmode" value="<?=$tapmode?>">
                <div class="form-wrap">
                <?if($tapmode=='ac'){?>
               <!-- 입력폼 start -->
                    <div class="form">
                        <div class="tit">타이틀</div>
                        <div class="con"><input name="add_account_category_name" type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">수입/지출</div>
                        <div class="con">
                            <select name="add_account_type" id="account_type">
                                <option value="0" >지출</option>
                                <option value="1" >수입</option>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">통계사용여부</div>
                        <div class="con">
                                <label class="c-input ci-radio">
                                    <input type="radio" checked name="add_statistics_use" value="y">  사용 
                                    <div class="ci-show"></div>
                                </label>
                                <label class="c-input ci-radio">
                                    <input type="radio"  name="add_statistics_use" value="n">  미사용 
                                    <div class="ci-show"></div>
                                </label>
                        </div>
                    </div>
                    <?}else if($tapmode=='pay'){?>
                    <div class="form">
                        <div class="tit">결제수단명</div>
                        <div class="con"><input name="add_payment_name" type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">은행명</div>
                        <div class="con">
                            <select  name="add_bank_idx" >
                                <? foreach ($bank_rows as $b_row) { ?>
                                    <option value="<?= $b_row['systemcode_idx'];?>"><?= $b_row['systemcode_name'];?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">결제 타입</div>
                        <div class="con">
                            <select name="add_payment_type" >
                                <option value="card" >card</option>
                                <option value="pay" >pay</option>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">통계사용여부</div>
                        <div class="con">
                                <label class="c-input ci-radio">
                                    <input type="radio" checked name="add_statistics_use" value="y">  사용 
                                    <div class="ci-show"></div>
                                </label>
                                <label class="c-input ci-radio">
                                    <input type="radio"  name="add_statistics_use" value="n">  미사용 
                                    <div class="ci-show"></div>
                                </label>
                        </div>
                    </div>
                    <?}else if($tapmode=='bank'){?>
                    <div class="form">
                        <div class="tit">은행명</div>
                        <div class="con"><input name="add_systemcode_name" type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">은행코드</div>
                        <div class="con"><input name="add_systemcode_value" type="text"></div>
                    </div>
                    <?}else if($tapmode=='check'){?>
                    <div class="form">
                        <div class="tit">내용</div>
                        <div class="con"><input name="add_title" type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">지출분야</div>
                        <div class="con">
                            <select name="add_account_type" id="account_type">
                                <option value="0" >지출</option>
                                <option value="1" >수입</option>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">기본금액</div>
                        <div class="con"><input name="add_default_price" type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">메모</div>
                        <div class="con"><input name="add_memo" type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">지출분야</div>
                        <div class="con">
                            <select name="add_account_category_idx" >
                                <? foreach ($ac_rows as $ac_row) { ?>
                                <option value="<?= $ac_row['account_category_idx']?>" ><?= $ac_row['account_category_name']?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                    <?}?>
                    <div class="btn-center-wrap">
                        <a href="javascript://" onclick="data_save('basise_saveform')" class="c-btn save">신규등록</a>
                    </div>
                </div>
               <!-- 입력폼 end -->
                </form>
            </div>
        </div>
    </div>
    <!-- ***** 신규등록 모달창 END ***** -->
</body>
</html>