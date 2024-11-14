<?$day = isset($_GET['day']) ? $_GET['day'] : null;?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>지출/수입 입력 폼</title>
    <style>
        /* 전체 배경 색상 */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 20px;
        }

        /* 테이블 스타일 */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* 테이블 헤더 스타일 */
        thead {
            background-color: #50bcdf;
            color: #ffffff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            font-weight: bold;
            width: 20%;
            background-color: #e6f5fc;
        }

        /* 테두리 스타일 */
        th, td {
            border-bottom: 1px solid #dddddd;
        }

        /* 행 호버 효과 */
        tbody tr:hover {
            background-color: #c6e9f5;
        }
    </style>
</head>
<body>

<h2><?php echo $day;?>일 지출/수입 입력 폼 </h2>
<form action="process_form.php" method="POST">
    <table>
        <tbody>
            <tr>
                <th><label for="type">지출/수입:</label></th>
                <td>
                    <select name="type" id="type">
                        <option value="수입">수입</option>
                        <option value="지출">지출</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <th><label for="date">결제일:</label></th>
                <td><input type="date" name="date" id="date" required></td>
            </tr>

            <tr>
                <th><label for="description">내용:</label></th>
                <td><input type="text" name="description" id="description" placeholder="지출/수입 내용" required></td>
            </tr>
            
            <tr>
                <th><label for="amount">금액:</label></th>
                <td><input type="number" name="amount" id="amount" placeholder="금액을 입력하세요" required></td>
            </tr>

            <tr>
                <th><label for="memo">메모:</label></th>
                <td><textarea name="memo" id="memo" placeholder="메모를 입력하세요"></textarea></td>
            </tr>

            <tr>
                <th><label for="method">지출 수단:</label></th>
                <td>
                    <select name="method" id="method">
                        <option value="현금">현금</option>
                        <option value="카드">카드</option>
                        <option value="이체">이체</option>
                        <option value="기타">기타</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><label for="category">지출 분야:</label></th>
                <td>
                    <select name="category" id="category">
                        <option value="식비">식비</option>
                        <option value="교통비">교통비</option>
                        <option value="문화/여가">문화/여가</option>
                        <option value="쇼핑">쇼핑</option>
                        <option value="건강">건강</option>
                        <option value="기타">기타</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    
    <!-- 제출 버튼 -->
    <button type="submit">저장</button>
	<a href="/account book/html/main/"> 홈으로 </a>
</form>

</body>
</html>
