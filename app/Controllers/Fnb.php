<?php

namespace App\Controllers;

use App\Models\Modelfnb;
use CodeIgniter\RESTful\ResourceController;

class Fnb extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $modelMhs = new Modelfnb();
        $data = $modelMhs->findAll();
        $response = [
        'status' => 200,
        'error' => "false",
        'message' => '',
        'totaldata' => count($data),
        'data' => $data,
        ];
        return $this->respond($response, 200);

    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($cari = null)
    {
        $modelMhs = new Modelfnb();
        $data = $modelMhs->orLike('id', $cari)
        ->orLike('namafnb', $cari)->get()->getResult();
        if(count($data) > 1) {
        $response = [
        'status' => 200,
        'error' => "false",
        'message' => '',
        'totaldata' => count($data),
        'data' => $data,
        ];
        return $this->respond($response, 200);
        }else if(count($data) == 1) {
        $response = [
        'status' => 200,
        'error' => "false",
        'message' => '',
        'totaldata' => count($data),
        'data' => $data,
        ];
        return $this->respond($response, 200);
        }else {
        return $this->failNotFound('maaf data ' . $cari . 
        ' tidak ditemukan');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $modelMhs = new Modelfnb();
        $id = $this->request->getPost("id");
        $namafnb = $this->request->getPost("namafnb");
        $hargafnb = $this->request->getPost("hargafnb");
        $jumlahfnb = $this->request->getPost("jumlahfnb");
        $jenisfnb = $this->request->getPost("jenisfnb");
        $validation = \Config\Services::validation();
        $valid = $this->validate([
        'id' => [
        'rules' => 'is_unique[fnb.id]',
        'label' => 'AIDI',
        'errors' => [
            'is_unique' => "{field} sudah ada"
            ]
            ]
        ]);
        if(!$valid){
            $response = [
            'status' => 404,
            'error' => true,
            'message' => $validation->getError("id"),
            ];
            return $this->respond($response, 404);
        }else {
            $modelMhs->insert([
            'id' => $id,
            'namafnb' => $namafnb,
            'hargafnb' => $hargafnb,
            'jumlahfnb' => $jumlahfnb,
            'jenisfnb' => $jenisfnb,
            ]);
            $response = [
            'status' => 201,
            'error' => "false",
            'message' => "Data berhasil disimpan"
            ];
            return $this->respond($response, 201);
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $model = new Modelfnb();
        $data = [
        'namafnb' => $this->request->getVar("namafnb"),
        'hargafnb' => $this->request->getVar("hargafnb"),
        'jumlahfnb' => $this->request->getVar("jumlahfnb"),
        'jenisfnb' => $this->request->getVar("jenisfnb"),
        ];
        $data = $this->request->getRawInput();
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'message' => "Data Anda dengan ID $id berhasil dibaharukan"
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $modelMhs = new Modelfnb();
        $cekData = $modelMhs->find($id);
        if($cekData) {
            $modelMhs->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => "Selamat data sudah berhasil dihapus maksimal"
            ];
            return $this->respondDeleted($response);
        }else {
            return $this->failNotFound('Data tidak ditemukan kembali');
        }

    }
}
