<?php foreach( $data['pnr'] as $dt ) : ?>
<?php endforeach;?>
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
                                            <li><span class="bread-blod">Donatur Qurban</span>
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
                                            <li><span class="bread-blod">Peserta Qurban</span>
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
                            <div class="sparkline12-list shadow-reset mg-t-30">
                                <div class="sparkline12-hd">
                                    <div class="main-sparkline12-hd">
                                        <h1>Form Edit Peserta</h1>
                                    </div>
                                </div>
                                <div class="sparkline12-graph">
                                    <div class="basic-login-form-ad">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="all-form-element-inner">
      <form action="<?= BASEURL; ?>/Donatur/edit_data" method="POST">
          <input type="hidden" id="id" name="id" required="required" class="form-control" value="<?= $data['donatur']['id'];?>">
          <div class="form-group-inner">
              <div class="row">
                  <div class="col-lg-3">
                      <label class="login2 pull-right pull-right-pro">Nama Donatur</label>
                  </div>
                  <div class="col-lg-9">
                      <div class="form-select-list">
                          <input class="form-control" type="text" id="nama" name="nama" value="<?= $data['donatur']['nama']; ?>" required>
                      </div>
                  </div>
              </div>
          </div>

          <div class="form-group-inner">
              <div class="row">
                  <div class="col-lg-3">
                      <label class="login2 pull-right pull-right-pro">Alamat Donatur</label>
                  </div>
                  <div class="col-lg-9">
                      <div class="form-select-list">
                          <input class="form-control" type="text" id="alamat" name="alamat"  value="<?= $data['donatur']['alamat']; ?>">
                      </div>
                  </div>
              </div>
          </div>
		  
		  <div class="form-group-inner">
              <div class="row">
                  <div class="col-lg-3">
                      <label class="login2 pull-right pull-right-pro">Handphone Donatur</label>
                  </div>
                  <div class="col-lg-9">
                      <div class="form-select-list">
                          <input class="form-control" type="text" id="handphone" name="handphone"  value="<?= $data['donatur']['handphone']; ?>">
                      </div>
                  </div>
              </div>
          </div>
		  
		   <div class="form-group-inner">
              <div class="row">
                  <div class="col-lg-3">
                      <label class="login2 pull-right pull-right-pro">Jenis Qurban</label>
                  </div>
                  <div class="col-lg-9">
                      <div class="form-select-list">
                          <select name="jenis_qurbanlist" class="form-control" id="jenis_qurbanlist" required>
                <option value="">Pilih Jenis Qurban</option>
                <option value="kambing"<?= $data['donatur']['jenis_qurban'] == 'kambing' ? 'selected' : '' ?>>Kambing</option>
                <option value="sapi"<?= $data['donatur']['jenis_qurban'] == 'sapi' ? 'selected' : '' ?>>Sapi</option>
                <option value="sapi patungan"<?= $data['donatur']['jenis_qurban'] == 'sapi patungan' ? 'selected' : '' ?>>Sapi Patungan</option>
            </select>
			<input type="hidden" name="jenis_qurban" id="jenis_qurban" value="<?= $data['donatur']['jenis_qurban']; ?>">
                      </div>
                  </div>
              </div>
          </div>      
        
          
          <div class="form-group-inner">
              <div class="login-btn-inner">
                  <div class="row">
                      <div class="col-lg-3"></div>
                      <div class="col-lg-9">
                          <div class="login-horizental cancel-wp pull-left">
                              <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Save Change</button>
                              <a href="<?= BASEURL; ?>/Donatur/"  button type="button" class="btn btn-primary">Kembali</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Static Table End -->
        </div>
    </div>


<script>
document.getElementById('jenis_qurbanlist').addEventListener('change', function() {
    document.getElementById('jenis_qurban').value = this.value;
});
</script>