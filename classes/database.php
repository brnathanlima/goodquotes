<?php
class Database
{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = '123456';
    private $db_name = 'goodquotes';

    protected $dbh;
    protected $stmt;

    public function __construct()
    {
        try {            
            $this->dbh = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_user, $this->db_pass);
        } catch (Throwable $e) {
            echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
        }
    }

    public function query($query)
    {
        try {
            $this->stmt = $this->dbh->prepare($query);
        } catch (Throwable $e) {
            echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
        }
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        try {            
            $this->stmt->bindValue($param, $value, $type);
        } catch (\Throwable $th) {
            echo '<div class="alert alert-danger">'.get_class($th).' on line '.$th->getLine().' of '.$th->getFile().': '.$th->getMessage().'</div>';
        }
    }

    public function execute()
    {
        try {
            $this->stmt->execute();
        } catch (\Throwable $th) {
            echo '<div class="alert alert-danger">'.get_class($th).' on line '.$th->getLine().' of '.$th->getFile().': '.$th->getMessage().'</div>';
        }
    }

    public function resultSet()
    {
        try {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            echo '<div class="alert alert-danger">'.get_class($th).' on line '.$th->getLine().' of '.$th->getFile().': '.$th->getMessage().'</div>';
        }
    }

    public function lastInsertId()
    {
        try {
            return $this->dbh->lastInsertId();
        } catch (\Throwable $th) {
            echo '<div class="alert alert-danger">'.get_class($th).' on line '.$th->getLine().' of '.$th->getFile().': '.$th->getMessage().'</div>';
        }
    }

    public function single()
    {
        try {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            echo '<div class="alert alert-danger">'.get_class($th).' on line '.$th->getLine().' of '.$th->getFile().': '.$th->getMessage().'</div>';
        }
    }
}