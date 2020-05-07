<div class="col-lg-6">
<div class="row justify-content-center ml-100">
<form method="post" action="<?php echo base_url();?>frontend/Shopping/tambah" method="post" accept-charset="utf-8">	 	 
<img src="<?php echo base_url() .'gambar/product/'.$detail['gambar']; ?>" width="260"/>
<h4><?php echo $detail['nama_produk'];?></h4>	 
<h5><font color="#bd34eb">Rp. <?php echo number_format($detail['harga'],0,",",".");?></font></h5>	 	
<h6 class="text-muted"><?php echo $detail['deskripsi'];?></h6>	
  <input type="hidden" name="id" value="<?php echo $detail['id_produk']; ?>" />	 	
  <input type="hidden" name="nama" value="<?php echo $detail['nama_produk']; ?>" />	 	
  <input type="hidden" name="harga" value="<?php echo $detail['harga']; ?>" />	 	
  <input type="hidden" name="gambar" value="<?php echo $detail['gambar']; ?>"  />
  <input type="hidden" name="qty" value="1" />
 <button class="btn btn-md btn-success" type="submit">
 	<i class="glyphicon glyphicon-shopping-cart"></i> 
 <strong>Beli Sekarang</strong>
</button> 
 </form>	 
 </div>	
</div>