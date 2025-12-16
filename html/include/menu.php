     <?
     $tap_name =basename($_SERVER['PHP_SELF']);

     $menus = [
        "home.php"       => ["label" => "Home",       "url" => "/account_book/html/new_tap01/home.php"],
        "calendar.php"   => ["label" => "캘린더",     "url" => "/account_book/html/new_tap02/calendar.php"],
        "checklist.php"  => ["label" => "체크리스트", "url" => "/account_book/html/new_tap03/checklist.php"],
        "saving_loan.php"=> ["label" => "적금/채무",  "url" => "/account_book/html/new_tap04/saving_loan.php"],
        "basisecode.php" => ["label" => "코드관리",   "url" => "/account_book/html/new_tap05/basisecode.php"],
        "report.php"     => ["label" => "통계",       "url" => "/account_book/html/new_tap06/report.php"],
    ];
     ?>
    
     <div class="content-nav">
        <ul class="nav-list">
            <?foreach($menus as $file => $menu ){?>
                <li class="<?if($tap_name == $file){echo "on";}?>"><a  href="<?= $menu["url"] ?>"><?= $menu["label"] ?></a></li>
                
            <?}?>
        </ul>
    </div>