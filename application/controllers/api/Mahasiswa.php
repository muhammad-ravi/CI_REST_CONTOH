<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController {

    public function index_get(){
        $id = $this->get('id');
        if($id == ''){
            $mahasiswa = $this->mahasiswa_model->getMahasiswa();
        }else{
            $mahasiswa = $this->mahasiswa_model->getMahasiswa($id);
        }
        if($mahasiswa){
            $this->response([
                'status' => true,
                'data' => $mahasiswa
            ], 200);
        }else{
            $this->response([
                'status' => false,
                'data' => 'id not found'
            ], 404);
        }    
    }

    public function index_delete(){
        $id = $this->delete('id');
        if($id == ''){
            $this->response([
                'status' => false,
                'data' => 'id not found'
            ], 404);
        }else{
            if($this->mahasiswa_model->deleteMahasiswa($id) > 0){
                // OK
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'data' => 'Delete data success'
                ], 200);
            }else{
                // Id Not Found
                $this->response([
                    'status' => false,
                    'data' => 'Id Not Found'
                ], 404);
            }
        }
    }

    public function index_post(){
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        ];

        if($this->mahasiswa_model->createMahasiswa($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'New mahasiswa has been created'
            ], 201);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed to create data'
            ], 304);
        }
    }

    public function index_put(){
        $id = $this->put('id');
        $data = [
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan')
        ];
        if($this->mahasiswa_model->updateMahasiswa($data, $id) > 0){
            $this->response([
                'status' => true,
                'message' => 'New mahasiswa has been updated'
            ], 201);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], 304);
        }
    }
}