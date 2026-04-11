<?php
class Registration {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($name, $birthdate, $topic, $materials, $format) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO masterclass_registrations (name, birthdate, topic, materials, format) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$name, $birthdate, $topic, $materials, $format]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM masterclass_registrations");
        return $stmt->fetchAll();
    }

    public function update($id, $name) {
        $stmt = $this->pdo->prepare("UPDATE masterclass_registrations SET name=? WHERE id=?");
        $stmt->execute([$name, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM masterclass_registrations WHERE id=?");
        $stmt->execute([$id]);
    }
}
