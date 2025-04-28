<?php
class Qurban extends Controller {

    // Menampilkan daftar qurban berdasarkan kelompok
   public function index($kelompok_id=1)
{
    $data['judul'] = 'Data Qurban';
    $data['qurban'] = $this->model('Qurban_model')->getQurbanByKelompokId($kelompok_id);
    $data['kelompok'] = $this->model('KelompokQurban_model')->getKelompokById($kelompok_id);

    $this->view('home_index/header', $data);
    $this->view('qurban/index', $data);
    $this->view('home_index/footer');
}

public function listall()
	{
		$data['judul'] = 'Data Donatur';
		$data['qurban'] = $this->model('Qurban_model')->getAll();
		$this->view('home_index/header', $data);
		$this->view('qurban/list', $data);
		$this->view('home_index/footer');
	}
	
	public function countQurbanByKelompok($kelompok_id) {
    $this->db->query("SELECT COUNT(*) as jumlah FROM qurban WHERE kelompok_id = :kelompok_id");
    $this->db->bind(':kelompok_id', $kelompok_id);
    $result = $this->db->single();
    return $result['jumlah'];
}

    // Menambah data qurban
   public function tambah($kelompok_id = null)
{
    if ($kelompok_id === null) {
        echo "Kelompok Qurban tidak ditemukan.";
		 header('Location: ' . BASEURL . '/Qurban/listall');
        return;
    }

    $data['judul'] = 'Tambah Qurban';
	$data['kelompok'] = $this->model('KelompokQurban_model')->getKelompokById($kelompok_id);
    $data['donatur'] = $this->model('Donatur_model')->getAllDonatur();

    $this->view('home_index/header', $data);
    $this->view('qurban/tambah', $data);
    $this->view('home_index/footer');
}
 
   // Aksi menambah qurban
    public function aksi_tambah()
    {
        if (isset($_POST['kelompok_id']) && isset($_POST['donatur_id']) && isset($_POST['jenis_hewan'])) {
			$kelompok_id = $_POST['kelompok_id'];
    $jenis_hewan = $_POST['jenis_hewan'];
            // Prepare data to be inserted
            $data = [
                'kelompok_id' => $_POST['kelompok_id'],
                'donatur_id' => $_POST['donatur_id'],
                'jenis_hewan' => $_POST['jenis_hewan']
            ];
			
			// Ambil jumlah qurban saat ini dalam kelompok
    $jumlah_qurban = $this->model('Qurban_model')->countQurbanByKelompok($kelompok_id);

    // Validasi berdasarkan jenis hewan
    if ($jenis_hewan === 'kambing' && $jumlah_qurban >= 1) {
        echo "<script>
    alert('Kelompok kambing maksimal 1 anggota.');
    window.location.href='" . BASEURL . "/Qurban/tambah/" . $_POST['kelompok_id'] . "';
</script>";

        exit;
    }

    if ($jenis_hewan === 'sapi' && $jumlah_qurban >= 7) {
        echo "<script>alert('Kelompok sapi maksimal 7 anggota.'); 
		window.location.href='" . BASEURL . "/Qurban/tambah/" . $_POST['kelompok_id'] . "';
		</script>";
        exit;
    }

            // Call the model to insert data
            if ($this->model('Qurban_model')->tambahQurban($data)) {
                // Redirect to the Qurban page after successful insert
               // header('Location: ' . BASEURL . '/Qurban/index/' . $_POST['kelompok_id']);
				 header('Location: ' . BASEURL . '/KelompokQurban/index/');
                exit;
            } else {
                // Show error if insert failed
                //echo "Gagal menambah qurban.";
				 echo "<script>alert('Gagal menambah qurban'); 
				 window.location.href='" . BASEURL . "/Qurban/tambah/" . $_POST['kelompok_id'] . "';
				 </script>";
        exit;
            }
        } else {
            //echo "Data tidak lengkap.";
			echo "<script>alert('Data tidak lengkap'); 
			window.location.href='" . BASEURL . "/Qurban/tambah/" . $_POST['kelompok_id'] . "';
			</script>";
        }
    }
	// Menampilkan Form Edit
public function edit($id)
{
    $data['judul'] = 'Edit Qurban';
    // Ambil data qurban berdasarkan ID
    $data['qurban'] = $this->model('Qurban_model')->getQurbanById($id);
    // Ambil data kelompok qurban dan donatur untuk dropdown
    $data['kelompok_qurban'] = $this->model('KelompokQurban_model')->getAllKelompokQurban();
    $data['donatur'] = $this->model('Donatur_model')->getAllDonatur();

    $this->view('home_index/header', $data);
    $this->view('qurban/edit', $data);
    $this->view('home_index/footer');
}

// Menangani aksi update setelah form disubmit
public function aksi_update()
{
    if (isset($_POST['id'], $_POST['kelompok_id'], $_POST['donatur_id'], $_POST['jenis_hewan'])) {
        $data = [
            'id' => $_POST['id'],
            'kelompok_id' => $_POST['kelompok_id'],
            'donatur_id' => $_POST['donatur_id'],
            'jenis_hewan' => $_POST['jenis_hewan']
        ];

        if ($this->model('Qurban_model')->updateQurban($data) > 0) {
            header('Location: ' . BASEURL . '/Qurban/index/' . $_POST['kelompok_id']);
            exit;
        } else {
             header('Location: ' . BASEURL . '/Qurban/index/' . $_POST['kelompok_id']);
            exit;
        }
    } else {
        echo "Data tidak lengkap.";
    }
}


    // Menghapus data qurban
    public function hapus($id)
    {
        $this->model('Qurban_model')->hapusQurban($id);
        header('Location: ' . BASEURL . '/Qurban');
        exit;
    }
	
	public function laporanKelompok()
{
    $data['judul'] = 'Laporan Qurban per Kelompok';
    $data['laporan'] = $this->model('Qurban_model')->getDistribusiQurbanPerTahun();
    $this->view('qurban/laporan_kelompok', $data);
}
public function grafikDistribusi()
{
    $data['judul'] = 'Grafik Distribusi Qurban';
    $data['distribusi'] = $this->model('Qurban_model')->getDistribusiQurban();
    $this->view('qurban/grafik_distribusi', $data);
}

public function tambah_banyak()
{
    

    $data['judul'] = 'Tambah Qurban Banyak';
	$data['kelompok'] = $this->model('KelompokQurban_model')->getKelompokDenganKuotaTersisa();;
    $data['donatur'] = $this->model('Donatur_model')->getAllDonatur();

    $this->view('home_index/header', $data);
    $this->view('qurban/tambah_banyak', $data);
    $this->view('home_index/footer');
}

public function aksi_tambah_banyak() {
    $kelompok_ids = $_POST['kelompok_ids'];
    $jenis_hewan = $_POST['jenis_hewan'];
	$nama_kelompoks = $_POST['nama_kelompoks'];
    $donatur_ids = $_POST['donatur_ids'];

    if (empty($donatur_ids)) {
        echo "Harap pilih setidaknya satu donatur untuk kelompok.";
        return;
    }

    require_once __DIR__ . '/../models/Qurban_model.php';
    $qurbanModel = new Qurban_model;

    try {
        foreach ($kelompok_ids as $index => $kelompok_id) {
            $jenis = $jenis_hewan[$index];
			$nama = $nama_kelompoks[$index];

            // Validasi jumlah donatur sebelum disimpan
            $jumlahSaatIni = $qurbanModel->countQurbanByKelompok($kelompok_id);
            $jumlahTambahan = isset($donatur_ids[$kelompok_id]) ? count($donatur_ids[$kelompok_id]) : 0;
            $totalSetelah = $jumlahSaatIni + $jumlahTambahan;

             if ($jenis == 'kambing' && $totalSetelah > 1) {
                // Menampilkan pesan dan menghentikan eksekusi
                echo "<script>alert('Kelompok {$nama} jenis kambing hanya boleh memiliki satu donatur.'); window.history.back();</script>";
                exit();
            }

            if ($jenis == 'sapi' && $totalSetelah > 7) {
                // Menampilkan pesan dan menghentikan eksekusi
                echo "<script>alert('Kelompok {$nama} jenis sapi maksimal 7 donatur.'); window.history.back();</script>";
                exit();
            }

            // Jika lolos validasi, simpan data donatur
            if (!empty($donatur_ids[$kelompok_id])) {
                foreach ($donatur_ids[$kelompok_id] as $donatur_id) {
                    // Cek jika data sudah ada
                    $qurbanExist = $qurbanModel->checkQurbanExist($kelompok_id, $donatur_id, $jenis);
                    if ($qurbanExist) {
                        continue;  // Jika sudah ada, lanjutkan ke data berikutnya
                    }

                    // Jika tidak ada, simpan data
                    $qurbanModel->query("INSERT INTO qurban (kelompok_id, donatur_id, jenis_hewan) VALUES (:kelompok_id, :donatur_id, :jenis_hewan)");
                    $qurbanModel->bind(':kelompok_id', $kelompok_id);
                    $qurbanModel->bind(':donatur_id', $donatur_id);
                    $qurbanModel->bind(':jenis_hewan', $jenis);
                    $qurbanModel->execute();
                }
            }
        }

        // Arahkan ke halaman success setelah selesai
        header('Location: ' . BASEURL . '/Qurban/listall');
    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}


}
?>
