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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- custom jquery -->
    <script src="/account_book/html/skin/js/common.js"></script>

    <title>가계부 - home</title>
</head>
<body>
    <div class="wrap">
        <!-- ***** 다이어리 레이아웃 START ***** -->
        <div class="diary-wrap">
            <div class="outer-bg"></div>
            <!-- ***** 내지갑 START ***** -->
            <div class="side-wallet">
                <ul class="side-nav tab-btn">
                    <li class="on" data-tab="tc01"><a href="#none">2025</a></li>
                    <li data-tab="tc02"><a href="#none">Total</a></li>
                </ul>
                <div class="side-box tab-con-wrap">
                    <div class="inner tab-con tc01">
                        <div class="date-txt">
                            <p class="eng">2025년 1월 1일 ~ </p>
                            <p class="kor-date"><span class="fs-bold">2025</span>년 <span class="fs-bold">00</span>월 <span class="fs-bold">00</span>일</p>
                        </div>
                        <ul class="cash-list">
                            <li class="cash-blue">
                                <span class="l-tit">수입</span>
                                <span class="r-num">000,000,000 원</span>
                            </li>
                            <li class="cash-red">
                                <span class="l-tit">지출</span>
                                <span class="r-num">000,000,000 원</span>
                            </li>
                            <li>
                                <span class="l-tit">적금</span>
                                <span class="r-num">000,000,000 원</span>
                            </li>
                            <li>
                                <span class="l-tit">채무</span>
                                <span class="r-num">000,000,000 원</span>
                            </li>
                        </ul>
                    </div>
                    <div class="inner tab-con tc02" style="display:none;">
                        <div class="date-txt">
                            <p class="eng">처음시작한날부터</p>
                            <p class="kor-date"><span class="fs-bold">2025</span>년 <span class="fs-bold">00</span>월 <span class="fs-bold">00</span>일</p>
                        </div>
                        <ul class="cash-list">
                            <li class="cash-blue">
                                <span class="l-tit">수입</span>
                                <span class="r-num">000,000,000,000 원</span>
                            </li>
                            <li class="cash-red">
                                <span class="l-tit">지출</span>
                                <span class="r-num">000,000,000,000 원</span>
                            </li>
                            <li>
                                <span class="l-tit">적금</span>
                                <span class="r-num">000,000,000,000 원</span>
                            </li>
                            <li>
                                <span class="l-tit">채무</span>
                                <span class="r-num">000,000,000,000 원</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="side-btn">
                    <a href="#none">예정지출 보기</a>
                    <a href="#none">로그아웃</a>
                </div>
            </div>
            <!-- ***** 내지갑 END  ***** -->
            <div class="inner-box">
                <div class="content-nav">
                    <ul class="nav-list">
                        <li class="on"><a href="#none">Home</a></li>
                        <!-- 활성화 메뉴 클래스명 "on" 추가 -->
                        <li><a href="#none">캘린더</a></li>
                        <li><a href="#none">가계부</a></li>
                        <li><a href="#none">체크리스트</a></li>
                        <li><a href="#none">적금/채무</a></li>
                        <li><a href="#none">코드관리</a></li>
                        <li><a href="#none">통계</a></li>
                    </ul>
                </div>
                <div class="content-box">
                    <!-- home START -->
                    <div class="home-wrap">
                        <!-- 왼쪽 섹션 start -->
                        <section class="home-sect sect01">
                            
                            <div class="home-profile">
                                <div class="profile-img">
                                    <img src="./img/profile_test.jpg" alt="테스트프로필">
                                </div>
                                <div class="profile-dday">
                                    <span class="txt01">월급날까지...</span>
                                    <span class="txt02">D - 25</span>
                                </div>
                                <div class="profile-info">
                                    <ul class="info-list">
                                        <li>
                                            <span class="info-t">아이디</span>
                                            <span class="info-c">dkdlel1234</span>
                                        </li>
                                        <li>
                                            <span class="info-t">이름</span>
                                            <span class="info-c">홍길동</span>
                                        </li>
                                    </ul>
                                    <ul class="info-btn">
                                        <li>
                                            <a href="#none" class="info-btn">비밀번호 수정</a>
                                        </li>
                                        <li>
                                            <a href="#none" class="info-btn logout">로그아웃</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- 미니 캘린더 start -->
                            <div class="mini-calendar">
                                <div class="cal-month">
                                    <a href="#none" class="cal-month-arrow prev"><img src="/account_book/html/skin/img/ico_arrow_right.svg" alt="이전"></a>
                                    <p class="cal-month-text">12월</p>
                                    <a href="#none" class="cal-month-arrow next"><img src="/account_book/html/skin/img/ico_arrow_right.svg" alt="다음"></a>
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
                                        <li>&nbsp;</li><!-- 비어있는 곳에는 &nbsp; (공백값) 넣어주세요 -->
                                        <li>1</li>
                                        <li>2</li>
                                        <li>3</li>
                                        <li>4</li>
                                        <li>5</li>
                                        <li>6</li>
                                        <li>7</li>
                                        <li>8</li>
                                        <li>9</li>
                                        <li>10</li>
                                        <li>11</li>
                                        <li>12</li>
                                        <li>13</li>
                                        <li>14</li>
                                        <li>15</li>
                                        <!-- 오늘 인 경우 today 추가 -->
                                        <li class="today">16</li>
                                        <li>17</li>
                                        <li>18</li>
                                        <li>19</li>
                                        <li>20</li>
                                        <li>21</li>
                                        <li>22</li>
                                        <li>23</li>
                                        <li>24</li>
                                        <li>25</li>
                                        <li>26</li>
                                        <li>27</li>
                                        <li>28</li>
                                        <li>29</li>
                                        <li>30</li>
                                        <li>31</li>
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
                                    <h4>[ 2025년 00월 ] 카테고리별 지출</h4>
                                    <a class="btn-more" href="#none">MORE VIEW</a>
                                </div>
                                <div class="chart-area">
                                    <canvas id="homeChart"></canvas>
                                </div>
                            </div>
                            <!-- 차트 end -->

                            <!-- 최근 가계부 start -->
                            <div class="recent-account">
                                <div class="sect-tit">
                                    <h4>최근 가계부 내역</h4>
                                    <a class="btn-more" href="https://demoyujin.mycafe24.com/account_book/html/skin/accountlist.php">MORE VIEW</a>
                                </div>
                                <ul class="recent-list">
                                    <li class="rl-item">
                                        <div class="item-top">
                                            <!-- 수입 : sort01 / 지출 : sort02 / 적금채무 : sort만 있어도 됌 -->
                                            <span class="sort sort01">수입</span>
                                            <span class="date">2025.00.00</span>
                                        </div>
                                        <div class="item-mid">
                                            <p class="num">30,000 <span class="won">원</span></p>
                                        </div>
                                        <div class="item-bot">
                                            <p class="txt">
                                                <span class="txt-t">카테고리</span>
                                                <span class="txt-c">월급</span>
                                            </p>
                                            <p class="txt">
                                                <span class="txt-t">결제수단</span>
                                                <span class="txt-c">우리은행</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="rl-item">
                                        <div class="item-top">
                                            <!-- 수입 : sort01 / 지출 : sort02 / 적금채무 : sort만 있어도 됌 -->
                                            <span class="sort sort02">지출</span>
                                            <span class="date">2025.00.00</span>
                                        </div>
                                        <div class="item-mid">
                                            <p class="num">30,000 <span class="won">원</span></p>
                                        </div>
                                        <div class="item-bot">
                                            <p class="txt">
                                                <span class="txt-t">카테고리</span>
                                                <span class="txt-c">간식</span>
                                            </p>
                                            <p class="txt">
                                                <span class="txt-t">결제수단</span>
                                                <span class="txt-c">네이버페이</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="rl-item">
                                        <div class="item-top">
                                            <!-- 수입 : sort01 / 지출 : sort02 / 적금채무 : sort만 있어도 됌 -->
                                            <span class="sort">적금</span>
                                            <span class="date">2025.00.00</span>
                                        </div>
                                        <div class="item-mid">
                                            <p class="num">300,000 <span class="won">원</span></p>
                                        </div>
                                        <div class="item-bot">
                                            <p class="txt">
                                                <span class="txt-t">카테고리</span>
                                                <span class="txt-c">적금</span>
                                            </p>
                                            <p class="txt">
                                                <span class="txt-t">결제수단</span>
                                                <span class="txt-c">우리은행</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="rl-item">
                                        <div class="item-top">
                                            <!-- 수입 : sort01 / 지출 : sort02 / 적금채무 : sort만 있어도 됌 -->
                                            <span class="sort">채무</span>
                                            <span class="date">2025.00.00</span>
                                        </div>
                                        <div class="item-mid">
                                            <p class="num">300,000 <span class="won">원</span></p>
                                        </div>
                                        <div class="item-bot">
                                            <p class="txt">
                                                <span class="txt-t">카테고리</span>
                                                <span class="txt-c">채무</span>
                                            </p>
                                            <p class="txt">
                                                <span class="txt-t">결제수단</span>
                                                <span class="txt-c">우리은행</span>
                                            </p>
                                        </div>
                                    </li>
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


    <!-- 차트 script -->
    <script>
Chart.defaults.font.family = "'Pretendard', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif";
Chart.defaults.font.size = 12;
Chart.defaults.color = '#444';

window.addEventListener('DOMContentLoaded', () => {
  const ctx = document.getElementById('homeChart').getContext('2d');

  const homeChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['카테고리1', '카테고리2', '카테고리3', '카테고리4', '카테고리5'],
      datasets: [{
        label: '카테고리',
        data: [120000, 190000, 150000, 220000, 180000],
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