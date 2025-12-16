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
    <link rel="stylesheet" href="/account_book/html/skin/css/home.css">
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
                        <li><a href="#none">Home</a></li>
                        <!-- 활성화 메뉴 클래스명 "on" 추가 -->
                        <li><a href="#none">캘린더</a></li>
                        <li class="on"><a href="#none">체크리스트</a></li>
                        <li><a href="#none">적금/채무</a></li>
                        <li><a href="#none">코드관리</a></li>
                        <li><a href="#none">통계</a></li>
                    </ul>
                </div>
                <div class="content-box">
                    <!-- *** 내부영역 START *** -->
                    <div class="chklist-wrap">
                        <!-- 연도 start -->
                        <div class="chklist-month">
                            <div class="search-area">
                                <div class="search-lab">
                                    <select class="round">
                                        <option>2025년</option>
                                        <option>2024년</option>
                                        <option>2023년</option>
                                    </select>
                                </div>
                                <div class="search-lab">
                                    <a href="#none" class="search-btn" title="조회">조회</a>
                                </div>
                            </div>
                            <ul class="month-list">
                                <!-- 완료 -->
                                <li class="done">
                                    <a href="#none">
                                        <p class="month">01월</p>
                                        <p class="task">07 / 07</p>
                                        <span class="state">완료</span>
                                    </a>
                                </li>
                                <!-- 미완료 -->
                                <li class="fail">
                                    <a href="#none">
                                        <p class="month">02월</p>
                                        <p class="task">05 / 07</p>
                                        <span class="state">미완료</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#none">
                                        <p class="month">03월</p>
                                        <p class="task">00 / 00</p>
                                        <span class="state">미생성</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#none">
                                        <p class="month">04월</p>
                                        <p class="task">00 / 00</p>
                                        <span class="state">미생성</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#none">
                                        <p class="month">05월</p>
                                        <p class="task">00 / 00</p>
                                        <span class="state">미생성</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#none">
                                        <p class="month">06월</p>
                                        <p class="task">00 / 00</p>
                                        <span class="state">미생성</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#none">
                                        <p class="month">07월</p>
                                        <p class="task">00 / 00</p>
                                        <span class="state">미생성</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#none">
                                        <p class="month">08월</p>
                                        <p class="task">00 / 00</p>
                                        <span class="state">미생성</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#none">
                                        <p class="month">09월</p>
                                        <p class="task">00 / 00</p>
                                        <span class="state">미생성</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#none">
                                        <p class="month">10월</p>
                                        <p class="task">00 / 00</p>
                                        <span class="state">미생성</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#none">
                                        <p class="month">11월</p>
                                        <p class="task">00 / 00</p>
                                        <span class="state">미생성</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#none">
                                        <p class="month">12월</p>
                                        <p class="task">00 / 00</p>
                                        <span class="state">미생성</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- 연도 end -->
                        <!-- 리스트 start -->
                         <section class="chklist-list">
                            <div class="table-util">
                                <div class="left">
                                    <a href="#none" class="r-btn">초기생성</a>
                                    <a href="#none" class="r-btn save">저장</a>
                                    <a href="#none" class="r-btn delete">삭제</a>
                                </div>
                                <div class="right">
                                    <a href="#none" class="r-btn ico"><span><img src="/account_book/html/skin/img/ico_close_wh.svg"></span>상태취소</a>
                                    <a href="#none" class="r-btn ico"><span><img src="/account_book/html/skin/img/ico_check_wh.svg"></span>납부완료</a>
                                    <a href="#none" class="r-btn ico"><span><img src="/account_book/html/skin/img/ico_check_wh.svg"></span>수납완료</a>
                                </div>
                            </div>
                            <div class="table-wrap">
                                <table class="c-table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="single"></th>
                                            <th>내용</th>
                                            <th>지출/수입</th>
                                            <th>금액</th>
                                            <th>메모</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td><span class="c-lab --sm blue">납부완료</span> 엄마, 아빠 용돈 제일 길게 쓴다면 이렇게 길어집니다...길어집니다...길어집니다..</td>
                                            <td>지출</td>
                                            <td>300,000원</td>
                                            <td><input type="text" placeholder="메모"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td><span class="c-lab --sm blue">수납완료</span> 엄마, 아빠 용돈</td>
                                            <td>지출</td>
                                            <td>300,000원</td>
                                            <td><input type="text" placeholder="메모"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>엄마, 아빠 용돈</td>
                                            <td>지출</td>
                                            <td>300,000원</td>
                                            <td><input type="text" placeholder="메모"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>엄마, 아빠 용돈</td>
                                            <td>지출</td>
                                            <td>300,000원</td>
                                            <td><input type="text" placeholder="메모"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>엄마, 아빠 용돈</td>
                                            <td>지출</td>
                                            <td>300,000원</td>
                                            <td><input type="text" placeholder="메모"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>엄마, 아빠 용돈</td>
                                            <td>지출</td>
                                            <td>300,000원</td>
                                            <td><input type="text" placeholder="메모"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>엄마, 아빠 용돈</td>
                                            <td>지출</td>
                                            <td>300,000원</td>
                                            <td>
                                                <input type="text" placeholder="메모">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>
                                                <input type="text">
                                                <a href="#none" class="r-btn delete">취소</a></td>
                                            <td>지출</td>
                                            <td><input type="text"></td>
                                            <td>
                                                <input type="text" placeholder="메모">
                                            </td>
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
                         </section>
                        <!-- 리스트 end -->
                    </div>
                    <!-- *** 내부영역 END *** -->
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>


</body>
</html>