<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backupeando extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Backupeando';//Siempre define las migagas de pan
        $this->load->library('grocery_CRUD');
    }


    public function download_bkp($clave = 'fails' )
    {  
        if($clave!='admin6'){
            die('Error establishing a database connection ...');
        }

        // Load the DB utility class
        $this->load->dbutil();
        
        $prefs = array(
        'format'        => 'txt',                       // gzip, zip, txt
        'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
        'newline'       => "\n"                         // Newline character used in backup file
        );

        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('mybackup.zip', $backup);
        
    }

	

}
