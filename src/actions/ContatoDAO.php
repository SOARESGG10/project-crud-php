<?php

class ContatoDAO implements iDaoModeCrud 
{
    private $connectionPDO;
    private $table;

    public function __construct()
    {
        $this->connectionPDO = ConnectionPDO::getinstance();
        $this->table = "Contato";
    }

    public function create ($entitie) {
        $name = $entitie->getName();
        $email = $entitie->getEmail();
        $phone = $entitie->getPhone();

        $sqlStmt = "INSERT INTO $this->table (name, email, phone) VALUES (:name, :email, :phone)";
        $operation = $this->connectionPDO->prepare($sqlStmt);
        try {
            $operation->bindParam(":name", $name, PDO::PARAM_STR);
            $operation->bindParam(":email", $email, PDO::PARAM_STR);
            $operation->bindParam(":phone", $phone, PDO::PARAM_STR);

            if ($operation->execute()) {
                if ($operation->rowCount() > 0) {
                    $id = $this->connectionPDO->lastInsertId();
                    $entitie->setId($id);
                    return true;
                }
                return false;
            }

        } catch (PDOException $err) {
            echo $err->getMessage();
        }

    }
    public function read ($id=null) {

        $id !== null ? 
        $sqlStmt = "SELECT * FROM $this->table WHERE id = :id ORDER BY id DESC" :
        $sqlStmt = "SELECT * FROM $this->table ORDER BY id DESC";

        $operation = $this->connectionPDO->prepare($sqlStmt);
        
        try {
            
            if($id !== null):
                $operation->bindParam(":id", $id, PDO::PARAM_STR);
            endif;

            if ($operation->execute()) {
                if ($operation->rowCount() > 0) {
                    $id !== null ?
                        $result = $operation->fetch(PDO::FETCH_ASSOC) :
                        $result = $operation->fetchAll(PDO::FETCH_ASSOC);
                    
                    return $result;
                }
            }
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

    public function update ($entitie) {
        
        $id = $entitie->getId();
        $name = $entitie->getName();
        $email = $entitie->getEmail();
        $phone = $entitie->getPhone();

        $sqlStmt = "UPDATE $this->table SET name = :name, email = :email, phone = :phone WHERE id = :id";
        $operation = $this->connectionPDO->prepare($sqlStmt);

        try {

        $operation->bindParam(":id", $id, PDO::PARAM_INT);
        $operation->bindParam(":name", $name, PDO::PARAM_STR);
        $operation->bindParam(":email", $email, PDO::PARAM_STR);
        $operation->bindParam(":phone", $phone, PDO::PARAM_STR);

        if ($operation->execute()) {
            if ($operation->rowCount() > 0) {
                return true;
            }
            return false;
        } 
        return false;

        } catch (PDOException $err) {
            echo $err->getMessage();
        }

    }
    public function delete ($id) {
        $sqlStmt = "DELETE FROM $this->table WHERE id = :id";

        $operation = $this->connectionPDO->prepare($sqlStmt);

        try {
            $operation->bindParam(":id", $id, PDO::PARAM_INT);
            
            if ($operation->execute()) {

                if ($operation->rowCount() > 0) {
                    return true;
                }
                return false;
            }

        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
}   