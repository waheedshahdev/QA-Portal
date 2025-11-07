<?php
class Templates extends MX_Controller 
{

    public function test()
    {
        $data="";
        $this->admin($data);
    }


    public function public_bootstrap($data)
    {
        $this->load->view('public_bootstrap' ,$data);
    }

    public function admin($data)
    {
        
        $this->load->view("admin",$data);
    }

    public function home($data)
    {
        
        $this->load->view("home",$data);
    }




}