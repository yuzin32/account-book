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
                        <li><a href="#none">Home</a></li>
                        <!-- 활성화 메뉴 클래스명 "on" 추가 -->
                        <li class="on"><a href="#none">캘린더</a></li>
                        <li><a href="#none">체크리스트</a></li>
                        <li><a href="#none">적금/채무</a></li>
                        <li><a href="#none">코드관리</a></li>
                        <li><a href="#none">통계</a></li>
                    </ul>
                </div>
                <div class="content-box">
                    <!-- *** 캘린더 START *** -->
                    <div class="calendar-wrap">
                        <div class="calendar-container">
                            <!-- 달력 영역 start -->
                            <div class="calendar">
                                <div class="cal-title">
                                    <a href="#none" title="이전달" class="arrow prev">이전달</a>
                                    <p class="cal-ym"><span class="fs-bold">2025</span>년 <span class="fs-bold">9</span>월</p>
                                    <a href="#none" title="다음달" class="arrow next">다음달</a>
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
                                        <!-- 현재달이 아닌 날짜는 클래스명 "done" 추가 -->
                                        <li class="done">
                                            <a href="#none">
                                                <span class="day-num">31</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">1</span>
                                                <div class="money-area">
                                                    <p class="money-blue">+150,000</p><!-- 입금 -->
                                                    <p class="money-red">-150,000</p><!-- 출금 -->
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">2</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">3</span>
                                                <div class="money-area">
                                                     <p class="money-blue">+150,000</p><!-- 입금 -->
                                                    <p class="money-red">-300,000</p><!-- 출금 -->
                                                     <p class="money-gray">적금 300,000</p><!-- 적금 -->
                                                    <p class="money-gray">채무 50,000</p><!-- 채무 -->
                                                </div>
                                            </a>
                                        </li>
                                        <!-- '오늘' 날짜에는 클래스명 "today" 추가 -->
                                        <li class="today">
                                            <a href="#none">
                                                <span class="day-num">4</span>
                                                <span class="day-today">오늘</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">5</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">6</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">7</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">8</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">9</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">10</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">11</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">12</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">13</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">14</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">15</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">16</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">17</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">18</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">19</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">20</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">21</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">22</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">23</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">24</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">25</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">26</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">27</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">28</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">29</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#none">
                                                <span class="day-num">30</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <!-- 현재달이 아닌 날짜는 클래스명 "done" 추가 -->
                                        <li class="done">
                                            <a href="#none">
                                                <span class="day-num">1</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li class="done">
                                            <a href="#none">
                                                <span class="day-num">2</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li class="done">
                                            <a href="#none">
                                                <span class="day-num">3</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                        <li class="done">
                                            <a href="#none">
                                                <span class="day-num">4</span>
                                                <div class="money-area"></div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- 달력 영역 end -->
                            <!-- 내역 영역 start -->
                            <div class="month-breakdown">
                                <div class="mb-box">
                                    <div class="mb-box-tit">
                                        <p class="left-tit">9월 내역</p>
                                        <a href="#none" class="add-btn" title="내역추가">내역추가</a>
                                    </div>
                                    <div class="mb-box-con">
                                        <ul class="breakdown-list">
                                            <li>
                                                <p class="cate cate-blue">입금</p>
                                                <p><a href="#none" title="상세내역" class="modal-open" data-modal="total-list">150,000</a> <span class="won">원</span></p>
                                            </li>
                                            <li class="border-bold">
                                                <p class="cate cate-red">출금</p>
                                                <p><a href="#none" title="상세내역" class="modal-open" data-modal="total-list">150,000</a> <span class="won">원</span></p>
                                            </li>
                                            <li>
                                                <p class="cate">잔액</p>
                                                <p>0 <span class="won">원</span></p>
                                            </li>
                                        </ul>
                                        <br>
                                        <ul class="breakdown-list type2">
                                            <li>
                                                <p class="cate cate-gray">적금</p>
                                                <p><a href="#none" title="상세내역" class="modal-open" data-modal="total-list">150,000</a> <span class="won">원</span></p>
                                            </li>
                                            <li>
                                                <p class="cate cate-gray">채무</p>
                                                <p><a href="#none" title="상세내역" class="modal-open" data-modal="total-list">150,000</a> <span class="won">원</span></p>
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
    </div>

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
                    <div class="search-lab">
                        <span class="lab">카테고리</span>
                        <select class="round">
                            <option>전체</option>
                            <option>선택1</option>
                            <option>선택2</option>
                            <option>선택3</option>
                        </select>
                    </div>
                    <div class="search-lab">
                        <span class="lab">결제수단</span>
                        <select class="round">
                            <option>전체</option>
                            <option>선택1</option>
                            <option>선택12</option>
                            <option>선택123</option>
                        </select>
                    </div>
                    <div class="search-lab">
                        <span class="lab">&nbsp;</span>
                        <a class="search-btn" href="#none" title="검색">검색</a>
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
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2025-00-00</td>
                                    <td>가족</td>
                                    <td>용돈</td>
                                    <td>5,000</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>메모</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2025-00-00</td>
                                    <td>문화생활</td>
                                    <td>교보문고 책 [나의동그라미]</td>
                                    <td>15,000</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>친구가 책을 내서 삼</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2025-00-00</td>
                                    <td>문화생활</td>
                                    <td>교보문고 책 [나의동그라미]</td>
                                    <td>15,000</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>친구가 책을 내서 삼</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>2025-00-00</td>
                                    <td>가족</td>
                                    <td>용돈</td>
                                    <td>5,000</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>메모</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>2025-00-00</td>
                                    <td>가족</td>
                                    <td>용돈</td>
                                    <td>5,000</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>메모</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>2025-00-00</td>
                                    <td>문화생활</td>
                                    <td>교보문고 책 [나의동그라미]</td>
                                    <td>15,000</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>친구가 책을 내서 삼</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>2025-00-00</td>
                                    <td>가족</td>
                                    <td>용돈</td>
                                    <td>5,000</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>메모</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>2025-00-00</td>
                                    <td>가족</td>
                                    <td>용돈</td>
                                    <td>5,000</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>메모</td>
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