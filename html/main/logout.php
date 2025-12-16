
<?php
// 1. 세션 시작
session_start();

// 2. 모든 세션 변수 해제
$_SESSION = array();

// 3. 쿠키로 세션을 사용하는 경우, 쿠키도 지워준다
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// 4. 세션 종료
session_destroy();

// 5. 로그아웃 후 이동할 페이지로 리다이렉트
header("Location:/account_book/html/main/");
exit;
?>