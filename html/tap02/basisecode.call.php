<?

print_r($_POST);
$smode= $_POST['smode'];

if($smode =='ac_save'){
//지출분야 
$acount_category_name=$_POST['acount_category_name'];
$statistics_use=$_POST['statistics_use'];
$max_payment_category_idx = fetchAllRows('select ifnull(max(payment_idx),0) from acbook_payment_category;');
print_r($max_payment_category_idx);

//$newUserId = insertRow('acbook_payment_category', ['acount_category_name' => $acount_category_name, 'statistics_use' => $statistics_use );

}

?>