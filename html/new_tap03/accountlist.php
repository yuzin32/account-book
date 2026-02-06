<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?
//지출/수입 카테고리 
$sql = "select account_category_idx,account_type,account_category_name,statistics_use from acbook_account_category order by account_category_idx desc";
$ac_rows = $objdb->fetchAllRows($sql);
//결제수단
$sql ="select payment_idx,payment_name,bank_idx,payment_type,use_yn,price from acbook_payment order by payment_idx desc";
$pay_rows = $objdb->fetchAllRows($sql);
//적금 리스트
$sql =" select savings_idx,savings_name,total_price  from acbook_savings";
$s_rows = $objdb->fetchAllRows($sql);


if(empty($page_no))$page_no=0;//현재페이지번호 
if(empty($page_no_size))$page_no_size=5;//한화면에 나오는 페이지 갯수
if(empty($page_size))$pagesize=15;//한화면에나오는 데이터갯수
if(empty($page_box))$page_box=0;

$wherey='';
if(!empty($search_date)){$wherey .=" and account_date='".$search_date."'";}else{$search_date =""; }
if(!empty($search_account_type)){$wherey .=" and account_type=".$search_account_type;}else{$search_account_type ="";}

if(!empty($search_payment_idx)){$wherey .=" and payment_idx=".$search_payment_idx;}else{$search_payment_idx ="";}
if(!empty($search_account_category_idx)){$wherey .=" and account_category_idx=".$search_account_category_idx;}else{$search_account_category_idx ="";}
if(!empty($search_title)){$wherey .=" and title='".$search_title."'";}else{$search_title ="";}
if(!empty($search_saveing)){$wherey .=" and savings_yn='".$search_saveing."'";}else{$search_saveing ="";}
if(!empty($search_loan)){$wherey .=" and loan_yn='".$search_loan."'";}else{$search_loan ="";}


//지출내역
$sql ="select account_idx,account_type,account_category_idx,title,price,savings_idx,savings_yn,loan_yn,loan_type,loan_complete,payment_idx,DATE_FORMAT(account_date,'%Y-%m-%d') account_date,memo
from acbook_account where account_idx >= 0 and account_category_idx!=12 ".$wherey." order by account_date desc ";//limit ".$pagesize." OFFSET ".$page_no
//echo $sql;
$acount_list_rows = $objdb->fetchAllRows($sql);

//총 로우갯수
$sql="select count(*) cnt from acbook_account where account_idx >= 0".$wherey;
$acount =  $objdb-> fetchRow($sql);

$page_cnt=$acount['cnt']/$pagesize;//실질적 페이지 갯수 
$page_box_cnt=$page_cnt/$page_no_size;//페이지박스의갯수
//$qarydata="";
//$qarydata="&search_nyaer=".$search_nyaer."& search_month=".$search_month."&search_payment_idx=".$search_payment_idx."&search_account_category_idx=".$search_account_category_idx."&account_type=".$account_type."&account_date".$account_date;

?>
<script>
    function data_save(formName) {
    const form = document.forms[formName]; // 폼 이름으로 선택
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
                   <div class="accountlist-wrap">
                        <!--검색영역 start -->
                        <form name="cal_seachform" action="<?=$_self?>">
                        <div class="search-area">
                            <div class="search-lab">
                                <span class="lab">날짜</span>
                                <input name="search_date" type="date" value="<?=$search_date?>">
                            </div>
                             <div class="search-lab">
                                <span class="lab">수입/지출</span>
                                <select name="search_account_type">
                                    <option value="">전체</otption>
                                    <option value="0" <?=selected_on(0,$search_account_type)?>>지출</otption>
                                    <option value="1" <?=selected_on(1,$search_account_type)?>>수입</otption>
                                </select>
                            </div>
                            <div class="search-lab">
                                <span class="lab">카테고리</span>
                                <select name="search_account_category_idx">
                                    <option value="">전체</otption>
                                    <?foreach($ac_rows as $ac){?>
                                        <option value="<?=$ac['account_category_idx']?>" <?=selected_on($ac['account_category_idx'],$search_account_category_idx)?>><?=$ac['account_category_name']?></otption>
                                    <?}?>
                                </select>
                            </div>
                            <div class="search-lab">
                                <span class="lab">내역</span>
                                <input type="text" name="search_title" value="<?=$search_title?>">
                            </div>
                            <div class="search-lab">
                                <span class="lab">결제수단</span>
                                <select name="search_payment_idx">
                                    <option value="">전체</otption>
                                    <?foreach($pay_rows as $p){?>
                                        <option value="<?=$p['payment_idx']?>"<?=selected_on($p['payment_idx'],$search_payment_idx)?>><?=$p['payment_name']?></otption>
                                    <?}?>
                                </select>
                            </div>
                            <div class="search-lab">
                                <span class="lab">적금/채무</span>
                                <label class="c-input ci-check">
                                    <input name="search_saveing" value="y" type="checkbox" <?=checked_on('y',$search_saveing)?>> 적금
                                    <div class="ci-show"></div>
                                </label>
                                <label class="c-input  ci-check">
                                    <input name="search_loan" value="y" type="checkbox" <?=checked_on('y',$search_loan)?>> 채무
                                    <div class="ci-show"></div>
                                </label>
                            </div>
                            <div class="search-lab">
                                <a class="search-btn" href="javascript://" onclick="data_save('cal_seachform')">검색</a>
                            </div>
                        </div>
                        <br>
                        </form>
                        <!-- 검색영역 end -->
                    <div class="total-list-wrap">
                                <div class="table-util">
                                    <div class="u-left">
                                        <a href="#none" class="r-btn delete">삭제</a>
                                    </div>
                                    <div class="u-right">
                                        <!-- <a href="#none"  class="r-btn save">엑셀등록</a> -->
                                        <a href="#none"  class="r-btn save modal-open" data-modal="account-new">등록</a>
                                    </div>
                                </div>
                                <div class="list-table">
                                    <!-- 한페이지에 최대 13줄 -->
                                    <table class="c-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" class="single">
                                                </th>
                                                <th>No</th>
                                                <th>날짜</th>
                                                <th>카테고리</th>
                                                <th>상세내역</th>
                                                <th>금액</th>
                                                <th>결제수단</th>
                                                <th>적금</th>
                                                <th>채무</th>
                                                <th>메모</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? $no=0; 
                                            $num=$no+($page_no*$pagesize); 
                                            foreach (array_slice($acount_list_rows, $num, $pagesize) as $a_row) { ?>
                                            <td> <input type='checkbox' name="account_idx[]" value="<?= $a_row['account_idx'];?>" > </td>
                                            <td><?= $num+$no?> </td>
                                            <td><?= $a_row['account_date'];?></td>
                                            <td>
                                                <? foreach ($ac_rows as $ac_row) { 
                                                    if($ac_row['account_category_idx']== $a_row['account_category_idx']) echo $ac_row['account_category_name'];
                                                }?>
                                            </td>
                                            <td>
                                            <a href="#none"  class="c-btn underline modal-open" data-modal="account-updat" data-load="load" data-idx="<?= $a_row['account_idx'];?>"><?= $a_row['title'];?></a>    
                                            <!-- <a href="./calender_main.php?smode=updatemode&account_idx=<?= $a_row['account_idx'];?>">
                                                    </a>-->
                                                    </td> 
                                            <td><?= $a_row['price'];?>원</td>
                                            <td>
                                                <? foreach ($pay_rows as $p_row) { 
                                                    if($p_row['payment_idx']== $a_row['payment_idx']) echo $p_row['payment_name'];
                                                }?>
                                            </td>
                                            <td><?= $a_row['savings_yn'];?></td>
                                            <td><?= $a_row['loan_yn'];?></td>
                                            <td><?= $a_row['memo'];?></td>
                                        </tr>
                                        <? $no++;
                                        }?>
                                        </tbody>
                                    </table>
                                   <!-- 페이지네이션 -->
                                    <?
                                    $start_page = ($page_box * $page_no_size) + 1;
                                    $end_page   = $start_page + $page_no_size - 1;
                                    ?>
                                    <ul class="pagination">
                                        <li class="arrow prev">
                                            <?php if ($page_box > 0) { ?>
                                                <a href="<?=$_self?>?page_box=<?=($page_box-1)?>&page_no=<?=$start_page-1?>" title="이전"></a>
                                            <?php } ?>
                                        </li>

                                        <?php
                                        for ($p = $start_page; $p <= $end_page; $p++) {
                                            if($page_cnt>=$p){
                                        ?>
                                            <li <?php if ($page_no == $p) { ?>class="on"<?php } ?>>
                                                <a href="<?=$_self?>?page_no=<?=$p?>&page_box=<?=$page_box?>">
                                                    <?=$p?>
                                                </a>
                                            </li>
                                        <?php } } ?>
                                        <?php if ($page_box < $page_box_cnt) { ?>
                                        <li class="arrow next">
                                            <a href="<?=$_self?>?page_box=<?=($page_box+1)?>&page_no=<?=$end_page+1?>" title="다음"></a>
                                        </li>
                                        <?}?>
                                                                            </ul>
                                </div>
                            </div>
                   </div>
                   <!-- *** 내부영역 END *** -->

            </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>
  <!-- *****  모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap account-new" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label">
                    [가계부] 등록
                </p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <div class="m-body">
                <!-- 입력폼 start -->
                <form name="ac_saveform" action="/account_book/html/new_tap03/accountlist.call.php"  method="POST">
                <input name="smode" type="text" value="a_save">
                <div class="form-wrap div-col2">
                    <div class="form">
                        <div class="tit">날짜</div>
                        <div class="con">
                            <input name="add_account_date" type="date">
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">지출/수입</div>
                        <div class="con">
                            <select name="add_account_type" id='add_account_type'>
                                <option value="0">지출</option>
                                <option value="1">수입</option>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">카테고리</div>
                        <div class="con">
                            <select name="add_account_category_idx" id="add_account_category_idx">
                                <? foreach ($ac_rows as $ac_row) { ?>
                                <option value="<?= $ac_row['account_category_idx']?>"><?= $ac_row['account_category_name']?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">상세내역</div>
                        <div class="con"><input type="text" name="add_title" id="add_title"></div>
                    </div>
                    <div class="form">
                        <div class="tit">금액</div>
                        <div class="con"><input type="text" name="add_price" id="add_price"></div>
                    </div>
                    <div class="form">
                        <div class="tit">결제수단</div>
                        <div class="con">
                            <select name="add_payment_idx" id="add_payment_idx">
                                <option>::선택::</option>
                                    <? foreach ($pay_rows as $p_row) { ?>
                                        <option value="<?= $p_row['payment_idx']?>" ><?= $p_row['payment_name']?></option>
                                    <?}?>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">적금</div>
                        <div class="con">
                            <select name="add_savings_idx" id="add_savings_idx">
                                <option value="">해당없음</option>
                                <? foreach ($s_rows as $s_row) { ?>
                                <option value="<?= $s_row['savings_idx']?>"><?= $s_row['savings_name']?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">메모</div>
                        <div class="con"><input type="text" name="add_memo" id="add_memo"></div>
                    </div>
                    <div class="form">
                        <div class="tit">채무(아직 개발안함)</div>
                        <div class="con">
                            <select name="add_loan_idx" id="add_loan_idx">
                                <option value="">해당없음</option>
                            </select>
                        </div>
                    </div>
                    <div class="btn-center-wrap">
                        <a href="javascript://" onclick="data_save('ac_saveform');" class="c-btn save">등록</a>
                    </div>
                </div>
                </form>
               <!-- 입력폼 end -->
            </div>
        </div>
    </div>
    <!-- ***** 모달창 END ***** -->

    <script>
            // AJAX로 페이지 데이터 불러오기
            function dataload(idx) {
            $.ajax({
                url: "accountlist_ajax.php",
                type: "GET",
                data: {this_account_idx: idx},
                success: function(data) {
                try {
                    console.log(data);//console.log(data.title);
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
                $('#up_account_idx').val(data.account_idx);
                $('#up_account_date').val(data.account_date);
                $('#up_account_type').val(data.account_type);
                $('#up_account_category_idx').val(data.account_category_idx);
                $('#up_payment_idx').val(data.payment_idx);
                $('#up_title').val(data.title);
                $('#up_price').val(data.price);
                $('#up_savings_idx').val(data.savings_idx);
                $('#up_memo').val(data.memo);

            }
         </script>
     <!-- *****  모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap account-updat" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label">
                    [가계부] 수정
                </p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <div class="m-body">
                <!-- 입력폼 start -->
                <form name="ac_updateform" action="/account_book/html/new_tap03/accountlist.call.php"  method="POST">
                <input name="up_account_idx" id="up_account_idx" type="text" value="">
                <input name="smode" type="text" value="a_save">
                <div class="form-wrap div-col2">
                    <div class="form">
                        <div class="tit">날짜</div>
                        <div class="con">
                            <input type="date" id="up_account_date" name="up_account_date">
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">지출/수입</div>
                        <div class="con">
                            <select name="up_account_type" id='up_account_type'>
                                <option value="0">지출</option>
                                <option value="1">수입</option>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">카테고리</div>
                        <div class="con">
                            <select name="up_account_category_idx" id="up_account_category_idx">
                                <? foreach ($ac_rows as $ac_row) { ?>
                                <option value="<?= $ac_row['account_category_idx']?>"><?= $ac_row['account_category_name']?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">상세내역</div>
                        <div class="con"><input type="text" name="up_title" id="up_title"></div>
                    </div>
                    <div class="form">
                        <div class="tit">금액</div>
                        <div class="con"><input type="text" name="up_price" id="up_price"></div>
                    </div>
                    <div class="form">
                        <div class="tit">결제수단</div>
                        <div class="con">
                            <select name="up_payment_idx" id="up_payment_idx">
                                <option value="">::선택::</option>
                                    <? foreach ($pay_rows as $p_row) { ?>
                                        <option value="<?= $p_row['payment_idx']?>" ><?= $p_row['payment_name']?></option>
                                    <?}?>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">적금</div>
                        <div class="con">
                            <select name="up_savings_idx" id="up_savings_idx">
                                <option value="">해당없음</option>
                                <? foreach ($s_rows as $s_row) { ?>
                                <option value="<?= $s_row['savings_idx']?>"><?= $s_row['savings_name']?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">메모</div>
                        <div class="con"><input type="text" name="up_memo" id="up_memo"></div>
                    </div>
                    <div class="form">
                        <div class="tit">채무</div>
                        <div class="con">
                            <select name="up_loan_idx" id="up_loan_idx">
                                <option value="">해당없음</option>
                            </select>
                        </div>
                    </div>
                    <div class="btn-center-wrap">
                        <a href="javascript://" onclick="data_save('ac_updateform');" class="c-btn save">수정</a>
                    </div>
                </div>
                </form>
               <!-- 입력폼 end -->
            </div>
        </div>
    </div>
    <!-- ***** 모달창 END ***** -->
</body>
</html>