<?php

namespace App\Controllers;
use App\Models\Campaign_model;
use App\Models\Auth_model;
use App\Models\Transaction_model;

class Home extends BaseController
{
    public function __construct(){
        $this->campaign = new Campaign_model;
        $this->auth = new Auth_model;
        $this->transaction = new Transaction_model;
    }

    public function index()
    {
        // Stats
        $stat_good_people = $this->auth->statUser(); // total user
        $stat_campaign = $this->campaign->statTotalCampaign(); // total campaign active
        $stat_disbursement_fund = $this->transaction->statDisbursementFund();

        $dashboard_stats = [
            "total_user" => $stat_good_people['total_user'],
            "total_campaign" => $stat_campaign['total_campaign'],
            "total_disbursement" => $stat_disbursement_fund['total_disbursement']
        ];

        // dd($dashboard_stats);
        // End stats
        
        // List campaign
        $arrCampaign = [
            "limit" => 12,
            "offset" => 0
        ];
        $get_campaign = $this->campaign->getListCampaign($arrCampaign);
        $list_campaign = array_map(function($value){
            // Days left
            $start_date = time();
            $end_date = $value['end_date'];
			if ($start_date > $value['end_date']) {
				$interval_date	= "SELESAI";
			}else{
                $interval = $end_date - $start_date;
                $interval_date = round($interval / (60 * 60 * 24));
			}

            // Fund percentage
            $persentase = round($value['fund_collected'] / $value['fund_target'] * 100);
			if ($persentase > 100) {
				$res_persentase = 100;
			}else{
				$res_persentase = $persentase;
			}


            $value['days_left'] = $interval_date;
            $value['fund_percentage'] = $res_persentase;
            return $value;
        }, $get_campaign);
        // dd($list_campaign);
        // End list campaign

        $data = [
            "title" => "Yuk Amal",
            "head_slider" => true,
            "content" => "index",
            "list_campaign" => $list_campaign,
            "stats" => $dashboard_stats
        ];

        return view("layout", $data);
        // return view('welcome_message');
    }
}
