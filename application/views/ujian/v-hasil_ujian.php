<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <div class="content mt-2">
    <div class="container-fluid">
      <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-sm">
          <div class="card">
            <div class="card-header bg-success">
              <h4 class="m-0"><?= $title; ?></h4>
            </div>

            <!-- Swall -->
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>" data-title="Data Rekap Ujian">
            </div>
            <div class="card-body">
              <!-- Add Data -->
              <div class="col mb-3">
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRekapUjian"><i class="fas fa-plus"></i> Tambah Data</button> -->
                <a href="<?= base_url('ujian/hasil_ujian/form_add'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
              </div>

              <table id="example2" class="table  table-striped text-center">
                <thead>
                  <tr>
                    <th style="width: 30px;">No</th>
                    <!-- <th style="width: 250px;">Target Ujian</th> -->
                    <th>Nama Santri</th>
                    <th>Kelas</th>
                    <th>Periode</th>
                    <th>Total Nilai</th>
                    <th>Rata-Rata</th>
                    <th>Reward</th>
                    <!-- <th>Rangking</th> -->
                    <!-- <th style="width: 200px;">Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($hasil_ujian as $hu) : ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $hu['NamaLengkap']; ?></td>
                      <td><?= $hu['NamaKelas']; ?></td>
                      <td><?= $hu['Periode']; ?></td>
                      <td><?= $hu['Total']; ?></td>
                      <td><?= $hu['Rata-rata']; ?></td>
                      <td><?= $hu['Reward']; ?></td>
                      <!-- <td><b><?= $ru['ket_rekap']; ?></b></td> -->
                      <!-- <td>
                        <a href="<?= base_url('ujian/rekap_ujian/form_update/' . $ru['IdUjian']); ?>" class="btn btn-success">Ubah</a>
                        <a href="<?= base_url('ujian/rekap_ujian/delete/' . $ru['IdUjian']); ?>" class="btn btn-danger ml-3 tombol-hapus" tipeData="Rekap Ujian" namaData=<?= $ru['NamaLengkap']; ?>>Hapus</a>
                      </td> -->
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

            </div>
          </div>

        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->