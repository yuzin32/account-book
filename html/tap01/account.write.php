

<form action="account.call.php" method="POST">
    <table class="ac_write">
        <tbody>
            <tr>
                <th><label for="type">지출/수입:</label></th>
                <td>
                    <select name="type" id="account_type">
                        <option value="수입">수입</option>
                        <option value="지출">지출</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <th><label for="account_category_idx">지출 분야:</label></th>
                <td>
                    <select name="account_category_idx" id="account_category_idx">
                        <option value="식비">지출분야를 선택하세요</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="date">결제일:</label></th>
                <td><input type="date" name="date" id="date" required></td>
            </tr>

            <tr>
                <th><label for="title">내용:</label></th>
                <td><input type="text" name="title" id="title" placeholder="지출/수입 내용" required></td>
            </tr>
            
            <tr>
                <th><label for="price">금액:</label></th>
                <td><input type="number" name="price" id="price" placeholder="금액을 입력하세요" required></td>
            </tr>

            <tr>
                <th><label for="method">지출 수단:</label></th>
                <td>
                    <select name="method" id="method">
                        <option value="현금">결제수단을 선택하세요</option>
                    </select>
                </td>
            </tr>
			<tr>
                <th><label for="savings_yn">적금</label></th>
                <td><input type='checkbox' name='savings_yn' value></td>
                <td>
                    <select name="savings_idx" id="savings_idx">
                        <option value="현금">적금을 선택하세요</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><label for="memo">메모:</label></th>
                <td><textarea name="memo" id="memo" placeholder="메모를 입력하세요"></textarea></td>
            </tr>

        </tbody>
    </table>
    
    <!-- 제출 버튼 -->
    <button type="submit">저장</button>
	<a href="/account book/html/main/"> 홈으로 </a>
</form>

