<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?
if(!empty($search_nyaer)){ $main_year=$search_nyaer; }else{$main_year=date('Y'); $search_nyaer=date('Y'); }
if(!empty($search_month)){ $main_month= $search_month; }else{$main_month=date('n'); }

//체크리스트
$sql="SELECT nyear,nmonth,COUNT(*) AS total_count,SUM(CASE WHEN complete = 'y' THEN 1 ELSE 0 END) AS complete_count
,CASE WHEN COUNT(*) = SUM(CASE WHEN complete = 'y' THEN 1 ELSE 0 END) THEN 'y' ELSE 'n' END AS all_complete
FROM acbook_checklist_sub GROUP BY nyear, nmonth ORDER BY nyear DESC, nmonth DESC";
$ch_rows = $objdb->fetchAllRows($sql);

//체크리스트_데이터
$sql ="select t.check_sub_idx,t.complete,t.nmonth,t.nyear,t.check_idx,t.check_date,t.memo,t.title,t.default_price
from acbook_checklist_sub t where t.nyear=".$main_year." and t.nmonth=".$main_month;
$check_sub_rows = $objdb->fetchAllRows($sql);

//년도
$year_list = [];
$month_check=[];

foreach ($ch_rows as $ch) {   
$year_list[] = $ch['nyear']; 
if( $ch['nyear']== $main_year ){
$month_check[(int)$ch['nmonth']] = $ch;
}
}
$year_list = array_unique($year_list);

?>
<script>
function set_new_check(formName){
	document.getElementById('smode').value = 'c_s_save';
	data_save(formName)
}
function data_save(formName) {
    const form = document.forms[formName]; // 폼 이름으로 선택
        form.submit(); // submit 함수 호출
}
function data_del(formName,smode) {
    const form = document.forms[formName]; // 폼 이름으로 선택
	form["smode"].value = smode;
    form.submit(); // submit 함수 호출
}
function new_checklist(tableSelector) {
    const table = document.querySelector('#'+tableSelector);

    const new_num = find_maxnum('new_num')+1//제일큰 번호 찾기

    if (!table) return;
    const tr = document.createElement('tr');

    tr.innerHTML = `
        <input type="hidden" name="new_num[]" value="${new_num}">
        <td><input type="checkbox" class="single" name="new_chk[${new_num}]" value="y"></td>
        <td><input type="text" name="new_title[${new_num}]" value=""><a href="#none" class="r-btn delete new_delete">취소</a></td>
        <td>지출</td>
        <td><input type="title" name="new_default_price[${new_num}]" value=""> </td>
        <td> <input type="text" placeholder="메모" name="new_memo[${new_num}]" value=""></td>
    `;
     table.appendChild(tr);
}
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('new_delete')) {
        e.preventDefault();

        const tr = e.target.closest('tr');
        if (tr) tr.remove();
    }
});
</script>
<body>
    <div class="wrap">
        <!-- ***** 다이어리 레이아웃 START ***** -->
        <div class="diary-wrap">
            <div class="outer-bg"></div>
            <!-- 내지갑 --><? include_once "/demoyujin/www/account_book/html/include/mywellet.php"; ?>
            <div class="inner-box">
            <!-- 메뉴--><? include_once "/demoyujin/www/account_book/html/include/menu.php"; ?> 
                <div class="content-box">
                    <!-- *** 내부영역 START *** -->

                    <div class="chklist-wrap">
                        <!-- 연도 start -->
                        <div class="chklist-month">
                            <div class="search-area">
                                <div class="search-lab">
                                    <form name="search_form">
                                    <select class="round" name ="search_nyaer" action="/account_book/html/new_tap04/checklist.php"  method="POST">
                                        <?foreach($year_list as $my){?>
                                            <option value="<?=$my?>" <?=selected_on($main_year,$my)?>><?=$my?>년</option>
                                        <?}?>
                                    </select>
                                    </form>
                                </div>
                                <div class="search-lab">
                                    <a href="javascript://" onclick="data_save('search_form')" class="search-btn" title="조회">조회</a>
                                </div>
                            </div>
                            <ul class="month-list">
                                <?for($i=1; $i<=12; $i++){
                                    $mclass="";
                                    if($main_month==$i){$mclass.="on ";}
                                    ?>
                                    <?if (isset($month_check[$i])){
                                        $ch=$month_check[$i];
                                        if($ch['all_complete']=='y'){ $mclass.="done ";}else if($ch['all_complete']=='n'){$mclass.="fail";}
                                        ?>
                                        <li class="<?=$mclass?>">
                                            <a href="/account_book/html/new_tap04/checklist.php?search_month=<?=$i?>&search_nyaer=<?=$main_year?>" >
                                                <p class="month"><?=$i?>월</p>
                                                <p class="task"><?=$ch['total_count']?> / <?=$ch['complete_count']?></p>
                                                <span class="state"><?if($ch['all_complete']=='y'){echo "완료";}else{echo "미완료";}?></span>
                                            </a>
                                        </li>
                                     <?}else{?><!--체크리스트 데이터가 없음 -->
                                        <li class="<?= $mclass?>">
                                            <a href="/account_book/html/new_tap04/checklist.php?search_month=<?=$i?>">
                                                <p class="month"><?=$i?>월</p>
                                                <p class="task">0 / 0</p>
                                                <span class="state">미생성</span>
                                            </a>
                                        </li>
                                    <?}?>
                                <?}?>

                            </ul>
                        </div>
                        <!-- 연도 end -->
                        <!-- 리스트 start -->
                         <section class="chklist-list">
                           <form  name="c_s_form" action="/account_book/html/new_tap04/checklist.call.php"  method="POST" >
                            <input type='hidden' name="nmonth" value="<?echo $main_month;?>">	
                            <input type='hidden' name="nyear" value="<?echo $main_year;?>">		
                            <input type='hidden' name="smode" id='smode'value="c_s_update">	
                            <div class="table-util">
                                <div class="left">
                                    <a href="javascript://" onclick="set_new_check('c_s_form')" class="r-btn">초기생성</a>
                                    <a href="javascript://" onclick="data_save('c_s_form')" class="r-btn save" >저장</a>
                                    <a href="javascript://" onclick="data_del('c_s_form','c_s_del')" class="r-btn delete">삭제</a>
                                    <a href="javascript://" onclick="new_checklist('chk_tb')" class="r-btn">추가</a>
                                </div>
                                <div class="right">
                                </div>
                            </div>
                            <div class="table-wrap">
                                <table class="c-table" id="chk_tb">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" onclick="checkAll(this,this.form)" class="single"></th>
                                            <th>내용</th>
                                            <th>지출/수입</th>
                                            <th>금액</th>
                                            <th>메모</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <? foreach ($check_sub_rows as $c_row) { ?>
                                        <tr>
                                            <td><input type="checkbox" class="single" name="check_cp_idx[]" value="<?= $c_row['check_sub_idx'];?>" <?checked_on('y',$c_row['complete'])?>></td>
                                            <td><span class="c-lab --sm blue"><?if($c_row['complete']=='y'){?>납부완료<?}?></span><?=$c_row['title'];?></td>
                                            <td>지출</td>
                                            <input type='hidden' name="check_sub_idx[]" value="<?= $c_row['check_sub_idx'];?>">
                                            <td><?echo $c_row['default_price'];?>원</td>
                                            <td><input type="text" placeholder="메모" name="memo[<?echo $c_row['check_sub_idx'];?>]" value="<?echo $c_row['memo'];?>"></td>
                                        </tr>
                                        <?}?>
                     
                                    </tbody>
                                </table>
                            </div>
                            </form>              
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
