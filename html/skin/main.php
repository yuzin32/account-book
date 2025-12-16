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
                        <li class="on"><a href="#none">Home</a></li>
                        <!-- 활성화 메뉴 클래스명 "on" 추가 -->
                        <li><a href="#none">캘린더</a></li>
                        <li><a href="#none">체크리스트</a></li>
                        <li><a href="#none">적금/채무</a></li>
                        <li><a href="#none">코드관리</a></li>
                        <li><a href="#none">통계</a></li>
                    </ul>
                </div>
                <div class="content-box">
                    <!-- ***  START *** -->
                   
                    <!-- ***  END *** -->
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>


</body>
</html>