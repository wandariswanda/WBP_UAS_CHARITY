<?php

namespace App\Controllers;
use CodeIgniter\Files\File;

use App\Models\Campaign_model;
use App\Models\Media_model;

class Campaign extends BaseController
{
    protected $campaignTypeSpec = [ 
        'campaign_type' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tipe program tidak boleh kosong'
            ]
        ]
    ];
    protected $nameSpec = [ 
        'name' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Judul tidak boleh kosong'
            ]
        ]
    ];
    protected $fundTargetSpec = [ 
        'fund_target' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Target donasi tidak boleh kosong'
            ]
        ]
    ];
    protected $endDateSpec = [ 
        'end_date' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Batas waktu penggalangan tidak boleh kosong'
            ]
        ]
    ];
    protected $urlSpec = [ 
        'url' => [
            'rules' => 'required|is_unique[campaign.url]',
            'errors' => [
                'required' => 'Link tidak boleh kosong',
                'is_unique' => 'Maaf link sudah ada, silahkan mengganti linknya'
            ]
        ]
    ];
    protected $descriptionSpec = [ 
        'description' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi tidak boleh kosong'
            ]
        ]
    ];
    protected $shortDescriptionSpec = [ 
        'short_description' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Ajakan tidak boleh kosong'
            ]
        ]
    ];

    public function __construct(){
        helper("util");
        $this->uuid = service('uuid')->uuid4();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        
        $this->campaign = new Campaign_model;
        $this->media = new Media_model;
    }

    public function index()
    {
        $hai = "Screenshot 2022-02-25 143000.png";
        $file_name 	= 'PRG-'.date('ydmhis').rand(10,99);
        $ext = pathinfo($hai, PATHINFO_EXTENSION);
        $cover_img = $file_name.".".$ext;
        dd($cover_img);
        $meta = $this->session->get('meta');
        dd(time());
        return view('welcome_message');
    }

    function getCampaignByNadzir(){
        $meta = $this->session->get('meta');
		$page =  $_GET['page'];
        
        $limit = 5;
        $offset = $limit*$page;
        $arrCampaign = [
            "limit" => $limit,
            "offset" => $offset,
            "user" => $meta['user_id']
        ];
        $getProgram = $this->campaign->campaignByUser($arrCampaign);
        
		foreach ($getProgram as $key => $value) {
            $start_date = time();
            $end_date = $value['end_date'];
			if ($start_date > $value['end_date']) {
				$interval_date	= "SELESAI";
			}else{
                $interval = $end_date - $start_date;
                $interval_date = round($interval / (60 * 60 * 24));
			}

			$persentase = round($value['fund_collected'] / $value['fund_target'] * 100);
			if ($persentase > 100) {
				$res_persentase = 100;
			}else{
				$res_persentase = $persentase;
			}

			// Condition Status
			if ($value['status'] == "waiting_for_confirmation") {
				$status = "Menunggu Konfirmasi";
				$color	= "bg-warning";
			}elseif ($value['status'] == "approved") {
				$status = "Approved";
				$color	= "bg-success";
			}else{
				$status = "Rejected";
				$color	= "bg-danger";
			}

			echo '<a href="'.base_url('dashboard/campaign/overview/'.$value['id']).'">
					<div class="col-md-5">
						<div class="xs-popular-item xs-box-shadow">
							<div class="xs-item-header">
							<span class="span-status '.$color.'">'.$status.'</span>
								<img src="'.base_url('assets/images/campaign/'.$value['image']).'" class="size-img-campaign img-fluid" alt="">
								<div class="xs-skill-bar">
									<div class="xs-skill-track"  style="width: '.$res_persentase.'%;">
										<p style="right: -24px;"><span class="number-percentage-count number-percentage" data-value="'.$res_persentase.'" data-animation-duration="3500">'.$res_persentase.'</span>%</p>
									</div>
								</div>
							</div>
							<div class="xs-item-content">
								<a href="'.base_url('dashboard/campaign/overview/'.$value['id']).'" class="xs-post-title xs-mb-30">'.$value['name'].'</a>
								<ul class="xs-list-with-content">
									<li  class="days-pos">Rp '.number_format($value['fund_collected'], 0, ",", ".").'<span>Dana Terkumpul</span></li>
									<li>'.$interval_date.'<span>Sisa Hari</span></li>
								</ul>
							</div>
						</div>
					</div>
				</a>';
		}

        exit;		
	}

    public function createCampaign(){
        // List campaign type
        $list_campaign_type = $this->campaign->listCampaignType();
        // End list campaign type

        $data = [
            "title" => "Yukamal - Buat Program",
            "head_slider" => "",
            "content" => "user/add-campaign",
            "title_dashboard" => "Program",
            "validation" => $this->validation,
            "list_campaign_type" => $list_campaign_type
        ];

        return view("layout", $data);
    }

    public function doCreateCampaign(){
        $meta = $this->session->get('meta');
        $post = $this->request->getPost();
        

        // validaton post fields
        if(!$this->validate(
            array_merge(
                $this->campaignTypeSpec, $this->nameSpec, $this->fundTargetSpec, $this->endDateSpec,
                $this->urlSpec, $this->descriptionSpec, $this->shortDescriptionSpec
            )
        )){
            $validation = $this->validation;
            return redirect()->to('/dashboard/campaign/add')->withInput()->with('validation', $validation);
        }
        // End validation

        // Create campaign
        $arrCampaign = [
            "id"   => $this->uuid->toString(),
            "user" => $meta['user_id'],
            "name" => $post["name"],
            "url" => $post['url'],
            "description" => $post['description'],
            "short_description" => $post['short_description'],
            "campaign_type" => $post['campaign_type'],
            "start_date" => time(),
            "end_date" => strtotime($post['end_date']),
            "fund_target" => $post['fund_target'],
            "operating_cost_id" => "",
            "created_at" => time()

        ];
        $this->campaign->createCampaign($arrCampaign);
        // End 

        // Create Media
        $file_cover = $this->request->getFile('cover_img');
        // Config file upload
        $file_name 	= 'PRG-'.date('ydmhis').rand(10,99);
        $ext = pathinfo($file_cover->getName(), PATHINFO_EXTENSION);
        $cover_img = $file_name.".".$ext;
        $upload_file = $file_cover->move('assets/images/campaign', $cover_img);
        
        $arrMedia = [
            "id"   => $this->uuid->toString(),
            "campaign" => $arrCampaign['id'],
            "image" => $cover_img,
            "created_at" => time()
        ];
        $this->media->createMedia($arrMedia);
        // End create media

        session()->setFlashData("success", 'Berhasil menambahkan program');
        return redirect()->to(base_url('/dashboard/campaign/add'));
    }

    public function campaignDetail($url){
        $arrCampaign = [ "url" => $url ];
        $campaign_info = $this->campaign->campaignDetailCampaign($arrCampaign);

        // Days left
        $start_date = time();
        $end_date = $campaign_info['end_date'];
        if ($start_date > $campaign_info['end_date']) {
            $interval_date	= "SELESAI";
        }else{
            $interval = $end_date - $start_date;
            $interval_date = round($interval / (60 * 60 * 24));
        }

        // Fund percentage
        $persentase = round($campaign_info['fund_collected'] / $campaign_info['fund_target'] * 100);
        if ($persentase > 100) {
            $res_persentase = 100;
        }else{
            $res_persentase = $persentase;
        }

        $info_campaign = array_merge($campaign_info, [ 
            "days_left" => $interval_date,
            "fund_percentage" => $res_persentase 
        ]);

        $data = [
            "title" => "Yukamal - nama program",
            "head_slider" => "",
            "content" => "campaign/campaign-detail",
            "campaign" => $info_campaign,
            // "validation" => $this->validation
        ];

        return view("layout", $data);        
    }

    public function contribution($url){
        $arrCampaign = [ "url" => $url ];
        $campaign_info = $this->campaign->campaignDetailCampaign($arrCampaign);

        $data = [
            "title" => "Yukamal - Contribute",
            "head_slider" => "",
            "content" => "transaction/contribute",
            "validation" => $this->validation,
            "campaign" => $campaign_info
        ];

        return view("layout", $data);
    }

    public function contributePayment(){
        $meta = $this->session->get('meta');
        $post = $this->request->getPost();
        dd($post);

        // $arrCampaign = [
        //     "id"   => $this->uuid->toString(),
        //     "user" => $meta['user_id'],
        //     "name" => $post["name"],
        //     "url" => $post['url'],
        //     "description" => $post['description'],
        //     "short_description" => $post['short_description'],
        //     "campaign_type" => $post['campaign_type'],
        //     "start_date" => time(),
        //     "end_date" => strtotime($post['end_date']),
        //     "fund_target" => $post['fund_target'],
        //     "operating_cost_id" => "",
        //     "created_at" => time()

        //     id
        //     campaign
        //     user
        //     amount
        //     unique_code
        //     total
        //     bank
        //     notes
        //     status
        //     expired_at
        //     created_at
        //     updated_at

        // ];
    }
}
