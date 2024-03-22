<?php

namespace App\Repository;

use App\Database\Database;
use App\Model\Client;
use PDO;

class ClientRepository {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function create(Client $client) {
        $name=$client->getName();
        $email=$client->getEmail();
        $city=$client->getCity();
        $state=$client->getState();

        $query = "INSERT INTO cliente (nome, email, cidade, estado) VALUES (:nome, :email, :cidade, :estado)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cidade", $city);
        $stmt->bindParam(":estado", $state);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM cliente";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(Client $client) {
        $id = $client->getId();
        $query = "SELECT * FROM cliente WHERE cliente_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id , PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(Client $client) {
        $id=$client->getId();
        $name=$client->getName();
        $email=$client->getEmail();
        $city=$client->getCity();
        $state=$client->getState();

        $query = "UPDATE cliente SET nome = :nome, email = :email, cidade = :cidade, estado = :estado WHERE cliente_id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cidade", $city);
        $stmt->bindParam(":estado", $state);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete(Client $client) {
        $id = $client->getId();
        $query = "DELETE FROM cliente WHERE cliente_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id , PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}