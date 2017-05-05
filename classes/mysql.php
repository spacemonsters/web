<?php
/**
 * Created by PhpStorm.
 * User: Martti
 * Date: 5.04.2017
 * Time: 10:42
 */
class mysql
{ // klassi algus
    // klassi omadused
    var $conn = false; // ühendus andmebaasi serveriga
    var $host = false; // serveri host
    var $user = false; // serveri kasutaja
    var $pass = false; // serveri parool
    var $dbname = false; // serveri andmebaas
    // klassi tegevused
    function __construct($h, $u, $p, $dn){
        $this->host = $h;
        $this->user = $u;
        $this->pass = $p;
        $this->dbname = $dn;
        $this->connect();
    }// konstruktor
    function connect(){
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        if(mysqli_connect_error()){
            echo 'Viga andmebaasiserveriga ühenduses<br />';
            exit;
        }
    }// connect
    // päringu teostamine
    function query($sql){
        $res = mysqli_query($this->conn, $sql);
        if($res == false){
            echo 'Viga päringus!<br />';
            echo '<b>'.$sql.'</b><br />';
            echo mysqli_error($this->conn).'<br />';
            exit;
        }
        return $res;
    }// query
    // andmetega päringu teostamine
    function getArray($sql){
        $res = $this->query($sql);
        $data = array();
        while($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        if(count($data) == 0){
            return false;
        }
        return $data;
    }// getArray
} // klassi lõpp
?>