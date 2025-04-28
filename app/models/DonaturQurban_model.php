<?php
class DonaturQurban_model {

    private $table = 'donatur_qurban';
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Menambah data donatur qurban
    public function tambahDonaturQurban($data) {
        $query = "INSERT INTO {$this->table} (id_donatur, id_qurban, jumlah_donatur) 
                  VALUES (:id_donatur, :id_qurban, :jumlah_donatur)";
        
        $this->db->query($query);
        $this->db->bind('id_donatur', $data['id_donatur']);
        $this->db->bind('id_qurban', $data['id_qurban']);
        $this->db->bind('jumlah_donatur', $data['jumlah_donatur']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // Mendapatkan data donatur_qurban berdasarkan id_qurban
    public function getDonaturQurbanByQurbanId($id_qurban) {
        $this->db->query("SELECT * FROM {$this->table} WHERE id_qurban = :id_qurban");
        $this->db->bind('id_qurban', $id_qurban);
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

}
?>
