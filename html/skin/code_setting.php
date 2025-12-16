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
                        <li><a href="#none">캘린더</a></li>
                        <li><a href="#none">체크리스트</a></li>
                        <li><a href="#none">적금/채무</a></li>
                        <li class="on"><a href="#none">코드관리</a></li>
                        <li><a href="#none">통계</a></li>
                    </ul>
                </div>
                <div class="content-box">
                    <!-- *** 내부영역 START *** -->
                    <div class="setting-wrap">
                        <ul class="tab-list">
                            <li class="on"><a href="#none"><span class="ico"><img src="/account_book/html/skin/img/ico_setting_menu01.svg" alt="지출/수입"></span> 지출/수입</a></li>
                            <li><a href="#none"><span class="ico"><img src="/account_book/html/skin/img/ico_setting_menu02.svg" alt="결제수단"></span> 결제수단</a></li>
                            <li><a href="#none"><span class="ico"><img src="/account_book/html/skin/img/ico_setting_menu03.svg" alt="은행"></span> 은행</a></li>
                            <li><a href="#none"><span class="ico"><img src="/account_book/html/skin/img/ico_setting_menu04.svg" alt="체크리스트"></span> 체크리스트</a></li>
                        </ul>
                        <br><br>
                        <div class="tab-con-wrap">
                            <div class="tc tc01">
                                <div class="table-util">
                                    <div class="left">
                                        <a href="#none" class="r-btn delete">삭제</a>
                                        <a href="#none" class="r-btn modify">수정</a>
                                    </div>
                                    <div class="right">
                                        <a href="#none" class="r-btn save modal-open" data-modal="new-code">신규</a>
                                    </div>
                                </div>
                                <table class="c-table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="single"></th>
                                            <th>지출/수입</th>
                                            <th>타이틀</th>
                                            <th>통계사용여부</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>
                                                <select>
                                                    <option>지출</option>
                                                    <option>수입</option>
                                                </select>
                                            </td>
                                            <td><input type="text"></td>
                                            <td><input type="checkbox" class="single"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>
                                                <select>
                                                    <option>지출</option>
                                                    <option>수입</option>
                                                </select>
                                            </td>
                                            <td><input type="text"></td>
                                            <td><input type="checkbox" class="single"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>
                                                <select>
                                                    <option>지출</option>
                                                    <option>수입</option>
                                                </select>
                                            </td>
                                            <td><input type="text"></td>
                                            <td><input type="checkbox" class="single"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>
                                                <select>
                                                    <option>지출</option>
                                                    <option>수입</option>
                                                </select>
                                            </td>
                                            <td><input type="text"></td>
                                            <td><input type="checkbox" class="single"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>
                                                <select>
                                                    <option>지출</option>
                                                    <option>수입</option>
                                                </select>
                                            </td>
                                            <td><input type="text"></td>
                                            <td><input type="checkbox" class="single"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>
                                                <select>
                                                    <option>지출</option>
                                                    <option>수입</option>
                                                </select>
                                            </td>
                                            <td><input type="text"></td>
                                            <td><input type="checkbox" class="single"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>
                                                <select>
                                                    <option>지출</option>
                                                    <option>수입</option>
                                                </select>
                                            </td>
                                            <td><input type="text"></td>
                                            <td><input type="checkbox" class="single"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>
                                                <select>
                                                    <option>지출</option>
                                                    <option>수입</option>
                                                </select>
                                            </td>
                                            <td><input type="text"></td>
                                            <td><input type="checkbox" class="single"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="single"></td>
                                            <td>
                                                <select>
                                                    <option>지출</option>
                                                    <option>수입</option>
                                                </select>
                                            </td>
                                            <td><input type="text"></td>
                                            <td><input type="checkbox" class="single"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- *** 내부영역 END *** -->
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>

    <!-- ***** 신규등록 모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap new-code" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label">
                    [신규] 기초코드관리
                </p>
                <a href="#none" class="modal-close" title="창닫기">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div>
            <div class="m-body">
               <!-- 입력폼 start -->
                <div class="form-wrap">
                    <div class="form">
                        <div class="tit">타이틀</div>
                        <div class="con"><input type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">수입/지출</div>
                        <div class="con">
                            <select>
                                <option>수입</option>
                                <option>지출</option>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">통계사용여부</div>
                        <div class="con">
                                <label class="c-input ci-radio">
                                    <input type="radio" checked name="chart">  사용 
                                    <div class="ci-show"></div>
                                </label>
                                <label class="c-input ci-radio">
                                    <input type="radio"  name="chart">  미사용 
                                    <div class="ci-show"></div>
                                </label>
                        </div>
                    </div>
                    <div class="btn-center-wrap">
                        <a href="#none" class="c-btn save">신규등록</a>
                    </div>
                </div>
               <!-- 입력폼 end -->
            </div>
        </div>
    </div>
    <!-- ***** 신규등록 모달창 END ***** -->
</body>
</html>