<?php

namespace App\Database;

use PDO;

class Connection
{
    /** @var string $dbname */
    private $dbname;
    /** @var string $username */
    private $username;
    /** @var string $password */
    private $password;
    /** @var string $host */
    private $host;
    /** @var int  $port */
    private $port;

   public function __construct()
   {
       $this->dbname = getenv('DB_NAME');
       $this->username = getenv('DB_USER');
       $this->password  = getenv('DB_PASSWORD');
       $this->host  = getenv('DB_HOST');
       $this->port  = getenv('DB_PORT');
   }

   /**
    * @return PDO
    */
   public function getPdo(): PDO
   {
       $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}";
       $pdo = new PDO($dsn, $this->username, $this->password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       return  $pdo;
   }

    /**
     * @return string
     */ 
    public function getDbname()
    {
        return $this->dbname;
    }

    /**
     * @return string
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     *  @return string
     */ 
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */ 
    public function getPort(): string
    {
        return $this->port;
    }
}
