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
                    </div>
                    <!-- home END -->
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>


</body>
</html>