<?php
class user_service{
    var $db;
    function __construct($d){ $this->db=$d; }
    function GetUser($id){
        $r=$this->db->query("SELECT * FROM users WHERE id=".$id);
        if($r){ return $r->fetch(); } else { return false; }
    }
    function show($u){ echo "<h1>".$u['name']."</h1>"; }
}
?>