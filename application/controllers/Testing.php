<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller {



    function index()
    {   
        /*$this->load->library('unit_test');

        $test = 1 + 1;

        $expected_result = 2;

        $test_name = 'Adds one plus one';

        $rpta_test = $this->unit->run($test, $expected_result, $test_name);

        echo $rpta_test;*/

        $this->load->driver('test');

        
    }


   

	

}
