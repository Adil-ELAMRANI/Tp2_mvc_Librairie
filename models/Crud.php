<?php
// ModelClient.php
// Gestion des clients

namespace App\Models;

use PDO;
use PDOException;

abstract class Crud extends PDO {
    protected $table;
    protected $primaryKey = 'id';
    protected $fillable = [];

    final public function __construct() {
        try {
            parent::__construct('mysql:host=localhost; dbname=librairie; port=3306; charset=utf8', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }


    final public function select($field = null, $order = 'ASC')
    {
        if ($field == null) {
            $field = $this->primaryKey;
        }
        $sql = "SELECT * FROM $this->table ORDER BY $field $order";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    final public function selectId($value)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    final public function insert($data)
    {
        $data_keys = array_fill_keys($this->fillable, '');
        $data = array_intersect_key($data, $data_keys);

        $fieldName = implode(', ', array_keys($data));
        $fieldValue = ":" . implode(', :', array_keys($data));
        $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldValue);";

        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        if ($stmt->execute()) {
            return $this->lastInsertId();
        } else {
            return false;
        }
    }

    final public function update($data, $id)
    {
        if ($this->selectId($id)) {
            $data_keys = array_fill_keys($this->fillable, '');
            $data = array_intersect_key($data, $data_keys);

            $fieldName = null;
            foreach ($data as $key => $value) {
                $fieldName .= "$key = :$key, ";
            }
            $fieldName = rtrim($fieldName, ', ');
            $sql = "UPDATE $this->table SET $fieldName WHERE $this->primaryKey = :$this->primaryKey";
            $data[$this->primaryKey] = $id;

            $stmt = $this->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            return $stmt->execute();
        }
        return false;
    }

    final public function delete($value)
    {
        if ($this->selectId($value)) {
            $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(":$this->primaryKey", $value);
            return $stmt->execute();
        }
        return false;
    }
}
