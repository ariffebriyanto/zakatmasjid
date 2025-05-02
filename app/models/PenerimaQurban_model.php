<?php

class PenerimaQurban_model {
    private $table = 'penerima_kurban';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Mendapatkan semua data penerima kurban
    public function getAll() {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY id ASC");
        return $this->db->resultSet();
    }
	
	// Mendapatkan semua data penerima kurban
    public function getAllTukar() {
        $this->db->query("SELECT * FROM {$this->table} WHERE status = 'ditukar' ORDER BY tanggal_tukar DESC");
        return $this->db->resultSet();
    }

    // Mendapatkan data penerima kurban berdasarkan ID
    public function getById($id) {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // Menambahkan penerima kurban baru
    public function tambah($data) {
        $this->db->query("INSERT INTO {$this->table} (nama, alamat, handphone, kupon, tahun, status) VALUES (:nama, :alamat, :handphone, :kupon, :tahun, :status)");
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('handphone', $data['handphone']);
        $this->db->bind('kupon', $data['kupon']);
        $this->db->bind('tahun', $data['tahun']);
        $this->db->bind('status', $data['status']);
        return $this->db->execute();
    }

    // Mengupdate data penerima kurban
    public function update($data) {
        $this->db->query("UPDATE {$this->table} SET nama = :nama, alamat = :alamat, handphone = :handphone, status = :status WHERE id = :id");
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('handphone', $data['handphone']);
        $this->db->bind('status', $data['status']);
        return $this->db->execute();
    }

    // Menghapus data penerima kurban
    public function hapus($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    // Mengupdate status kupon menjadi 'ditukar'
    public function updateStatus($kupon)
{
    $this->db->query("UPDATE penerima_kurban SET status = 'ditukar' WHERE kupon = :kupon AND status = 'belum'");
    $this->db->bind(':kupon', $kupon);
    $this->db->execute();
    return $this->db->rowCount() > 0; // True jika ada yang diupdate
}

	public function getLastIdByTahun($tahun) {
    $this->db->query("SELECT kupon FROM penerima_kurban WHERE RIGHT(kupon, 2) = :tahun ORDER BY kupon DESC LIMIT 1");
    $this->db->bind(':tahun', $tahun);
    $result = $this->db->single();

    if ($result) {
        return $result['kupon']; // jika fetch menggunakan associative array
    } else {
        return null;
    }
}



	public function getByKupon($kupon)
{
    $this->db->query("SELECT * FROM {$this->table} WHERE kupon = :kupon");
    $this->db->bind('kupon', $kupon);
    return $this->db->single();
}
public function getByTahunStatus($tahun, $status) {
    // Mengonversi tahun ke format dua digit
    $tahunFormat2Digit = substr($tahun, -2); // Mengambil dua digit terakhir (misalnya '25' dari '2025')

   $this->db->query("SELECT * FROM penerima_kurban WHERE tahun = :tahun AND status = :status");
	 $this->db->bind(':tahun', $tahunFormat2Digit);
    $this->db->bind(':status', $status);
     return $this->db->resultSet();
}

   // Hitung total berdasarkan status ('belum', 'ditukar')
    public function countStatus($status)
    {
        $this->db->query("SELECT COUNT(*) as total FROM penerima_kurban WHERE status = :status");
        $this->db->bind(':status', $status);
        return $this->db->single()['total'];
    }

    // Hitung total kupon berdasarkan tahun
    public function countByYear($year)
    {
		 $tahunFormat2Digit = substr($year, -2); // Mengambil dua digit terakhir (misalnya '25' dari '2025')
        $this->db->query("SELECT COUNT(*) as total FROM penerima_kurban WHERE tahun = :tahun");
        $this->db->bind(':tahun', $tahunFormat2Digit);
        return $this->db->single()['total'];
    }

}
