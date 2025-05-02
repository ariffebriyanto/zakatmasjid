<style type="text/css">
    /* [IMAGE] */
.zoomD {
  width: 600px;
  height: auto;
  cursor: pointer;
}

/* [LIGHTBOX] */
#lb-back {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  background: rgba(0, 0, 0, 0.5);
  z-index: 999;
  visibility: hidden;
  opacity: 0;
  transition: all 0.4s;
}
#lb-back.show {
  visibility: visible;
  opacity: 1;
}
#lb-img {
  text-align: center;
}

/* [DOES NOT MATTER] */
html, body {
  padding: 0;
  margin: 0;
}
</style>

<!-- Breadcome start-->
            <div class="breadcome-area mg-b-30 small-dn">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcome-list shadow-reset">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="breadcome-heading">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul class="breadcome-menu">
                                            <li><a href="<?=BASEURL;?>/home_index">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Penukaran Kupon</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcome End-->

            <!-- Breadcome start-->
            <div class="breadcome-area mg-b-30 des-none">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcome-heading">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <ul class="breadcome-menu">
                                            <li><a href="<?=BASEURL;?>/home_index">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Penukaran Kupon</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcome End-->
			
			<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Tabel <span class="table-project-n">Data</span> Penukaran Kupon</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
	
                      
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <table id="table"
                                data-toggle="table"
                                data-pagination="true"
                                data-search="true"
                                data-show-columns="true"
                                data-show-pagination-switch="true"
                                data-show-refresh="true"
                                data-key-events="true"
                                data-show-toggle="true"
                                data-resizable="true"
                                data-cookie="true"
                                data-cookie-id-table="saveId"
                                data-click-to-select="true"
                                data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="no">No</th>
        <th data-field="nama">Nama</th>
        <th data-field="alamat">Alamat</th>
        <th data-field="handphone">Handphone</th>
        <th data-field="kupon">Kupon</th>
        <th data-field="tahun">Tahun</th>
		 <th data-field="status">Status</th>
		  <th data-field="tanggal_tukar">Tanggal Tukar</th>
        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data['penerima'] as $pnr) : ?>
                                        <tr>
                                            <td><?= $no++; ?>.</td>
                                            <td><?= $pnr['nama']; ?></td>
                                            <td><?= $pnr['alamat']; ?></td>
                                            <td><?= $pnr['handphone']; ?></td>
											<td><?= $pnr['kupon']; ?></td>
											<td><?= $pnr['tahun']; ?></td>
                                            <td><?= $pnr['status']; ?></td>
                                            <td><?php 
    if (!empty($pnr['tanggal_tukar']) && $pnr['tanggal_tukar'] !== '0000-00-00' && strtotime($pnr['tanggal_tukar']) !== false) {
        echo date('d F Y H:i:s', strtotime($pnr['tanggal_tukar']));
    } else {
        echo '';
    }
    ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

<div class="row">
    <div class="col-lg-4">
        <div class="alert alert-warning">
            <strong>Total Kupon Tahun <?= date('Y'); ?>:</strong> <span id="total_tahun_ini"><?= $data['total_tahun_ini']; ?></span>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="alert alert-info">
            <strong>Total Belum Tukar:</strong> <span id="total_belum"><?= $data['total_belum']; ?></span>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="alert alert-success">
            <strong>Total Sudah Ditukar:</strong> <span id="total_ditukar"><?= $data['total_ditukar']; ?></span>
        </div>
    </div>
</div>

                           				

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Static Table End -->
<div id="lb-back">
  <div id="lb-img"></div>
</div>
</div>
</div>
    <script type="text/javascript">
	
	function formatTanggalIndonesia(tanggalStr) {
    const bulan = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    const tgl = new Date(tanggalStr);
    const hari = String(tgl.getDate()).padStart(2, '0');
    const bulanNama = bulan[tgl.getMonth()];
    const tahun = tgl.getFullYear();
    const jam = String(tgl.getHours()).padStart(2, '0');
    const menit = String(tgl.getMinutes()).padStart(2, '0');
    const detik = String(tgl.getSeconds()).padStart(2, '0');
    return `${hari} ${bulanNama} ${tahun} ${jam}:${menit}:${detik}`;
}
	
	function refreshTableData() {
		
    fetch("<?= BASEURL; ?>/PenerimaQurban/getDataKupon")
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector("#table tbody");
            tbody.innerHTML = "";
            let no = 1;

            // Update data tabel
            data.penerima.forEach(pnr => {
				let tanggalTukarFormatted = "";

    if (pnr.tanggal_tukar && pnr.tanggal_tukar !== "0000-00-00" && !isNaN(new Date(pnr.tanggal_tukar))) {
        tanggalTukarFormatted = formatTanggalIndonesia(pnr.tanggal_tukar);
    }
                const row = `
                    <tr>
                        <td>${no++}.</td>
                        <td>${pnr.nama}</td>
                        <td>${pnr.alamat}</td>
                        <td>${pnr.handphone}</td>
                        <td>${pnr.kupon}</td>
                        <td>${pnr.tahun}</td>
                        <td>${pnr.status}</td>
						<td>${tanggalTukarFormatted}</td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });

            // Update total kupon
            document.getElementById("total_belum").innerText = data.total_belum;
            document.getElementById("total_ditukar").innerText = data.total_ditukar;
            document.getElementById("total_tahun_ini").innerText = data.total_tahun_ini;
        });
}


// Mulai auto-refresh setiap 5 detik
setInterval(refreshTableData, 5000);

// Panggil pertama kali saat halaman dimuat
document.addEventListener("DOMContentLoaded", refreshTableData);

        // This function will show the image in the lightbox
var zoomImg = function () {
  // Create evil image clone
  var clone = this.cloneNode();
  clone.classList.remove("zoomD");

  // Put evil clone into lightbox
  var lb = document.getElementById("lb-img");
  lb.innerHTML = "";
  lb.appendChild(clone);

  // Show lightbox
  lb = document.getElementById("lb-back");
  lb.classList.add("show");
};

window.addEventListener("load", function(){
  // Attach on click events to all .zoomD images
  var images = document.getElementsByClassName("zoomD");
  if (images.length>0) {
    for (var img of images) {
      img.addEventListener("click", zoomImg);
    }
  }

  // Click event to hide the lightbox
  document.getElementById("lb-back").addEventListener("click", function(){
    this.classList.remove("show");
  })
});
    </script>