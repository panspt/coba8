<?php
$cektambah = $this->db->query("SELECT * FROM tb_sewatambah JOIN tb_user ON tb_user.id_user=tb_sewatambah.iduser WHERE kodesewa='$t->kode_sewa'");

$dt = $this->db->query("SELECT SUM(jml_hari) as hr, SUM(total) as ttl FROM tb_sewatambah  WHERE kodesewa='$t->kode_sewa' GROUP BY kodesewa")->row();
$cekhari = (($cektambah->num_rows() > 0) ? $t->jml_hari - $dt->hr : $t->jml_hari);
$cektotal = (($cektambah->num_rows() > 0) ? $t->total - $dt->ttl : $t->total);
?>
<div class="modal-header">
    <h5 class="modal-title text-secondary" id="staticBackdropLabel">DETAIL MEMBER SEWA PS <span class="float-end"> - KODE : <?= $t->kode_sewa; ?></span></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body ">
    <div class="table-responsive" style="height: 500px;">
        <table style="width: 100%; " class="text-dark">
            <tr>
                <td width="40%">ID MEMBER</td>
                <td width="3%">:</td>
                <td><?= $t->kode_maktif; ?></td>
            </tr>

            <tr>
                <td>NAMA MEMBER</td>
                <td width="3%">:</td>
                <td><?= $t->nama_maktif; ?></td>
            </tr>
            <tr>
                <td>NO TELP-/HP</td>
                <td width="3%">:</td>
                <td><?= $t->hp; ?></td>
            </tr>
            <tr style="vertical-align: top;">
                <td>ALAMAT MEMBER</td>
                <td width="3%">:</td>
                <td><?= $t->alamat; ?></td>
            </tr>
            <tr>
                <td>SEWA PS</td>
                <td width="3%">:</td>
                <td><?= $t->jenis_ps; ?></td>
            </tr>
            <tr>
                <td>LAMA SEWA</td>
                <td width="3%">:</td>
                <td><?= $cekhari; ?> Hari</td>
            </tr>
            <tr>
                <td>HARGA SEWA</td>
                <td width="3%">:</td>
                <td>Rp <span class="float-end me-3"><?= number_format($cektotal, 0, ',', '.'); ?> </span></td>
            </tr>
            <tr>
                <td>PETUGAS</td>
                <td width="3%">:</td>
                <td><span class="text-danger"><?= $t->nama_user; ?></span></td>
            </tr>
            <tr>
                <td>TANGGAL</td>
                <td width="3%">:</td>
                <td><?= format_indo($t->dari_tanggal); ?></td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>
            <?php if ($cektambah->num_rows() > 0) {
                foreach ($cektambah->result() as $c) {
            ?>
                    <tr>
                        <td>TAMABAH SEWA</td>
                        <td width="3%">:</td>
                        <td><?= $c->jml_hari; ?> Hari</td>
                    </tr>
                    <tr>
                        <td>HARGA SEWA</td>
                        <td width="3%">:</td>
                        <td>Rp <span class="float-end me-3"><?= number_format($c->total, 0, ',', '.'); ?> </span></td>
                    </tr>
                    <tr>
                        <td>TANGGAL</td>
                        <td width="3%">:</td>
                        <td><?= format_indo($c->tgl_tambah); ?></td>
                    </tr>
                    <tr>
                        <td>PETUGAS</td>
                        <td width="3%">:</td>
                        <td><span class="text-danger"><?= $c->nama_user; ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <hr>
                        </td>
                    </tr>
                <?php }; ?>
                <tr>
                    <td>JUMLAH SEWA</td>
                    <td width="3%">:</td>
                    <td> <?= $t->jml_hari; ?> Hari </td>
                </tr>
            <?php }; ?>

            <tr>
                <td>JUMLAH TOTAL</td>
                <td width="3%">:</td>
                <td>Rp <span class="float-end me-3"><?= number_format($t->total, 0, ',', '.'); ?> </span></td>
            </tr>
            <tr>
                <td>JUMLAH DIBAYAR</td>
                <td width="3%">:</td>
                <td>Rp <span class="float-end me-3"><?= number_format($t->dibayar, 0, ',', '.'); ?> </span></td>
            </tr>
            <tr>
                <td>SISA PEMBAYARAN</td>
                <td width="3%">:</td>
                <td>Rp <span class="float-end me-3"><?= number_format($t->total - $t->dibayar, 0, ',', '.'); ?> </span></td>
            </tr>
            <?php
            $kem = $this->db->query("SELECT * FROM  tb_sewakembali JOIN tb_user ON  tb_user.id_user=tb_sewakembali.iduser  WHERE   kodesewa='$t->kode_sewa' ");
            if (!empty($kem->num_rows())) {
                $k = $kem->row();
            ?>
                <tr>
                    <td colspan="3">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td>DIKEMBALIKAN</td>
                    <td width="3%">:</td>
                    <td><?= format_indo($k->tgl_sk); ?></td>
                </tr>
                <tr>
                    <td>PETUGAS</td>
                    <td width="3%">:</td>
                    <td><span class="text-danger"><?= $k->nama_user; ?></span></td>
                </tr>
            <?php }; ?>
        </table>
    </div>
</div>