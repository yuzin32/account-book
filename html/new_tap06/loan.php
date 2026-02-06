<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?
//은행
$sql ="select systemcode_idx,systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='bank'";
$bank_rows = $objdb->fetchAllRows($sql);
//대출타입
$sql ="select systemcode_value,systemcode_name from acbook_systemcode where systemcode_key='loan_type'";
$loan_type = $objdb->fetchAllRows($sql);

$wherey="";
//채무
$sql = "select loan_idx,counterparty_name,loan_reason,loan_date,total_amount,loan_type,bank_idx
,(select systemcode_name from acbook_systemcode where systemcode_key='bank' and systemcode_idx=l.bank_idx) bank_name
,(select systemcode_name from acbook_systemcode where systemcode_key='loan_type' and systemcode_value=l.loan_type) loan_type_name
FROM acbook_loan l where loan_idx>=0".$wherey;
$loan_rows = $objdb->fetchAllRows($sql);

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
                        <div class="search-area">
                            <div class="search-lab">
                                <span class="lab">유형선택</span>
                                <select>
                                    <option value="">::선택::</otption>
                                    <? foreach ($loan_type as $lt) { ?>
                                    <option value="<?= $lt['systemcode_idx'];?>" <?=selected_on($lt['systemcode_idx'],$serch_loan_type)?> ><?= $lt['systemcode_name'];?></option>
                                    <?}?>   
                                </select>
                            </div>
                            <div class="search-lab">
                                <span class="lab">상대(이름)</span>
                                <input type="text">
                            </div>
                            <div class="search-lab">
                                <span class="lab">사유</span>
                                <input type="text">
                            </div>
                            <div class="search-lab">
                                <span class="lab">날짜</span>
                                <input type="date">
                            </div>
                            <div class="search-lab">
                                <span class="lab">은행</span>
                                <select>
                                    <option value="">::선택::</otption>
                                        <? foreach ($bank_rows as $b_row) { ?>
                                        <option value="<?= $b_row['systemcode_idx'];?>" <?=selected_on($b_row['systemcode_idx'],$serch_bank)?> ><?= $b_row['systemcode_name'];?></option>
                                        <?}?>
                                </select>
                            </div>
                            <div class="search-lab">
                                <a class="search-btn" href="#none">검색</a>
                            </div>
                        </div>
                        <br>
                        <!-- 검색영역 end -->
                        <div class="table-util">
                            <div class="left">
                                <a href="javascript://" onclick="data_del('l_listform','l_del')" class="r-btn delete">삭제</a>
                                <!-- <a href="#none" class="r-btn modify">수정</a> -->
                            </div>
                            <div class="right">
                                <a href="#none" class="r-btn save modal-open" data-modal="debt-new">신규등록</a>
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
                                            <td><a href="#none" class="c-btn underline modal-open" data-modal="debt-new" data-load="load" data-idx="<?= $l_row['loan_idx'];?>">
                                                <?= $l_row['bank_name'] != ''? $l_row['bank_name'] : $l_row['counterparty_name'] ?></a></td>
                                            <td><?=$l_row['loan_reason']?></td>
                                            <td><?=$l_row['loan_date']?></td>
                                            <td><?=$l_row['total_amount']?>원</td>
                                            <td><a href="#none" class="c-btn underline modal-open " data-modal="debt-list"></a></td>
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
            bankSelect.style.display = 'inline-block';
            counterparty.value = '';
            counterparty.setAttribute('disabled', 'disabled');
            addLoanType.value = '2'; // select 값 설정
        } else {
            counterparty.removeAttribute('disabled');
            bankSelect.style.display = 'none';
            bankSelect.value = '';
        }
}
            // AJAX로 페이지 데이터 불러오기
            function dataload(idx) {
            $.ajax({
                url: "loan_ajax.php",
                type: "GET",
                data: {this_loan_idx: idx},
                success: function(data) {
                try {
                    //console.log(data);
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
                clearForm('l_saveform');
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
                click_bank_yn();
            }
         </script>
    <!-- ***** 등록/수정 모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap debt-new" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label">
                    [채무] 신규등록
                </p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <div class="m-body">
                <form name="l_saveform" id="l_saveform" action="/account_book/html/new_tap06/loan.call.php"  method="POST">
                    <input type='hidden' name="smode" value="l_save">
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
                                <select name="add_bank_idx" id="add_bank_idx" style="display:none;">
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
                            <a href="javascript://" onclick="data_save('l_saveform')" class="c-btn save">신규등록</a>
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
                <p class="mh-label">
                    [채무] 이채림
                </p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <div class="m-body">
                <!-- 모달 리스트 영역 start -->
                <div class="modal-list-area">
                    <div class="list-top">
                        총 내역 <span class="num">8</span>건
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
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>빌려줌</td>
                                    <td>이런저런이유로</td>
                                    <td>2026.00.00</td>
                                    <td>5,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>빌려줌</td>
                                    <td>이런저런이유로</td>
                                    <td>2026.00.00</td>
                                    <td>5,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>빌려줌</td>
                                    <td>이런저런이유로</td>
                                    <td>2026.00.00</td>
                                    <td>5,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>빌림</td>
                                    <td>이런저런이유로</td>
                                    <td>2026.00.00</td>
                                    <td>5,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>빌려줌</td>
                                    <td>이런저런이유로</td>
                                    <td>2026.00.00</td>
                                    <td>5,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>빌려줌</td>
                                    <td>이런저런이유로</td>
                                    <td>2026.00.00</td>
                                    <td>5,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>빌려줌</td>
                                    <td>이런저런이유로</td>
                                    <td>2026.00.00</td>
                                    <td>5,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>빌려줌</td>
                                    <td>이런저런이유로</td>
                                    <td>2026.00.00</td>
                                    <td>5,000</td>
                                    <td>0</td>
                                </tr>

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
                    </div>
                </div>
                <!-- 모달 리스트 영역 end -->
            </div>
        </div>
    </div>
    <!-- ***** 상세리스트 모달창 END ***** -->
</body>
</html>