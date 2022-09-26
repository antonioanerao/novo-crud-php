<?php

namespace Core\Database;
use Core\Databas\Connection;
use Exception;
use PDO;
use PDOStatement;

abstract class Model extends Connection
{
    private PDOStatement $query;
    
    private function prepExec($prep,$exec)
    {
        $this->query = $this->prepare($prep);
        $this->query->execute($exec);
    }
    
    public function selectAll($table)
    {
        $statement = $this->prepare("select * from {$table}");
        $statement->execute();
        
        return $statement->fetchAll(PDO::FETCH_CLASS);
        
    }

    public function select($campos,$tabela,$prep,$exec)
    {
        $this -> prepExec('SELECT '. $campos .' FROM '. $tabela .' '. $prep . ' ', $exec);
        return $this -> query;
    }

    public function update($tabela,$prep,$exec)
    {
        $this -> prepExec('UPDATE '.$tabela.' SET '. $prep .' ', $exec);
        return $this -> query;
    }
    
    public function insert($table, $parameters) {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ' , array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );
        
        try {
            $statement = $this->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
        return true;
    }

    public function delete($tabela,$prep,$exec)
    {
        $this -> prepExec('DELETE FROM '.$tabela.' '. $prep .' ', $exec);
        return $this -> query;
    }
    
    public function selectJoin($campos,$tabela,$prep,$exec)
    {
        $this -> prepExec('SELECT '. $campos .' FROM '. $tabela .' '. $prep .'', $exec);
        return $this -> query;
        //return $this -> query retornará o resultado da ação em um var_dump no objeto extanciado
    }
}
