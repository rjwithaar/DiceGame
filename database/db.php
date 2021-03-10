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

    /**
     * Function to insert a record to the database
     * @param string $table name of the table to insert record
     * @param string $columns name of columns to insert record
     * @param string $values data to insert
     * @return bool true on success
     */
    public function Create($table, $columns,$values)
    {
        $query = sprintf('INSERT INTO %1$s (%2$s) VALUES (%3$s)', $table, $columns, $values);
        $sth = $this->db->prepare($query);
        $sth->execute();
        return true;
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

    /**
     * Function to Update database records
     * @param string $table name of the table to read
     * @param string $set colums and values to set
     * @param string $where filter rows with where; default 1
     * @return bool true on succes
     */
    public function Update($table, $set, $where = '1')
    {
        $query = sprintf('UPDATE %1$s SET %2$s WHERE %3$s', $table, $set, $where);
        $sth = $this->db->prepare($query);
        $sth->execute();
        return true;
    }

    /**
     * Function to Delete database records
     * @param string $table name of the table to read
     * @param string $where filter rows to delete
     * @return bool true on success
     */
    public function Delete($table, $where)
    {
        $query = sprintf('DELETE FROM %1$s WHERE %2$s', $table, $where);
        $sth = $this->db->prepare($query);
        $sth->execute();
        return true;
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
