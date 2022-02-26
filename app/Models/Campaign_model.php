<?php
 
namespace App\Models;
use CodeIgniter\Model;

class Campaign_model extends Model
{
  protected $table = 'campaign';
  protected $campaign_type = 'campaign_type';

  public function __construct(){
    $this->db = \Config\Database::connect();
  }

  // Campaign type
  public function listCampaignType(){
    $req = $this->db->table($this->campaign_type)
                        ->where(['status' => 1])
                        ->get()
                        ->getResultArray();
    
    return $req;
  }
  // End

  public function campaignByUrl($param){
    $get_data = $this->where('url', $param['url'])->first();
    return $get_data;
  } 
  
  public function createCampaign($param){
    $query = $this->db->table($this->table);
    $req = $query->insert($param);
    return $req;
  }

  public function campaignByUser($param){
      $sql = "select a.*, b.image from campaign a
              left join media b ON a.id = b.campaign
              where user = '".$param['user']."' and is_deleted = 0 
              order by created_at desc 
              limit ".$param['offset']." ,".$param['limit']."";
      $result = $this->db->query($sql)->getResultArray();
      return $result;
  }

  public function getListCampaign($param){
    $sql = "select a.*, b.image, c.username, d.name as full_name from campaign a
            left join media b ON a.id = b.campaign
            left join auth c ON a.user = c.user
            left join user d ON a.user = d.id
            where a.status = 'approved' 
            order by created_at desc 
            limit ".$param['offset']." ,".$param['limit']."";
    $result = $this->db->query($sql)->getResultArray();
    return $result;
  }

  public function statTotalCampaign(){
    $sql = "select count(id) as total_campaign from campaign a
            where a.status = 'approved'";
    $result = $this->db->query($sql)->getRowArray();
    return $result;
  }

  public function campaignDetailCampaign($param){
    $sql = "select a.*, b.image, c.username, d.name as full_name from campaign a
            left join media b ON a.id = b.campaign
            left join auth c ON a.user = c.user
            left join user d ON a.user = d.id
            where a.url = '".$param['url']."'";
    $result = $this->db->query($sql)->getRowArray();
    return $result;
  }
}