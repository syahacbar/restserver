<?php

require APPPATH . '/libraries/REST_Controller.php';
Class Pendaftar Extends REST_Controller{
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('Pendaftar_model', 'pendaftar');
    }
    
    // untuk menampilkan data
    function index_get(){
        $id = $this->get('id');

        if ($id === NULL)
        {
            $pendaftar = $this->pendaftar->getPendaftar();
        } 
        else 
        {
            $pendaftar = $this->pendaftar->getPendaftar($id);
        }

        if ($pendaftar) 
        {
            $this->response($pendaftar, REST_Controller::HTTP_OK);
        } 
        else 
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Data pendaftar tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'status' => $this->put('status')
        ];

        if ($this->pendaftar->updatePendaftar($data,$id) > 0)
        {
            $this->response($data,200); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengubah data pendaftar'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }
    
    
}
?>
