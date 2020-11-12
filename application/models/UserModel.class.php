<?php
class UserModel extends Model{
    
    public function getUsers()
    {
        $sql = "SELECT * FROM $this->table";
        $user = $this->db->getAll($sql);
        return $user;
    }
}