<?php
 
namespace App\Models;
use CodeIgniter\Model;

class Transaction_model extends Model
{
  protected $table = 'transaction';
  protected $disbursement_fund = 'disbursement_fund';

  public function __construct(){
    $this->db = \Config\Database::connect();
  }
  
  public function statDisbursementFund(){
    $sql = "select count(id) as total_disbursement from disbursement_fund a
            where a.status = 'approved'";
    $result = $this->db->query($sql)->getRowArray();
    return $result;
  }
}