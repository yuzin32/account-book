<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>기본 HTML 템플릿</title>
    <style>
        /* 기본 스타일 */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #f4f4f4;
            color: #fff;
            padding: 1em;
            text-align: center;
        }
        main {
            margin: 20px;
        }
        footer {
            background-color:#f4f4f4;
            color: #fff;
            padding: 1em;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>


	<main>
	 <? 
	 include "calender.php"; ?>
	</main>


</body>


</html>
