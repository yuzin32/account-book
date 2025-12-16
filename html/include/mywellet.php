<?
//////////내지갑 데이터 
$sql="SELECT nyear,userid,
	SUM(CASE WHEN (account_type=1 and savings_yn='n'and loan_yn='n') THEN price ELSE 0 END) AS y_in_price,
	SUM(CASE WHEN (account_type=0 and savings_yn='n'and loan_yn='n')  THEN price ELSE 0 END) AS y_out_price,
    SUM(CASE WHEN savings_yn='y' THEN price ELSE 0 END) AS y_savings_price,
    SUM(CASE WHEN loan_yn='y' THEN price ELSE 0 END) AS y_loan_price
FROM acbook_account WHERE userid='".$_SESSION['userid']."'GROUP BY nyear";
$y_acount_rows = $objdb->fetchAllRows($sql);
$t_in_price=0; $t_out_price=0; $t_savings_price=0; $t_loan_price=0;
?>
<!-- ***** 내지갑 START ***** -->
            <div class="side-wallet">
                <ul class="side-nav tab-btn">
                    <li class="on" data-tab="tc01"><a href="#none"><?=date('Y')?></a></li>
                    <li data-tab="tc02"><a href="#none">Total</a></li>
                </ul>
                <div class="side-box tab-con-wrap">
                    <div class="inner tab-con tc01">
                        <div class="date-txt">
                            <p class="eng"><?=date('Y')?>년 1월 1일 ~ </p>
                            <p class="kor-date"><span class="fs-bold"><?=date('Y')?></span>년 <span class="fs-bold"><?=date('m')?></span>월 <span class="fs-bold"><?=date('d')?></span>일</p>
                        </div>
                        <ul class="cash-list">
                            <?foreach($y_acount_rows as $y_a_row){
                                $t_in_price +=$y_a_row['y_in_price'];
                                $t_out_price +=$y_a_row['y_out_price']; 
                                $t_savings_price += $y_a_row['y_savings_price'];
                                $t_loan_price +=$y_a_row['y_loan_price'];

                                if(date('Y')==$y_a_row['nyear']){?>
                                <li class="cash-blue">
                                    <span class="l-tit">수입</span>
                                    <span class="r-num"><?=number_format($y_a_row['y_in_price'])?> 원</span>
                                </li>
                                <li class="cash-red">
                                    <span class="l-tit">지출</span>
                                    <span class="r-num"><?=number_format($y_a_row['y_out_price'])?> 원</span>
                                </li>
                                <li>
                                    <span class="l-tit">적금</span>
                                    <span class="r-num"><?=number_format($y_a_row['y_savings_price'])?> 원</span>
                                </li>
                                <li>
                                    <span class="l-tit">채무</span>
                                    <span class="r-num"><?=number_format($y_a_row['y_loan_price'])?> 원</span>
                                </li>
                                <?}
                            }?>
                        </ul>
                    </div>
                    <div class="inner tab-con tc02" style="display:none;">
                        <div class="date-txt">
                            <p class="eng">처음시작한날부터</p>
                            <p class="kor-date"><span class="fs-bold">2025</span>년 <span class="fs-bold"><?=date("m")?></span>월 <span class="fs-bold"><?=date("d")?></span>일</p>
                        </div>
                        <ul class="cash-list">
                            <li class="cash-blue">
                                <span class="l-tit">수입</span>
                                <span class="r-num"><?=number_format($t_in_price)?> 원</span>
                            </li>
                            <li class="cash-red">
                                <span class="l-tit">지출</span>
                                <span class="r-num"><?=number_format($t_out_price)?> 원</span>
                            </li>
                            <li>
                                <span class="l-tit">적금</span>
                                <span class="r-num"><?=number_format($t_savings_price)?> 원</span>
                            </li>
                            <li>
                                <span class="l-tit">채무</span>
                                <span class="r-num"><?=number_format($t_loan_price)?> 원</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="side-btn">
                    <a href="#none">예정지출 보기</a>
                    <a href="/account_book/html/main/logout.php" >로그아웃</a>
                </div>
            </div>
            <!-- ***** 내지갑 END  ***** -->