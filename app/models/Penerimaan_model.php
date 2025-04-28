<?php 

class Penerimaan_model {

	private $table='t_penerimaan';
	private $db;

	public function __construct(){
		$this->db = new database;
	}

	public function getAllPenerimaan()
	{
		$this->db->query("SELECT * FROM t_penerimaan JOIN t_penerima USING(id_penerima) JOIN t_amil USING(id_amil)");
	 		return $this->db->resultSet();
	}

	public function Pembagian()
	{
		include "app/config/koneksi.php";
		$i=0;
		$cek=$db->query("SELECT count(id_penerima) as jumlah_penerima from t_penerima WHERE status='1'");
		while ($lihat=$cek->fetch()){
			$penerima = $lihat['jumlah_penerima'];			
		}

		$tahun = date("Y");
		$total_uang = 0;
		$total_beras = 0;
		$bagi_uang = 0;
		$bagi_beras = 0;

		$cek_uang=$db->query("SELECT * from t_pembayaran WHERE year(tgl_penyerahan)='$tahun'");
		while ($lihat_uang=$cek_uang->fetch()){
			$jml = $lihat_uang['total_pembayaran'];
                $jml2 = strlen($jml);
                if ($jml2 <= 4 ) { 
                	$total_beras = $total_beras+$lihat_uang['total_pembayaran']; 
                } else { 
                    $total_uang = $total_uang+$lihat_uang['total_pembayaran'];
                }

                $i++;
		}

		$total_donasi = 0;
		$cek_donasi=$db->query("SELECT * from t_donasi WHERE year(tgl_donasi)='$tahun' and status_validasi='1'");
		while ($lihat_donasi=$cek_donasi->fetch()){
        $total_donasi = $total_donasi+$lihat_donasi['total_donasi']; 
		}

		$bagi_uang = ($total_uang+$total_donasi)/$penerima;
        $bagi_beras = $total_beras/$penerima;

        // echo "Total Uang: $total_uang";
        // echo "Total Beras: $total_beras";
        // echo "Penerima: $penerima";

        $data[$i]['jumlah_penerima']=$penerima;
        $data[$i]['bagi_uang']=$bagi_uang;
        $data[$i]['bagi_beras']=$bagi_beras;
        $data[$i]['total_uang']=$total_uang;
        $data[$i]['total_beras']=$total_beras;
        $data[$i]['total_donasi']=$total_donasi;



        // echo "Uangnya: $bagi_uang";
        // echo "Berasnya: $bagi_beras";

		return $data;
	}

public function getAllPenerimaan2()
{
    $this->db->query("SELECT SUM(jumlah_penerimaan_uang) as jumlah_uang FROM t_penerimaan");
    $uangResult = $this->db->single();
    $jumlah_uang = isset($uangResult[0]['jumlah_uang']) ? (int)$uangResult[0]['jumlah_uang'] : 0;

    $this->db->query("SELECT SUM(jumlah_penerimaan_beras) as jumlah_beras FROM t_penerimaan");
    $berasResult = $this->db->single();
    $jumlah_beras = isset($berasResult[0]['jumlah_beras']) ? (int)$berasResult[0]['jumlah_beras'] : 0;
    return [
        'jumlah_uang' => $jumlah_uang,
        'jumlah_beras' => $jumlah_beras
    ];
}


	public function getPenerimaanById($id)
	{

		$this->db->query("SELECT * FROM t_penerimaan join t_penerima using(id_penerima) WHERE id_penerimaan=:id");
		$this->db->bind('id',$id);
		return $this->db->single();
	}

	public function tambahDataPenerimaan($data)
	{
		include "app/config/koneksi.php";

		$hitung = count($data['id_penerima']);
		$id_amil = $data['id_amil'];
		$tgl_penerimaan = $data['tgl_penerimaan'];

		// echo $hitung;
		for($a=0; $a<$hitung;$a++){
			$id_penerima[$a]=$data['id_penerima'][$a];
			$jumlah_penerimaan_uang[$a]=$data['jumlah_penerimaan_uang'][$a];
			$jumlah_penerimaan_beras[$a]=$data['jumlah_penerimaan_beras'][$a];
			
			// echo "<hr><p>Tanggal Pembayaran: ".$tgl_penerimaan."<br>Id Amil: ".$id_amil."<br> Id Penerima: ".$id_penerima[$a]."<br> Jumlah Penerimaan Uang: ".$jumlah_penerimaan_uang[$a]."<br> Jumlah Penerimaan Beras: ".$jumlah_penerimaan_beras[$a];

			// ✅ Simpan hanya jika salah satu jumlah > 0
		if ($jumlah_penerimaan_uang[$a] > 0 || $jumlah_penerimaan_beras[$a] > 0) {
			$query1 = "INSERT INTO t_penerimaan
			VALUES ('', :id_amil, :id_penerima, :tgl_penerimaan, :jumlah_penerimaan_uang, :jumlah_penerimaan_beras)";
			$this->db->query($query1);
			$this->db->bind('id_amil', $id_amil);
			$this->db->bind('id_penerima', $id_penerima[$a]);
			$this->db->bind('tgl_penerimaan', $tgl_penerimaan);
			$this->db->bind('jumlah_penerimaan_uang', $jumlah_penerimaan_uang[$a]);
			$this->db->bind('jumlah_penerimaan_beras', $jumlah_penerimaan_beras[$a]);
			$this->db->execute();
		}
		}
		return $this->db->rowCount();

	}
	
	public function hapusDataPenerimaan($id){
		$query = "DELETE FROM ". $this->table ." WHERE id_penerimaan= :id_penerimaan";
		$this->db->query($query);
		$this->db->bind('id_penerimaan',$id);
		$this->db->execute();
		return $this ->db->rowCount();
		
	}

	public function ambilDataPenerimaan($id)
	{
		$this->db->query('SELECT * FROM '.$this-> table .' WHERE id_penerimaan=:id_penerimaan');
		$this->db->bind('id_penerimaan',$id);
		return $this->db->single();
	}

	public function editDataPenerimaan($data){

		include "app/config/koneksi.php";

		$query = "UPDATE t_penerimaan SET 
		id_amil= :id_amil,
		tgl_penerimaan= :tgl_penerimaan,
		jumlah_penerimaan_uang= :jumlah_penerimaan_uang,
		jumlah_penerimaan_beras= :jumlah_penerimaan_beras
		WHERE id_penerimaan = :id_penerimaan ";

		$this->db->query($query);
		$this->db->bind('id_amil', $data['id_amil']);
		$this->db->bind('tgl_penerimaan', $data['tgl_penerimaan']);
		$this->db->bind('jumlah_penerimaan_uang', $data['jumlah_penerimaan_uang']);
		$this->db->bind('jumlah_penerimaan_beras', $data['jumlah_penerimaan_beras']);
		$this->db->bind('id_penerimaan', $data['id_penerimaan']);
		$this->db->execute();

		return $this->db->rowCount();
	}

}