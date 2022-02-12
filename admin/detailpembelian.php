<div class="panel-headline">
    <div class="panel-heading">
        <h2>Detail Pembelian</h2>
    </div>
    <?php
    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN user ON pembelian.id_user=user.id_user WHERE pembelian.id_pembelian='$_GET[id]'");
    $detail = $ambil->fetch_assoc();
    $status= $detail['status_pembelian'];
    // var_dump($detail);
    ?>
    <div class="panel-body">
        
    <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <h3>Pembelian #<?=$detail['id_pembelian']?></h3>
                        Tanggal :<i class='far fa-calendar-alt'></i> <?=$detail['tanggal_pembelian']?><br>
                        Status :<?php if($status=="pending"):
                        ?>
                            <span class="label label-info"><?=$status?></span>
        
                        <?php elseif($status=="Sudah mengirim pembayaran"): ?>
                    
                            <span class="label label-primary"><?=$status?></span>
                        
                        <?php elseif($status=="Batal"): ?>
                    
                            <span class="label label-danger"><?=$status?></span>
                        

                        <?php else:?>
                    
                            <span class="label label-success"><?=$status?></span>
                            <br>
                            <?php if(!empty($detail['resi_pengiriman'])):?>
                            Resi : <?=$detail['resi_pengiriman'];?>
                            <?php endif ?>
                        
                        <?php endif ?>
                    </div>
                    <div class="col-md-3">
                        <h3>Pelanggan</h3> 
                        <i class="fa fa-user"></i>  <?=$detail['nama_user'];?>
                        <br>
                        <i class="fa fa-phone"></i> <?=$detail['tlp_user'];?>
                        <br>
                        <i class="fa fa-envelope"></i> <?=$detail['email_user'];?>
                    </div>
                    <div class="col-md-3">
                        <h3>Pengiriman</h3>
                        Kota Pengiriman : <?=$detail['nama_kota'];?><br>
                        Alamat Pengiriman : <?=$detail['alamat_pengiriman']?>

                    </div>
                </div>
                <table class="table table-striped mt-5">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Berat</th>
                            <th>Jumlah</th>
                            <th>Subberat</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $nomor=1;?>
                    <?php $totalbelanja=0?>
                    <?php $ambil2 = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'")?>
                    <?php while($pecah =  $ambil2->fetch_assoc()){?>
                        <tr>
                            <th><?=$nomor;?></th>
                            <td><?=$pecah['nama'];?></td>
                            <td>Rp.<?=number_format($pecah['harga']);?></td>
                            <td><?=number_format($pecah['berat']);?> Gr</td>
                            <td><?=$pecah['jumlah'];?></td>
                            <td><?=number_format($pecah['subberat'])?> Gr</td>
                            <td>Rp.<?=number_format($pecah['subharga'])?></td>
                        </tr>
                    <?php 
                    $nomor++;
                    $totalbelanja +=$pecah['subharga'];
                    } 
                    ?>
                    </tbody>
                    </table> 
                    <div class="row">
                        <div class="col-md-7 mt-5">
                        </div>
                        <div class="col-md-5 mt-5">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Total Belanja</td>
                                        <td>Rp.<?=number_format($totalbelanja)?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Ongkir</td>
                                        <td>Rp.<?=number_format($detail['tarif'])?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Bayar</td>
                                        <td>Rp.<?=number_format($detail['total_pembelian'])?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
    </div>
</div>