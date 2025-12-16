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
                    <!-- *** 내부영역 START *** -->
                    
                    <!-- *** 내부영역 END *** -->
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