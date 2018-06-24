<?php
    require("../../config/database.php");
    class fcm{
        private $db;

        public function __construct($database){
            $this->db = $database;
        }

        //Menampilkan token berdasarkan username
        public function showToken($username){
          $sql = "SELECT token FROM tb_user WHERE username='$username'";
          $query = $this->db->query($sql);
          return $query;
        }

        //Register Token dari HP ke Database
        public function regisToken($token, $username){
            //$sql = "INSERT INTO users(Token, username) Values ('$token', '$username') ON DUPLICATE KEY UPDATE Token = '$token' ; ";
            $sql = "UPDATE tb_user SET token='$token' WHERE username='$username'";
            $query = $this->db->query($sql);
            if(!$query){
                return "Failed";
            }else{
                return "Success";
            }
        }

        //View token by username
        public function cekToken($username){
            $sql = "SELECT token FROM tb_user WHERE username='$username'";
            $query = $this->db->query($sql);
            return $query;
        }

        //Push notifikasi ke HP
        public function send_notification($tokens, $message){
           $url = 'https://fcm.googleapis.com/fcm/send';

           $msg = array(
             'body' => "$message",
             'title' => "Cozzal Notification"
           );

           $fields = array(
             'registration_ids' => $tokens,
             'notification' => $msg
           );

           $headers = array(
             'Authorization:key = AIzaSyDfckQkrj7GdgV4X75Zhe0eyjoTqPXsjyk',
             'Content-Type: application/json'
           );

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
           curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
           $result = curl_exec($ch);
           if ($result === FALSE) {
             die('Curl failed: ' . curl_error($ch));
           }
           curl_close($ch);
           return $result;
        }
    }
?>
