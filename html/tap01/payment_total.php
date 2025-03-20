<?
include_once "/demoyujin/www/account_book/html/include/head.php";  
$total_money=0;//총남은돈 

?>
    <table class="cal_list2" >
        <tbody>
		<?foreach($pay_rows as $p){
			$total_money+=$p['price'];
			?>
            <tr>
                <th><?echo $p['payment_name'];?></th>
                <td>
					<?echo number_format($p['price']);?>
                </td>
            </tr>
            <?}?>
            <tr>
                <th>총 남은돈</th>
                <td>
					<?echo number_format($total_money);?>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="cal_list2" >
        <tbody>
		<?foreach($s_rows as $s){
			?>
            <tr>
                <th><?echo $s['savings_name'];?></th>
                <td>
					<?echo number_format($s['total_price']);?>
                </td>
            </tr>
            <?}?>
        </tbody>
    </table>
