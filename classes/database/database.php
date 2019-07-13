<?php


class database implements databaseHelpers
{
    protected $connection;
    private  $dbType="mysql";
    private $dbHost="localhost";
    private  $dbName="Blogging";
    private  $dbUser="root";
    private  $dbPass="";
    private  $dbOptions=[PDO::MYSQL_ATTR_INIT_COMMAND=>"set Names utf8"];
    public function __construct()
    {
        try{
            $connect= new PDO("{$this->dbType}:host={$this->dbHost};dbname={$this->dbName}", $this->dbUser, $this->dbPass,$this->dbOptions);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection = $connect;
        }catch (PDOException $PDOException)
        {
            throw $PDOException;
        }
    }
    public function getData(string $query, array $parameters = [])
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($parameters);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    public function getDataAsObject(string $query, array $parameters = [])
    {
      return globals::toObject($this->getData($query,$parameters)) ;
    }
    public function setData(string $query, array $parameters = [])
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($parameters);
        $count = $stmt->rowCount();
        return $count;
    }
}