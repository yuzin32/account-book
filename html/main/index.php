<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?php
if(empty($_GET['smode'])){
    $smode = 'login';
}else{ $smode = $_GET['smode'];}
?>
<script>
function data_save(formName) {
    const form = document.forms[formName]; // 폼 이름으로 선택
        form.submit(); // submit 함수 호출
}
</script>

<title>login</title>
</head>
<body>
    <div class="wrap">
        <div class="login-wrap">
            <div class="outer-bg"></div>
            <div class="inner-box">
                <div class="content-nav">
                    <ul class="nav-list">
                     <?if($smode != 'edit'){?>
                        <li <?if($smode == 'login'){?>class="on"<?}?>><a href="/account_book/html/main/">로그인</a></li>
                        <li <?if($smode == 'join'){?>class="on"<?}?>><a href="/account_book/html/main/?smode=join">회원가입</a></li>
                    <?}else{ ?>
                         <li><a href="/account_book/html/new_tap01/home.php">홈</a></li>
                     <?}?>
                    </ul>
                </div>
                <div class="content-box">
                    <?if($smode=='join' || $smode=='edit'){
                    include "join.php";
                    }else{
                    include "login.php";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

