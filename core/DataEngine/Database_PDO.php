<?php
namespace App\Core\DataEngine;


  class Database_PDO {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(string $dbengine){

        // Set DSN
        if ($dbengine == 'SQLite'){
            $this->dbh = new \PDO('sqlite:'.DB_FILE);
        }else{
            $dsn = $dbengine. ':host=' . $this->host . ';dbname=' . $this->dbname;
            $this->dbh = new \PDO($dsn, $this->user, $this->pass, $options);
        }

        try {
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->dbh->exec('set names utf8');
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            // echo $this->error;
        }
    }

    // Prepare statement with query
    public function query($sql){
      $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
    public function bind($param, $value, $type = null){
      if(is_null($type)){
        switch(true){
          case is_int($value):
            $type = \PDO::PARAM_INT;
            break;
          case is_bool($value):
            $type = \PDO::PARAM_BOOL;
            break;
          case is_null($value):
            $type = \PDO::PARAM_NULL;
            break;
          default:
            $type = \PDO::PARAM_STR;
        }
      }

      $this->stmt->bindParam($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute(){
      return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function getArray(){
      $this->execute();
      return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function getSingle(){
      $this->execute();
      return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

  }
