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
                        <li class="on"><a href="#none">적금/채무</a></li>
                        <li><a href="#none">코드관리</a></li>
                        <li><a href="#none">통계</a></li>
                    </ul>
                </div>
                <div class="content-box">
                    <!-- *** 내부영역 START *** -->
                    <div class="saving-wrap">
                        <!-- 검색영역 start -->
                        <div class="search-area">
                            <div class="search-lab">
                                <span class="lab">유형선택</span>
                                <select>
                                    <option>::선택::</otption>
                                    <option>적금</otption>
                                    <option>채무</otption>
                                </select>
                            </div>
                            <div class="search-lab">
                                <span class="lab">은행명</span>
                                <select>
                                    <option>::선택::</otption>
                                    <option>부산은행</otption>
                                    <option>신한은행</otption>
                                </select>
                            </div>
                            <div class="search-lab">
                                <span class="lab">타이틀</span>
                                <input type="text">
                            </div>
                            <div class="search-lab">
                                <span class="lab">1회금액</span>
                                <input type="text">
                            </div>
                            <div class="search-lab">
                                <span class="lab">총금액</span>
                                <input type="text">
                            </div>
                            <div class="search-lab">
                                <span class="lab">시작일</span>
                                <input type="date">
                            </div>
                            <div class="search-lab">
                                <span class="lab">종료일</span>
                                <input type="date">
                            </div>
                            <div class="search-lab">
                                <span class="lab">사용여부</span>
                                <select>
                                    <option>::선택::</otption>
                                    <option>사용</otption>
                                    <option>미사용</otption>
                                </select>
                            </div>
                            <div class="search-lab">
                                <a class="search-btn" href="#none">검색</a>
                            </div>
                        </div>
                        <br>
                        <!-- 검색영역 end -->
                        <div class="table-util">
                            <div class="left">
                                <a href="#none" class="r-btn delete">삭제</a>
                                <a href="#none" class="r-btn modify">수정</a>
                            </div>
                            <div class="right">
                                <a href="#none" class="r-btn save modal-open" data-modal="save-new">신규등록</a>
                            </div>
                        </div>
                        <!-- 리스트 최대 9개 -->
                        <div class="table-wrap">
                            <table class="c-table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="single"></th>
                                        <th>유형</th>
                                        <th>은행명</th>
                                        <th>타이틀</th>
                                        <th>1회 금액</th>
                                        <th>총금액</th>
                                        <th>시작일</th>
                                        <th>종료일</th>
                                        <th>사용여부</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" class="single"></td>
                                        <td><span class="c-lab blue --sm">적금</span></td>
                                        <td>국민은행</td>
                                        <td>하나청년저축계좌</td>
                                        <td>150,000원</td>
                                        <td>300,000,000원</td>
                                        <td>2025.00.00</td>
                                        <td>2025.00.00</td>
                                        <td>
                                            <input type="checkbox" id="toggle1" hidden class="c-toggle"> 
                                            <label for="toggle1" class="c-togglelabel">
                                                <span class="c-togglebutton"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="single"></td>
                                        <td><span class="c-lab red --sm">채무</span></td>
                                        <td>국민은행</td>
                                        <td>하나청년저축계좌</td>
                                        <td>150,000원</td>
                                        <td>300,000,000원</td>
                                        <td>2025.00.00</td>
                                        <td>2025.00.00</td>
                                        <td>
                                            <input type="checkbox" id="toggle2" hidden class="c-toggle"> 
                                            <label for="toggle2" class="c-togglelabel">
                                                <span class="c-togglebutton"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="single"></td>
                                        <td><span class="c-lab red --sm">채무</span></td>
                                        <td>국민은행</td>
                                        <td>하나청년저축계좌</td>
                                        <td>150,000원</td>
                                        <td>300,000,000원</td>
                                        <td>2025.00.00</td>
                                        <td>2025.00.00</td>
                                        <td>
                                            <input type="checkbox" id="toggle2" hidden class="c-toggle"> 
                                            <label for="toggle2" class="c-togglelabel">
                                                <span class="c-togglebutton"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="single"></td>
                                        <td><span class="c-lab blue --sm">적금</span></td>
                                        <td>국민은행</td>
                                        <td>하나청년저축계좌</td>
                                        <td>150,000원</td>
                                        <td>300,000,000원</td>
                                        <td>2025.00.00</td>
                                        <td>2025.00.00</td>
                                        <td>
                                            <input type="checkbox" id="toggle1" hidden class="c-toggle"> 
                                            <label for="toggle1" class="c-togglelabel">
                                                <span class="c-togglebutton"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="single"></td>
                                        <td><span class="c-lab blue --sm">적금</span></td>
                                        <td>국민은행</td>
                                        <td>하나청년저축계좌</td>
                                        <td>150,000원</td>
                                        <td>300,000,000원</td>
                                        <td>2025.00.00</td>
                                        <td>2025.00.00</td>
                                        <td>
                                            <input type="checkbox" id="toggle1" hidden class="c-toggle"> 
                                            <label for="toggle1" class="c-togglelabel">
                                                <span class="c-togglebutton"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="single"></td>
                                        <td><span class="c-lab red --sm">채무</span></td>
                                        <td>국민은행</td>
                                        <td>하나청년저축계좌</td>
                                        <td>150,000원</td>
                                        <td>300,000,000원</td>
                                        <td>2025.00.00</td>
                                        <td>2025.00.00</td>
                                        <td>
                                            <input type="checkbox" id="toggle2" hidden class="c-toggle"> 
                                            <label for="toggle2" class="c-togglelabel">
                                                <span class="c-togglebutton"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="single"></td>
                                        <td><span class="c-lab blue --sm">적금</span></td>
                                        <td>국민은행</td>
                                        <td>하나청년저축계좌</td>
                                        <td>150,000원</td>
                                        <td>300,000,000원</td>
                                        <td>2025.00.00</td>
                                        <td>2025.00.00</td>
                                        <td>
                                            <input type="checkbox" id="toggle1" hidden class="c-toggle"> 
                                            <label for="toggle1" class="c-togglelabel">
                                                <span class="c-togglebutton"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="single"></td>
                                        <td><span class="c-lab red --sm">채무</span></td>
                                        <td>국민은행</td>
                                        <td>하나청년저축계좌</td>
                                        <td>150,000원</td>
                                        <td>300,000,000원</td>
                                        <td>2025.00.00</td>
                                        <td>2025.00.00</td>
                                        <td>
                                            <input type="checkbox" id="toggle2" hidden class="c-toggle"> 
                                            <label for="toggle2" class="c-togglelabel">
                                                <span class="c-togglebutton"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="single"></td>
                                        <td><span class="c-lab blue --sm">적금</span></td>
                                        <td>국민은행</td>
                                        <td>하나청년저축계좌</td>
                                        <td>150,000원</td>
                                        <td>300,000,000원</td>
                                        <td>2025.00.00</td>
                                        <td>2025.00.00</td>
                                        <td>
                                            <input type="checkbox" id="toggle1" hidden class="c-toggle"> 
                                            <label for="toggle1" class="c-togglelabel">
                                                <span class="c-togglebutton"></span>
                                            </label>
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
                    </div>
                    <!-- *** 내부영역 END *** -->
                </div>
            </div>
        </div>
        <!-- ***** 다이어리 레이아웃 END ***** -->
    </div>

    <!-- ***** 상세리스트 모달창 START ***** -->
    <!-- 모달창 작동 jquery : /account_book/html/skin/js/common.js -->
    <div class="modal-wrap save-new" style="display:none">
        <div class="bg"></div>
        <div class="modal">
            <div class="m-head">
                <p class="mh-label">
                    [적금/채무] 신규등록
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
                        <div class="tit">타이틀</div>
                        <div class="con"><input type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">은행명</div>
                        <div class="con">
                            <select>
                                <option>::선택::</option>
                                <option>부산은행</option>
                                <option>신한은행</option>
                            </select>
                        </div>
                    </div>
                   <div class="form">
                        <div class="tit">1회 적금액</div>
                        <div class="con"><input type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">총 적금액</div>
                        <div class="con"><input type="text"></div>
                    </div>
                    <div class="form">
                        <div class="tit">시작일</div>
                        <div class="con"><input type="date"></div>
                    </div>
                    <div class="form">
                        <div class="tit">종료일</div>
                        <div class="con"><input type="date"></div>
                    </div>
                    <div class="form">
                        <div class="tit">사용여부</div>
                        <div class="con">
                            <input type="checkbox" id="toggle1" hidden class="c-toggle"> 
                            <label for="toggle1" class="c-togglelabel">
                                <span class="c-togglebutton"></span>
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
    <!-- ***** 상세리스트 모달창 END ***** -->
</body>
</html>