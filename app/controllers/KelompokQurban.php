<?php
class KelompokQurban extends Controller {

    // Menampilkan semua kelompok qurban
    public function index()
    {
        $data['judul'] = 'Kelompok Qurban';
        $data['kelompok'] = $this->model('KelompokQurban_model')->getAllKelompokQurban();
        $this->view('home_index/header', $data);
        $this->view('kelompok_qurban/index', $data);
        $this->view('home_index/footer');
    }

    // Menampilkan form tambah kelompok qurban
    public function tambah()
    {
        $data['judul'] = 'Tambah Kelompok Qurban';
        $this->view('home_index/header', $data);
        $this->view('kelompok_qurban/tambah', $data);
        $this->view('home_index/footer');
    }



    // Aksi menambah kelompok qurban
    public function aksi_tambah()
    {
        if (isset($_POST['jenis_hewan']) && isset($_POST['tahun']) && isset($_POST['nama_kelompok']) ) {
            $data = [
			    'nama_kelompok' => $_POST['nama_kelompok'],
                'jenis_hewan' => $_POST['jenis_hewan'],
                'tahun' => $_POST['tahun']
            ];

            if ($this->model('KelompokQurban_model')->tambahKelompokQurban($data)) {
                header('Location: ' . BASEURL . '/KelompokQurban');
                exit;
            } else {
                echo "Gagal menambah kelompok qurban.";
            }
        }
    }
	

	
	public function form_edit($id)
	{
		$data['judul'] = 'Detail Kelompok';
		$data['kelompok'] = $this->model('KelompokQurban_model')->ambilDataKelompok($id);
		$this->view('home_index/header', $data);
		$this->view('kelompok_qurban/edit', $data);
		$this->view('home_index/footer');
	}

  public function edit($id) {
        $data['title'] = 'Edit Kelompok Qurban';
        $data['kelompok'] = $this->model('KelompokQurban_model')->getKelompokById($id);
        $data['jumlah_donatur'] = $this->model('KelompokQurbanModel')->getJumlahDonaturByKelompok($id);
        
        $this->view('templates/header', $data);
        $this->view('kelompok/edit', $data); // <-- sesuaikan path view-nya
        $this->view('templates/footer');
    }

    public function edit_data() {
    $id = $_POST['id'];
    $nama_kelompok = $_POST['nama_kelompok'];
    $jenis_hewan_baru = $_POST['jenis_hewan'];

    // Ambil data sebelumnya
    $kelompokLama = $this->model('KelompokQurban_model')->getKelompokById($id);
	$total = $this->model('KelompokQurban_model')->getJumlahDonaturByKelompok($id);
    $jenis_hewan_lama = $kelompokLama['jenis_hewan'];

    // Jika jenis hewan diubah
    if ($jenis_hewan_lama != $jenis_hewan_baru && $total > 0) {
        // Hapus semua data qurban yang terkait
        $this->model('Qurban_model')->hapusByKelompokId($id);
    }

    // Update data kelompok
    $this->model('KelompokQurban_model')->updateDataKelompok([
        'id' => $id,
        'nama_kelompok' => $nama_kelompok,
        'jenis_hewan' => $jenis_hewan_baru
    ]);

    header('Location: ' . BASEURL . '/kelompokqurban');
    exit;
}



    // Menghapus kelompok qurban
 public function hapus($id)
{
    $model = $this->model('KelompokQurban_model');
    $kelompok = $model->getKelompokById($id);
$total = $this->model('KelompokQurban_model')->getJumlahDonaturByKelompok($id);

    if (!$kelompok) {
        die("Data dengan ID $id tidak ditemukan.");
    }
	
	if ($total > 0) {
        // Hapus semua data qurban yang terkait
        $this->model('Qurban_model')->hapusByKelompokId($id);
    }

    $model->hapusKelompokQurban($id);
    header('Location: ' . BASEURL . '/KelompokQurban');
    exit;
}



	
	



}
?>
