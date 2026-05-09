<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?
//은행
$sql ="select systemcode_idx,systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='bank'";
$bank_rows = $objdb->fetchAllRows($sql);
//대출타입
$sql ="select systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='loan_type'";
$loan_type = $objdb->fetchAllRows($sql);

$wherey="";
if (isset($search_loan_type) && $search_loan_type !== '') {$wherey.=" and loan_type=".$search_loan_type;
}else{$search_loan_type="";}

if(!empty($search_counterparty_name)){$wherey.=" and counterparty_name LIKE '%".$search_counterparty_name."%'";
}else{$search_counterparty_name="";}

if(!empty($search_loan_reason)){$wherey.=" and loan_reason LIKE '%".$search_loan_reason."%'";
}else{$search_loan_reason="";}

if(!empty($search_loan_date)){$wherey.=" and loan_date='".$search_loan_date."'";
}else{$search_loan_date="";}

if(!empty($search_bank_idx)){$wherey.=" and bank_idx=".$search_bank_idx;
}else{$search_bank_idx="";}


//채무
$sql = "select loan_idx,counterparty_name,loan_reason,loan_date,total_amount,loan_type,bank_idx
,(select systemcode_name from acbook_systemcode where systemcode_key='bank' and systemcode_idx=l.bank_idx) bank_name
,(select systemcode_name from acbook_systemcode where systemcode_key='loan_type' and systemcode_value=l.loan_type) loan_type_name
FROM acbook_loan l where loan_idx>=0".$wherey;
$loan_rows = $objdb->fetchAllRows($sql);
//echo $sql;

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- front-end css -->
    <link rel="stylesheet" href="/account_book/html/skin/css/jquery-ui.css">
	<link rel="stylesheet" href="/account_book/html/skin/css/default.css">
    <link rel="stylesheet" href="/account_book/html/skin/css/common.css">
    <link rel="stylesheet" href="/account_book/html/skin/css/login.css">
    <link rel="stylesheet" href="/account_book/html/skin/css/diary.css">
    <!-- jquery + jquery UI -->
    <script src="/account_book/html/skin/js/jquery-3.7.1.min.js"></script>
    <script src="/account_book/html/skin/js/jquery-ui.js"></script>
    <!-- custom jquery -->
    <script src="/account_book/html/skin/js/common.js"></script>
    <title>가계부</title>
</head>
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
                        <form name="l_seachform" action="<?=$_self?>" method="POST">
                        <!-- 검색영역 start -->
                        <div class="search-area">
                            <div class="search-lab">
                                <span class="lab">유형선택</span>
                                <select name="search_loan_type">
                                    <option value="">::선택::</otption>
                                    <? foreach ($loan_type as $lt) { ?>
                                    <option value="<?= $lt['systemcode_value']?>" <?= selected_on($lt['systemcode_value'],$search_loan_type)?> ><?= $lt['systemcode_name'];?></option>
                                    <?}?>   
                                </select>
                            </div>
                            <div class="search-lab">
                                <span class="lab" >상대(이름)</span>
                                <input type="text" name="search_counterparty_name" value="<?=$search_counterparty_name?>">
                            </div>
                            <div class="search-lab">
                                <span class="lab"  >사유</span>
                                <input type="text" name="search_loan_reason" value="<?=$search_loan_reason?>">
                            </div>
                            <div class="search-lab">
                                <span class="lab">날짜</span>
                                <input type="date" name="search_loan_date" value="<?=$search_loan_date?>">
                            </div>
                            <div class="search-lab">
                                <span class="lab">은행</span>
                                <select name="search_bank_idx">
                                    <option value="">::선택::</otption>
                                        <? foreach ($bank_rows as $b_row) { ?>
                                        <option value="<?= $b_row['systemcode_idx'];?>" <?=selected_on($b_row['systemcode_idx'],$search_bank)?> ><?= $b_row['systemcode_name'];?></option>
                                        <?}?>
                                </select>
                            </div>
                            <div class="search-lab">
                                <a class="search-btn" href="#none" onclick="data_save('l_seachform')">검색</a>
                            </div>
                        </div>
                        <br>
                        </form>
                        <!-- 검색영역 end -->
                        <div class="table-util">
                            <div class="left">
                                <a href="javascript://" onclick="data_del('l_listform','l_del')" class="r-btn delete">삭제</a>
                                <!-- <a href="#none" class="r-btn modify">수정</a> -->
                            </div>
                            <div class="right">
                                <a href="#none" class="r-btn save modal-open" data-modal="debt-new" data-form="l_saveform" data-mode="l_save">신규등록</a>
                            </div>
                        </div>
                        <!-- 리스트 최대 9개 -->
                        <div class="table-wrap">
                            <form name="l_listform" action="/account_book/html/new_tap06/loan.call.php"  method="POST">
                                <input type='hidden' name="smode" value="">
                                <table class="c-table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="single"></th>
                                            <th>유형</th>
                                            <th>상대(이름)</th>
                                            <th>사유</th>
                                            <th>날짜</th>
                                            <th>금액</th>
                                            <th>잔금</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? foreach ($loan_rows as $l_row) { 
                                            if($l_row['loan_type']==0){$loan_type_class="red";}else if($l_row['loan_type']==1){$loan_type_class="blue";}else{$loan_type_class="";}
                                            ?>
                                        <tr>
                                            <td><input type="checkbox" class="single" name="loan_idx[]" value="<?= $l_row['loan_idx'];?>"></td>
                                            <td><span class="c-lab <?=$loan_type_class?> --sm"><?=$l_row['loan_type_name']?></span></td>
                                            <td><a href="#none" class="c-btn underline modal-open" data-modal="debt-new" data-load="load"
                                            data-form="l_saveform" data-mode="up_l_save" data-idx="<?= $l_row['loan_idx'];?>">
                                                <?= $l_row['bank_name'] != ''? $l_row['bank_name'] : $l_row['counterparty_name'] ?></a></td>
                                            <td><?=$l_row['loan_reason']?></td>
                                            <td><?=$l_row['loan_date']?></td>
                                            <td><a href="#none" class="c-btn underline modal-open" data-modal="debt-list" data-load="load" data-idx="<?= $l_row['loan_idx'];?>"><?=$l_row['total_amount']?>원</a></td>
                                            <td></td>
                                        </tr>
                                        <?}?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <!-- *** 내부영역 END *** -->
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>
    <script>
        function click_bank_yn() {
            const bankYn = document.getElementById('bank_yn'); // 체크박스
            const addLoanType = document.getElementById('add_loan_type'); // select
            const bankSelect = document.getElementById('add_bank_idx'); // 은행 select
            const counterparty = document.getElementById('add_counterparty_name'); // 거래처 input
            
                if (bankYn.checked) {
                    bankSelect.removeAttribute('disabled');
                    bankSelect.style.display = 'inline-block';
                    
                    counterparty.value = '';
                    counterparty.setAttribute('disabled', 'disabled');
                    addLoanType.value = '2'; // select 값 설정
                } else {
                    counterparty.removeAttribute('disabled');

                    bankSelect.setAttribute('disabled', 'disabled');
                    bankSelect.style.display = 'none';
                    bankSelect.value = '';
                }
        }
        // AJAX로 페이지 데이터 불러오기
        function dataload(idx,modal,page) {
            $.ajax({
                url: "loan_ajax.php",
                type: "GET",
                data: { this_loan_idx: idx, modal: modal ,page: page},
                dataType: "json",   
                success: function(data) {
                    success_dataload(data);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                    alert("데이터를 불러오는 중 오류가 발생했습니다.");
                }
            });
        }
        function success_dataload(data) {
            if(data.modal=='debt-new'){
                $('#save_title').text( '[채무] 수정');
                $('#add_loan_idx').val(data.loan_idx);
                $('#add_loan_type').val(data.loan_type);
                $('#add_loan_type_name').val(data.loan_type_name);
                $('#add_counterparty_name').val(data.counterparty_name);
                $('#add_loan_reason').val(data.loan_reason);
                $('#add_loan_date').val(data.loan_date);
                $('#add_total_amount').val(data.total_amount);
                if(data.bank_idx!==""){  
                    $('#bank_yn').prop('checked',true);
                    $('#add_bank_idx').val(data.bank_idx);
                    $('#add_bank_name').val(data.bank_name);
                }
                $('#save_btn').text( '수정');
                click_bank_yn();       
            }else if(data.modal=='debt-list'){
               // console.log("data 전체:", data);
                    $('#list_title').text( ' [채무]'+data.counterparty_name);
                    $("#listTableBody").html(data.rows_html);
                    $("#listpagination").html(data.pagination_html);
                    $('#list_total_count').text(data.total_count);
                    
            }

        }
        </script>
    <!-- ***** 등록/수정 모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap debt-new" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label" id="save_title" > [채무] 신규등록 </p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <div class="m-body">
                <form name="l_saveform" id="l_saveform" action="/account_book/html/new_tap06/loan.call.php"  method="POST">
                <input type='hidden' name="add_loan_idx" id="add_loan_idx" value="">
                <input type='hidden' name="smode" id="smode" value="l_save">
                    <!-- 입력폼 start -->
                    <div class="form-wrap div-col2">
                        <div class="form">
                            <div class="tit">유형</div>
                            <div class="con">
                                <select name="add_loan_type" id="add_loan_type">
                                    <? foreach ($loan_type as $lt) { ?>
                                    <option value="<?= $lt['systemcode_value'];?>"><?= $lt['systemcode_name'];?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                        <div class="form">
                            <div class="tit">날짜</div>
                            <div class="con"><input type="date" name="add_loan_date" id="add_loan_date"></div>
                        </div>
                        <div class="form">
                            <div class="tit">상대(이름)</div>
                            <div class="con">
                                <input type="text" name="add_counterparty_name" id="add_counterparty_name" >
                                <input type="checkbox" class="single" name="bank_yn" id="bank_yn" value="y" onclick="click_bank_yn()">
                                <label for="bank_yn">은행대출</label>
                                <select name="add_bank_idx" id="add_bank_idx" style="display:none;" disabled>
                                        <? foreach ($bank_rows as $b_row) { ?>
                                        <option value="<?= $b_row['systemcode_idx'];?>" ><?= $b_row['systemcode_name'];?></option>
                                        <?}?>
                                </select>
                            </div>
                        </div>
                        <div class="form">
                            <div class="tit">대출금액</div>
                            <div class="con"><input type="text" name="add_total_amount" placeholder="숫자만 입력" id="add_total_amount"></div>
                        </div>
                        <div class="form">
                            <div class="tit">사유</div>
                            <div class="con"><input type="text" name="add_loan_reason" id="add_loan_reason"></div>
                        </div>
                        <div class="btn-center-wrap">
                            <a href="javascript://" onclick="data_save('l_saveform')" class="c-btn save" id="save_btn">신규등록</a>
                        </div>
                    </div>
                <!-- 입력폼 end -->
                </form>
            </div>
        </div>
    </div>
    <!-- ***** 등록/수정 모달창 END ***** -->

    <!-- ***** 상세리스트 모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap debt-list" style="display:none">
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
                                    <th>유형</th>
                                    <th>사유</th>
                                    <th>날짜</th>
                                    <th>금액</th>
                                    <th>잔금</th>
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