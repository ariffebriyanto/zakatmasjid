<?php
class Donatur extends Controller {
	public function index()
	{
		$data['judul'] = 'Data Donatur';
		$data['donatur'] = $this->model('Donatur_model')->getAllDonatur();
		$this->view('home_index/header', $data);
		$this->view('donatur/index', $data);
		$this->view('home_index/footer');
	}

	public function tambah()
	{
		$data['judul'] = 'Tambah Donatur';
		$this->view('home_index/header', $data);
		$this->view('donatur/tambah', $data);
		$this->view('home_index/footer');
	}

public function aksi_tambah() {
    $data = [
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat'],
        'handphone' => $_POST['handphone'],
        'jenis_qurban' => $_POST['jenis_qurban']
    ];

    $jenis_qurban = $_POST['jenis_qurban'];

    // Validasi jenis_qurban
    $valid_jenis = ['kambing', 'sapi', 'sapi patungan'];
    if (!in_array($jenis_qurban, $valid_jenis)) {
        echo "<script>alert('Jenis qurban tidak valid!');window.location.href='" . BASEURL . "/Donatur/tambah';</script>";
        exit;
    }

    // Tentukan jenis hewan (untuk kelompok_qurban)
    $jenis_hewan = ($jenis_qurban === 'kambing') ? 'kambing' : 'sapi';

    // Cari kelompok dengan kapasitas sesuai jenis qurban
    $kelompok = $this->model('Donatur_model')->cariKelompokTersedia($jenis_hewan, $jenis_qurban);

    if ($kelompok) {
        $donatur_id = $this->model('Donatur_model')->tambahDonatur($data);
        if ($donatur_id) {
            $this->model('Donatur_model')->catatQurban($donatur_id, $jenis_hewan, $kelompok['id']);
            header("Location: " . BASEURL . "/Donatur");
            exit;
        }
    } else {
        echo "<script>alert('Kelompok belum tersedia atau penuh. Silakan buat kelompok baru.');window.location.href='" . BASEURL . "/Donatur/tambah';</script>";
        exit;
    }
}



	public function hapus($id)
	{
		$total = $this->model('Donatur_model')->getJumlahDonaturTahunIni($id);

 
	
	if ($total > 0) {
        // Hapus semua data qurban yang terkait
        $this->model('Qurban_model')->hapusTahunIniByDonatur($id);
    }
		
		$this->model('Donatur_model')->hapus($id);
		header('Location: ' . BASEURL . '/Donatur');
		exit;
	}

	public function form_edit($id)
{
    $data['judul'] = 'Edit Donatur';
    $data['donatur'] = $this->model('Donatur_model')->getDonaturById($id);

    if (!$data['donatur']) {
        echo "Donatur dengan ID $id tidak ditemukan.";
        exit;
    }

    $this->view('home_index/header', $data);
    $this->view('donatur/form_edit', $data);
    $this->view('home_index/footer');
}

	public function edit_data()
	{
		    $data = [
        'id' => $_POST['id'],
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat'],
        'handphone' => $_POST['handphone'],
        'jenis_qurban' => $_POST['jenis_qurban']
    ];

    $jenis_qurban = $_POST['jenis_qurban'];

    // Validasi jenis_qurban
    $valid_jenis = ['kambing', 'sapi', 'sapi patungan'];
    if (!in_array($jenis_qurban, $valid_jenis)) {
        echo "<script>alert('Jenis qurban tidak valid!');window.location.href='" . BASEURL . "/Donatur/edit/" . $data['id'] . "';</script>";
        exit;
    }

    // Tentukan jenis hewan (untuk kelompok_qurban)
    $jenis_hewan = ($jenis_qurban === 'kambing') ? 'kambing' : 'sapi';

    // Cari kelompok yang sudah ada untuk jenis qurban ini, atau buat kelompok baru
    $kelompok = $this->model('Donatur_model')->cariKelompokTersedia($jenis_hewan, $jenis_qurban);

    // Jika kelompok tersedia atau baru dibuat
    if ($kelompok) {
        // Update data donatur
        $update_success = $this->model('Donatur_model')->edit($data);
        if ($update_success) {
            // Catat qurban untuk donatur
            $this->model('Donatur_model')->catatQurban($data['id'], $jenis_hewan, $kelompok['id']);
            header("Location: " . BASEURL . "/Donatur");
            exit;
        }
    } else {
        // Jika tidak ada kelompok yang tersedia, beri tahu user
        echo "<script>alert('Kelompok belum tersedia atau penuh. Silakan buat kelompok baru.');window.location.href='" . BASEURL . "/Donatur/edit/" . $data['id'] . "';</script>";
        exit;
    }
		
		

	}
	public function laporan()
{
    $data['judul'] = 'Laporan Donatur';
    $data['donatur'] = $this->model('Donatur_model')->getDonaturQurban();
    $this->view('donatur/laporan', $data);
}
	
	public function laporanPerTahun()
{
    $data['judul'] = 'Laporan Donatur per Tahun';
    $data['laporan'] = $this->model('Donatur_model')->getLaporanDonaturPerTahun();
    $this->view('donatur/laporan_pertahun', $data);
}

public function exportLaporanDonaturPdf()
{
	 $data['judul'] = 'Laporan Donatur per Tahun';
    $data['laporan'] = $this->model('Donatur_model')->getLaporanDonaturPerTahun();
	 $this->view('donatur/laporan_donatur', $data);

    
}


}
