<?php include_once  "/demoyujin/www/account_book/Setting/config.inc.php";
header('Content-Type: application/json; charset=UTF-8');?>
<?
$inputID = $_POST['inputID'];

if($inputID){
    $sql = "select userid from member where userid='".$inputID."'";
    $userid = $objdb->fetchRow($sql);
    if ($userid && isset($userid['userid'])) {
        $response = [
            "message" => "이미 존재하는 아이디입니다."
        ];
    }else{
        $response = [
            "message" => "사용가능한 아이디입니다."
        ];
        
    }
    
}






echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>