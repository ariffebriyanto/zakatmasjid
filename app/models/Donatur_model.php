<?php
class Donatur_model {
	private $table = 'donatur';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getAllDonatur()
	{
		$this->db->query("SELECT * FROM donatur ORDER BY id ASC");
		return $this->db->resultSet();
	}
	
	 

    // Fungsi untuk menghitung jumlah donatur di kelompok tertentu
    public function getJumlahDonaturInKelompok($kelompok_id) {
        $this->db->query("SELECT COUNT(*) AS jumlah FROM donatur WHERE kelompok_id = :kelompok_id");
        $this->db->bind(':kelompok_id', $kelompok_id);
        $result = $this->db->single();
        return $result['jumlah'];
    }
	
	public function assignToKelompok($donaturId, $kelompokId) {
    // Ambil jenis hewan dari kelompok
    $kelompok = $this->db->query("SELECT * FROM kelompok_qurban WHERE id = :kelompok_id", [
        ':kelompok_id' => $kelompokId
    ])->fetch();

    // Ambil data donatur untuk mengecek apakah sudah ada dalam kelompok
    $donatur = $this->db->query("SELECT * FROM qurban WHERE donatur_id = :donatur_id AND kelompok_id = :kelompok_id", [
        ':donatur_id' => $donaturId,
        ':kelompok_id' => $kelompokId
    ])->fetch();

    // Jika donatur sudah ada, kembalikan false
    if ($donatur) {
        return false;
    }

    // Validasi jumlah donatur di kelompok
    $jumlah_donatur = $this->db->query("SELECT COUNT(*) AS jumlah FROM qurban WHERE kelompok_id = :kelompok_id", [
        ':kelompok_id' => $kelompokId
    ])->fetchColumn();

    // Sesuaikan dengan kapasitas jenis hewan
    if ($kelompok['jenis_hewan'] == 'kambing' && $jumlah_donatur >= 1) {
        return false; // Kambing hanya bisa 1 donatur
    } elseif ($kelompok['jenis_hewan'] == 'sapi' && $jumlah_donatur >= 1) {
        return false; // Sapi hanya bisa 1 donatur
    } elseif ($kelompok['jenis_hewan'] == 'sapi patungan' && $jumlah_donatur >= 7) {
        return false; // Sapi Patungan bisa maksimal 7 donatur
    }

    // Jika validasi lolos, masukkan donatur ke dalam kelompok
    $this->db->query("INSERT INTO qurban (jenis_hewan, kelompok_id, donatur_id) VALUES (:jenis_hewan, :kelompok_id, :donatur_id)", [
        ':jenis_hewan' => $kelompok['jenis_hewan'],
        ':kelompok_id' => $kelompokId,
        ':donatur_id' => $donaturId
    ]);

    return true;
}



	public function getDonaturById($id)
	{
		$this->db->query("SELECT * FROM donatur WHERE id = :id");
		$this->db->bind('id', $id);
		return $this->db->single();
	}

	public function tambah($data)
	{
		$this->db->query("INSERT INTO donatur (nama, alamat, handphone) VALUES (:nama, :alamat, :handphone)");
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('alamat', $data['alamat']);
		$this->db->bind('handphone', $data['handphone']);
		return $this->db->execute();
	}
	
	 // Menambahkan data donatur
   public function tambahDataDonatur($data)
{
    $query = "INSERT INTO donatur (nama, alamat, handphone) VALUES (:nama, :alamat, :handphone)";
    $this->db->query($query);
    $this->db->bind(':nama', $data['nama']);
    $this->db->bind(':alamat', $data['alamat']);
	$this->db->bind(':handphone', $data['handphone']);

 

     try {
        $this->db->execute();
        return $this->db->rowCount();
    } catch (PDOException $e) {
        echo "DB ERROR: " . $e->getMessage();
        return 0;
    }
}


	public function edit($data)
	{
		$this->db->query("UPDATE donatur SET nama = :nama, alamat = :alamat, handphone = :handphone, jenis_qurban = :jenis_qurban WHERE id = :id");
		$this->db->bind('id', $data['id']);
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('alamat', $data['alamat']);
		$this->db->bind('handphone', $data['handphone']);
				$this->db->bind('jenis_qurban', $data['jenis_qurban']);
		
		return $this->db->execute();
	}

	public function hapus($id)
	{
		$this->db->query("DELETE FROM donatur WHERE id = :id");
		$this->db->bind('id', $id);
		return $this->db->execute();
	}
	
	public function getDonaturQurban()
{
    $this->db->query("
        SELECT d.nama, COUNT(q.id) AS jumlah_qurban
        FROM donatur d
        LEFT JOIN qurban q ON d.id = q.donatur_id
        GROUP BY d.id, d.nama
    ");
    return $this->db->resultSet();
}
	
	public function getLaporanDonaturPerTahun()
{
    $this->db->query("
        SELECT 
            d.nama AS nama_donatur,
            k.jenis_hewan,
            k.tahun,
            COUNT(q.id) AS jumlah_qurban
        FROM qurban q
        JOIN donatur d ON q.donatur_id = d.id
        JOIN kelompok_qurban k ON q.kelompok_id = k.id
        GROUP BY d.nama, k.jenis_hewan, k.tahun
        ORDER BY k.tahun DESC, d.nama ASC
    ");
    return $this->db->resultSet();
}

//baru
public function tambahDonatur($data) {
    $this->db->query("INSERT INTO donatur (nama, alamat, handphone, jenis_qurban) VALUES (:nama, :alamat, :handphone, :jenis_qurban)");
    $this->db->bind(':nama', $data['nama']);
    $this->db->bind(':alamat', $data['alamat']);
    $this->db->bind(':handphone', $data['handphone']);
    $this->db->bind(':jenis_qurban', $data['jenis_qurban']);
    $this->db->execute();
    return $this->db->lastInsertId();
}

public function catatQurban($donatur_id, $jenis_hewan, $kelompok_id) {
    $this->db->query("INSERT INTO qurban (jenis_hewan, kelompok_id, donatur_id) VALUES (:jenis_hewan, :kelompok_id, :donatur_id)");
    $this->db->bind(':jenis_hewan', $jenis_hewan);
    $this->db->bind(':kelompok_id', $kelompok_id);
    $this->db->bind(':donatur_id', $donatur_id);
    $this->db->execute();
}

public function getJumlahDonaturTahunIni($id_donatur) {
        $this->db->query("SELECT COUNT(*) AS jumlah 
              FROM qurban q
              JOIN kelompok_qurban k ON q.kelompok_id = k.id
              WHERE k.tahun = YEAR(CURDATE()) 
              AND q.donatur_id = :id_donatur");
        $this->db->bind('id_donatur', $id_donatur);
        return $this->db->single()['jumlah'];
    }

public function cariKelompokTersedia($jenis_hewan, $jenis_qurban) {
    $this->db->query("SELECT * FROM kelompok_qurban WHERE jenis_hewan = :jenis_hewan AND tahun = YEAR(CURDATE())");
    $this->db->bind(':jenis_hewan', $jenis_hewan);
    $kelompok_list = $this->db->resultSet();

    foreach ($kelompok_list as $kelompok) {
        // Hitung jumlah donatur yang sudah masuk ke kelompok ini
        $this->db->query("SELECT COUNT(*) as total FROM qurban WHERE kelompok_id = :id");
        $this->db->bind(':id', $kelompok['id']);
        $count = $this->db->single()['total'];

        // Kapasitas tergantung jenis_qurban
        if ($jenis_qurban === 'sapi patungan') {
            $kapasitas = 7;
        } else {
            $kapasitas = 1;
        }

        if ($count < $kapasitas) {
            return $kelompok;
        }
    }

    return false; // Tidak ada kelompok tersedia
}

}
