<?php
class Login {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function loginuser($username, $password) {
     $result = $this->db->prepare("SELECT * FROM tb_user WHERE username= ? AND password= ?");
        $result->bindParam(1, $username);
        $result->bindParam(2, $password);
        $result->execute();
        $rows = $result->fetch();
        return $rows;
    }
}
?>
