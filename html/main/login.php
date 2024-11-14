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
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }
        main {
            margin: 20px;
        }
        footer {
            background-color: #333;
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

	<header>
		<h1>로그인</h1>
	</header>

	<main>
		<form method="POST" name='login' action='login_call.php'>
			<input type='password' name='password'>
			 <button type="submit">로그인</button>
		</form>
	</main>

	<footer>
		<p>&copy; 2024 Your Website. All rights reserved.</p>
	</footer>

</body>
</html>
