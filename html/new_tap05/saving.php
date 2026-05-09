<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?
$wherey="";
if(!empty($serch_bank)){$wherey.=" and bank_idx='$serch_bank'";}else{$serch_bank="";}


if(!empty($search_savings_name)){$wherey.=" and savings_name like '%$search_savings_name%'";}else{$search_savings_name="";}
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
                         <form name="cal_seachform" action="<?=$_self?>" method="POST">
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
                                    <span class="lab">현재 적금액</span>
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
                                        <option value="n" <?=selected_on('n',$search_use_yn)?>>미사용</otption>
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
                            </div>
                            <div class="right">
                                <a href="#none" class="r-btn save modal-open" data-modal="saveing-new" data-form="s_saveform" data-mode="s_save">신규등록</a>
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
                                        <th>현재 적금액</th>
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
                                        <td><a href="#none" class="c-btn underline modal-open" data-modal="saveing-new" data-load="load" data-idx="<?= $s_row['savings_idx'];?>" data-form="s_saveform" data-mode="up_s_save">
                                            <?= $s_row['savings_name'];?></a></td>
                                        <td><?= $s_row['one_price'];?>원</td>
                                        <td><a href="#none" class="c-btn underline modal-open" data-modal="saveing-list" data-load="load" data-idx="<?= $s_row['savings_idx'];?>"><?= $s_row['total_price'];?>원</a></td>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>
        <script>
        // AJAX로 페이지 데이터 불러오기
        function dataload(idx,modal,page) {
        $.ajax({
            url: "saving_ajax.php",
            type: "GET",
            data: {this_saving_idx: idx,modal: modal ,page: page},
            success: function(data) {
            try {
                console.log(data);
                success_dataload(data)
            } catch (e) {
                console.error("JSON parse error:", e);
                console.log(data);
            }
            },
            error: function() {
            alert("데이터를 불러오는 중 오류가 발생했습니다.");
            }
        });
        }
        function success_dataload(data) {
            if(data.modal=='saveing-new'){
                $('#save_title').text( '[적금] 수정');
                $('#save_btn').text( '수정');
                $('#add_bank_idx').val(data.bank_idx);
                $('#add_savings_idx').val(data.savings_idx);
                $('#add_savings_name').val(data.savings_name);
                $('#add_start_date').val(data.start_date);
                $('#add_end_date').val(data.end_date);
                $('#add_one_price').val(data.one_price);
                $('#add_total_price').val(data.total_price);
                if (data.use_yn === 'y') {
                    $('#add_use_yn').prop('checked', true);
                } 
            }else if(data.modal=='saveing-list'){
            // console.log("data 전체:", data);
                $('#list_title').text( ' [적금]'+data.savings_name);
                $("#listTableBody").html(data.rows_html);
                $("#listpagination").html(data.pagination_html);
                $('#list_total_count').text(data.total_count);
            }
        }
        </script>
        <!-- ***** 상세리스트 모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap saveing-new" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label" id="save_title">
                    [적금] 신규등록
                </p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <form name="s_saveform" id="s_saveform" action="/account_book/html/new_tap05/saving.call.php"  method="POST">
            <input type='hidden' name="add_savings_idx" id="add_savings_idx" value="">
            <input type='hidden' name="smode" id="smode" value="s_save">
            <div class="m-body">
                <!-- 입력폼 start -->
                <div class="form-wrap div-col2">
                    <div class="form">
                        <div class="tit">타이틀</div>
                        <div class="con"><input type="text" name="add_savings_name" id="add_savings_name"></div>
                    </div>
                    <div class="form">
                        <div class="tit">은행명</div>
                        <div class="con">
                            <select name="add_bank_idx" id="add_bank_idx">
                                <option value="">::선택::</option>
                                <? foreach ($bank_rows as $b_row) { ?>
                                <option value="<?= $b_row['systemcode_idx'];?>"><?= $b_row['systemcode_name'];?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                   <div class="form">
                        <div class="tit">1회 적금액</div>
                        <div class="con"><input type="text" name="add_one_price" id="add_one_price"></div>
                    </div>
                    <div class="form">
                        <div class="tit">현재 적금액</div>
                        <div class="con"><input type="text" name="add_total_price" id="add_total_price"></div>
                    </div>
                    <div class="form">
                        <div class="tit">시작일</div>
                        <div class="con"><input type="date" name="add_start_date" id="add_start_date"></div>
                    </div>
                    <div class="form">
                        <div class="tit">종료일</div>
                        <div class="con"><input type="date" name="add_end_date" id="add_end_date"></div>
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
                        <a href="javascript://" onclick="data_save('s_saveform')" class="c-btn save" id="save_btn">신규등록</a>
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
    <!-- ***** 상세리스트 모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap saveing-list" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label" id="list_title"></p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <div class="m-body">
                <!-- 모달 리스트 영역 start -->
                <div class="modal-list-area">
                    <div class="list-top">
                        총 내역 <span class="num" id="list_total_count"></span>건
                    </div>
                    <div class="list-table-wrap">
                        <table class="list-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>사유</th>
                                    <th>날짜</th>
                                    <th>금액</th>
                                </tr>
                            </thead>
                            <!-- 리스트 8개씩 보임 -->
                            <tbody id="listTableBody">
                            </tbody>
                        </table>

                        <!-- 페이지네이션 -->
                        <ul class="pagination" id="listpagination">
                        </ul>
                    </div>
                </div>
                <!-- 모달 리스트 영역 end -->
            </div>
        </div>
    </div>
    <!-- ***** 상세리스트 모달창 END ***** -->
</body>
</html>