<?php
defined('BASEPATH') or exit('No direct script access allowed');
// panggil autoload Spout
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

// Pakai reader Spout
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Musyrif extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    cek_login();
    $this->load->model('Musyrif_M');
  }

  // List all your items
  public function index()
  {
    $data = [
      'title' => 'Data Musyrif',
      'user' => $this->db->get_where('login', ['username' => $this->session->userdata('username')])->row_array(),
      'musyrif' => $this->Musyrif_M->getAllMusyrif(),
      'isi' => 'musyrif/index',
    ];

    $this->load->view('templates/wrapper-admin', $data);
  }

  // Add a new item
  public function add()
  {
    $data = [
      'NamaMusyrif' => $this->input->post('nama_musyrif'),
      'Email' => $this->input->post('email'),
      'NoHp' => $this->input->post('no_hp'),
    ];
    $this->Musyrif_M->addMusyrif($data);
    $this->session->set_flashdata('pesan', 'Berhasil ditambahkan!');
    redirect('musyrif');
  }

  //Update one item
  public function update($id)
  {
    $data = [
      'IdMusyrif' => $id,
      'NamaMusyrif' => $this->input->post('nama_musyrif'),
      'Email' => $this->input->post('email'),
      'NoHp' => $this->input->post('no_hp'),
    ];
    $this->Musyrif_M->updateMusyrif($data);
    $this->session->set_flashdata('pesan', 'Berhasil diubah!');
    redirect('musyrif');
  }

  //Delete one item
  public function delete($id)
  {
    $data = ['IdMusyrif' => $id];
    $this->Musyrif_M->deleteMusyrif($data);
    $this->session->set_flashdata('pesan', 'Berhasil dihapus!');
    redirect('musyrif');
  }

  public function import()
  {
    $config['upload_path']    = './assets/upload/musyrif/';
    $config['allowed_types']  = 'xls|xlsx';
    $config['file_name']       = 'data musyrif ' . time();
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('importMusyrif')) {
      $file = $this->upload->data();
      $reader = ReaderEntityFactory::createXLSXReader();

      // Baca file excel yang diupload
      $reader->open('./assets/upload/musyrif/' . $file['file_name']);
      $save = array();
      foreach ($reader->getSheetIterator() as $sheets) {
        $numRow = 1;
        // Looping row dalam sheet
        foreach ($sheets->getRowIterator() as $row) {
          if ($numRow > 1) {
            $dataSiswa = array(
              'NamaMusyrif' => $row->getCellAtIndex(1),
              'Email'       => $row->getCellAtIndex(2),
              'NoHp'        => $row->getCellAtIndex(3),
            );
            array_push($save, $dataSiswa);
          }
          $numRow++;
        }
        $reader->close();
        $this->Musyrif_M->importMusyrif($save);
        $this->session->set_flashdata('pesan', 'Berhasil diimport!');
        redirect('musyrif');
      }
    } else {
      echo "Errors : " . $this->upload->display_errors();
    }
  }

  public function export()
  {
    $tipeFile = $this->input->post('tipeFile');
    if ($tipeFile == "pdf") {
      $this->export_pdf();
    } elseif ($tipeFile == 'xls') {
      $this->export_xls();
    } else {
      $this->export_xlsx();
    }
  }

  public function export_pdf()
  {
    $mpdf = new \Mpdf\Mpdf();
    $namafile = 'Data Musyrif.pdf';
    $dataMusyrif = $this->Musyrif_M->getAllMusyrif();
    $tampilan = $this->load->view('export/pdf/musyrif', ['musyrif' => $dataMusyrif], TRUE);
    $mpdf->WriteHTML($tampilan);
    $mpdf->Output($namafile, "D");
  }

  public function export_xls()
  {
    echo "Export XLS";
  }

  public function export_xlsx()
  {
    echo "Export XLSX";
  }
}

/* End of file Musyrif.php */
