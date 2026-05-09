<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
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

//최신글
$sql="select a.account_idx,a.account_type ,ac.account_category_name,p.payment_name,a.price,DATE_FORMAT(a.account_date,'%Y-%m-%d') account_date,a.loan_yn ,a.savings_yn
from acbook_account a 
LEFT join acbook_account_category ac on ac.account_category_idx = a.account_category_idx
LEFT join acbook_payment p on p.payment_idx = a.payment_idx
where a.account_idx >= 0 and a.account_category_idx!=12 ORDER BY a.account_date DESC LIMIT 4";
$new_acount_list_rows = $objdb->fetchAllRows($sql);

//카테고리 그래프
$sql="SELECT  ac.account_category_name,SUM(a.price) AS total_price
FROM acbook_account a LEFT JOIN acbook_account_category ac  ON ac.account_category_idx = a.account_category_idx 
where month=".date('m')."  and nyear=".date('Y')." GROUP BY a.account_category_idx, ac.account_category_name ";
$account_category_grp_rows = $objdb->fetchAllRows($sql);
foreach ($account_category_grp_rows as $ac) {
    $categories[] = $ac['account_category_name'];
    $prices[] = $ac['total_price'];
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body>
    <div class="wrap">
        <!-- ***** 다이어리 레이아웃 START ***** -->
        <div class="diary-wrap">
            <div class="outer-bg"></div>
            <!-- 내지갑 --><? include_once "/demoyujin/www/account_book/html/include/mywellet.php"; ?>
            <div class="inner-box">
            <!-- 메뉴--><? include_once "/demoyujin/www/account_book/html/include/menu.php"; ?> 
        <div class="content-box">
                    <!-- home START -->
                    <div class="home-wrap">
                        <!-- 왼쪽 섹션 start -->
                        <section class="home-sect sect01">
                            
                            <div class="home-profile">
                                <div class="profile-img">
                                    <img src="/account_book/html/skin/img/profile_test.jpg" alt="테스트프로필">
                                </div>
                                <div class="profile-dday">
                                    <span class="txt01">월급날까지...</span>
                                    <span class="txt02">D - 25</span>
                                </div>
                                <div class="profile-info">
                                    <ul class="info-list">
                                        <li>
                                            <span class="info-t">아이디</span>
                                            <span class="info-c"><?=$_SESSION['userid']?></span>
                                        </li>
                                        <li>
                                            <span class="info-t">이름</span>
                                            <span class="info-c"><?=$_SESSION['name']?></span>
                                        </li>
                                    </ul>
                                    <ul class="info-btn">
                                        <li>
                                            <a  href="#none"  class="r-btn modal-open" data-modal="edit_pw_chk" >정보 수정</a>
                                        </li>
                                        <li>
                                            <a href="/account_book/html/main/logout.php" class="info-btn logout">로그아웃</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- 미니 캘린더 start -->
                            <div class="mini-calendar">
                                <div class="cal-month">
                                    <a href="/account_book/html/new_tap01/home.php?<?=$prev_txt?>" class="cal-month-arrow prev"><img src="/account_book/html/skin/img/ico_arrow_right.svg" alt="이전"></a>
                                    <p class="cal-month-text"><?=$main_month?>월</p>
                                    <a href="/account_book/html/new_tap01/home.php?<?=$next_txt?>" class="cal-month-arrow next"><img src="/account_book/html/skin/img/ico_arrow_right.svg" alt="다음"></a>
                                </div>
                                <div class="cal-week">
                                    <ul class="week-list">
                                        <li class="red">일</li>
                                        <li>월</li>
                                        <li>화</li>
                                        <li>수</li>
                                        <li>목</li>
                                        <li>금</li>
                                        <li class="red">토</li>
                                    </ul>
                                   <ul class="day-list">
                                        <? $start_done=date("t", mktime(0, 0, 0, $main_month, 0, $main_year))-$startDayOfWeek; ?>
                                        <? for ($i = 0; $i < $startDayOfWeek; $i++) {?>
                                        <li></li>
                                        <? $start_done++; }?>

                                        <?for ($day = 1; $day <= $lastDayOfMonth; $day++) { 
                                            $class_day=""; 
                                            if($day == date('d')&& $main_month==date('m')){  $class_day="today";  }?>
                                        <li class="<?=$class_day?>" ><?=$day?> </li>
                                       <?// 토요일마다 줄 바꿈
                                       if (($day + $startDayOfWeek) % 7 == 0) {
                                         }
                                    } ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- 미니 캘린더 end -->
                        </section>
                        <!-- 왼쪽 섹션 end -->

                        <!-- 오른쪽 섹션 start -->
                        <section class="home-sect sect02">
                            <!-- 차트 start -->
                            <div class="category-chart">
                                <div class="sect-tit">
                                    <h4>[ <?=date('Y')?>년 <?=date('m')?>월 ] 카테고리별 지출</h4>
                                    <a class="btn-more" href="/account_book/html/new_tap08/report.php">MORE VIEW</a>
                                </div>
                                <div class="chart-area"> 
                                    <!-- hidden -->
                                    <canvas id="homeChart"></canvas>
                                </div>
                            </div>
                            <!-- 차트 end -->

                            <!-- 최근 가계부 start -->
                            <div class="recent-account">
                                <div class="sect-tit">
                                    <h4>최근 가계부 내역</h4>
                                    <a class="btn-more" href="/account_book/html/new_tap03/accountlist.php">MORE VIEW</a>
                                </div>
                                <ul class="recent-list">
                                    <?foreach($new_acount_list_rows as $n_a){?>
                                    <li class="rl-item">
                                        <div class="item-top">
                                             <?if($n_a["account_type"]==1){
                                                $a_class="sort01"; $a_type="수입";
                                             }else if($n_a["account_type"]==0){
                                                if($n_a["loan_yn"]=='y'){
                                                $a_class=""; $a_type="대출";
                                                }else if($n_a["savings_yn"]=='y'){
                                                $a_class=""; $a_type="적금";
                                                }else{ $a_class="sort02"; $a_type="지출"; }
                                             }?>
                                            <span class="sort <?=$a_class?>"><?=$a_type?></span>
                                            <span class="date"><?=$n_a["account_date"]?></span>
                                        </div>
                                        <div class="item-mid">
                                            <p class="num"><?=number_format($n_a["price"])?> <span class="won">원</span></p>
                                        </div>
                                        <div class="item-bot">
                                            <p class="txt">
                                                <span class="txt-t">카테고리</span>
                                                <span class="txt-c"><?=$n_a["account_category_name"]?></span>
                                            </p>
                                            <p class="txt">
                                                <span class="txt-t">결제수단</span>
                                                <span class="txt-c"><?=$n_a["payment_name"]?></span>
                                            </p>
                                        </div>
                                    </li>
                                    <?}?>
                                </ul>
                            </div>
                            <!-- 최근 가계부 end -->
                        </section>
                        <!-- 오른쪽 섹션 end -->
                    </div>
                    <!-- home END -->
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>
    <div class="modal-wrap edit_pw_chk" style="display:none">
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
                    <div class="form">
                        <div class="tit">비밀번호</div>
                        <div class="con"><input type="password" name="input_pwd" id="input_pwd"></div>
                        <a class="form-btn" id="id_chk" onclick="pw_chk()" href="#none">중복체크</a>
                    </div>
               <!-- 입력폼 end -->
            </div>
        </div>
    </div>
    <!-- ***** 모달창 END ***** -->
 <script type="text/javascript">
function pw_chk(){
	$.ajax({
    type: "post",
    url: "home_chk.php",
    data: { input_pwd: $("#input_pwd").val() },
    dataType: "json",  // 응답은 JSON
    success: function(res) {
        if(res.url=='y'){
            location.href = "/account_book/html/main/?smode=edit";
        }else{ alert(res.message); // JSON 키 접근 }
    },
    error: function(xhr, status, error) {
        console.log("에러:", error);
        console.log("응답:", xhr.responseText);
    }
});
	}
    </script>
       <!-- 차트 script -->
<script>
Chart.defaults.font.family = "'Pretendard', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif";
Chart.defaults.font.size = 12;
Chart.defaults.color = '#444';

window.addEventListener('DOMContentLoaded', () => {
  const categories = <?php echo json_encode($categories); ?>;
  const prices = <?php echo json_encode($prices); ?>;

  const ctx = document.getElementById('homeChart').getContext('2d');

  const homeChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: categories,
      datasets: [{
        label: '카테고리',
        data: prices,
        borderWidth: 1,
        borderColor: ['rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(153, 102, 255)'],
        backgroundColor: ['rgba(255, 99, 132,0.4)',
      'rgba(54, 162, 235,0.4)',
      'rgba(255, 205, 86,0.4)',
      'rgba(75, 192, 192,0.4)',
      'rgba(153, 102, 255,0.4)'],
        borderRadius: 3,
        barThickness: 40
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
            display: false,
        },
        tooltip: {
          enabled: true
        }
      },
      scales: {
        x: {
          grid: {
            display: false
          }
        },
        y: {
          beginAtZero: true,
          ticks: {
            font: {
              size: 11
            }
          }
        }
      }
    }
  });
});
</script>

</body>
</html>