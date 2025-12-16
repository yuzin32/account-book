<?if(empty($log_f)){ $log_f=""; }?>
<form name="loginform" action="login_call.php" method="POST">
    <section class="login-top">
        <p class="txt01">로그인</p>
        <p class="txt02">가계부에 입장하시려면 로그인해주세요.</p>
    </section>
    <section class="login-inp">
        <div class="inp-id">
            <input type="text" name="userid" placeholder="아이디">
        </div>
        <div class="inp-pw">
            <input type="password" name="input_pwd" placeholder="비밀번호">
            <a href="#none" class="pw-eyes show" title="비밀번호 보기"></a>
            <a href="#none" class="pw-eyes hide" title="비밀번호 숨김" style="display:none;"></a>
        </div>
        <!-- 2025-09-24 아이디/ 비밀번호 에러메세지 추가 -->
        <?if($log_f=='N1'){?><p class="error-text">입력하신 아이디가 등록되어 있지 않습니다.</p><?}?>
        <?if($log_f=='N2'){?><p class="error-text">입력하신 비밀번호가 틀렸습니다.</p><?}?>
        <a class="login-btn" href="javascript://" onclick="data_save('loginform')" >입장하기</a>
    </section>
</form>
 