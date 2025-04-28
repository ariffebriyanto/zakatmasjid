<?php
class KelompokQurban_model {
	private $table = 'kelompok_qurban';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

 // Method untuk mengambil semua kelompok qurban
    public function getAllKelompokQurban() {
        $this->db->query("SELECT * FROM kelompok_qurban ORDER BY id DESC");
        return $this->db->resultSet();
    }
	
	
	
	 // Method untuk menambahkan data kelompok qurban
    public function tambahKelompokQurban($data) {
        $query = "INSERT INTO " . $this->table . " (nama_kelompok, jenis_hewan, tahun) VALUES (:nama_kelompok, :jenis_hewan, :tahun)";
        
        // Menyiapkan query
        $this->db->query($query);
        
        // Binding data ke query
		$this->db->bind(':nama_kelompok', $data['nama_kelompok']);
    $this->db->bind(':jenis_hewan', $data['jenis_hewan']);
    $this->db->bind(':tahun', $data['tahun']);

    try {
        // Eksekusi query dan mengembalikan hasil
        $this->db->execute();
        return true; // Jika berhasil
    } catch (Exception $e) {
        // Log error jika terjadi kesalahan
        echo "Terjadi kesalahan: " . $e->getMessage();
        return false; // Jika gagal
    }
    }
	
	public function getAll()
	{
		$this->db->query("SELECT * FROM kelompok_qurban ORDER BY id DESC");
		return $this->db->resultSet();
	}

	public function tambah($data)
	{
		$this->db->query("INSERT INTO kelompok_qurban (nama_kelompok, jenis_hewan, tahun) VALUES (:nama, :jenis, :tahun)");
		$this->db->bind('nama', $data['nama_kelompok']);
		$this->db->bind('jenis', $data['jenis_hewan']);
		$this->db->bind('tahun', $data['tahun']);
		return $this->db->execute();
	}
	
	public function hapusKelompokQurban($id)
{
    $this->db->query("DELETE FROM kelompok_qurban WHERE id = :id");
    $this->db->bind('id', $id);
   return $this->db->execute();
}
public function ambilDataKelompok($id)
	{
		$this->db->query('SELECT * FROM '.$this-> table .' WHERE id=:id');
		$this->db->bind('id',$id);
		return $this->db->single();
	}

	// public function editDataKelompok($data){
    // if (!isset($data['id']) || !isset($data['nama_kelompok'])) {
        // throw new Exception("Missing 'id' or 'nama_kelompok' in data");
    // }

    // $query = "UPDATE kelompok_qurban SET 
        // nama_kelompok = :nama_kelompok
        // WHERE id = :id";

    // $this->db->query($query);
    // $this->db->bind('id', $data['id']);
    // $this->db->bind('nama_kelompok', $data['nama_kelompok']);
    // $this->db->execute();

    // return $this->db->rowCount();
// }

public function getKelompokDenganKuotaTersisa()
{
    $tahun = date('Y'); // Ambil tahun sekarang
    $this->db->query("
        SELECT k.*, COUNT(q.donatur_id) AS jumlah_donatur
        FROM kelompok_qurban k
        LEFT JOIN qurban q ON k.id = q.kelompok_id
        WHERE k.tahun = :tahun
        GROUP BY k.id
    ");
    $this->db->bind('tahun', $tahun);
    $kelompok = $this->db->resultSet();

    // Filter kelompok yang masih memiliki kuota
    $kelompokDenganKuota = array_filter($kelompok, function($k) {
        // Kambing hanya boleh 1 donatur
        if ($k['jenis_hewan'] == 'kambing' && $k['jumlah_donatur'] < 1) {
            return true;
        }
        // Sapi maksimal 7 donatur
        if ($k['jenis_hewan'] == 'sapi' && $k['jumlah_donatur'] < 7) {
            return true;
        }
        return false;
    });

    return $kelompokDenganKuota;
}
// Fungsi untuk mendapatkan kelompok berdasarkan jenis hewan
    public function getKelompokByJenis($jenis_qurban) {
        $this->db->query("SELECT * FROM kelompok_qurban WHERE jenis_hewan = :jenis_qurban LIMIT 1");
        $this->db->bind(':jenis_qurban', $jenis_qurban);
        return $this->db->single();
    }
	
	public function editDataKelompok($data)
{
    if (!isset($data['id']) || !isset($data['nama_kelompok']) || !isset($data['jenis_hewan'])) {
        throw new Exception("Missing required data");
    }

    $query = "UPDATE kelompok_qurban SET 
        nama_kelompok = :nama_kelompok,
        jenis_hewan = :jenis_hewan
        WHERE id = :id";

    $this->db->query($query);
    $this->db->bind('id', $data['id']);
    $this->db->bind('nama_kelompok', $data['nama_kelompok']);
    $this->db->bind('jenis_hewan', $data['jenis_hewan']);
    $this->db->execute();

    return $this->db->rowCount();
}

public function getById($id)
{
    $this->db->query("SELECT * FROM kelompok_qurban WHERE id = :id");
    $this->db->bind('id', $id);
    return $this->db->single();
}
public function getKelompokById($id) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getJumlahDonaturByKelompok($id_kelompok) {
        $this->db->query("SELECT COUNT(donatur_id) as jumlah FROM qurban WHERE kelompok_id = :id");
        $this->db->bind('id', $id_kelompok);
        return $this->db->single()['jumlah'];
    }

   public function updateDataKelompok($data)
{
    $query = "UPDATE " . $this->table . " SET 
              nama_kelompok = :nama_kelompok,
              jenis_hewan = :jenis_hewan
              WHERE id = :id";

    $this->db->query($query);
    $this->db->bind('id', $data['id']);
    $this->db->bind('nama_kelompok', $data['nama_kelompok']);
    $this->db->bind('jenis_hewan', $data['jenis_hewan']);
    $this->db->execute();

    return $this->db->rowCount();
}

}
