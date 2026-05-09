<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";
header('Content-Type: application/json; charset=UTF-8');?>
<?
$input_pwd = $_POST['input_pwd'];

if($input_pwd){
    $sql = "select pwd from member where userid='{$_SESSION['userid']}'";
    $row = $objdb->fetchRow($sql);
    
    if (setPwdEncrypt($input_pwd)==$row['pwd']) {
        $response = [
            "message" => "비밀번호가 맞습니다.",
            "url" => "y"
        ];
    }else{
        $response = [
            "message" => "비밀번호가 틀렸습니다."
        ];
        
    }
    
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>