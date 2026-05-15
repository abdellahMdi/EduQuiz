<?php

require_once "../../config/Database.php";

class ResultRepository {

    private $conn;

    public function __construct() {

        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getResults() {

        $sql = "SELECT 
                    users.name,
                    results.score

                FROM results

                JOIN users
                ON users.id = results.student_id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
// utilisa afichage
<?php

require_once "../src/repositories/ResultRepository.php";


$resultRepo = new ResultRepository();

$results = $resultRepo->getResults();



?>