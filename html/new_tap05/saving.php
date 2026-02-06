<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?
$wherey="";
if(!empty($search_savings_name)){$wherey.=" and savings_name='$search_savings_name'";}else{$search_savings_name="";}
if(!empty($search_one_price)){$wherey.=" and one_price=$search_one_price";}else{$search_one_price="";}
if(!empty($search_total_price)){$wherey.=" and total_price=$search_total_price";}else{$search_total_price="";}

if(!empty($search_startdate)){$wherey.=" and start_date='$search_startdate'";}else{$search_startdate="";}
if(!empty($search_end_date)){$wherey.=" and end_date='$search_end_date'";}else{$search_end_date="";}
if(!empty($search_use_yn)){$wherey.=" and use_yn='$search_use_yn'";}else{$search_use_yn="";}

//적금
$sql = "select savings_idx,savings_name,bank_idx,DATE_FORMAT(start_date, '%Y-%m-%d') start_date,DATE_FORMAT(end_date, '%Y-%m-%d') end_date,use_yn,one_price,total_price 
,(select systemcode_name from acbook_systemcode where systemcode_key='bank' and systemcode_idx=s.bank_idx) bank_name
from acbook_savings s where savings_idx>=0 ".$wherey;
$saving_rows = $objdb->fetchAllRows($sql);
//echo $sql;

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
                    <div class="saving-wrap">
                        <!-- 검색영역 start -->
                         <form name="cal_seachform" action="<?=$_self?>">
                            <div class="search-area">
                                <div class="search-lab">
                                    <span class="lab">은행명</span>
                                    <select name="serch_bank" >
                                        <option value="">::선택::</otption>
                                        <? foreach ($bank_rows as $b_row) { ?>
                                        <option value="<?= $b_row['systemcode_idx'];?>" <?=selected_on($b_row['systemcode_idx'],$serch_bank)?> ><?= $b_row['systemcode_name'];?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <div class="search-lab">
                                    <span class="lab">타이틀</span>
                                    <input type="text" name="search_savings_name" value="<?=$search_savings_name?>">
                                </div>
                                <div class="search-lab">
                                    <span class="lab">1회금액</span>
                                    <input type="text" name="search_one_price" value="<?=$search_one_price?>">
                                </div>
                                <div class="search-lab">
                                    <span class="lab">총금액</span>
                                    <input type="text" name="search_total_price" value="<?=$search_total_price?>">
                                </div>
                                <div class="search-lab">
                                    <span class="lab">시작일</span>
                                    <input type="date" name="search_startdate" value="<?=$search_startdate?>">
                                </div>
                                <div class="search-lab">
                                    <span class="lab">종료일</span>
                                    <input type="date" name="search_end_date" value="<?=$search_end_date?>">
                                </div>
                                <div class="search-lab">
                                    <span class="lab">사용여부</span>
                                    <select name="search_use_yn" <?=selected_on('y',$search_use_yn)?>>
                                        <option value="y" <?=selected_on('y',$search_use_yn)?>>사용</otption>
                                        <option value="n" <?=selected_on('y',$search_use_yn)?>>미사용</otption>
                                    </select>
                                </div>
                                <div class="search-lab">
                                    <a class="search-btn" href="javascript://" onclick="data_save('cal_seachform')">검색</a>
                                </div>
                            </div>
                        </form>
                        <br>
                        <!-- 검색영역 end -->
                        <div class="table-util">
                            <div class="left">
                                 <a href="javascript://" onclick="data_del('s_listform','s_del')" class="r-btn delete">삭제</a>
                                <a href="#none" class="r-btn modify">수정</a>
                            </div>
                            <div class="right">
                                <a href="#none" class="r-btn save modal-open" data-modal="save-new">신규등록</a>
                            </div>
                        </div>
                        <!-- 리스트 최대 9개 -->
                        <div class="table-wrap">
                            <form name="s_listform" action="/account_book/html/new_tap05/saving.call.php"  method="POST">
                                <input type='hidden' name="smode" value="">
                            <table class="c-table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="single"></th>
                                        <th>유형</th>
                                        <th>은행명</th>
                                        <th>타이틀</th>
                                        <th>1회 금액</th>
                                        <th>총금액</th>
                                        <th>시작일</th>
                                        <th>종료일</th>
                                        <th>사용여부</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? $i=0;  
                                    foreach ($saving_rows as $s_row) {  ?>
                                    <tr>
                                        <td><input type="checkbox" class="single" name="savings_idx[]" value="<?= $s_row['savings_idx'];?>"></td>
                                        <td><span class="c-lab blue --sm">적금</span></td>
                                        <td><?= $s_row['bank_name'];?></td>
                                        <td><?= $s_row['savings_name'];?></td>
                                        <td><?= $s_row['one_price'];?>원</td>
                                        <td><?= $s_row['total_price'];?></td>
                                        <td><?= $s_row['start_date'];?></td>
                                        <td><?= $s_row['end_date'];?></td>
                                        <td>
                                            <input type="checkbox" id="toggle<?=$i?>" hidden class="c-toggle" <?=checked_on('y',$s_row['use_yn']);?>> 
                                            <label for="toggle<?=$i?>" class="c-togglelabel">
                                                <span class="c-togglebutton"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    
                                     <?$i++; }?>
                                     
                                </tbody>
                            </table>
                            <!-- 페이지네이션 -->
                                <ul class="pagination">
                                    <li class="arrow prev"><a href="#none" title="이전"></a></li>
                                    <li class="on"><a href="#none">1</a></li>
                                    <li><a href="#none">2</a></li>
                                    <li><a href="#none">3</a></li>
                                    <li><a href="#none">4</a></li>
                                    <li><a href="#none">5</a></li>
                                    <li class="arrow next"><a href="#none" title="다음"></a></li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>
        <!-- ***** 상세리스트 모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap save-new" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label">
                    [적금/채무] 신규등록
                </p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <form name="s_saveform" action="/account_book/html/new_tap05/saving.call.php"  method="POST">
            <input type='hidden' name="smode" value="s_save">
            <div class="m-body">
                <!-- 입력폼 start -->
                <div class="form-wrap div-col2">
                    <div class="form">
                        <div class="tit">타이틀</div>
                        <div class="con"><input type="text" name="add_savings_name"></div>
                    </div>
                    <div class="form">
                        <div class="tit">은행명</div>
                        <div class="con">
                            <select name="add_bank_idx">
                                <option value="">::선택::</option>
                                <? foreach ($bank_rows as $b_row) { ?>
                                <option value="<?= $b_row['systemcode_idx'];?>"><?= $b_row['systemcode_name'];?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                   <div class="form">
                        <div class="tit">1회 적금액</div>
                        <div class="con"><input type="text" name="add_one_price"></div>
                    </div>
                    <div class="form">
                        <div class="tit">총 적금액</div>
                        <div class="con"><input type="text" name="add_total_price"></div>
                    </div>
                    <div class="form">
                        <div class="tit">시작일</div>
                        <div class="con"><input type="date" name="add_start_date"></div>
                    </div>
                    <div class="form">
                        <div class="tit">종료일</div>
                        <div class="con"><input type="date" name="add_end_date"></div>
                    </div>
                    <div class="form">
                        <div class="tit">사용여부</div>
                        <div class="con">
                            <input type="checkbox" name="add_use_yn" id="add_use_yn" value="y" hidden class="c-toggle"> 
                            <label for="add_use_yn" class="c-togglelabel">
                                <span class="c-togglebutton"></span>
                            </label>
                        </div>
                    </div>
                    <div class="btn-center-wrap">
                        <a href="javascript://" onclick="data_save('s_saveform')" class="c-btn save">신규등록</a>
                    </div>
                </div>
                </form>
               <!-- 입력폼 end -->
            </div>
        </div>
    </div>
    <!-- ***** 상세리스트 모달창 END ***** -->
</body>
</html>