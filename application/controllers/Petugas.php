<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_playstation');
		$this->load->model('m_petugas');
		$this->load->model('m_barang');
		$this->load->model('m_memberaktif');
		$this->load->model('m_playstation');
		$this->load->library('form_validation');
	}

	public function index()
	{
		chek_belom_login();

		$data = [
			'title' => 'Aime | Channel PS',
			'log' => $this->m_user->user_login(),
			'ps' => $this->m_playstation->live_channel2()->result(),
			'ren' => $this->m_petugas->live_member3()->result(),

		];
		$this->load->view('template/header_user', $data);
		$this->load->view('template/home');
		$this->load->view('template/footer_user');
	}

	public function start()
	{
		date_default_timezone_set('Asia/Jakarta');
		// $date = date('dmyhis');
		// $kod =  $this->m_petugas->kode_rental();
		$kode = $this->m_petugas->kode_rental();
		$id_ch = $this->input->post('id');
		$waktu = $this->input->post('waktu');

		if ($waktu == "A") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60)); //1 jam kedepan
			$paket = "Paket : 1 Jam";
		} else if ($waktu == "B") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) + (60 * 30)); //1.5 jam kedepan
			$paket = "Paket : 1.5 Jam";
		} else if ($waktu == "C") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) * 2); //2 jam kedepan
			$paket = "Paket : 2 Jam";
		} else if ($waktu == "D") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) * 2 + (60 * 30)); //2.5 jam kedepan
			$paket = "Paket : 2.5 Jam";
		} else if ($waktu == "E") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) * 3); //3 jam kedepan
			$paket = "Paket : 3 Jam";
		} else if ($waktu == "F") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) * 3 + (60 * 30)); //3.5 jam kedepan
			$paket = "Paket : 3.5 Jam";
		} else if ($waktu == "G") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) * 4); //4 jam kedepan
			$paket = "Paket : 4 Jam";
		} else if ($waktu == "H") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 30)); //30 menitkedepan
			$paket = "Paket : 30 Menit";
		} else if ($waktu == "I") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 1)); //30 menitkedepan
			$paket = "Paket : coba";
		} else if ($waktu == "") {
			$wktu = "";
			$paket = "Paket : 0 Jam";
			$this->session->set_flashdata('notiff', '<div class="alert alert-danger" role="alert">"GAGAL START" <br>Pastikan paket yang anda pilih sudah benar</div>');
			redirect('petugas');
		}

		$data = [
			'iduser' => $this->input->post('user'),
			'kode' => $kode,
			'nama' => $this->input->post('nm'),
			// 'tanggal' => date('Y-m-d'),
		];
		$this->db->insert('tb_member', $data);

		if ($waktu == "kosong") {
			$data2 = [
				'idchannel' => $id_ch,
				'kode_member' => $kode,
				'start' => date('Y-m-d H:i:s'),
				'harga_rental' => $this->input->post('harga'),
				'aktif' => 'Y'
			];
			$this->db->insert('tb_rental', $data2);
		} else {
			$data2 = [
				'idchannel' => $id_ch,
				'kode_member' => $kode,
				'start' => date('Y-m-d H:i:s'),
				'stop' => $wktu,
				'harga_rental' => $this->input->post('harga'),
				'aktif' => 'Y'
			];
			$this->db->insert('tb_rental', $data2);

			$data3 = [
				'kode_mem' => $kode,
				'paket' => $paket,
			];
			$this->db->insert('tb_paket', $data3);
		}
		redirect('petugas');
	}

	public function add()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_rt = $this->input->post('id');
		$id_pk = $this->input->post('id_pk');
		$waktu_lama = $this->input->post('waktu_lama');

		$date = date_create($waktu_lama);

		$waktu = $this->input->post('waktu');
		if ($waktu == "A") {
			date_add($date, date_interval_create_from_date_string('1 hours'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //1 jam kedepan
			$paket = "Tambah : 1 Jam";
		} else if ($waktu == "B") {
			date_add($date, date_interval_create_from_date_string('1 hours  30 minute'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //1.5 jam kedepan
			$paket = "Tambah : 1.5 Jam";
		} else if ($waktu == "C") {
			date_add($date, date_interval_create_from_date_string('2 hours'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //2 jam kedepan
			$paket = "Tambah : 2 Jam";
		} else if ($waktu == "D") {
			date_add($date, date_interval_create_from_date_string('2 hours  30 minute'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //2.5 jam kedepan
			$paket = "Tambah : 2.5 Jam";
		} else if ($waktu == "E") {
			date_add($date, date_interval_create_from_date_string('3 hours'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //3 jam kedepan
			$paket = "Tambah : 3 Jam";
		} else if ($waktu == "F") {
			date_add($date, date_interval_create_from_date_string('3 hours  30 minute'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //3.5 jam kedepan
			$paket = "Tambah : 3.5 Jam";
		} else if ($waktu == "G") {
			date_add($date, date_interval_create_from_date_string('4 hours'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //4 jam kedepan
			$paket = "Tambah : 4 Jam";
		} else if ($waktu == "H") {
			date_add($date, date_interval_create_from_date_string('30 minute'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //30 Menit kedepan
			$paket = "Tambah : 30 Menit";
		} else if ($waktu == "I") {
			date_add($date, date_interval_create_from_date_string('1 minute'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //30 Menit kedepan
			$paket = "Tambah : Coba";
		} else if ($waktu == "") {
			$wktu = "";
			$paket = "Tambah : 0 Jam";
			$this->session->set_flashdata('notiff', '<div class="alert alert-danger" role="alert">"GAGAL TAMBAH" <br>Pastikan paket yang anda pilih sudah benar</div>');
			redirect('petugas');
		}

		$data = [
			'stop' => $wktu,
		];
		$this->db->where('id_rental', $id_rt);
		$this->db->update('tb_rental', $data);

		$data2 = [
			'paket' => $paket,
		];
		$this->db->where('id_paket', $id_pk);
		$this->db->update('tb_paket', $data2);
		redirect('petugas');
	}

	public function hapus_start()
	{
		$id_pk = $this->input->post('id_pk');
		if ($id_pk == "KO") {
		} else {
			$this->db->where('id_paket', $id_pk);
			$this->db->delete('tb_paket');
		}

		$id_rt = $this->input->post('id_rt');
		$this->db->where('id_rental', $id_rt);
		$this->db->delete('tb_rental');

		$id_mm = $this->input->post('id_mm');
		$this->db->where('id_member', $id_mm);
		$ss = $this->db->delete('tb_member');
		echo json_encode($ss);
	}

	public function stop()
	{
		date_default_timezone_set('Asia/Jakarta');
		// $a = $this->input->post('id_ch');
		$b = $this->input->post('id_mm');
		$c = $this->input->post('id_rt');
		$id_pk = $this->input->post('id_pk');
		$id_hpk = $this->input->post('id_hpk');
		if ($id_pk == "KO") {
			$data = [
				'stop' => date('Y-m-d H-i-s'),
				'aktif' => 'N'
			];
			$this->db->where('id_rental', $c);
			$this->db->update('tb_rental', $data);
		} else {
			$data = [
				'aktif' => 'N'
			];
			$this->db->where('id_rental', $c);
			$this->db->update('tb_rental', $data);
		}

		$data2 = [
			'sts_bayar' => 'B'
		];
		$this->db->where('id_member', $b);
		$this->db->update('tb_member', $data2);

		if ($id_hpk == "KO") {
		} else {
			$this->db->where('id_paket', $id_hpk);
			$this->db->delete('tb_paket');
		}

		$data3 = [
			'status' => 'N'
		];
		echo json_encode($data3);
	}

	public function hitung_rental()
	{
		date_default_timezone_set('Asia/Jakarta');
		$cek = $this->m_petugas->live_member();

		if (!empty($cek)) { // Jika data sewa ada/ditemukan

			$awal  = date_create($cek->start);
			$akhir = date_create($cek->stop); // waktu sekarang
			$diff  = date_diff($awal, $akhir);
			$thn = $diff->y . ' Tahun, ';
			$bln = $diff->m . ' Bulan, ';
			$hr = $diff->d . ' Hari, ';
			$t = $diff->y;
			$b = $diff->m;
			$h = $diff->d;
			$jamm =  $diff->h;
			$mnt =  $diff->i;
			$dtk =  $diff->s;

			$waktu_awal        = strtotime($cek->start);
			$waktu_akhir    = strtotime($cek->stop);
			//menghitung selisih dengan hasil detik
			$diff    = $waktu_akhir - $waktu_awal;
			//membagi detik menjadi jam
			// $hari = floor($diff / (60 * 60 * 24));

			// $jam    = floor($diff / (60 * 60));

			// $menit2 = $diff - $jam * (60 * 60);
			$menit = floor($diff / 60);
			// $detik = floor($menit / 60);

			$sql = "SELECT * FROM tb_ps WHERE id_ps='$cek->idps' ";
			$w = $this->db->query($sql)->row();

			$total = ($menit / $w->menit) * $cek->harga_rental;


			if ($t > 0) {
				$thn1 = $thn;
			} else {
				$thn1 = "";
			}

			if ($b > 0) {
				$bln1 = $bln;
			} else {
				$bln1 = "";
			}

			if ($h > 0) {
				$hr1 = $hr;
			} else {
				$hr1 = "";
			}

			if ($jamm >= 10) {
				$jamm1 = $jamm;
			} else {
				$jamm1 = "0" . $jamm;
			}

			if ($mnt >= 10) {
				$mnt1 = $mnt;
			} else {
				$mnt1 = "0" . $mnt;
			}

			if ($dtk >= 10) {
				$dtk1 = $dtk;
			} else {
				$dtk1 = "0" . $dtk;
			}
			$timestampg = $thn1 . $bln1 . $hr1 .  $jamm1 .  ":" . $mnt1 . ":" . $dtk1;
			if ($total > 100) {
				$tl_rp = number_format($total, 0, ",", ".");
				$jmldigit = strlen($tl_rp);
				$cekttl = substr($tl_rp, -3);

				if ($jmldigit == 5) {
					$potong = substr($tl_rp, 0, 1);
					$pot = $potong . '000';
				} elseif ($jmldigit == 6) {
					$potong = substr($tl_rp, 0, 2);
					$pot = $potong . '000';
				} elseif ($jmldigit == 7) {
					$potong = substr($tl_rp, 0, 3);
					$pot = $potong . '000';
				} elseif ($jmldigit == 9) {
					$potong = substr($tl_rp, 0, 5);
					$angka2 = str_replace(".", "", $potong);
					$pot = $angka2 . '000';
				}

				if ($cekttl >= 100 && $cekttl <= 500) {
					$genap = 500;
				} else if ($cekttl > 500 && $cekttl <= 999) {
					$genap = 1000;
				} else {
					$genap = 0;
				}


				if ($jmldigit == 3) {
					$gabung = $genap;
				} else {
					$gabung = $pot + $genap;
				}

				$penjualan = $this->db->query("SELECT SUM(jml_total) as total FROM tb_penjualan WHERE kode_pembayaran='$cek->kode'");
				$pen = $penjualan->row();
				$ttlpen = (empty($pen->total)) ? 0 : $pen->total;


				$jml_total = $gabung + $ttlpen;

				// Buat sebuah array
				$callback = array(
					'status' => 'success', // Set array status dengan success
					'kode' => $cek->kode,
					'id_member' => $cek->id_member,
					'id_rental' => $cek->id_rental,
					'nama' => $cek->nama,
					'tl_rp' => "Rp " . number_format($gabung, 0, ",", "."),
					'totalrental' => $gabung,
					'total' => $jml_total,
					'jenis_ps' => $w->jenis_ps,
					'lama' => $timestampg,
					'tl_pj' => "Rp " . number_format($ttlpen, 0, ",", "."),
					'sub_tl_pj' => "Rp " . number_format($jml_total, 0, ",", "."),
				);
				echo json_encode($callback);
			} else {
				$penjualan = $this->db->query("SELECT SUM(jml_total) as total FROM tb_penjualan WHERE kode_pembayaran='$cek->kode'");
				$pen = $penjualan->row();
				$ttlpen = (empty($pen->total)) ? 0 : $pen->total;


				$jml_total = 500 + $ttlpen;

				$callback = array(
					'status' => 'success', // Set array status dengan success
					'kode' => $cek->kode,
					'id_member' => $cek->id_member,
					'id_rental' => $cek->id_rental,
					'nama' => $cek->nama,
					'tl_rp' => "Rp " . number_format(500, 0, ",", "."),
					'totalrental' => 500,
					'total' => $jml_total,
					'jenis_ps' => $w->jenis_ps,
					'lama' => $timestampg,
					'tl_pj' => "Rp " . number_format($ttlpen, 0, ",", "."),
					'sub_tl_pj' => "Rp " . number_format($jml_total, 0, ",", "."),
				);
				echo json_encode($callback);
			}
		} else {
			$callback = array('status' => 'failed'); // set array status dengan failed
			echo json_encode($callback);
		}
	}

	public function simpan_pembayaran_rental()
	{
		date_default_timezone_set('Asia/Jakarta');
		$kode = $this->input->post('kode');
		$id_r = $this->input->post('id_r');
		$data = [
			'lama_rental' => $this->input->post('lamarental'),
		];
		$this->db->where('id_rental', $id_r);
		$this->db->update('tb_rental', $data);

		$byr = $this->input->post('byr');
		$total = $this->input->post('total');
		if ($byr >= $total) {
			$hs = $total;
		} else {
			$hs = $byr;
		}

		$datalap = [
			'tgl' => date('Y-m-d'),
			'tgl_jam' => date('Y-m-d H:i:s'),
			'kode' => $kode,
			'jumlah' => $hs,
		];
		$this->db->insert('tb_laporan', $datalap);

		$cp = $this->m_petugas->cek_laporan_penjualan($kode);
		if (!empty($cp->num_rows())) {
			foreach ($cp->result() as $p) {
				$datalapp = [
					'tgl' => date('Y-m-d'),
					'tgl_jam' => date('Y-m-d H:i:s'),
					'kode' => $p->kode_penjualan,
					'jumlah' => $p->jml_total,
				];
				$this->db->insert('tb_laporan', $datalapp);

				$datap = [
					'sts_bayar' => 'L',
				];
				$this->db->where('id_penjualan', $p->id_penjualan);
				$this->db->update('tb_penjualan', $datap);
			}
		}

		$id_m = $this->input->post('id_m');
		$data2 = [
			'tgl_laporan' => date('Y-m-d'),
			'tgl_pembayaran' => date('Y-m-d H:i:s'),
			'total' => $this->input->post('total'),
			'dibayar' => $this->input->post('byr'),
			'sts_bayar' => 'L',
		];
		$this->db->where('id_member', $id_m);
		$this->db->update('tb_member', $data2);

		echo json_encode($data);
	}

	public function print()
	{
		$kode = $this->input->post('kode');
		$data = [
			'm' => $this->m_petugas->cek_member($kode)->row(),
		];
		$this->load->view('petugas/print_rentals', $data);
	}

	public function edit_rental()
	{
		$kode = $this->input->post('kode');
		$lap = $this->m_petugas->cek_laporan($kode)->row();
		$this->db->where('id_laporan', $lap->id_laporan);
		$this->db->delete('tb_laporan');

		$data = [
			'sts_bayar' => 'B',
		];
		$this->db->where('kode', $kode);
		$this->db->update('tb_member', $data);
		echo json_encode($kode);
	}

	public function hapus_rental()
	{
		$kode = $this->input->post('kode');
		$l = $this->m_petugas->cek_laporan($kode)->row();
		if (!empty($l->kode)) {
			$this->db->where('id_laporan', $l->id_laporan);
			$this->db->delete('tb_laporan');
		}
		$idpk = $this->input->post('idpk');
		if ($idpk != 0) {
			$this->db->where('id_paket', $idpk);
			$this->db->delete('tb_paket');
		}

		$idm = $this->input->post('idm');
		$this->db->where('id_member', $idm);
		$this->db->delete('tb_member');

		$idr = $this->input->post('idr');
		$this->db->where('id_rental', $idr);
		$this->db->delete('tb_rental');
		echo json_encode($idm);
	}



	// penjualan

	public function penjualan()
	{
		chek_belom_login();

		$data = [
			'title' => 'Aime | Data Transaksi Penjualan',
			'log' => $this->m_user->user_login(),
			'mem' => $this->m_petugas->live_member2()->result(),
			'pen' => $this->m_petugas->live_penjualan()->result(),
			'cekcek' => $this->m_petugas->cek_edit_penjualan()->num_rows(),
		];
		$this->load->view('template/header_user', $data);
		$this->load->view('petugas/penjualan');
		$this->load->view('template/footer_user');
	}

	public function cek_kode_barang()
	{
		date_default_timezone_set('Asia/Jakarta');
		$kodep = $this->m_petugas->invoice();
		$cekinputan = $this->input->post('cek');
		$kode = $this->input->post('kd');
		$cek = $this->m_barang->cek_kode_barang($kode)->num_rows();
		$c = $this->m_barang->cek_kode_barang($kode)->row();
		if (empty($cek)) {
			$data = [
				'hasil' => 'gagal',
			];
			echo json_encode($data);
		} else {
			if ($cekinputan == 'baru') {
				$pen = $this->m_petugas->cek_penjualan()->num_rows();
				if (empty($pen)) {
					$datap = [
						'iduser' => $this->session->userdata('id_user'),
						'kode_penjualan' => $kodep,
						'kode_pembayaran' => '-',
						'tgl_penjualan' => date('Y-m-d H:i:s'),
						'tgl_laporan' => date('Y-m-d'),
						'sts_bayar' => 'B',
					];
					$this->db->insert('tb_penjualan', $datap);
				}

				$data = [
					'id'      => $c->kode_barang,
					'qty'     => 1,
					'price'   => $c->harga_barang,
					'name'    => $c->nama_barang,
				];
				$this->cart->insert($data);
				$data = [
					'hasil' => 'success',
				];
				echo json_encode($data);
			} else if ($cekinputan == 'lama') {

				$edit = $this->m_petugas->cek_edit_penjualan()->row();
				$cekker = $this->m_petugas->cek_data_keranjang($edit->kode_penjualan, $kode)->row();
				if (empty($cekker->id_keranjang)) {
					$datae = [
						'kodepenjualan' => $edit->kode_penjualan,
						'kodebarang' => $kode,
						'jml' => 1,
						'harga' => $c->harga_barang,
					];
					$this->db->insert('tb_keranjang', $datae);
					$data = [
						'hasil' => 'success',
					];
					echo json_encode($data);
				} else {
					$qty = $cekker->jml + 1;
					$datae = [
						'jml' => $qty,
					];
					$this->db->where('id_keranjang', $cekker->id_keranjang);
					$this->db->update('tb_keranjang', $datae);
					$data = [
						'hasil' => 'success',
					];
					echo json_encode($data);
				}
			}
		}
	}

	public function live_penjualan()
	{
		$cart = $this->cart->contents();
		$no = 1;
		foreach ($cart as $c) {
			$b = $this->db->query("SELECT * FROM tb_barang WHERE kode_barang='$c[id]' ")->row();
			echo '<tr>';
			echo '<td class="text-center">' . $no++ . '</td>';
			echo '<td>' . $b->kode_barang . '</td>';
			echo '<td>' . $b->nama_barang . '</td>';
			echo '<td class="text-center ">
			<div class="input-group w-100">
				<button data-qty="' . $c['qty'] . '" data-id="' . $c['rowid'] . '" class="btn  btn-danger input-group-text" id="minus">-</button>
				<input type="text" class="form-control form-control-sm text-center  bg-white" readonly style="border:0px" value="' . $c['qty'] . '">
				<button data-qty="' . $c['qty'] . '" data-id="' . $c['rowid'] . '" class="btn  btn-success input-group-text" id="plus">+</button>	
			</div>
			</td>';
			echo '<td class="text-end">' . number_format($b->harga_barang) . '</td>';
			echo '<td class="text-end">' . number_format($c['subtotal'], 0, ',', '.') . '</td>';
			if ($this->session->userdata('level') == 1) {
				echo '<td><button data-id="' . $c['rowid'] . '" data-nm="' . $c['name'] . '"  class="btn btn-sm btn-danger hapus_item"><i class="fa fa-trash"></i></button></td>';
			}
			echo '</tr>';
		}
	}

	public function datapenjualan()
	{
		$ttl = $this->cart->total();
		$pen = $this->m_petugas->cek_penjualan()->row();
		if (empty($pen->kode_penjualan)) {
			$kode = 'AUTO';
		} else {
			$kode = $pen->kode_penjualan;
		}
		$data = [
			'kode' => $kode,
			'ttl' => "Rp " . number_format($ttl, 0, ',', '.'),
			'ttl2' =>  $ttl,
		];
		echo json_encode($data);
	}

	public function tambah()
	{
		$cek = $this->input->post('cek');
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$jml = $qty + 1;
		if ($cek == 'baru') {
			$data = [
				'rowid' => $id,
				'qty' => $jml
			];
			$this->cart->update($data);
			echo json_encode($data);
		} else {
			$data = [
				'jml' => $jml
			];
			$this->db->where('id_keranjang', $id);
			$this->db->update('tb_keranjang', $data);
			echo json_encode($data);
		}
	}

	public function kurang()
	{
		$cek = $this->input->post('cek');
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$jml = $qty - 1;

		if ($cek == 'baru') {
			$data = [
				'rowid' => $id,
				'qty' => $jml
			];
			$this->cart->update($data);
			echo json_encode($data);
		} else {
			$data = [
				'jml' => $jml
			];
			$this->db->where('id_keranjang', $id);
			$this->db->update('tb_keranjang', $data);
			echo json_encode($data);
		}
	}

	public function hapus_item()
	{
		$cek = $this->input->post('cek');
		$item = $this->input->post('item');
		if ($cek == 'baru') {
			$jml_item = count($this->cart->contents());
			if ($jml_item == 1) {

				$pen = $this->m_petugas->cek_penjualan()->row();
				$this->db->where('id_penjualan', $pen->id_penjualan);
				$this->db->delete('tb_penjualan');

				$rowid = $this->input->post('id');
				$this->cart->remove($rowid);
				echo  json_encode($rowid);
			} else {
				$rowid = $this->input->post('id');
				$this->cart->remove($rowid);
				echo  json_encode($rowid);
			}
		} else if ($cek == 'lama') {
			if ($item == 1) {
				$pen = $this->m_petugas->cek_penjualan2()->row();
				$this->db->where('id_penjualan', $pen->id_penjualan);
				$this->db->delete('tb_penjualan');

				$id = $this->input->post('id');
				$this->db->where('id_keranjang', $id);
				$this->db->delete('tb_keranjang');
				echo json_encode($pen);
			} else {
				$id = $this->input->post('id');
				$this->db->where('id_keranjang', $id);
				$this->db->delete('tb_keranjang');
				echo json_encode($id);
			}
		}
	}

	public function simpan_penjualan()
	{
		date_default_timezone_set('Asia/Jakarta');
		$cek = $this->input->post('cek');
		$kode = $this->input->post('kode');
		if ($cek == 'baru') {
			$kodepen = $this->m_petugas->cek_penjualan()->row();
			// pindahkan ke keranjang
			foreach ($this->cart->contents() as $t) {
				$data = [
					'kodepenjualan' => $kodepen->kode_penjualan,
					'kodebarang' => $t['id'],
					'jml' => $t['qty'],
					'harga' => $t['price'],
				];
				$this->db->insert('tb_keranjang', $data);
			}

			$jns_pembayaran = $this->input->post('bayar');
			if ($jns_pembayaran == 'cash') {
				$sts = 'L';
			} else {
				$sts = 'M';
			}
			if ($jns_pembayaran == 'cash') {
				$datalap = [
					'tgl' => date('Y-m-d'),
					'tgl_jam' => date('Y-m-d H:i:s'),
					'kode' => $kode,
					'jumlah' => $this->input->post('ttl'),
				];
				$this->db->insert('tb_laporan', $datalap);
			}

			// update data penjualan
			$datap = [
				'kode_pembayaran' => $this->input->post('bayar'),
				'jml_total' => $this->input->post('ttl'),
				'dibayar' => $this->input->post('dibayar'),
				'sts_bayar' => $sts,
			];
			$this->db->where('id_penjualan', $kodepen->id_penjualan);
			$this->db->update('tb_penjualan', $datap);

			// hapus data cart
			foreach ($this->cart->contents() as $t) {
				$this->cart->remove($t['rowid']);
			}
			echo json_encode($datap);
		} else {
			$jns_pembayaran = $this->input->post('bayar');
			if ($jns_pembayaran == 'cash') {
				$sts = 'L';
			} else {
				$sts = 'M';
			}

			if ($jns_pembayaran == 'cash') {
				$l = $this->m_petugas->cek_laporan($kode)->row();
				$datalap = [
					'tgl' => date('Y-m-d'),
					'tgl_jam' => date('Y-m-d H:i:s'),
					'jumlah' => $this->input->post('ttl'),
				];
				$this->db->where('id_laporan', $l->id_laporan);
				$this->db->update('tb_laporan', $datalap);
			}

			$e = $this->m_petugas->cek_edit_penjualan()->row();
			$datap = [
				'kode_pembayaran' => $this->input->post('bayar'),
				'jml_total' => $this->input->post('ttl'),
				'dibayar' => $this->input->post('dibayar'),
				'sts_bayar' => $sts,
			];
			$this->db->where('id_penjualan', $e->id_penjualan);
			$this->db->update('tb_penjualan', $datap);
			echo json_encode($datap);
		}
	}

	public function edit_penjualan()
	{
		$id = $this->input->post('id');
		$data = [
			'sts_bayar' => 'E',
		];
		$this->db->where('id_penjualan', $id);
		$this->db->update('tb_penjualan', $data);
		echo json_encode($id);
	}

	public function live_edit_penjualan()
	{
		$cek = $this->m_petugas->cek_edit_penjualan()->row();
		if (!empty($cek->kode_penjualan)) {
			$no = 1;
			$keranjang = $this->db->query("SELECT * FROM tb_keranjang WHERE kodepenjualan='$cek->kode_penjualan' ")->result();
			foreach ($keranjang as $c) {
				$b = $this->db->query("SELECT * FROM tb_barang WHERE kode_barang='$c->kodebarang' ")->row();
				echo '<tr>';
				echo '<td class="text-center">' . $no++ . '</td>';
				echo '<td>' . $b->kode_barang . '</td>';
				echo '<td>' . $b->nama_barang . '</td>';
				echo '<td class="text-center ">
			<div class="input-group w-100">
				<button data-qty="' . $c->jml . '" data-id="' . $c->id_keranjang . '" class="btn  btn-danger input-group-text" id="minus">-</button>
				<input type="text" class="form-control form-control-sm text-center  bg-white" readonly style="border:0px" value="' . $c->jml . '">
				<button data-qty="' . $c->jml . '" data-id="' . $c->id_keranjang . '" class="btn  btn-success input-group-text" id="plus">+</button>	
			</div>
			</td>';
				echo '<td class="text-end">' . number_format($c->harga, 0, ',', '.') . '</td>';
				echo '<td class="text-end">' . number_format($c->jml * $c->harga, 0, ',', '.') . '</td>';
				if ($this->session->userdata('level') == 1) {
					echo '<td><button data-id="' . $c->id_keranjang . '" data-nm="' . $b->nama_barang . '"  class="btn btn-sm btn-danger hapus_item"><i class="fa fa-trash"></i></button></td>';
				}
				echo '</tr>';
			}
		} else {
		}
	}

	public function datapenjualanedit()
	{
		$cek = $this->m_petugas->cek_edit_penjualan()->row();
		if (empty($cek->kode_penjualan)) {
			// $kode = 'AUTO';
		} else {
			$jmlker = $this->db->query("SELECT SUM(jml) as jum FROM tb_keranjang WHERE kodepenjualan='$cek->kode_penjualan' GROUP BY kodepenjualan")->row();
			$jml = (empty($jmlker->jum)) ? 0 : $jmlker->jum;

			$jmlbr = $this->db->query("SELECT SUM(jml*harga) as jum FROM tb_keranjang WHERE kodepenjualan='$cek->kode_penjualan' GROUP BY kodepenjualan")->row();
			$jmlb = (empty($jmlbr->jum)) ? 0 : $jmlbr->jum;

			$data = [
				'kode' => $cek->kode_penjualan,
				'ttl' => "Rp " . number_format($jmlb, 0, ',', '.'),
				'ttl2' =>  $jmlb,
				'cart' =>  'lama',
				'item' =>  $jml,
			];
			echo json_encode($data);
		}
	}

	public function hapus_penjualan()
	{
		$kode = $this->input->post('kd');
		$l = $this->m_petugas->cek_laporan($kode)->row();
		if (!empty($l->kode)) {
			$this->db->where('id_laporan', $l->id_laporan);
			$this->db->delete('tb_laporan');
		}

		$keranjang = $this->m_petugas->cek_kode_keranjang($kode)->result();
		foreach ($keranjang as $k) {
			$this->db->where('id_keranjang', $k->id_keranjang);
			$this->db->delete('tb_keranjang');
		}

		$id = $this->input->post('id');
		$this->db->where('id_penjualan', $id);
		$this->db->delete('tb_penjualan');
		echo json_encode($id);
	}

	public function print_penjualan()
	{
		$kode = $this->input->post('kode');
		$data = [
			'p' => $this->m_petugas->cek_kode_penjualan($kode)->row(),
		];
		$this->load->view('petugas/print_penjualan', $data);
	}


	// member
	public function member()
	{
		chek_belom_login();
		date_default_timezone_set('Asia/Jakarta');
		$this->form_validation->set_rules('nik', 'NIK', 'required|trim|is_unique[tb_member_aktif.nik]', ['is_unique' => 'NIK  sudah pernah diinputkan, silahkan pilih NIK lain!']);
		if ($this->form_validation->run() == false) {
			$data = [
				'title' => 'Aime | Data Member',
				'log' => $this->m_user->user_login(),
				'mem' => $this->m_memberaktif->live_member()->result(),
			];
			$this->load->view('template/header_user', $data);
			$this->load->view('petugas/member');
			$this->load->view('template/footer_user');
		} else {
			$kode = $this->m_memberaktif->kode();
			$config['upload_path'] = './uploads/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang image yang dizinkan
			$config['encrypt_name'] = TRUE; //enkripsi nama file
			$this->upload->initialize($config);

			if (!empty($_FILES['gambar']['name'])) {
				if ($this->upload->do_upload('gambar')) {
					//Compress Image
					$foto = $this->upload->data('file_name');
					// $this->_create_thumbs($foto);

					// $b = $this->input->post('harga');
					// $harga = str_replace(",", "", $b);
					$data = [
						'iduserdaf' => $this->session->userdata('id_user'),
						'nik' => $this->input->post('nik'),
						'nama_maktif' => $this->input->post('nama'),
						'hp' => $this->input->post('hp'),
						'alamat' => $this->input->post('alamat'),
						'kode_maktif' => $kode . date('H') . date('my'),
						'askode' => $kode,
						'tgl_daftar' => date('Y-m-d'),
						'gambar' => $foto

					];

					$this->db->insert('tb_member_aktif', $data);
					$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Input data berhasil</div>');
					redirect('petugas/member');
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Gagal input </div>');
					redirect('petugas/member');
				}
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Gambar Masih Kosong </div>');
				redirect('petugas/member');
			}
		}
	}

	public function edit_member()
	{
		$niklama = $this->input->post('niklama');
		$nik = $this->input->post('nik');
		$id = $this->input->post('id');
		if ($niklama != $nik) {
			$ceknik = $this->m_memberaktif->cekdatanik($nik)->num_rows();
			if (!empty($ceknik)) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Gagal Edit member, Pastikan no NIK tidak sama dengan member lain </div>');
				redirect('petugas/member');
			}
		} else {
			$config['upload_path'] = './uploads/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang image yang dizinkan
			$config['encrypt_name'] = TRUE; //enkripsi nama file
			$this->upload->initialize($config);

			if (!empty($_FILES['gambar']['name'])) {
				if ($this->upload->do_upload('gambar')) {
					// $gbr = $this->upload->data();
					//Compress Image
					$foto = $this->upload->data('file_name');
					$fotolama = $this->input->post('filelama');
					$path = './uploads/';

					@unlink($path . $fotolama);

					$data = [
						'nik' => $this->input->post('nik'),
						'nama_maktif' => $this->input->post('nama'),
						'hp' => $this->input->post('hp'),
						'alamat' => $this->input->post('alamat'),
						'gambar' => $foto
					];

					$this->db->where('id_member_aktif', $id);
					$this->db->update('tb_member_aktif', $data);
					$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil</div>');
					redirect('petugas/member');
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Gagal input </div>');
					redirect('petugas/member');
				}
			} else {
				$data = [
					'nik' => $this->input->post('nik'),
					'nama_maktif' => $this->input->post('nama'),
					'hp' => $this->input->post('hp'),
					'alamat' => $this->input->post('alamat'),
				];
				$this->db->where('id_member_aktif', $id);
				$this->db->update('tb_member_aktif', $data);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil</div>');
				redirect('petugas/member');
			}
		}
	}

	public function hapus_maktif()
	{
		$a = $this->input->post('id');
		$kode = $this->input->post('kode');
		$cek =  $this->m_memberaktif->ceksewaps($kode)->num_rows();
		if ($cek > 0) {
			$data = [
				'hasil' => 'gagal',
			];
			echo json_encode($data);
		} else {
			$data = [
				'hasil' => 'success',
			];
			$this->db->where('id_member_aktif', $a);
			$this->db->delete('tb_member_aktif');
			echo json_encode($data);
		}
	}

	public function cetak_kartu($nik)
	{
		chek_belom_login();
		$data = [
			'title' => 'Aime | Cetak Data Member',
			'log' => $this->m_user->user_login(),
			'm' => $this->m_memberaktif->cekdatanik($nik)->row(),
		];
		$this->load->view('template/header_user', $data);
		$this->load->view('petugas/kartu_member');
		$this->load->view('template/footer_user');
	}


	// data sewa

	public function sewa()
	{
		chek_belom_login();

		$data = [
			'title' => 'Aime | Data Sewa Harian',
			'log' => $this->m_user->user_login(),
			'swa' => $this->m_playstation->live_sewa_group()->result(),
			'tran' => $this->m_memberaktif->live_sewa()->result(),
			'kdsw' => $this->m_memberaktif->live_pskembali()->result(),
			'list' => $this->m_playstation->live_sewa()->result(),
		];
		$this->load->view('template/header_user', $data);
		$this->load->view('petugas/sewa');
		$this->load->view('template/footer_user');
	}

	public function cekmemberaktif()
	{
		$id = $this->input->post('id');
		$cek = $this->m_memberaktif->cekkodemember($id)->row();
		if (empty($cek->kode_maktif)) {
			$data = [
				'hasil' => 'kosong',
			];
			echo json_encode($data);
		} else {
			$data = [
				'hasil' => 'ada',
				'an' => $cek->nama_maktif,
				'alamat' => $cek->alamat,
			];
			echo json_encode($data);
		}
	}

	public function cekps()
	{
		$id = $this->input->post('id');
		$cek = $this->m_playstation->cekps($id)->row();
		$data = [
			'harga' => "Rp " . number_format($cek->harga_sewa, 0, ',', '.'),
			'hrgas' => $cek->harga_sewa,
		];
		echo json_encode($data);
	}

	public function cekhari()
	{
		$hr = $this->input->post('hari');
		$ps = $this->input->post('ps');
		$sisa = $this->input->post('sisa');
		$cek = $this->m_playstation->cekjmlhari($hr, $ps)->row();
		$kos = $this->m_playstation->cekps($ps)->row();
		if (empty($cek->id_ps)) {
			$ttl = $kos->harga_sewa * $hr;
			$jml = $ttl + $sisa;
			$data = [
				'harga' => "Rp " . number_format($ttl, 0, ',', '.'),
				'hrgas' => $ttl,
				'ttlrp' => "Rp " . number_format($jml, 0, ',', '.'),
				'ttl' => $jml,
			];
			echo json_encode($data);
		} else {
			$jml = $cek->harga_sewa + $sisa;
			$data = [
				'harga' => "Rp " . number_format($cek->harga_sewa, 0, ',', '.'),
				'hrgas' => $cek->harga_sewa,
				'ttlrp' => "Rp " . number_format($jml, 0, ',', '.'),
				'ttl' => $jml,
			];
			echo json_encode($data);
		}
	}

	public function cek_harga_manual()
	{
		$tgla = $this->input->post('tgl1');
		$tglb = $this->input->post('tgl2');
		$ps = $this->input->post('ps');

		$tgl1 = new DateTime($tgla);
		$tgl2 = new DateTime($tglb);
		$hr = $tgl2->diff($tgl1);

		$cek = $this->m_playstation->cekjmlhari($hr->d, $ps)->row();
		$kos = $this->m_playstation->cekps($ps)->row();
		if (empty($cek->id_ps)) {
			$ttl = $kos->harga_sewa * $hr->d;
			$data = [
				'harga' => "Rp " . number_format($ttl, 0, ',', '.'),
				'hrgas' => $ttl,
				'hari' => $hr->d . " Hari",
				'harias' => $hr->d,
			];
			echo json_encode($data);
		} else {
			$data = [
				'harga' => "Rp " . number_format($cek->harga_sewa, 0, ',', '.'),
				'hrgas' => $cek->harga_sewa,
				'hari' => $hr->d . " Hari",
				'harias' => $hr->d,
			];
			echo json_encode($data);
		}
	}

	public function simpansewaps()
	{
		date_default_timezone_set('Asia/Jakarta');
		$kode = $this->m_memberaktif->kodesewa();
		$hari = $this->input->post('hari');

		$harga = $this->input->post('hrg');
		$dibayar = $this->input->post('dby');
		if ($dibayar >= $harga) {
			$lap = $harga;
		} else {
			$lap = $dibayar;
		}

		// input data laporan
		if ($dibayar != 0) {
			$datalap = [
				'tgl' => date('Y-m-d'),
				'tgl_jam' => date('Y-m-d H:i:s'),
				'kode' => $kode,
				'jumlah' => $lap,
			];
			$this->db->insert('tb_laporan', $datalap);
		}

		// menentukan hari berikutnya dari tanggal hari ini
		$sampai_tgl = date('Y-m-d H:i:s', time() + (60 * 60 * 24 * $hari));
		$data = [
			'kode_sewa' => $kode,
			'idps' => $this->input->post('idps'),
			'iduser' => $this->session->userdata('id_user'),
			'idmember' => $this->input->post('kode'),
			'dari_tanggal' => date('Y-m-d H:i:s'),
			'sampai_tanggal' => $sampai_tgl,
			'jml_hari' => $this->input->post('hari'),
			'total' => $this->input->post('hrg'),
			'dibayar' => $lap,
			'dbyasli' => $this->input->post('dby'),
		];
		$this->db->insert('tb_sewaps', $data);
		echo json_encode($kode);
	}

	public function print_sewaps()
	{
		$kode = $this->input->post('kode');
		$data = [
			'm' => $this->m_memberaktif->cek_kode_sewaps($kode)->row(),
		];
		$this->load->view('petugas/print_sewaps', $data);
	}

	public function simpan_tambah_sewa()
	{
		date_default_timezone_set('Asia/Jakarta');
		$kode = $this->input->post('kd');
		$c = $this->m_memberaktif->cek_kode_sewaps($kode)->row();
		$kodet = $this->m_memberaktif->kodetambahsewa();

		$hari = $this->input->post('hr');
		$tgl = $this->input->post('tgl');
		$sisa = $this->input->post('sisa');
		$hrg = $this->input->post('hrg');
		$byr = $this->input->post('byr');


		$jml = $sisa + $hrg;
		// $jml3 = $jml - $byr;
		if ($byr >= $jml) {
			$cek_bayar = $jml;
		} else {
			$cek_bayar = $byr;
		}


		// input data laporan
		if ($byr != 0) {
			$datalap = [
				'tgl' => date('Y-m-d'),
				'tgl_jam' => date('Y-m-d H:i:s'),
				'kode' => $kode,
				'jumlah' => $cek_bayar,
			];
			$this->db->insert('tb_laporan', $datalap);
		}



		// tambah sewa
		$data2 = [
			'kodesewa' => $kode,
			'kode_tambah' => $kodet,
			'jml_hari' => $hari,
			'sisa_terakhir' => $sisa,
			'total' => $this->input->post('hrg'),
			'dibayar' => $this->input->post('byr'),
			'iduser' => $this->session->userdata('id_user'),
			'tgl_tambah' => date('Y-m-d H:i:s'),
		];
		$this->db->insert('tb_sewatambah', $data2);
		// $idtambah = $this->db->insert_id();

		// uypdate tgl
		$timestamp = strtotime($tgl);
		$jmhr = +$hari . 'day';
		$sampai_tgl = date('Y-m-d H:i:s', strtotime($jmhr, $timestamp));

		$cekharga = $hrg + $c->total;
		$cekdibayr = $cek_bayar + $c->dibayar;

		$id = $this->input->post('id');
		$hri = $c->jml_hari + $hari;
		$data = [
			'sampai_tanggal' => $sampai_tgl,
			'jml_hari' => $hri,
			'total' => $cekharga,
			'dibayar' => $cekdibayr,
		];
		$this->db->where('id_sewaps', $id);
		$this->db->update('tb_sewaps', $data);
		echo json_encode($kode);
	}



	public function cari()
	{
		$kata = $this->input->post('kata');
		$member = $this->m_memberaktif->carimember($kata)->num_rows();
		if ($member > 0) {
			$ada = $this->m_memberaktif->carimember($kata)->result();
			foreach ($ada as $a) {

				echo '<tr>';
				echo '<td>' . $a->kode_maktif . '</td>';
				echo '<td>' . $a->nama_maktif . '</td>';
				echo '<td>' . $a->hp . '</td>';
				echo '<td>' . $a->alamat . '</td>';
				echo '<td><button data-kd="' . $a->kode_maktif . '" data-nm="' . $a->nama_maktif . '" data-alm="' . $a->alamat . '" data-bs-dismiss="modal"  class="btn btn-dark w-100 btn_pilih"><i class="fa fa-edit me-2"></i> PILIH</button></td>';
				echo '</td>';
			}
		} else {
			echo '<tr><td class="text-center "colspan="5" ><h1 class="text-dark">Data tidak ditemukan</h1></td></tr>';
		}
	}

	public function detailsewa()
	{
		$kode = $this->input->post('kode');
		$data = [
			't' => $this->m_memberaktif->cek_kode_sewaps($kode)->row(),
		];
		$this->load->view('petugas/detail_sewaps', $data);
	}

	public function ps_kembali()
	{
		date_default_timezone_set('Asia/Jakarta');
		$kode = $this->input->post('kode');
		$kodek = $this->m_memberaktif->kodesewakembali();
		$sw = $this->m_memberaktif->cek_kode_sewaps($kode)->row();
		if ($sw->total == $sw->dibayar) {
			$id = $sw->id_sewaps;
			$data = [
				'sts_sewa' => 'K',
			];
			$this->db->where('id_sewaps', $id);
			$this->db->update('tb_sewaps', $data);

			$data = [
				'kode_sk' => $kodek,
				'kodesewa' => $kode,
				'tgl_sk' => date('Y-m-d H:i:s'),
				'iduser' => $this->session->userdata('id_user'),
				'sisa_pembayaran' => 0,
				'dibayar' => 0,
			];
			$this->db->insert('tb_sewakembali', $data);



			$data2 = [
				'hasil' => 'lunas',
			];
			echo json_encode($data2);
		} else {
			$data2 = [
				'hasil' => 'belumlunas',
				'kode' => $kode,
				'harga' => $sw->total,
				'dibayar' => $sw->dibayar,
				'sisa' => $sw->total - $sw->dibayar,

				'hargarp' => "Rp " . number_format($sw->total),
				'dibayarrp' => "Rp " . number_format($sw->dibayar),
				'sisarp' => "Rp " . number_format($sw->total - $sw->dibayar),

				'memberid' => $sw->idmember,
				'namamemberpl' => $sw->nama_maktif,
				'jnsps' => $sw->jenis_ps,
				'jmlhari' => $sw->jml_hari,
			];
			echo json_encode($data2);
		}
	}

	public function updatepelunasan()
	{
		date_default_timezone_set('Asia/Jakarta');
		$kode = $this->input->post('kode');
		$kodek = $this->m_memberaktif->kodesewakembali();
		$sw = $this->m_memberaktif->cek_kode_sewaps($kode)->row();


		$ttl = $this->input->post('sisa');
		$dby = $this->input->post('dby');

		if ($dby >= $ttl) {
			$sts = "K";
			$ceklap = $ttl;
			$updibayar = $sw->total;
		} else {
			$sts = "A";
			$ceklap = $dby;
			$updibayar = $sw->dibayar + $dby;
		}

		$id = $sw->id_sewaps;
		$data = [
			'sts_sewa' => $sts,
			'dibayar' => $updibayar,
		];
		$this->db->where('id_sewaps', $id);
		$this->db->update('tb_sewaps', $data);

		// input data laporan
		if ($dby != 0) {
			$datalap = [
				'tgl' => date('Y-m-d'),
				'tgl_jam' => date('Y-m-d H:i:s'),
				'kode' => $kode,
				'jumlah' => $ceklap,
			];
			$this->db->insert('tb_laporan', $datalap);
		}

		$datak = [
			'kode_sk' => $kodek,
			'kodesewa' => $kode,
			'tgl_sk' => date('Y-m-d H:i:s'),
			'iduser' => $this->session->userdata('id_user'),
			'sisa_pembayaran' => $ttl,
			'dibayar' => $dby,
		];
		$this->db->insert('tb_sewakembali', $datak);
		echo json_encode($kode);
	}

	public function print_pelunasan()
	{
		$kode = $this->input->post('kode');
		$data = [
			'm' => $this->m_memberaktif->cek_kode_sewaps($kode)->row(),
		];
		$this->load->view('petugas/print_pelunasan', $data);
	}

	public function hapus_sewaps()
	{
		$kode = $this->input->post('kode');
		$id = $this->input->post('id');
		$cek = $this->m_memberaktif->cekkodekembali($kode)->num_rows();
		if ($cek > 0) {
			$ada = $this->m_memberaktif->cekkodekembali($kode)->result();
			foreach ($ada as $a) {
				$this->db->where('id_sewakembali ', $a->id_sewakembali);
				$this->db->delete('tb_sewakembali');
			}
		}

		$cektam = $this->m_memberaktif->cekkodetambah($kode)->num_rows();
		if (!empty($cektam)) {
			$tam = $this->m_memberaktif->cekkodetambah($kode)->result();
			foreach ($tam as $t) {
				$this->db->where('id_sewatambah ', $t->id_sewatambah);
				$this->db->delete('tb_sewatambah');
			}
		}

		$ceksewa = $this->m_petugas->cek_laporan($kode)->result();
		foreach ($ceksewa as $cs) {
			$this->db->where('id_laporan ', $cs->id_laporan);
			$this->db->delete('tb_laporan');
		}

		$this->db->where('id_sewaps', $id);
		$this->db->delete('tb_sewaps');
		echo json_encode($kode);
	}


	// invoice

	public function invoice()
	{
		chek_belom_login();

		$data = [
			'title' => 'Aime | Invoice Harian',
			'log' => $this->m_user->user_login(),
			'sft' => $this->m_user->live_shift()->result(),
		];
		$this->load->view('template/header_user', $data);
		$this->load->view('petugas/invoice');
		$this->load->view('template/footer_user');
	}

	public function cari_data_shift()
	{
		$id = $this->input->post('id');
		if (!empty($id)) {
			$t = $this->m_petugas->cek_shift($id)->row();
			$data = [
				'm' => $this->m_petugas->cek_shift($id)->row(),
				'log' => $this->m_user->user_login(),
			];
			$this->load->view('petugas/cek_invoice', $data);
		} else {
			echo 'Data tidakditemukan....';
		}
	}


	// password
	public function ubah_password()
	{

		$id = $this->input->post('id');
		$passlm = $this->input->post('passlm');


		$pass_lama = $this->input->post('pass_lama');
		$pass1 = $this->input->post('pass1');
		$pass2 = $this->input->post('pass2');
		if (!password_verify($pass_lama, $passlm)) {
			// pass lama salah
			$data = [
				'hasil' => 'gagal',
				'isi' => 'Password lama salah',
			];
			echo json_encode($data);
		} else if ($pass_lama == $pass1) {
			// pas baru dan lama sama
			$data = [
				'hasil' => 'gagal',
				'isi' => 'Password baru tidak boleh sama dengan yang lama!',
			];
			echo json_encode($data);
		} else if ($pass1 < 6) {
			// pass kurang dari 6 digit
			$data = [
				'hasil' => 'gagal',
				'isi' => 'Password baru tidak boleh kurang dari 6 digit!',
			];
			echo json_encode($data);
		} else if ($pass1 != $pass2) {
			// konfirm pass tidak sama
			$data = [
				'hasil' => 'gagal',
				'isi' => 'Konfoirmasi Password baru tidak sama',
			];
			echo json_encode($data);
		} else {
			$pass_hash = password_hash($pass1, PASSWORD_DEFAULT);

			$this->db->set('password', $pass_hash);
			$this->db->where('id_user', $id);
			$this->db->update('tb_user');

			$data = [
				'hasil' => 'berhasil',
				'isi' => 'Password Anda berhasil dirubah...',
			];
			echo json_encode($data);
		}
	}
}
