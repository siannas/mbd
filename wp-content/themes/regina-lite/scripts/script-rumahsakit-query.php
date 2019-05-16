<?php
	global $wpdb;
	$query;

	function lihat_list_obat(){
		return "SELECT * FROM obat;";		
	}

	function statistik_obat(){
		return "SELECT * FROM statistik_obat;";
	}

	function statistik_menjaga(){
		return "SELECT * FROM statistik_menjaga;";
	}

	function top_pegawai(){
		return "SELECT topPegawai();";
	}

	function cari_yang_kurang_mampu(){
		return "CALL cari_yang_kurang_mampu();";
	}

	function cari_kamar_populer(){
		return "SELECT topKamar();";
	}

	function cari_yang_menginap(){
		return "CALL cari_yang_menginap();";
	}

	function cek_harga_kamar(){
		return "SELECT * FROM kamar_pasien;";
	}
	
	function cek_kamar(){
		return "SELECT id_kamar, id_pasien FROM kamar_pasien JOIN menginap USING(id_kamar);";
	}

	function annas_4a(){
		return "SELECT * FROM histori_harga_kamar;";
	}

	function annas_4b(){
		return "SELECT * FROM histori_harga_obat;";
	}

	function annas_5a(){
		return "SELECT nama_pasien, tipe_pembayaran, total_pembayaran FROM pasien JOIN pembayaran USING(id_pasien) WHERE tipe_pembayaran LIKE 'Kartu Kredit';";
	}

	function annas_5b(){
		return "SELECT nama_pegawai, nama_pasien FROM pegawai LEFT JOIN (menjaga  JOIN pasien USING (id_pasien)) USING(id_pegawai);";
	}

	function annas_6(){
		return "SELECT * FROM kamar_pasien WHERE upper(tipe_kamar)='BASIC';";
	}

	function chaniyah_1a(){
		$data = "CREATE OR REPLACE VIEW 1a AS
			SELECT DISTINCT peg.*,m.tanggal_periksa FROM pegawai peg,memeriksa m, pasien pa
			WHERE (peg.id_pegawai=m.id_pegawai) AND (pa.id_pasien=m.id_pasien) AND 
			(EXTRACT(DAY FROM m.tanggal_periksa)<>'12') AND (EXTRACT(DAY FROM m.tanggal_periksa)<>'21');";

		return "SELECT * FROM 1a;";
	}

	function chaniyah_1b(){
		$data = "CREATE OR REPLACE VIEW `1b` AS
				SELECT pa.* FROM pasien pa
				WHERE NOT EXISTS(SELECT i.id_pasien FROM menginap i WHERE i.id_pasien=pa.id_pasien)";

		// $wpdb->query($wpdb->prepare($data));

		return "SELECT * FROM `1b`;";
	}

	function chaniyah_2a(){
		return "SELECT tot_priksa('PS020');";
	}

	function chaniyah_2b(){
		return "SELECT obat_laku();";
	}

	
	function chaniyah_3a(){
		return "CALL bkn_tunai();";
	}

	function chaniyah_3b(){
		return "CALL ubah_tunai();";
	}

	function chaniyah_4a(){
		return "SELECT * FROM baru;";
	}

	function chaniyah_4b(){
		return "SELECT * FROM update_pasien_priksa;";
	}

	function chaniyah_5a(){
		return "SELECT DISTINCT pa.*,i.tanggal_masuk,i.tanggal_keluar,DATEDIFF(i.tanggal_keluar,i.tanggal_masuk) AS lama_inap FROM memeriksa m JOIN pasien pa USING(id_pasien)
				JOIN menginap i USING(id_pasien)
				WHERE m.status='Rawat inap'
				ORDER BY pa.id_pasien ASC;";
	}

	function chaniyah_5b(){
		return "SELECT DISTINCT pa.*,inap_kmr.id_kamar FROM pasien pa LEFT JOIN (SELECT DISTINCT *
				FROM menginap JOIN kamar_pasien USING(id_kamar))inap_kmr USING(id_pasien);";
	}

	function chaniyah_6(){
		return "SELECT * FROM obat WHERE UPPER(nama_obat)='AMOXICILIN';";
	}

	function karina_1a(){
		return "SELECT * FROM pasien_kalazion;";
	}

	function karina_1b(){
		// $data = "CREATE OR REPLACE VIEW `1b` AS
		// 		SELECT pa.* FROM pasien pa
		// 		WHERE NOT EXISTS(SELECT i.id_pasien FROM menginap i WHERE i.id_pasien=pa.id_pasien)";

		// $wpdb->query($wpdb->prepare($data));

		return "SELECT * FROM `pasien_kamar_dawai`;";
	}

	function karina_2a(){
		return "SELECT pendapatan_2018();";
	}

	function karina_2b(){
		return "SELECT hitung_pasien_kamar('Melati');";
	}

	
	function karina_3a(){
		return "CALL diskon_pembayaran();";
	}

	function karina_3b(){
		return "CALL data_pasien();";
	}

	function karina_4a(){
		return "SELECT * FROM histori_data_pasien;";
	}

	function karina_4b(){
		return "SELECT * FROM histori_data_periksa;";
	}

	function karina_5a(){
		return "SELECT COUNT(m.id_pasien) AS Jumlah
				FROM pasien p JOIN memeriksa m USING (id_pasien)
				WHERE p.nama_pasien='David Laksmana' AND m.status='Rawat jalan';";
	}

	function karina_5b(){
		return "SELECT DISTINCT p.*, o.nama_obat
				FROM pasien p LEFT JOIN (membeli m JOIN obat o USING (id_obat)) USING (id_pasien);";
	}

	function karina_6(){
		return "SELECT * FROM pembayaran WHERE upper(id_pegawai)='PG022';";
	}

	if(isset($_GET['selector'])){
		$name = $_GET['selector'];
	
		switch($name){
			case 'cari obat':
				$query = lihat_list_obat();
				break;
			case 'annas 1a':
				echo '<h3>Membuat view obat yang paling sering terjual</h3>';
				$query = statistik_obat();
				break;
			case 'annas 1b':
				echo '<h3>Membuat view pegawai yang menjaga di kamar VVIP</h3>';
				$query = statistik_menjaga();
				break;
			case 'annas 2a':
				echo '<h3>Membuat procedure untuk mencari pegawai yang paling sering menjaga</h3>';
				$query = top_pegawai();
				break;
			case "annas 2b":
				echo '<h3>Membuat fungsi yang mengembalikan kamar mana yang paling sering dipilih pasien</h3>';
				$query = cari_kamar_populer();
				break;
			case "annas 3a":
				echo '<h3>Membuat fungsi untuk menggolongkan pasien yang perlu mendapat bantuan apabila rawat inap di kelas basic dan tagihan di atas 700.000</h3>';
				$query = cari_yang_kurang_mampu();
				break;
			case "annas 3b":
				echo '<h3>Membuat procedure untuk mencari pasien yang sedang rawat inap</h3>';
				$query = cari_yang_menginap();
				break;
			case "annas 4a":
				echo '<h3>Trigger untuk memasukkan data perubahan harga kamar beserta waktu di tabel baru</h3>';
				$query = annas_4a();
				break;
			case "annas 4b":
				echo '<h3>Trigger untuk memasukkan data perubahan harga obat beserta waktu di tabel baru</h3>';
				$query = annas_4b();
				break;	
			case "cek harga kamar":
				$query = cek_harga_kamar();
				break;
			case "annas 5a":
				echo '<h3>Tampilkan nama pasien dan daftar kredit pasien yang telah dibayarkan</h3>';
				$query = annas_5a();
				break;
			case "annas 5b":
				echo '<h3>Tampilkan data pegawai dan pasien yang pernah dia jaga</h3>';
				$query = annas_5b();
				break;
			case "annas 6":
				echo '<h3>Membuat index pada tabel kamar pasien menggunakan jenis kamar dan fungsi yang dapat mendeteksi jenis kamar dengan huruf besar</h3>';
				$query = annas_6();
				break;
			case "chaniyah 1a":
				echo '<h3>View yang menampilkan pegawai yang memeriksa pasien tidak pada tanggal 12 maupun tanggal 21</h3>';
				$query = chaniyah_1a();
				break;
			case "chaniyah 1b":
				echo '<h3>View yang menampilkan data pasien yang tidak menginap</h3>';
				$query = chaniyah_1b();
				break;
			case "chaniyah 2a":
				echo '<h3>Fungsi untuk mengembalikan jumlah berapa kali pasien di periksa dengan input id pasiennya</h3>';
				$query = chaniyah_2a();
				break;
			case "chaniyah 2b":
				echo '<h3>Fungsi untuk mengembalikan stok obat yang paling sering dibeli</h3>';
				$query = chaniyah_2b();
				break;
			case "chaniyah 3a":
				echo '<h3>Procedure untuk menghitung jumlah pasien yang tidak membayar secara tunai</h3>';
				$query = chaniyah_3a();
				break;
			case "chaniyah 3b":
				echo '<h3>Procedure untuk mengubah tipe pembayaran menjadi tunai jika total dari seluruh pembayarannya kurang dari 90.000</h3>';
				$query = chaniyah_3b();
				break;
			case "chaniyah 4a":
				echo '<h3>Trigger untuk menghapus obat  yang diinginkan pada tabel obat, jika obat dihapus akan ada tabel yang memunculkan  pesan “obat telah habis”</h3>';
				$query = chaniyah_4a();
				break;
			case "chaniyah 4b":
				echo '<h3>Trigger untuk mengubah status memeriksa menjadi “sudah sembuh” pada tabel update_pasien_priksa ketika diagnosa menjadi null karena pasien dianggap sudah sembuh saat diagnosa nya sudah tidak ada</h3>';
				$query = chaniyah_4b();
				break;
			case "chaniyah 5a":
				echo '<h3>Tampilkan berapa lama pasien menginap pada pasien yang ber status rawat inap</h3>';
				$query = chaniyah_5a();
				break;
			case "chaniyah 5b":
				echo '<h3>Tampilkan data pasien dan kamar yang pernah dia inapi</h3>';
				$query = chaniyah_5b();
				break;
			case "chaniyah 6":
				echo '<h3>Membuat index dengan menggunakan fungsi yang dapat mendeteksi nama obat dengan huruf besar</h3>';
				$query = chaniyah_6();
				break;
			case "karina 1a":
				echo '<h3>View yang menampilkan data pasien yang pernah atau sedang menderita penyakit kalazion</h3>';
				$query = karina_1a();
				break;
			case "karina 1b":
				echo '<h3>View yang menampilkan data pasien yang pernah menginap di kamar Dawai</h3>';
				$query = karina_1b();
				break;
			case "karina 2a":
				echo '<h3>fungsi untuk menghitung total pendapatan di tahun 2018</h3>';
				$query = karina_2a();
				break;
			case "karina 2b":
				echo '<h3>Fungsi untuk menghitung banyaknya pasien yang pernah menginap di kamar tertentu, menggunakan input nama kamar</h3>';
				$query = karina_2b();
				break;
			case "karina 3a":
				echo '<h3>Procedure untuk memberi diskon 10% bagi yang menginap di kamar Meranti</h3>';
				$query = karina_3a();
				break;
			case "karina 3b":
				echo '<h3>Procedure untuk menampilkan data pasien yang paling sering periksa</h3>';
				$query = karina_3b();
				break;
			case "karina 4a":
				echo '<h3>Tabel log yang dapat menyimpan histori tabel pasien baik insert, update maupun delete, simpan juga tanggal dan statusnya. Untuk update simpan data sebelum dan setelah data diupdate</h3>';
				$query = karina_4a();
				break;
			case "karina 4b":
				echo '<h3>Tabel log yang dapat menyimpan histori tabel memeriksa baik insert, update maupun delete, simpan juga tanggal dan statusnya. Untuk update simpan data sebelum dan setelah data diupdate</h3>';
				$query = karina_4b();
				break;
			case "karina 5a":
				echo '<h3>Menghitung berapa kali pasien tertentu periksa dan berstatus rawat jalan</h3>';
				$query = karina_5a();
				break;
			case "karina 5b":
				echo '<h3>Menampilkan seluruh data pasien beserta obat yang dia beli</h3>';
				$query = karina_5b();
				break;
			case "karina 6":
			echo '<h3>Membuat index pada tabel pembayaran untuk mencari data pembayaran menggunakan id pegawai dan id pegawai ini bisa di deteksi walau menggunakan huruf kecil</h3>';
				$query = karina_6();
				break;
		}
	}
	
?>