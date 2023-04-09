<h1 align="center">💡| Linguagem Técnica de Programação</h1>

-   ## 🐘 | PHP e MySQL :: CRUD – Create, Read, Update, Delete

### **Respostas:**

    1. Interface é o nome dado para o modo como ocorre a “comunicação” entre duas partes distintas e que não podem se conectar diretamente. Podemos definir como interface o contrato entre a classe e o mundo exterior, uma interface especifíca o que uma classe deve implementar.

### Exemplo

```php
interface iDaoModeCrud {

    public function create ($entitie);
    public function read ($id);
    public function update ($entitie);
    public function delete ($id);
}

/**
 * A classe ContatoDAO implementa a interface iDaoModeCrud.
 *
 * Caso algum dos métodos não for implementado, será gerado um erro.
*/

class ContatoDAO implements iDaoModeCrud {

    public function create ($entitie);
    public function read ($id);
    public function update ($entitie);
    public function delete ($id);
}
```

2. São pedaços individuais de código que definem métodos que, diferentes de classes, podm ser usados para fornecer funcionalidades adicionais. Este é um recurso introduzido no PHP 5.4.
   Os traits são muito semelhantes ás classes abastratas, mas com algumas diferenças que permitem que sejam usados por várias classes indepedentes ao mesmo tempo. Quando penso em traits, penso em um conjunto de ferramentas, como uma
   chave de fenda.

3. No bindParam() o argumento esperado deve ser uma referência (variável ou constante) e não pode ser um tipo primitivo (como uma string ou um inteiro). Já o bindValue() permite receber tanto as referências como de maneira "hardcoding".

### Exemplo

#### - **bindParam()**

```php
$stmt->bindParam(":id", 10); // Inválido
```

```php
$id = 10;
$stmt->bindParam(":id", $id); // Válido
```

#### - **bindValue()**

```php
$stmt->bindValue(":id", 10); // Válido
```

```php
$id = 10;
$stmt->bindValue(":id", $id); // Válido
```

4. Para a versão atual do PHP:

```php
spl_autoload_register(
    function ($className) {
    require $className.".php";
}
);
```

5.

```php

/**
 * Retirado a coluna "id" na instrução INSERT, com o auto incremento ativado não é necessário passar o valor da chave primária.
*/

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
```

## Observação:

-   É necessário criar o banco de dados e tabela para o realizamento do CRUD.

```sql
CREATE DATABASE Agenda;

USE Agenda;

CREATE TABLE Contato (
    id INT PRIMARY KEY,
    name VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    phone VARCHAR(15)
)
```

## 🔰 | Colaboradores:

-   Beatriz Natali
-   Matheus Rodrigues
-   Rafael Henrique
