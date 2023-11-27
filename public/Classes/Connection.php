<?php

class Connection {
    private $host;
    private $port;
    private $database;
    private $user;
    private $password;
    private $pdo;

    public function __construct($host, $port, $database, $user, $password) {
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
        $this->connect();
    }

    private function connect() {
        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->database}";
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }

    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Erro na consulta SQL: " . $e->getMessage());
        }
    }

    // Exemplo de uso
    // $connection = new Connection('localhost', '8004', 'db', 'root', 'secret');
    // $pdo = $connection->getPdo();

    // // Exemplo de consulta usando o novo método
    // $sql = 'SELECT * FROM sua_tabela WHERE id = :id';
    // $params = [':id' => 1];

    // $stmt = $connection->query($sql, $params);

    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //     print_r($row);
    // }

}

?>
