<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_kelompok extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    cek_login();
    $this->load->model('Detail_kelompok_M');
    $this->load->model('Santri_M');
    $this->load->model('Kelompok_M');
    $this->load->model('Musyrif_M');
  }

  // List all your items
  public function index($offset = 0)
  {
    $data = [
      'title'           => 'Detail Kelompok',
      'user'            => $this->db->get_where('login', ['username' => $this->session->userdata('username')])->row_array(),
      'detail_kelompok' => $this->Detail_kelompok_M->getAllDetailKelompok(),
      'siswa'           => $this->Santri_M->getAllSantri(),
      'kelompok'        => $this->Kelompok_M->getAllKelompok(),
      'musyrif'         => $this->Musyrif_M->getAllMusyrif(),
      'isi'             => 'halaqoh/v-detail_kelompok',
    ];

    $this->load->view('templates/wrapper-admin', $data);
  }

  // Add a new item
  public function add()
  {
    $data = [
      'IdKelompok' => $this->input->post('kelompok'),
      'IdSiswa' => $this->input->post('siswa'),
      'IdMusyrif' => $this->input->post('musyrif')
    ];
    $this->Detail_kelompok_M->addDetailKelompok($data);
    $this->session->set_flashdata('pesan', 'Berhasil ditambahkan!');
    redirect('halaqoh/detail_kelompok');
  }

  //Update one item
  public function update($id)
  {
    $data = [
      'IdDetailKelompok' => $id,
      'IdKelompok' => $this->input->post('kelompok'),
      'IdSiswa' => $this->input->post('siswa'),
      'IdMusyrif' => $this->input->post('musyrif')
    ];
    $this->Detail_kelompok_M->updateDetailKelompok($data);
    $this->session->set_flashdata('pesan', 'Berhasil diubah!');
    redirect('halaqoh/detail_kelompok');
  }

  //Delete one item
  public function delete($id)
  {
    $data = ['IdDetailKelompok' => $id];
    $this->Detail_kelompok_M->deleteDetailKelompok($data);
    $this->session->set_flashdata('pesan', 'Berhasil dihapus!');
    redirect('halaqoh/detail_kelompok');
  }
}

/* End of file Detail_kelompok.php */
