<?php

class PenerimaQurban extends Controller {

    private $penerimaModel;

    public function __construct() {
        $this->penerimaModel = $this->model('PenerimaQurban_model');
    }

    // Menampilkan daftar penerima kurban
    public function index() {
		$data['judul'] = 'Data Penerima';
        $penerima = $this->penerimaModel->getAll();
		$this->view('home_index/header', $data);
        $this->view('penerimaqurban/index', ['penerima' => $penerima]);
		$this->view('home_index/footer', $data);
    }

  // Menampilkan daftar penerima kurban
 public function indextukar() {
		$data['judul'] = 'Data Penukaran Kupon';
        $penerima = $this->penerimaModel->getAllTukar();
		$this->view('home_index/header', $data);
        $this->view('penerimaqurban/montukar', ['penerima' => $penerima]);
		$this->view('home_index/footer', $data);
    }

 public function tambah() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tahun = date('y'); // Tahun 2 digit, misal 2025 → 25

        // Ambil kupon terakhir berdasarkan tahun
        $lastKupon = $this->penerimaModel->getLastIdByTahun($tahun);

        if ($lastKupon === null) {
            $nomorUrut = 1;
        } else {
            // Ambil 4 digit nomor urut dari posisi ke-1 (setelah huruf A), panjang 4 digit
            $nomorUrut = (int)substr($lastKupon, 1, 4) + 1;
        }

        // Format kupon: A0001 + tahun
        $kupon = 'A' . sprintf('%04d', $nomorUrut) . $tahun;

        $data = [
            'nama' => trim($_POST['nama']),
            'alamat' => trim($_POST['alamat']),
            'handphone' => trim($_POST['handphone']),
            'kupon' => $kupon,
            'tahun' => $tahun,
            'status' => 'belum'
        ];

        if ($this->penerimaModel->tambah($data)) {
            echo "<script>
                alert('Data berhasil ditambah!');
                window.location.href = '" . BASEURL . "/PenerimaQurban';
            </script>";
        } else {
            echo "<script>
                 alert('Data berhasil ditambah!');
                window.location.href = '" . BASEURL . "/PenerimaQurban';
            </script>";
        }
    } else {
		$data['judul'] = 'Tambah Penerima';
		$this->view('home_index/header', $data);
        $this->view('penerimaqurban/tambah');
		$this->view('home_index/footer', $data);
    }
}





    // Menampilkan form untuk mengedit data penerima kurban
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'nama' => trim($_POST['nama']),
                'alamat' => trim($_POST['alamat']),
                'handphone' => trim($_POST['handphone']),
                'status' => $_POST['status']
            ];

            if ($this->penerimaModel->update($data)) {
                echo "<script>
            alert('Data berhasil diupdate!');
            window.location.href = '". BASEURL ."/PenerimaQurban';
          </script>";
            } else {
                 echo "<script>
            alert('Data berhasil diupdate!');
            window.location.href = '". BASEURL ."/PenerimaQurban';
          </script>";
            }
        } else {
			$data['judul'] = 'Edit Penerima';
            $penerima = $this->penerimaModel->getById($id);
			$this->view('home_index/header', $data);
            $this->view('penerimaqurban/edit', ['penerima' => $penerima]);
			$this->view('home_index/footer', $data);
        }
    }

    // Menghapus penerima kurban
    public function hapus($id) {
        if ($this->penerimaModel->hapus($id)) {
            header('Location: ' . BASEURL . '/PenerimaQurban');
        } else {
             header('Location: ' . BASEURL . '/PenerimaQurban');
        }
    }

    // Menandai kupon sebagai "ditukar"
    public function tukarkupon() {
		$data['judul'] = 'Tukar Kupon Manual';
		$this->view('home_index/header', $data);
        $this->view('penerimaqurban/tukar');
		$this->view('home_index/footer', $data);
    }
	 public function tukarkuponqr() {
		 $data['judul'] = 'Tukar Kupon Otomatis';
		$this->view('home_index/header', $data);
        $this->view('penerimaqurban/tukarqr');
		$this->view('home_index/footer', $data);
    }
	
	public function cetakKupon($tahun) {
    require_once 'assets/phpqrcode/qrlib.php';
    require_once 'assets/mpdf/mpdf.php';

    // Ambil daftar penerima kupon yang belum ditukar berdasarkan tahun
    $list = $this->penerimaModel->getByTahunStatus($tahun, 'belum');

    // Proses untuk membuat QR Code untuk setiap kupon
    foreach ($list as $row) {
        $qrCodePath = __DIR__ . '/../../assets/qrcode/' . $row['kupon'] . '.png';
        QRcode::png($row['kupon'], $qrCodePath); // Menyimpan QR Code
    }

    // Kirim data kupon ke view cetakkupon.php
    $data['kuponData'] = $list;

    // Tangkap output HTML dari view cetakkupon.php
    ob_start();
    include __DIR__ . '/../views/penerimaqurban/cetakkupon.php';
    $html = ob_get_clean();

    // Buat file PDF menggunakan mPDF
    $mpdf = new mPDF();
    $mpdf->WriteHTML($html);
     $mpdf->Output('KuponQurban.pdf', 'D'); // atau 'I' jika ingin inline
}

public function cetakQr($tahun) {
    require_once 'assets/phpqrcode/qrlib.php';
    require_once 'assets/mpdf/mpdf.php';

    // Ambil daftar penerima kupon yang belum ditukar berdasarkan tahun
    $list = $this->penerimaModel->getByTahunStatus($tahun, 'belum');

    // Proses untuk membuat QR Code untuk setiap kupon
    foreach ($list as $row) {
        $qrCodePath = __DIR__ . '/../../assets/qrcode/' . $row['kupon'] . '.png';
        QRcode::png($row['kupon'], $qrCodePath); // Menyimpan QR Code
    }

    // Kirim data kupon ke view cetakkupon.php
    $data['kuponData'] = $list;

    // Tangkap output HTML dari view cetakkupon.php
    ob_start();
    include __DIR__ . '/../views/penerimaqurban/cetakqr.php';
    $html = ob_get_clean();

    // Buat file PDF menggunakan mPDF
    $mpdf = new mPDF();
    $mpdf->WriteHTML($html);
	 //$mpdf->Output(); // atau 'I' jika ingin inline
     $mpdf->Output('KuponQurban.pdf', 'D'); // atau 'I' jika ingin inline
}


    // Export data ke Excel
    public function exportExcel() {
        $data = $this->penerimaModel->getAll();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="daftar_penerima_kurban.xls"');

        $output = '<table border="1">';
        $output .= '<tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Handphone</th><th>Kupon</th><th>Tahun</th><th>Status</th></tr>';

        foreach ($data as $row) {
            $output .= '<tr>';
            $output .= '<td>' . $row['id'] . '</td>';
            $output .= '<td>' . $row['nama'] . '</td>';
            $output .= '<td>' . $row['alamat'] . '</td>';
            $output .= '<td>' . $row['handphone'] . '</td>';
            $output .= '<td>' . $row['kupon'] . '</td>';
            $output .= '<td>' . $row['tahun'] . '</td>';
            $output .= '<td>' . $row['status'] . '</td>';
            $output .= '</tr>';
        }

        $output .= '</table>';

        echo $output;
    }
	
public function tukar()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $kodeKupon = null;

        // 1. Cek input manual terlebih dahulu
        if (!empty($_POST['kode_manual'])) {
            $kodeKupon = trim($_POST['kode_manual']);
        }

        // 2. Jika tidak ada input manual, lanjut ke pemrosesan QR image
        elseif (isset($_FILES['qrimage']) && $_FILES['qrimage']['tmp_name']) {
            $uploadDir = __DIR__ . '/../../assets/uploads/';
            $uploadedFile = $uploadDir . basename($_FILES['qrimage']['name']);

            if (move_uploaded_file($_FILES['qrimage']['tmp_name'], $uploadedFile)) {
                // Jalankan ZBAR
                $zbarPath = __DIR__ . '/../../zbar/zbarimg.exe';
                $command = '"' . $zbarPath . '" ' . escapeshellarg($uploadedFile) . ' 2>&1';
                $output = shell_exec($command);

                if (preg_match('/QR-Code:(.+)/', $output, $matches)) {
                    $kodeKupon = trim($matches[1]);
                } else {
                    echo "<script>alert('QR Code tidak valid.'); window.location.href = '". BASEURL ."/PenerimaQurban/tukar';</script>";
                    return;
                }
            } else {
                echo "<script>alert('Gagal mengunggah gambar.'); window.location.href = '". BASEURL ."/PenerimaQurban/tukar';</script>";
                return;
            }
        }

        // 3. Jika kode kupon sudah didapatkan, update status
        if ($kodeKupon) {
            if ($this->penerimaModel->updateStatus($kodeKupon)) {
                echo "<script>alert('Kupon $kodeKupon berhasil ditukar.'); window.location.href = '". BASEURL ."/PenerimaQurban';</script>";
            } else {
                echo "<script>alert('Kupon tidak ditemukan atau sudah ditukar.'); window.location.href = '". BASEURL ."/PenerimaQurban/tukar';</script>";
            }
        } else {
            echo "<script>alert('Silakan upload gambar QR atau isi kode manual.'); window.location.href = '". BASEURL ."/PenerimaQurban/tukar';</script>";
        }

    } else {
        $this->view('penerimaqurban/tukar');
    }
}


public function tukarqr() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kupon'])) {
        $kodeKupon = trim($_POST['kupon']);

        if ($this->penerimaModel->updateStatus($kodeKupon)) {
            echo "Kupon $kodeKupon berhasil ditukar.";
        } else {
            echo "Kupon tidak ditemukan atau sudah ditukar.";
        }
    } else {
        $this->view('penerimaqurban/tukarqr'); // tampilkan view jika bukan POST
    }
}
public function getData()
{
    $data = $this->penerimaModel->getAll(); // adjust with your model
    echo json_encode($data);
}
public function getDataKupon()
{
   
    $data = [
        'penerima' => $this->penerimaModel->getAllTukar(),
        'total_belum' => $this->penerimaModel->countStatus('belum'),
        'total_ditukar' => $this->penerimaModel->countStatus('ditukar'),
        'total_tahun_ini' => $this->penerimaModel->countByYear(date('Y'))
    ];

    header('Content-Type: application/json');
    echo json_encode($data);
}


}
