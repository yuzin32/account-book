
<style>
    /* 기본 스타일 */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .tabs {
        width: 100%;
        max-width: 600px;
    }

    .tab-buttons {
        display: flex;
        background-color: #e0f7ff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .tab-buttons button {
        flex: 1;
        padding: 12px 16px;
        background-color: #e0f7ff;
        border: none;
        cursor: pointer;
        color: #0077cc;
        font-weight: bold;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .tab-buttons button.active,
    .tab-buttons button:hover {
        background-color: #b3e5ff;
        color: #005a99;
    }

    .tab-content {
        padding: 16px;
        border: 1px solid #b3e5ff;
        border-top: none;
        background-color: #ffffff;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

</style>
<?$page_name = basename($_SERVER['PHP_SELF']);
echo $page_name;
if($page_name=='')$p_active1="active";
if($page_name=='2')$p_active2="active";
if($page_name=='3')$p_active3="active";
?>

<div class="tabs">
    <!-- 탭 버튼 -->
    <div class="tab-buttons">
        <button class="tab-link <?php echo $p_active1;?>">Tab 1</button>
        <button class="tab-link <?php echo $p_active2;?>">Tab 2</button>
        <button class="tab-link <?php echo $p_active3;?>">Tab 3</button>
    </div>

    <!-- 탭 내용 -->
    <div class="tab-content">
    </div>
</div>
