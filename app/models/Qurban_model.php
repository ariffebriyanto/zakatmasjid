<?php
class Qurban_model {
	private $table = 'qurban';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}
	
	
    // Metode untuk menjalankan query SQL
    public function query($query)
    {
        $this->db->query($query);
    }

    // Bind parameter ke query
    public function bind($param, $value)
    {
        $this->db->bind($param, $value);
    }

    // Eksekusi query
    public function execute()
    {
        return $this->db->execute();
    }
	
	  // Fungsi untuk mendapatkan semua data qurban berdasarkan kelompok
    public function getQurbanByKelompok($kelompok_id) {
        $this->db->query("SELECT * FROM qurban WHERE kelompok_id = :kelompok_id");
        $this->db->bind(':kelompok_id', $kelompok_id);
        return $this->db->resultSet();  // Mengembalikan semua data qurban berdasarkan kelompok
    }

    // Fungsi untuk menghitung jumlah kambing berdasarkan kelompok
    public function countKambingByKelompok($kelompok_id) {
        $this->db->query("SELECT COUNT(*) as jumlah FROM qurban WHERE kelompok_id = :kelompok_id AND jenis_hewan = 'kambing'");
        $this->db->bind(':kelompok_id', $kelompok_id);
        $result = $this->db->single();  // Mengambil data satu baris
        return $result['jumlah'];  // Mengembalikan jumlah kambing
    }

    // Fungsi untuk menghitung jumlah sapi berdasarkan kelompok
    public function countSapiByKelompok($kelompok_id) {
        $this->db->query("SELECT COUNT(*) as jumlah FROM qurban WHERE kelompok_id = :kelompok_id AND jenis_hewan = 'sapi'");
        $this->db->bind(':kelompok_id', $kelompok_id);
        $result = $this->db->single();
        return $result['jumlah'];
    }
	
	 public function checkQurbanExist($kelompok_id, $donatur_id, $jenis_hewan)
    {
        // Query untuk memeriksa apakah data sudah ada di tabel qurban
        $this->db->query("SELECT COUNT(*) as total FROM qurban WHERE kelompok_id = :kelompok_id AND donatur_id = :donatur_id AND jenis_hewan = :jenis_hewan");
        $this->db->bind(':kelompok_id', $kelompok_id);
        $this->db->bind(':donatur_id', $donatur_id);
        $this->db->bind(':jenis_hewan', $jenis_hewan);
        
        // Eksekusi query dan ambil hasilnya
        $result = $this->db->single();

        // Jika jumlahnya lebih dari 0, berarti data sudah ada
        return $result['total'] > 0;
    }
	
	// Fungsi untuk menambahkan donatur ke dalam kelompok qurban
    public function tambahDonaturKeKelompok($donatur_id, $kelompok_id) {
        // Query untuk menambahkan donatur ke dalam kelompok qurban
        $this->db->query("INSERT INTO qurban (donatur_id, kelompok_id) VALUES (:donatur_id, :kelompok_id)");
        $this->db->bind(':donatur_id', $donatur_id);
        $this->db->bind(':kelompok_id', $kelompok_id);
        $this->db->execute();
    }
	
	public function getQurbanByKelompokId($kelompok_id)
{
    $this->db->query("
        SELECT q.id, 
               q.kelompok_id, 
               k.nama_kelompok, 
               k.jenis_hewan, 
               d.nama AS nama_donatur 
        FROM qurban q
        JOIN kelompok_qurban k ON q.kelompok_id = k.id
        JOIN donatur d ON q.donatur_id = d.id
        WHERE q.kelompok_id = :kelompok_id
    ");
    $this->db->bind('kelompok_id', $kelompok_id);
    return $this->db->resultSet();
}

public function hapusByKelompokId($id_kelompok)
{ $query = "DELETE FROM qurban WHERE kelompok_id = :id_kelompok";
    $this->db->query($query);
    $this->db->bind(':id_kelompok', $id_kelompok);
    return $this->db->execute();  // Jika berhasil, akan mengembalikan nilai lebih dari 0
 
}

public function hapusTahunIniByDonatur($id_donatur) {
    $query = "DELETE q 
              FROM qurban q
              JOIN kelompok_qurban k ON q.kelompok_id = k.id
              WHERE k.tahun = YEAR(CURDATE()) 
              AND q.donatur_id = :id_donatur";

    $this->db->query($query);
    $this->db->bind('id_donatur', $id_donatur);
    return $this->db->execute();
}



	public function getAll()
	{
		$this->db->query("SELECT q.id, d.nama, k.jenis_hewan,k.nama_kelompok, k.tahun
						  FROM qurban q
						  JOIN donatur d ON q.donatur_id = d.id
						  JOIN kelompok_qurban k ON q.kelompok_id = k.id
						  ORDER BY q.id DESC");
		return $this->db->resultSet();
	}
	
	public function countQurbanByKelompok($kelompok_id)
{
    $this->db->query("SELECT COUNT(*) as total FROM qurban WHERE kelompok_id = :kelompok_id");
    $this->db->bind('kelompok_id', $kelompok_id);
    return $this->db->single()['total'];
}

	
	// Fungsi untuk menambah qurban
    public function tambahQurban($data)
    {
		
        // Query untuk menambah data qurban
        $this->db->query("INSERT INTO qurban (kelompok_id, donatur_id, jenis_hewan) VALUES (:kelompok_id, :donatur_id, :jenis_hewan)");

        // Bind data ke parameter
        $this->db->bind('kelompok_id', $data['kelompok_id']);
        $this->db->bind('donatur_id', $data['donatur_id']);
        $this->db->bind('jenis_hewan', $data['jenis_hewan']);

        // Eksekusi query dan cek apakah berhasil
        try {
        $this->db->execute();
        return $this->db->rowCount();
    } catch (PDOException $e) {
        echo "DB ERROR: " . $e->getMessage();
        return 0;
    }
    }

	public function tambah($data)
	{
		// validasi max 7 donatur untuk sapi
		$this->db->query("SELECT COUNT(*) as total, k.jenis_hewan 
						  FROM qurban q 
						  JOIN kelompok_qurban k ON q.kelompok_id = k.id 
						  WHERE q.kelompok_id = :kelompok_id");
		$this->db->bind('kelompok_id', $data['kelompok_id']);
		$result = $this->db->single();

		if ($result['jenis_hewan'] == 'sapi' && $result['total'] >= 7) {
			return -1; // sudah penuh
		}

		$this->db->query("INSERT INTO qurban (kelompok_id, donatur_id) VALUES (:kelompok, :donatur)");
		$this->db->bind('kelompok', $data['kelompok_id']);
		$this->db->bind('donatur', $data['donatur_id']);
		return $this->db->execute();
	}
	// Ambil data qurban berdasarkan ID
public function getQurbanById($id)
{
	
    $this->db->query("SELECT * FROM qurban WHERE id = :id");
    $this->db->bind(':id', $id);
    return $this->db->single();
}

// Update data qurban
public function updateQurban($data)
{
    $query = "UPDATE qurban SET kelompok_id = :kelompok_id, donatur_id = :donatur_id, jenis_hewan = :jenis_hewan WHERE id = :id";
    $this->db->query($query);
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':kelompok_id', $data['kelompok_id']);
    $this->db->bind(':donatur_id', $data['donatur_id']);
    $this->db->bind(':jenis_hewan', $data['jenis_hewan']);
    return $this->db->execute();  // Jika berhasil, akan mengembalikan nilai lebih dari 0
}
public function hapusQurban($id)
{
    $query = "DELETE FROM qurban WHERE id = :id";
    $this->db->query($query);
    $this->db->bind(':id', $id);
    return $this->db->execute();  // Jika berhasil, akan mengembalikan nilai lebih dari 0
}

public function getDistribusiQurbanPerTahun()
{
    $this->db->query("
        SELECT 
            k.tahun,
            k.jenis_hewan,
            COUNT(q.id) AS jumlah_qurban
        FROM qurban q
        JOIN kelompok_qurban k ON q.kelompok_id = k.id
        GROUP BY k.tahun, k.jenis_hewan
        ORDER BY k.tahun desc, k.jenis_hewan ASC
    ");
    return $this->db->resultSet();
}


public function getJumlahQurbanPerKelompok()
{
    $this->db->query("
        SELECT k.id AS kelompok_id, k.jenis_hewan, COUNT(q.id) AS jumlah_qurban
        FROM kelompok_qurban k
        LEFT JOIN qurban q ON k.id = q.kelompok_id
        GROUP BY k.id, k.jenis_hewan
    ");
    return $this->db->resultSet();
}
public function getDistribusiQurban()
{
    $this->db->query("
        SELECT k.jenis_hewan, COUNT(q.id) AS jumlah
        FROM kelompok_qurban k
        LEFT JOIN qurban q ON k.id = q.kelompok_id
        GROUP BY k.jenis_hewan
    ");
    return $this->db->resultSet();
}

public function tambahQurbanOtomatis($donatur_id, $jenis_hewan)
	{
		$tahun = date('Y');
		$max_anggota = ($jenis_hewan == 'sapi') ? 7 : 1;

		// Cari kelompok yang belum penuh
		$this->db->query("
			SELECT k.id, COUNT(q.id) as total 
			FROM kelompok_qurban k
			LEFT JOIN qurban q ON q.kelompok_id = k.id
			WHERE k.jenis_hewan = :jenis AND k.tahun = :tahun
			GROUP BY k.id
			HAVING total < :maks
			LIMIT 1
		");
		$this->db->bind('jenis', $jenis_hewan);
		$this->db->bind('tahun', $tahun);
		$this->db->bind('maks', $max_anggota);
		$kelompok = $this->db->single();

		if ($kelompok) {
			$kelompok_id = $kelompok['id'];
		} else {
			// Buat kelompok baru
			$nama_kelompok = $jenis_hewan . " " . rand(1,999) . " " . $tahun;
			$this->db->query("INSERT INTO kelompok_qurban (jenis_hewan, tahun, nama_kelompok) VALUES (:jenis, :tahun, :nama)");
			$this->db->bind('jenis', $jenis_hewan);
			$this->db->bind('tahun', $tahun);
			$this->db->bind('nama', $nama_kelompok);
			$this->db->execute();
			$kelompok_id = $this->db->lastInsertId();
		}

		// Masukkan ke tabel qurban
		$this->db->query("INSERT INTO qurban (jenis_hewan, kelompok_id, donatur_id) VALUES (:jenis, :kelompok, :donatur)");
		$this->db->bind('jenis', $jenis_hewan);
		$this->db->bind('kelompok', $kelompok_id);
		$this->db->bind('donatur', $donatur_id);
		return $this->db->execute();
	}
	public function tambahBanyak($dataArray)
{
    $this->db->beginTransaction();

    try {
        foreach ($dataArray as $data) {
            $this->db->query("INSERT INTO qurban (kelompok_id, donatur_id, jenis_hewan) VALUES (:kelompok_id, :donatur_id, :jenis_hewan)");
            $this->db->bind(':kelompok_id', $data['kelompok_id']);
            $this->db->bind(':donatur_id', $data['donatur_id']);
            $this->db->bind(':jenis_hewan', $data['jenis_hewan']);
            $this->db->execute();
        }

        $this->db->commit();
        return true;
    } catch (PDOException $e) {
        $this->db->rollBack();
        echo "Gagal menyimpan data: " . $e->getMessage();
        return false;
    }
}


}