<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            "title" => "Dashboard",
            "head_slider" => "",
            "content" => "user/dashboard",
            "title_dashboard" => "Overview"
            // "validation" => $this->validation
        ];

        return view("layout", $data);
    }

    public function campaign(){
        $data = [
            "title" => "Yukamal - Program",
            "head_slider" => "",
            "content" => "user/list_campaign",
            "title_dashboard" => "Program"
            // "validation" => $this->validation
        ];

        return view("layout", $data);
    }
}
