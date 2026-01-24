<? include_once "/demoyujin/www/account_book/html/include/head.php"; 
if(empty($_SESSION['userid'])){
	header("Location:/account_book/html/main/");
}?>
<?
if(!isset($search_month))$search_month='';
if(!isset($search_day))$search_day='';
if(!empty($search_nyaer)){ $main_year=$search_nyaer; }else{$main_year=date('Y'); $search_nyaer=date('Y'); }
if(!empty($search_month)){ $main_month=sprintf('%02d', $search_month); }else{$main_month=date('m'); }
if(!empty($search_day)){ $main_day=sprintf('%02d', $search_day); }else{$main_day=date('d'); }
$account_date=$main_year.'-'.$main_month.'-'.$main_day;
/*-------------------------------*/
//1월이면 작년12월로 나머진 전 달로
if($main_month=='1'){ $prev_txt="search_nyaer=".($main_year-1)."&search_month=12";
}else{ $prev_txt="search_nyaer=".$main_year."&search_month=".($main_month-1); }

//1월이면 작년12월로 나머진 전 달로
if($main_month=='12'){ $next_txt="search_nyaer=".($main_year+1)."&search_month=1";
}else{ $next_txt="search_nyaer=".$main_year."&search_month=".($main_month+1); }

// 해당 월의 첫날과 마지막 날
$firstDayOfMonth = strtotime("$main_year-$main_month-01");
$lastDayOfMonth = date('t', $firstDayOfMonth);

// 첫날의 요일 (0: 일요일, 6: 토요일)
$startDayOfWeek = date('w', $firstDayOfMonth);
//전달의 마지막날짜 
$wherey="nyear=$main_year and  month = $main_month and userid='".$_SESSION['userid']."'";
//////////////////////캘린더데이터 
$sql="SELECT day,userid, account_type,savings_yn,loan_yn,
	SUM(CASE WHEN account_type=1 THEN price ELSE 0 END) AS in_sum_price,
	SUM(CASE WHEN account_type=0 THEN price ELSE 0 END) AS out_sum_price,
    SUM(CASE WHEN savings_yn='y' THEN price ELSE 0 END) AS savings_price,
    SUM(CASE WHEN loan_yn='y' THEN price ELSE 0 END) AS loan_price
FROM acbook_account WHERE ".$wherey." GROUP BY account_type,day,savings_yn,loan_yn,userid";

$m_acount_rows = $objdb->fetchAllRows($sql);
$m_sum_savings=0; $m_sum_loan=0; $m_in_price=0; $m_out_price=0; 

//상세내역글갯수
$sql ="select count(*)from acbook_account where account_idx >= 0 and account_category_idx!=12 and ".$wherey." ";
$a_row_count = $objdb->fetchRow($sql);

$account_category = select_account_category_name('all');
$payment = select_payment_name('all');
?>
<body>
    <div class="wrap">
        <!-- ***** 다이어리 레이아웃 START ***** -->
        <div class="diary-wrap">
            <div class="outer-bg"></div>
            <!-- 내지갑 --><? include_once "/demoyujin/www/account_book/html/include/mywellet.php"; ?>
            <div class="inner-box">
              <!-- 메뉴 --> <? include_once "/demoyujin/www/account_book/html/include/menu.php"; ?>
                <div class="content-box">
                    <!-- *** 캘린더 START *** -->
                    <div class="calendar-wrap">
                        <div class="calendar-container">
                            <!-- 달력 영역 start -->
                            <div class="calendar">
                                <div class="cal-title">
                                    <a href="/account_book/html/new_tap02/calendar.php?<?=$prev_txt?>" title="이전달" class="arrow prev">이전달</a>
                                    <p class="cal-ym"><span class="fs-bold"><?=$main_year?></span>년 <span class="fs-bold"><?=$main_month?></span>월</p>
                                    <a href="/account_book/html/new_tap02/calendar.php?<?=$next_txt?>"  title="다음달" class="arrow next">다음달</a>
                                </div>
                                <div class="cal-week">
                                    <ul class="week-list">
                                        <li class="week-red">일</li>
                                        <li>월</li>
                                        <li>화</li>
                                        <li>수</li>
                                        <li>목</li>
                                        <li>금</li>
                                        <li class="week-blue">토</li>
                                    </ul>
                                </div>
                                <div class="cal-day">
                                    <ul class="day-list">
                                        <? $start_done=date("t", mktime(0, 0, 0, $main_month, 0, $main_year))-$startDayOfWeek; ?>
                                        <? for ($i = 0; $i < $startDayOfWeek; $i++) {?>
                                        <!-- 현재달이 아닌 날짜는 클래스명 "done" 추가 -->
                                        <li class="done">
                                            <a href="#none">
                                                <span class="day-num"><?=$start_done?></span>
                                            </a>
                                        </li>
                                       <?
                                        $start_done++;
                                       }
                                        ?>
                                        <? for ($day = 1; $day <= $lastDayOfMonth; $day++) { ?>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num"><?=$day?></span>
                                                <div class="money-area">
                                                <div class="money-area">
                                                    <?
                                                    $out_sum_price=0; $in_sum_price=0; $savings_price=0; $loan_price=0;
                                                    foreach($m_acount_rows as $a_row){
                                                        if($a_row['day']==$day){
                                                            if($a_row['savings_yn']!='y' && $a_row['loan_yn']!='y'){
                                                                if($a_row['in_sum_price']!=0)$in_sum_price = $a_row['in_sum_price'];
                                                                if($a_row['out_sum_price']!=0)$out_sum_price = $a_row['out_sum_price'];
                                                                $m_in_price+=$a_row['in_sum_price']; //총입금데이터
                                                                $m_out_price+=$a_row['out_sum_price'];//총출금데이터
                                                            }

                                                            if($a_row['savings_price']!=0)$savings_price = $a_row['savings_price'];
                                                            if($a_row['loan_price']!=0)$loan_price = $a_row['loan_price'];
                                                        
                                                            if($a_row['savings_price']!=0)$m_sum_savings +=$a_row['savings_price'];//총적금데이터
                                                            if($a_row['loan_price']!=0)$m_sum_loan+=$a_row['loan_price'];//총대출데이터
                                                            
                                                        }
                                                    }
                                                    ?>
                                                    <p class="money-blue">+<?=number_format($in_sum_price)?></p><!-- 입금 -->
                                                    <p class="money-red">-<?=number_format($out_sum_price)?></p><!-- 출금 -->
                                                    <p class="money-gray">적금 <?=number_format($savings_price)?></p><!-- 적금 -->
                                                    <p class="money-gray">채무 <?=number_format($loan_price)?></p><!-- 채무 -->
                                                </div>
                                                </div>
                                            </a>
                                        </li>
                                       <?// 토요일마다 줄 바꿈
                                       if (($day + $startDayOfWeek) % 7 == 0) {
						                }
                                    } ?>
                                    <!-- // 마지막 주 빈 칸 채우기 -->
                                    <?$endDayOfWeek = ($startDayOfWeek + $lastDayOfMonth) % 7;
                                    $end_done=0;
                                    if ($endDayOfWeek != 0) {
                                        for ($i = $endDayOfWeek; $i < 7; $i++) {
                                            $end_done++;
                                    ?><!-- 현재달이 아닌 날짜는 클래스명 "done" 추가 -->
                                            <li class="done">
                                                <a href="#none">
                                                    <span class="day-num"><?= $end_done?></span>
                                                    <div class="money-area"></div>
                                                </a>
                                            </li>
                                    <?	}
                                    }?>
                                    </ul>
                                </div>
                            </div>
                            <!-- 달력 영역 end -->
                            <!-- 내역 영역 start -->
                            <div class="month-breakdown">
                                <div class="mb-box">
                                    <div class="mb-box-tit">
                                        <p class="left-tit"><?=$search_month?>월 내역</p>
                                        <a href="#none" class="add-btn" title="내역추가">내역추가</a>
                                    </div>
                                    <div class="mb-box-con">
                                        <ul class="breakdown-list">
                                            <li>
                                                <p class="cate cate-blue">입금</p>
                                                <p><a href="#none" title="상세내역" class="modal-open" data-modal="total-list" data-type="in_list"><?=number_format($m_in_price)?></a> <span class="won">원</span></p>
                                            </li>
                                            <li class="border-bold">
                                                <p class="cate cate-red">출금</p>
                                                <p><a href="#none" title="상세내역" class="modal-open" data-modal="total-list" data-type="out_list"><?=number_format($m_out_price)?></a> <span class="won">원</span></p>
                                            </li>
                                            <li>
                                                <p class="cate">잔액</p>
                                                <p><?=number_format($m_in_price-$m_out_price)?><span class="won">원</span></p>
                                            </li>
                                        </ul>
                                        <br>
                                        <ul class="breakdown-list type2">
                                            <li>
                                                <p class="cate cate-gray">적금</p>
                                                <p><a href="#none" title="상세내역" class="modal-open" data-modal="total-list" data-type="save_list"><?=number_format($m_sum_savings)?></a> <span class="won">원</span></p>
                                            </li>
                                            <li>
                                                <p class="cate cate-gray">채무</p>
                                                <p><a href="#none" title="상세내역" class="modal-open" data-modal="total-list" data-type="loan_list"><?=number_format($m_sum_loan)?></a> <span class="won">원</span></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 내역 영역 end -->
                        </div>
                    </div>
                    <!-- *** 캘린더 END *** -->
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
         <script>
            // AJAX로 페이지 데이터 불러오기
            function loadPage(page) {
                var main_year  = <?=$main_year?>;
                var main_month = <?=$main_month?>;
                var list_type = $('input[name="list_type"]').val();
                var search_ac = $('#list_search_ac').val();
                var search_p = $('#list_search_p').val();
            $.ajax({
                url: "account_total_list_ajax.php",
                type: "GET",
                data: { page:page ,main_year:main_year,main_month:main_month,list_type:list_type,search_ac:search_ac,search_p:search_p},
                success: function(response) {
                try {
                    const data = JSON.parse(response);
                    $("#accountTableBody").html(data.rows_html);
                    $("#pagination").html(data.pagination_html);
                } catch (e) {
                    console.error("JSON parse error:", e);
                    console.log(response);
                }
                },
                error: function() {
                alert("데이터를 불러오는 중 오류가 발생했습니다.");
                }
            });
            }
         </script>
         <!-- ***** 상세리스트 모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap total-list" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label">
                    [입금] 상세리스트
                </p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <div class="m-body">
                <!-- 모달 검색영역 start -->
                <div class="modal-search-area">
                    <input type="hidden" name="list_type" value="">
                    <div class="search-lab">
                        <span class="lab">카테고리</span>
                        <select id="list_search_ac" class="round">
                            <option value="">선택</option>
                           <? foreach ($account_category as $ac_idx => $ac_name){
                            echo "<option value=".$ac_idx.">".$ac_name."</option>";
                            }?>
                        </select>
                    </div>
                    <div class="search-lab">
                        <span class="lab">결제수단</span>
                        <select id="list_search_p" class="round">
                            <option value="">선택</option>
                            <?foreach ($payment as $p_idx => $p_name){
                            echo "<option value=".$p_idx.">".$p_name."</option>";
                            }?>
                        </select>
                    </div>
                    <div class="search-lab">
                        <span class="lab">&nbsp;</span>
                        <a class="search-btn" href="#none" title="검색" onclick="loadPage(1)" >검색</a>
                    </div>
                </div>
                <!-- 모달 검색영역 end -->
                <!-- 모달 리스트 영역 start -->
                <div class="modal-list-area">
                    <div class="list-top">
                        총 내역 <span class="num">99</span>건
                    </div>
                    <div class="list-table-wrap">
                        <table class="list-table">
                            <thead>
                                <tr>
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
                            <!-- 리스트 8개씩 보임 -->
                            <tbody id="accountTableBody">
                            </tbody>
                        </table>

                        <!-- 페이지네이션 -->
                        <ul class="pagination" id="pagination">
                        </ul>
                    </div>
                </div>
                <!-- 모달 리스트 영역 end -->
            </div>
        </div>
    </div>
    <!-- ***** 상세리스트 모달창 END ***** -->

</div>
</body>
</html>