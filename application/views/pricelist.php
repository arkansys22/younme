<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Harga Wedding Organizer</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>


html{
  scroll-behavior:smooth;
}

.section{
  scroll-margin-top:80px; /* sesuaikan tinggi navbar */
}


/* ACCORDION */
.accordion{
  margin-top:15px;
}

.acc-item{
  border-bottom:1px solid #eee;
}

.acc-header{
  padding:12px;
  font-weight:600;
  cursor:pointer;
  display:flex;
  justify-content:space-between;
  align-items:center;
  background:#fafafa;
  border-radius:8px;
  margin-bottom:5px;
  transition:0.3s;
}

.acc-header:hover{
  background:#f1f1f1;
}

#popup-discount{
  background:#4CAF50;
  font-size:12px;
  padding:5px 10px;
  border-radius:20px;
  color:#fff;
}

.acc-body.open{
  padding:10px;
}

.acc-body{
  max-height:0;
  overflow:hidden;
  transition:max-height 0.4s ease, padding 0.3s ease;
}

.acc-item.active .acc-body{
  max-height:9999px; /* bebas */
}

.acc-item.active .acc-header span{
  transform:rotate(45deg);
}



.faq-answer ul {
  padding-left: 18px;
  margin: 8px 0;
}

.faq-answer li {
  margin-bottom: 5px;
}

.faq-answer p {
  margin: 6px 0;
  line-height: 1.5;
}

.desc {
  transition: all 0.3s ease;
  overflow: hidden;
}

.desc.collapsed {
  display: -webkit-box;
  -webkit-line-clamp: 3; /* jumlah baris */
  -webkit-box-orient: vertical;
}

.toggle-desc {
  display: inline-block;
  margin-top: 5px;
  color: #007bff;
  cursor: pointer;
  font-size: 13px;
}

/* POPUP */
.popup{
  display:none;
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.7);
  justify-content:center;
  align-items:center;
  z-index:2000;
  padding:20px;
}

/* CONTENT */
.popup-content{
  background:#fff;
  width:100%;
  max-width:900px;
  border-radius:15px;
  overflow:hidden;
  display:flex;
  flex-direction:column;
  max-height:90vh;
  max-width:600px; /* biar lebih fokus & elegan */
  margin:auto;
  animation:fadeIn 0.3s ease;
}

/* MOBILE FIX (WAJIB) */




/* DESKTOP */
@media(min-width:768px){
.popup-content{
    flex-direction:row;
    max-height:90vh; /* biar responsif */
  }


  .popup-right{
    width:100%;
    overflow-y:auto;
  }

}

.popup-gallery-grid{
  display:grid;
  grid-template-columns:repeat(2, 1fr);
  gap:10px;
  scroll-behavior:smooth;

  max-height:none;
  overflow:visible;
  padding-right:5px; /* biar ga kepotong scrollbar */
}

/* OPTIONAL: biar scrollbar lebih halus */
.popup-gallery-grid::-webkit-scrollbar{
  width:6px;
}

.popup-gallery-grid::-webkit-scrollbar-thumb{
  background:#ccc;
  border-radius:10px;
}

.popup-gallery-grid img{
  width:100%;
  aspect-ratio:1/1;
  object-fit:cover;
  border-radius:10px;
  cursor:pointer;
  transition:0.3s;
}

.popup-gallery-grid img:hover{
  transform:scale(1.05);
}



/* KANAN (DETAIL) */
.popup-right{
  padding:25px;
  overflow-y:auto;
  flex:1;
}

@media(min-width:768px){
  .popup-right{
    width:100%;
  }
}

/* CLOSE */
.close{
  position:absolute;
  top:15px;
  right:15px;
  width:42px;
  height:42px;
  border:none;
  border-radius:50%;
  cursor:pointer;

  display:flex;
  align-items:center;
  justify-content:center;

  background:rgba(0,0,0,0.5);
  backdrop-filter:blur(6px);

  transition:0.3s;
  z-index:20;

  opacity:0;
  transform:scale(0.8);
}

.popup[style*="flex"] .close{
  opacity:1;
  transform:scale(1);
}

/* HOVER */
.close:hover{
  background:#e91e63;
  transform:scale(1.1);
}

/* SVG STYLE */
.close svg{
  stroke:#fff;
  stroke-width:2.5;
  stroke-linecap:round;
  transition:0.3s;
}

/* ANIMASI HALUS */
.close:hover svg{
  transform:scale(1.2);
}




.popup-right h3{
  font-size:24px;
  font-weight:700;
  margin-bottom:10px;
}

.popup-right .price{
  font-size:24px;
  font-weight:bold;
}

#wa-btn{
  width:100%;
  text-align:center;
  position:sticky;
  bottom:0;
  background:#25D366;
  margin-top:15px;
  z-index:10;
}


/* TAMBAHAN IMAGE */
.card-img{
  width:100%;
  aspect-ratio:4/5; /* 1080:1350 */
  overflow:hidden;
  border-radius:12px;
  margin-bottom:15px;
}

.card-img img{
  width:100%;
  height:100%;
  object-fit:cover;
  display:block;
  transition:transform 0.5s ease;
}

.card.active .card-img img{
  transform:scale(1.05);
}

.card:hover .card-img img{
  transform:scale(1.1);
}

.carousel-track{
  cursor: grab;
  display:flex;
  gap:20px;
  transition:transform 0.5s cubic-bezier(0.22,1,0.36,1);
  will-change:transform;
  user-select: none;
}
.carousel-track:active{
  cursor: grabbing;
}

.carousel{
  position:relative;
  overflow:hidden;
  touch-action:pan-y;
}


*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins',sans-serif;
}

body{
  background:#f8f8f8;
  color:#333;
}

/* NAVBAR */
.navbar{
  position:fixed;
  top:0;
  width:100%;
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:15px 20px;
  z-index:1000;

  background:rgba(255,255,255,0.7);
  backdrop-filter:blur(12px);
  -webkit-backdrop-filter:blur(12px);

  box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.navbar.scrolled{
  background:rgba(255,255,255,0.95);
  backdrop-filter:blur(15px);
}


/* MENU DESKTOP */
.nav-menu{
  display:flex;
  gap:15px;
}

.nav-menu a.active{
  color:#e91e63;
  font-weight:600;
}

.nav-menu a{
  text-decoration:none;
  color:#333;
  font-size:14px;
  transition:0.3s;
}

.nav-menu a:hover{
  color:#e91e63;
}

/* HAMBURGER */
.menu-toggle{
  display:none;
  font-size:26px;
  cursor:pointer;
}

/* MOBILE */
@media(max-width:768px){

  .menu-toggle{
    display:block;
  }

  .nav-menu{
    position:absolute;
    top:60px;
    left:0;
    width:100%;
    flex-direction:column;
    align-items:center;
    gap:15px;
    padding:20px 0;

    background:rgba(255,255,255,0.85);
    backdrop-filter:blur(12px);

    /* 🔥 ANIMASI */
    transform:translateY(-20px);
    opacity:0;
    pointer-events:none;
    transition:all 0.35s ease;
  }

  .nav-menu.active{
    transform:translateY(0);
    opacity:1;
    pointer-events:auto;
  }

  .nav-menu a{
    font-size:16px;
    padding:10px 0;
    width:100%;
    text-align:center;
  }
}


.navbar a{
  text-decoration:none;
  color:#333;
  margin:0 10px;
  font-size:14px;
}

/* HERO */
.hero{
  height:700px;
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  background:linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)), url('<?= base_url('assets/uploads/pricelist/banner.png') ?>');
  background-size:cover;
  color:#fff;
  padding:20px;
}

.hero h1{
  font-size:40px;
}

.hero p{
  margin-top:10px;
}

/* SECTION */
.section{
  padding:80px 20px;
  max-width:1200px;
  margin:auto;
}

.section h2{
  text-align:center;
  margin-bottom:40px;
}

/* SLIDER CONTAINER */
.grid{
  display:flex;
  gap:20px;
  overflow-x:auto;
  scroll-snap-type:x mandatory;
  padding-bottom:10px;
}

/* HILANGKAN SCROLLBAR */
.grid::-webkit-scrollbar{
  display:none;
}


/* DESKTOP (3 ITEM) */
@media(min-width:768px){
  .card{
    flex:0 0 calc(33.333% - 14px);
  }
}

.card:hover{
  transform:translateY(-5px);
}

.price{
  font-size:20px;
  color:#e91e63;
  font-weight:600;
}

.old-price{
  text-decoration: line-through;
  color:#999;
  font-size:14px;
  margin-right:8px;
}

.btn{
  display:inline-block;
  padding:10px 15px;
  background:#e91e63;
  color:#fff;
  border-radius:8px;
  text-decoration:none;
  font-size:14px;
}

/* FOOTER */
.footer{
  text-align:center;
  padding:30px;
  background:#222;
  color:#fff;
}

/* RESPONSIVE */
@media(max-width:600px){
  .hero h1{
    font-size:28px;
  }
  .close{
    width:45px;
    height:45px;
    font-size:22px;
  }
}


.slider-wrapper{
  position:relative;
}

.slide-btn{
  position:absolute;
  top:40%;
  transform:translateY(-50%);
  background:#fff;
  border:none;
  width:40px;
  height:40px;
  border-radius:50%;
  box-shadow:0 2px 10px rgba(0,0,0,0.2);
  cursor:pointer;
  z-index:10;
}

.slide-btn.prev{ left:-10px; }
.slide-btn.next{ right:-10px; }

/* WRAPPER */
.carousel{
  position:relative;
  overflow:hidden;
}

/* TRACK */
.carousel-track{
  display:flex;
  gap:20px;
  transition:transform 0.4s ease;
}

/* CARD */
.card{
  flex:0 0 80%;
  opacity:0.9;
  transform:scale(0.85);
  transition:all 0.5s ease;
  box-shadow:0 10px 30px rgba(0,0,0,0.1);
  border-radius:15px;
  background:#fff;
  padding:15px;
  position:relative;

}

/* DESKTOP */
@media(min-width:768px){
  .card{
    flex:0 0 calc(33.333% - 20px);
  }
}

/* 🔥 CARD AKTIF (TENGAH) */
.card.active{
  opacity:1;
  transform:scale(1);
  z-index:2;
}

/* 🔥 EFEK SAMPING */
.card.active ~ .card{
  opacity:0.6;
}





/* DOT */
.dots{
  text-align:center;
  margin-top:15px;
}

.dots span{
  display:inline-block;
  width:8px;
  height:8px;
  background:#ccc;
  border-radius:50%;
  margin:5px;
  cursor:pointer;
}

.dots .active{
  background:#e91e63;
}

.carousel-btn{
  position:absolute;
  top:40%;
  transform:translateY(-50%);
  width:45px;
  height:45px;
  border:none;
  border-radius:50%;
  background:#fff;
  box-shadow:0 4px 10px rgba(0,0,0,0.2);
  cursor:pointer;
  z-index:10;
}

.prev-btn{ left:10px; }
.next-btn{ right:10px; }



.badge{
  position:absolute;
  top:10px;
  left:10px;
  background:linear-gradient(45deg,#ff4d4d,#e91e63);
  color:#fff;
  font-size:12px;
  padding:6px 10px;
  border-radius:20px;
  font-weight:600;
  box-shadow:0 3px 8px rgba(0,0,0,0.2);
}


/* ZOOM FULLSCREEN */
.img-zoom{
  display:none;
  position:fixed;
  z-index:3000;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.9);

  justify-content:center;
  align-items:center;
  animation:fadeIn 0.3s ease;
}

/* GAMBAR */
.img-zoom img{
  max-width:90%;
  max-height:90%;
  border-radius:10px;
  animation:zoomIn 0.3s ease;
}

/* CLOSE BUTTON */
.zoom-close{
  position:absolute;
  top:20px;
  right:25px;
  font-size:35px;
  color:#fff;
  cursor:pointer;
  z-index:10;
}

/* ANIMASI */
@keyframes zoomIn{
  from{ transform:scale(0.8); opacity:0; }
  to{ transform:scale(1); opacity:1; }
}

</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
  <strong><?= htmlspecialchars(nama_website()) ?></strong>

  <div class="menu-toggle" id="menu-toggle">&#9776;</div>

  <div class="nav-menu" id="nav-menu">
    <a href="#wo">WO</a>
    <a href="#lamaran">Lamaran</a>
    <a href="#gedung">Gedung</a>
    <a href="#rumah">Rumah</a>
    <a href="#vendor">Vendor</a>
  </div>
</div>

<!-- HERO -->
<div class="hero">
  <div>
    <h1>Paket Pernikahan Terbaik</h1>
    <p>Solusi lengkap untuk hari spesial Anda</p>
  </div>
</div>

<!-- WEDDING ORGANIZER -->
<div class="section" id="wo">
  <h2>Paket Wedding Organizer</h2>

  <div class="carousel">
  	<button class="carousel-btn prev-btn">&#10094;</button>
    <button class="carousel-btn next-btn">&#10095;</button>

    <div class="carousel-track">

    


    	<?php $no = 1; foreach ($paketwo as $p): ?>


	      <!-- CARD -->
	      <div class="card">
	        <div class="card-img">
	        		<?php 
				      // Ambil semua gambar dari tabel data_pricelist_gambar sesuai id session
				      $gambarPaket = $this->db->get_where('data_pricelist_gambar', [
				          'data_pricelist_idsession' => $p->data_pricelist_idsession
				      ])->result();
				      if(!empty($gambarPaket)){
				          // tampilkan gambar pertama sebagai thumbnail
				          $firstImg = $gambarPaket[0];
				    ?>

	          <img src="<?= base_url('assets/uploads/pricelist/'.$firstImg->data_pricelist_gambar_nama) ?>">
		      <?php } else { ?>
		          <img src="https://via.placeholder.com/400x400?text=No+Image">
		      <?php } ?>
	      
	        </div>
	        <h3><?= $p->data_pricelist_judul ?></h3>
	        <p class="price">
	          <span class="old-price">Rp <?= number_format($p->data_pricelist_harga, 0, ',', '.')?></span>
	          Rp <?= number_format($p->data_pricelist_hargapromo, 0, ',', '.') ?>
	        </p>
	        <div class="badge auto-discount"></div>
	        <a href="#" class="btn detail-btn"
	          data-title="<?= $p->data_pricelist_judul ?>"
	          data-price="<?= $p->data_pricelist_hargapromo ?>"
	          data-oldprice="<?= $p->data_pricelist_harga ?>"
	          data-desc="<?= $p->data_pricelist_deskripsi ?>"          
	          data-images='[
	          <?php 
		          $imgUrls = [];
		          foreach($gambarPaket as $img){
		              $imgUrls[] = base_url('assets/uploads/pricelist/'.$img->data_pricelist_gambar_nama);
		          }
		          echo '"' . implode('","', $imgUrls) . '"';
		        ?>
	          ]'>
	          Detail
	        </a>
	      </div>      

      	<?php endforeach; ?> 

      	

    </div>
	<div class="dots"></div>
   

  </div>

</div>





<!-- LAMARAN -->
<div class="section" id="lamaran">
  <h2>Paket Lamaran</h2>
  <div class="carousel">
   	<button class="carousel-btn prev-btn">&#10094;</button>
    <button class="carousel-btn next-btn">&#10095;</button>
    <div class="carousel-track">
    

    	<?php $no = 1; foreach ($paketlamaran as $p): ?>


      <!-- CARD -->
      <div class="card">
        <div class="card-img">
          <?php 
				      // Ambil semua gambar dari tabel data_pricelist_gambar sesuai id session
				      $gambarPaket = $this->db->get_where('data_pricelist_gambar', [
				          'data_pricelist_idsession' => $p->data_pricelist_idsession
				      ])->result();
				      if(!empty($gambarPaket)){
				          // tampilkan gambar pertama sebagai thumbnail
				          $firstImg = $gambarPaket[0];
				    ?>

	          <img src="<?= base_url('assets/uploads/pricelist/'.$firstImg->data_pricelist_gambar_nama) ?>">
		      <?php } else { ?>
		          <img src="https://via.placeholder.com/400x400?text=No+Image">
		      <?php } ?>
        </div>
        <h3><?= $p->data_pricelist_judul ?></h3>
        <p class="price">
          <span class="old-price">Rp <?= number_format($p->data_pricelist_harga, 0, ',', '.')?></span>
          Rp <?= number_format($p->data_pricelist_hargapromo, 0, ',', '.') ?>
        </p>
        <div class="badge auto-discount"></div>
        <a href="#" class="btn detail-btn"
          data-title="<?= $p->data_pricelist_judul ?>"
          data-price="<?= $p->data_pricelist_hargapromo ?>"
          data-oldprice="<?= $p->data_pricelist_harga ?>"
          data-desc="<?= $p->data_pricelist_deskripsi ?>"          
          data-images='[
          <?php 
		          $imgUrls = [];
		          foreach($gambarPaket as $img){
		              $imgUrls[] = base_url('assets/uploads/pricelist/'.$img->data_pricelist_gambar_nama);
		          }
		          echo '"' . implode('","', $imgUrls) . '"';
		        ?>
          ]'>
          Detail
        </a>
      </div>      

      <?php endforeach; ?> 


    </div>
    <div class="dots"></div> 
  </div>
</div>

<!-- GEDUNG -->
<div class="section" id="gedung">
  <h2>Paket Wedding Gedung</h2>
  <div class="carousel">
 	<button class="carousel-btn prev-btn">&#10094;</button>
    <button class="carousel-btn next-btn">&#10095;</button>

    <div class="carousel-track">

	
    	<?php $no = 1; foreach ($paketgedung as $p): ?>


      <!-- CARD -->
      <div class="card">
        <div class="card-img">
           <?php 
				      // Ambil semua gambar dari tabel data_pricelist_gambar sesuai id session
				      $gambarPaket = $this->db->get_where('data_pricelist_gambar', [
				          'data_pricelist_idsession' => $p->data_pricelist_idsession
				      ])->result();
				      if(!empty($gambarPaket)){
				          // tampilkan gambar pertama sebagai thumbnail
				          $firstImg = $gambarPaket[0];
				    ?>

	          <img src="<?= base_url('assets/uploads/pricelist/'.$firstImg->data_pricelist_gambar_nama) ?>">
		      <?php } else { ?>
		          <img src="https://via.placeholder.com/400x400?text=No+Image">
		      <?php } ?>
        </div>
        <h3><?= $p->data_pricelist_judul ?></h3>
        <p class="price">
          <span class="old-price">Rp <?= number_format($p->data_pricelist_harga, 0, ',', '.')?></span>
          Rp <?= number_format($p->data_pricelist_hargapromo, 0, ',', '.') ?>
        </p>
        <div class="badge auto-discount"></div>
        <a href="#" class="btn detail-btn"
          data-title="<?= $p->data_pricelist_judul ?>"
          data-price="<?= $p->data_pricelist_hargapromo ?>"
          data-oldprice="<?= $p->data_pricelist_harga ?>"
          data-desc="<?= $p->data_pricelist_deskripsi ?>"          
          data-images='[
          <?php 
		          $imgUrls = [];
		          foreach($gambarPaket as $img){
		              $imgUrls[] = base_url('assets/uploads/pricelist/'.$img->data_pricelist_gambar_nama);
		          }
		          echo '"' . implode('","', $imgUrls) . '"';
		        ?>
          ]'>
          Detail
        </a>
      </div>      

      <?php endforeach; ?> 

    </div> 
    <div class="dots"></div> 
  </div>
</div>

<!-- RUMAH -->
<div class="section" id="rumah">
  <h2>Paket Wedding Rumah</h2>
  <div class="carousel">
 <button class="carousel-btn prev-btn">&#10094;</button>
    <button class="carousel-btn next-btn">&#10095;</button>


    <div class="carousel-track">
	    	<?php $no = 1; foreach ($paketrumah as $p): ?>


      <!-- CARD -->
      <div class="card">
        <div class="card-img">
           <?php 
				      // Ambil semua gambar dari tabel data_pricelist_gambar sesuai id session
				      $gambarPaket = $this->db->get_where('data_pricelist_gambar', [
				          'data_pricelist_idsession' => $p->data_pricelist_idsession
				      ])->result();
				      if(!empty($gambarPaket)){
				          // tampilkan gambar pertama sebagai thumbnail
				          $firstImg = $gambarPaket[0];
				    ?>

	          <img src="<?= base_url('assets/uploads/pricelist/'.$firstImg->data_pricelist_gambar_nama) ?>">
		      <?php } else { ?>
		          <img src="https://via.placeholder.com/400x400?text=No+Image">
		      <?php } ?>
        </div>
        <h3><?= $p->data_pricelist_judul ?></h3>
        <p class="price">
          <span class="old-price">Rp <?= number_format($p->data_pricelist_harga, 0, ',', '.')?></span>
          Rp <?= number_format($p->data_pricelist_hargapromo, 0, ',', '.') ?>
        </p>
        <div class="badge auto-discount"></div>
        <a href="#" class="btn detail-btn"
          data-title="<?= $p->data_pricelist_judul ?>"
          data-price="<?= $p->data_pricelist_hargapromo ?>"
          data-oldprice="<?= $p->data_pricelist_harga ?>"
          data-desc="<?= $p->data_pricelist_deskripsi ?>"          
          data-images='[
          <?php 
		          $imgUrls = [];
		          foreach($gambarPaket as $img){
		              $imgUrls[] = base_url('assets/uploads/pricelist/'.$img->data_pricelist_gambar_nama);
		          }
		          echo '"' . implode('","', $imgUrls) . '"';
		        ?>
          ]'>
          Detail
        </a>
      </div>      

      <?php endforeach; ?> 

    </div> 
    <div class="dots"></div> 
  </div>
</div>

<!-- VENDOR -->
<div class="section" id="vendor">
  <h2>Vendor Pernikahan</h2>
  <div class="carousel">
    <button class="carousel-btn prev-btn">&#10094;</button>
    <button class="carousel-btn next-btn">&#10095;</button>

    <div class="carousel-track">
    	

    	<?php $no = 1; foreach ($paketvendor as $p): ?>


      <!-- CARD -->
      <div class="card">
        <div class="card-img">
           <?php 
				      // Ambil semua gambar dari tabel data_pricelist_gambar sesuai id session
				      $gambarPaket = $this->db->get_where('data_pricelist_gambar', [
				          'data_pricelist_idsession' => $p->data_pricelist_idsession
				      ])->result();
				      if(!empty($gambarPaket)){
				          // tampilkan gambar pertama sebagai thumbnail
				          $firstImg = $gambarPaket[0];
				    ?>

	          <img src="<?= base_url('assets/uploads/pricelist/'.$firstImg->data_pricelist_gambar_nama) ?>">
		      <?php } else { ?>
		          <img src="https://via.placeholder.com/400x400?text=No+Image">
		      <?php } ?>
        </div>
        <h3><?= $p->data_pricelist_judul ?></h3>
        <p class="price">
          <span class="old-price">Rp <?= number_format($p->data_pricelist_harga, 0, ',', '.')?></span>
          Rp <?= number_format($p->data_pricelist_hargapromo, 0, ',', '.') ?>
        </p>
        <div class="badge auto-discount"></div>
        <a href="#" class="btn detail-btn"
          data-title="<?= $p->data_pricelist_judul ?>"
          data-price="<?= $p->data_pricelist_hargapromo ?>"
          data-oldprice="<?= $p->data_pricelist_harga ?>"
          data-desc="<?= $p->data_pricelist_deskripsi ?>"          
          data-images='[
          <?php 
		          $imgUrls = [];
		          foreach($gambarPaket as $img){
		              $imgUrls[] = base_url('assets/uploads/pricelist/'.$img->data_pricelist_gambar_nama);
		          }
		          echo '"' . implode('","', $imgUrls) . '"';
		        ?>
          ]'>
          Detail
        </a>
      </div>      

      <?php endforeach; ?> 

    </div> 
    <div class="dots"></div> 
  </div>
</div>

<!-- FOOTER -->
<div class="footer">
  <p>© <?= date('Y') ?> <?= htmlspecialchars(nama_website()) ?> - All Rights Reserved</p>
</div>

<!-- POPUP -->
<div id="popup" class="popup">
  <div class="popup-content">

    <button class="close" aria-label="Tutup">
      <svg viewBox="0 0 24 24" width="20" height="20">
        <line x1="6" y1="6" x2="18" y2="18"/>
        <line x1="18" y1="6" x2="6" y2="18"/>
      </svg>
    </button>

    <!-- KANAN -->
    <div class="popup-right">
      <h3 id="popup-title"></h3>
      <p class="price">
        <span id="popup-old-price" class="old-price"></span>
        <span id="popup-price"></span>
      </p>
      <div id="popup-discount" class="badge" style="position:static; display:inline-block; margin-top:5px;"></div>

      <!-- ACCORDION -->
      <div class="accordion">

        <!-- DESKRIPSI -->
        <div class="acc-item">
          <div class="acc-header">Deskripsi Paket <span>+</span></div>
          <div class="acc-body">
            <div id="popup-desc"></div>
          </div>
        </div>

        <!-- GALERI INFO -->
        <div class="acc-item">
          <div class="acc-header">Galeri Paket <span>+</span></div>
          <div class="acc-body">
            <div id="popup-gallery" class="popup-gallery-grid"></div>
          </div>
        </div>

      </div>

      <a id="wa-btn" class="btn" target="_blank">Pesan via WhatsApp</a>
    </div>

  </div>
</div>

<!-- IMAGE ZOOM -->
<div id="imgZoom" class="img-zoom">
  <span class="zoom-close">&times;</span>
  <img id="zoomedImg">
</div>
<script>



  const popup = document.getElementById("popup");
  const popupTitle = document.getElementById("popup-title");
  const popupPrice = document.getElementById("popup-price");
  const popupDesc = document.getElementById("popup-desc");
  const waBtn = document.getElementById("wa-btn");

  // INIT ACCORDION (WAJIB JALAN SEKALI)
  function initAccordion(){
    document.querySelectorAll(".acc-header").forEach(header=>{
      header.onclick = () => {
        const body = header.nextElementSibling;

        if(body.style.maxHeight){
          body.style.maxHeight = null;
        } else {
          document.querySelectorAll(".acc-body").forEach(b => b.style.maxHeight = null);
          body.style.maxHeight = body.scrollHeight + "px";
        }
      };
    });
  }
  initAccordion();


  // OPEN POPUP (SATU EVENT SAJA 🔥)
  document.addEventListener("click", function(e){
    const btn = e.target.closest(".detail-btn");
    if(!btn) return;

    e.preventDefault();

    popup.style.display = "flex";

    // RESET
    document.querySelectorAll(".acc-body").forEach(b => b.style.maxHeight = null);

    // =========================
    // 🔥 AMBIL DATA DINAMIS
    // =========================
    const title = btn.dataset.title || "";
    const price = parseInt(btn.dataset.price || 0);
    const oldPrice = parseInt(btn.dataset.oldprice || 0);
    const desc = btn.dataset.desc || "";

    // TITLE
    popupTitle.innerText = title;

    // FORMAT HARGA
    popupPrice.innerText = formatRupiah(price);

    if(oldPrice){
      popupOldPrice.innerText = formatRupiah(oldPrice);
      popupOldPrice.style.display = "inline";
    } else {
      popupOldPrice.style.display = "none";
    }

    // 🔥 AUTO HEMAT
    if(oldPrice && price){
      const persen = Math.round(((oldPrice - price) / oldPrice) * 100);
      popupDiscount.innerText = `Hemat ${persen}%`;
      popupDiscount.style.display = "inline-block";
    } else {
      popupDiscount.style.display = "none";
    }

    // =========================
    // DESKRIPSI
    // =========================
    const formattedDesc = desc.split(',').map(item => item.trim()).join('<br>');
	popupDesc.innerHTML = `<p>${formattedDesc}</p>`;

    
    // =========================
    // GALLERY
    // =========================
    const gallery = document.getElementById("popup-gallery");
    gallery.innerHTML = "";

    try{
      const images = JSON.parse(btn.dataset.images || "[]");

      images.forEach(img=>{
        const el = document.createElement("img");
        el.src = img;
        el.onclick = ()=>{
          openZoom(img);
        };
        gallery.appendChild(el);
      });
    } catch(err){
      console.log("image error", err);
    }

    // =========================
    // WHATSAPP
    // =========================
    const phone = "6281234567890";
    const text = `Halo, saya tertarik dengan paket ${title}`;
    waBtn.href = `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
  });


  // CLOSE BUTTON
  document.querySelector(".close").onclick = ()=>{
    popup.style.display = "none";
  };

  // CLICK OUTSIDE
  popup.onclick = (e)=>{
    if(e.target === popup){
      popup.style.display = "none";
    }
  };
  </script>
  <script>

  	document.querySelectorAll('.carousel').forEach(carousel => {
    const track = carousel.querySelector('.carousel-track');
    const cards = Array.from(track.children);
    const nextBtn = carousel.querySelector('.next-btn');
    const prevBtn = carousel.querySelector('.prev-btn');
    const dotsContainer = carousel.querySelector('.dots');
    let current = 0;

    function updateSlider(){
        const width = cards[0].offsetWidth + 20;
        track.style.transform = `translateX(-${current * width}px)`;
        cards.forEach(c => c.classList.remove('active'));
        cards[current].classList.add('active');
        const dots = dotsContainer.querySelectorAll('span');
        dots.forEach(d => d.classList.remove('active'));
        dots[current].classList.add('active');
    }

    function createDots(){
        dotsContainer.innerHTML = '';
        cards.forEach((_, i) => {
            const dot = document.createElement('span');
            if(i===0) dot.classList.add('active');
            dot.onclick = ()=>{ current = i; updateSlider(); };
            dotsContainer.appendChild(dot);
        });
    }

    nextBtn.onclick = ()=>{ current = (current+1) % cards.length; updateSlider(); };
    prevBtn.onclick = ()=>{ current = (current-1+cards.length) % cards.length; updateSlider(); };

    createDots();
    updateSlider();
});




    const track = document.getElementById("track");
    const cards = Array.from(track.children);

    const nextBtn = document.querySelector(".next-btn");
    const prevBtn = document.querySelector(".prev-btn");
    const dotsContainer = document.getElementById("dots");

    let current = 0;

    // 👉 ambil lebar card
    function getCardWidth(){
      return cards[0].offsetWidth + 20;
    }

    // 👉 update slider
    function updateSlider(){
      const width = getCardWidth();

      track.style.transition = "transform 0.4s ease";
      track.style.transform = `translateX(-${current * width}px)`;

      updateActiveCard();
      updateDots();
    }

    // 👉 active card
    function updateActiveCard(){
      cards.forEach(c => c.classList.remove("active"));
      cards[current].classList.add("active");
    }

    // 👉 dots
    function createDots(){
      dotsContainer.innerHTML = "";

      cards.forEach((_, i)=>{
        const dot = document.createElement("span");

        if(i === 0) dot.classList.add("active");

        dot.onclick = ()=>{
          current = i;
          updateSlider();
        };

        dotsContainer.appendChild(dot);
      });
    }

    function updateDots(){
      const dots = dotsContainer.querySelectorAll("span");

      dots.forEach(d => d.classList.remove("active"));
      dots[current].classList.add("active");
    }

    // 👉 next prev
    function nextSlide(){
      current++;
      if(current >= cards.length){
        current = 0; // looping clean
      }
      updateSlider();
    }

    function prevSlide(){
      current--;
      if(current < 0){
        current = cards.length - 1;
      }
      updateSlider();
    }

    // 👉 button
    nextBtn.onclick = nextSlide;
    prevBtn.onclick = prevSlide;

    // 👉 swipe (mobile)
    let startX = 0;

    track.addEventListener("touchstart", e=>{
      startX = e.touches[0].clientX;
    });

    track.addEventListener("touchend", e=>{
      let diff = startX - e.changedTouches[0].clientX;

      if(diff > 50) nextSlide();
      else if(diff < -50) prevSlide();
    });

    // 👉 drag (desktop)
    let isDown = false;
    let startPos = 0;

    track.addEventListener("mousedown", e=>{
      isDown = true;
      startPos = e.pageX;
    });

    track.addEventListener("mouseup", e=>{
      if(!isDown) return;
      isDown = false;

      let diff = startPos - e.pageX;

      if(diff > 50) nextSlide();
      else if(diff < -50) prevSlide();
    });

    track.addEventListener("mouseleave", ()=> isDown = false);

    // INIT
    createDots();
    updateSlider();
  </script>

  <script>
    const sections = document.querySelectorAll(".section");
    const navLinks = document.querySelectorAll(".nav-menu a");

    window.addEventListener("scroll", () => {

      if(isClickScrolling) return; // 🔥 skip kalau lagi klik

      let current = "";

      sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;

        if (window.scrollY >= sectionTop - 120 &&
            window.scrollY < sectionTop + sectionHeight - 120) {
          current = section.getAttribute("id");
        }
      });

      navLinks.forEach(link => {
        link.classList.remove("active");

        if (link.getAttribute("href") === "#" + current) {
          link.classList.add("active");
        }
      });
    });

    
    const toggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("nav-menu");

    // toggle menu
    toggle.onclick = () => {
      menu.classList.toggle("active");
    };

    // ✅ AUTO CLOSE saat klik menu
    document.querySelectorAll(".nav-menu a").forEach(link => {
      link.addEventListener("click", function(e){
        e.preventDefault();

        isClickScrolling = true; // 🔥 matikan scroll detector sementara

        const targetId = this.getAttribute("href");
        const target = document.querySelector(targetId);

        if(!target) return;

        const navbarHeight = document.querySelector(".navbar").offsetHeight;
        const targetPosition = target.offsetTop - navbarHeight - 10;

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth"
        });

        // 🔥 set active langsung
        navLinks.forEach(l => l.classList.remove("active"));
        this.classList.add("active");

        menu.classList.remove("active");

        // 🔥 hidupkan lagi scroll detector setelah animasi selesai
        setTimeout(() => {
          isClickScrolling = false;
        }, 500); // sesuaikan durasi smooth scroll
      });
    });

    // ✅ CLOSE kalau klik luar menu
    document.addEventListener("click", (e)=>{
      if(!e.target.closest(".navbar")){
        menu.classList.remove("active");
      }
    });


    window.addEventListener("scroll", ()=>{
      const nav = document.querySelector(".navbar");

      if(window.scrollY > 50){
        nav.classList.add("scrolled");
      } else {
        nav.classList.remove("scrolled");
      }
    });


    const popupOldPrice = document.getElementById("popup-old-price");
    const popupDiscount = document.getElementById("popup-discount");

    function formatRupiah(angka){
      return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }


    document.querySelectorAll(".card").forEach(card => {
      const btn = card.querySelector(".detail-btn");
      const badge = card.querySelector(".auto-discount");

      if(!btn || !badge) return;

      const price = parseInt(btn.dataset.price || 0);
      const oldPrice = parseInt(btn.dataset.oldprice || 0);

      if(oldPrice && price){
        const persen = Math.round(((oldPrice - price) / oldPrice) * 100);
        badge.innerText =  `🔥 Diskon ${persen}%`;
        badge.style.display = "block";
      } else {
        badge.style.display = "none";
      }
    });
  </script>

  <script>
      const zoomModal = document.getElementById("imgZoom");
      const zoomedImg = document.getElementById("zoomedImg");
      const zoomClose = document.querySelector(".zoom-close");

      // 🔥 FUNCTION OPEN ZOOM
      function openZoom(src){
        zoomModal.style.display = "flex";
        zoomedImg.src = src;
      }

      // 🔥 CLOSE
      zoomClose.onclick = () => zoomModal.style.display = "none";

      zoomModal.onclick = (e)=>{
        if(e.target === zoomModal){
          zoomModal.style.display = "none";
        }
      };

  </script>
</body>
</html>