<? include_once "/demoyujin/www/account_book/html/include/head.php"; ?>
<?if(!empty($_GET['smode'])){
$smode='join';
}else{ $smode='login';}

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
                        <li <?if($smode == 'login'){?>class="on"<?}?>><a href="/account_book/html/main/">로그인</a></li>
                        <li <?if($smode == 'join'){?>class="on"<?}?>><a href="/account_book/html/main/?smode=join">회원가입</a></li>
                    </ul>
                </div>
                <div class="content-box">
                    <?if($smode=='join'){
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

