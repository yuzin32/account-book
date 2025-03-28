<?php
/*PDO와 MySQLi 중 다른 DB로의 변경이 더쉽다고 해서 PDO이용
. PDO를 사용하는 또 다른 이유는 준비 구문(Prepare Statements :bind)을 활용할 수 있기 때문이다.  준비 구문을 사용하면 SQL 인젝션 공격을 막을 수 있고, 애플리케이션의 성능이 향상된다.
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class MySQLPDOClass
{
	private $pdo;
    public function getPDOConnection() {
        if ($this->pdo === null) { // 연결이 없으면 새로 생성
            $dsn = "mysql:host=localhost;dbname=demoyujin;charset=utf8";
            $username = "demoyujin";
            $password = "dbwls3250!";
            try {
                $this->pdo = new PDO($dsn, $username, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Connected successfully\n";
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
function fetchAllRows($sql) {
    $pdo = $this->getPDOConnection();

    try {
        //echo "Executing SQL: $sql\n";
        $stmt = $pdo->query($sql);

        if (!$stmt) {
            $errorInfo = $pdo->errorInfo();
            die("Query Error: " . $errorInfo[2]); // MySQL 에러 메시지 출력
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

       /* if (empty($rows)) {
            echo "No rows found.\n";
        } else {
            print_r($rows);
        }*/

        return $rows;
    } catch (PDOException $e) {
        die("Error fetching rows: " . $e->getMessage());
    }
}
function fetchRow($sql) {
    $pdo = $this->getPDOConnection();

    try {
        //echo "Executing SQL: $sql\n";
        $stmt = $pdo->query($sql);

        if (!$stmt) {
            $errorInfo = $pdo->errorInfo();
            die("Query Error: " . $errorInfo[2]); // MySQL 에러 메시지 출력
        }

        // 한 행만 반환할 때는 fetch() 사용
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // 값이 없으면 0을 반환
        return $row ? $row : [0];
    } catch (PDOException $e) {
        die("Error fetching rows: " . $e->getMessage());
    }
}
	function insertRow($tableName, $data) {
		$pdo = $this->getPDOConnection();
		$columns = implode(', ', array_keys($data));//데이터 키를 열 이름으로, 값을 자리표시자로 변환.
		$placeholders = implode(', ', array_fill(0, count($data), '?'));
		$sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
		
		try {
			$stmt = $pdo->prepare($sql);// SQL문을 준비. 자리표시자를 사용하여 보안을 강화.
			$stmt->execute(array_values($data));//데이터를 바인딩하고 쿼리를 실행.
			return $sql; // 마지막 삽입된 ID 반환 $pdo->lastInsertId();
		} catch (PDOException $e) {
			die("Error inserting row: " . $e->getMessage());
		}
	}
	function updateRow($tableName, $data, $where) {
		$pdo = $this->getPDOConnection();
		$columns = implode(' = ?, ', array_keys($data)) . ' = ?';
		$sql = "UPDATE $tableName SET $columns WHERE $where";
		
		try {
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array_values($data));
			return  $sql;// 변경된 행 수 반환$stmt->rowCount();
		} catch (PDOException $e) {
			die("Error updating row: " . $e->getMessage());
		}
	}
	function deleteRow($tableName, $where) {
		$pdo = $this->getPDOConnection();
		$sql = "DELETE FROM $tableName WHERE $where";
		
		try {
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			return $sql;  // 삭제된 행 수 반환 $stmt->rowCount();
		} catch (PDOException $e) {
			die("Error deleting row: " . $e->getMessage());
		}
	}
}

/*
사용 예제
php
코드 복사
// SELECT 예제
$rows = fetchAllRows('users');
print_r($rows);

// INSERT 예제
$newUserId = insertRow('users', ['name' => 'John', 'email' => 'john@example.com']);
echo "New user ID: $newUserId";

// UPDATE 예제
$rowsUpdated = updateRow('users', ['email' => 'newemail@example.com'], 'id = 1');
echo "$rowsUpdated rows updated.";

// DELETE 예제
$rowsDeleted = deleteRow('users', 'id = 1');
echo "$rowsDeleted rows deleted.";
*/
?>