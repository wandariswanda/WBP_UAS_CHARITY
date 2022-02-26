<?php
 
namespace App\Models;
use CodeIgniter\Model;

class Media_model extends Model
{
  protected $table = 'media';

  public function __construct(){
    $this->db = \Config\Database::connect();
  }
  
  public function createMedia($param){
    $query = $this->db->table($this->table);
    $req = $query->insert($param);
    return $req;
  }
}