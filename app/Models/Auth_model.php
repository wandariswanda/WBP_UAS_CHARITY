<?php
 
namespace App\Models;
use CodeIgniter\Model;

class Auth_model extends Model
{
  protected $table = 'auth';

  public function __construct(){
    $this->db = \Config\Database::connect();
  }

  public function getUser($usernameOrEmail){
    // $get_data = $this->db->where('username', $usernameOrEmail)->first();
    // return $get_data;
    $sql = "select * from auth a
            where a.username = '".$usernameOrEmail['username']."'";
    $result = $this->db->query($sql)->getRowArray();
    return $result;
  }
  
  public function statUser(){
    $sql = "select count(id) as total_user from auth a
            where a.role = 'user'";
    $result = $this->db->query($sql)->getRowArray();
    return $result;
  }


}