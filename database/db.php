<?php

class DB
{
    private $db;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'root';
    private $name = 'DiceGame';

    public function __construct()
    {
        try {
            $this->db = new PDO(sprintf("mysql:host=%s;dbname=%s", $this->host, $this->name), $this->user, $this->pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function Create()
    {

    }

    /**
     * Function to read a table from the database
     * @param string $table name of the table to read
     * @param string $columns name of columns to select; default *
     * @param string $where filter rows with where; default 1
     * @return array a list of all rows of re selected table
     */
    public function Read($table, $columns = '*', $where = '1')
    {
        $rows = [];
        $query = sprintf('SELECT %2$s FROM `%1$s` WHERE %3$s', $table, $columns, $where);

        $sth = $this->db->prepare($query);
        $sth->execute();

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function Update()
    {

    }

    public function Delete()
    {

    }

    public function getUsers()
    {
        $rows = [];
        $query = 'SELECT * FROM `users`';

        $sth = $this->db->prepare($query);
        $sth->execute();

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }

        echo '<pre>';
        var_dump($rows);
        echo '</pre>';
    }
}

$db = new DB();
