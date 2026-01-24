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
    <title>가계부 - 가계부</title>
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
                        <li class="on"><a href="#none">가계부</a></li>
                        <li><a href="#none">체크리스트</a></li>
                        <li><a href="#none">적금/채무</a></li>
                        <li><a href="#none">코드관리</a></li>
                        <li><a href="#none">통계</a></li>
                    </ul>
                </div>
                <div class="content-box">
                    <!-- *** 내부영역 START *** -->
                   <div class="accountlist-wrap">
                        <!-- 2026/01/07 추가 -- 검색영역 start -->
                        <div class="search-area">
                            <div class="search-lab">
                                <span class="lab">날짜</span>
                                <input type="date">
                            </div>
                            <div class="search-lab">
                                <span class="lab">카테고리</span>
                                <select>
                                    <option>::선택::</otption>
                                    <option>카테고리</otption>
                                    <option>카테고리</otption>
                                </select>
                            </div>
                            <div class="search-lab">
                                <span class="lab">내역</span>
                                <input type="text">
                            </div>
                            <div class="search-lab">
                                <span class="lab">결제수단</span>
                                <select>
                                    <option>::선택::</otption>
                                    <option>결제수단</otption>
                                    <option>결제수단</otption>
                                </select>
                            </div>
                            <div class="search-lab">
                                <span class="lab">적금/채무</span>
                                <label class="c-input ci-check">
                                    <input type="checkbox"> 적금
                                    <div class="ci-show"></div>
                                </label>
                                <label class="c-input  ci-check">
                                    <input type="checkbox"> 채무
                                    <div class="ci-show"></div>
                                </label>
                            </div>
                            <div class="search-lab">
                                <a class="search-btn" href="#none">검색</a>
                            </div>
                        </div>
                        <br>
                        <!-- 검색영역 end -->
                    <div class="total-list-wrap">
                                <div class="table-util">
                                    <div class="u-left">
                                        <a href="#none" class="r-btn delete">삭제</a>
                                        <a href="#none"  class="r-btn modify">수정</a>
                                    </div>
                                    <div class="u-right">
                                        <a href="#none"  class="r-btn save">엑셀등록</a>
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
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="single"></td>
                                                <td>553</td>
                                                <td>2025-00-00</td>
                                                <td>간식</td>
                                                <td>뚜레주르 초코케익</td>
                                                <td>15,000</td>
                                                <td>네이버페이</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>누구누구생일파티</td>
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
                <div class="form-wrap div-col2">
                    <div class="form">
                        <div class="tit">날짜</div>
                        <div class="con">
                            <input type="date">
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">지출/수입</div>
                        <div class="con">
                            <select>
                                <option>지출</option>
                                <option>수입</option>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">카테고리</div>
                        <div class="con">
                            <select>
                                <option>::선택::</option>
                                <option>카테고리1</option>
                                <option>카테고리2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">상세내역</div>
                        <div class="con"><input type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">금액</div>
                        <div class="con"><input type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">결제수단</div>
                        <div class="con">
                            <select>
                                <option>::선택::</option>
                                <option>결제수단1</option>
                                <option>결제수단2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">적금</div>
                        <div class="con">
                            <select>
                                <option>해당없음</option>
                                <option>적금1</option>
                                <option>적금2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">채무</div>
                        <div class="con">
                            <input type="checkbox" id="toggle1" hidden class="c-toggle"> 
                            <label for="toggle1" class="c-togglelabel">
                                <span class="c-togglebutton"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form">
                        <div class="tit">메모</div>
                        <div class="con"><input type="text"></div>
                    </div>
                    <div class="btn-center-wrap">
                        <a href="#none" class="c-btn save">등록</a>
                    </div>
                </div>
               <!-- 입력폼 end -->
            </div>
        </div>
    </div>
    <!-- ***** 모달창 END ***** -->

</body>
</html>