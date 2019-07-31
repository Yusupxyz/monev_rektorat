<!-- Default box -->
<div class="row">
  <div class="col-md-3 col-xs-12">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?= base_url();?>assets/dist/img/user4-128x128.jpg" alt="User profile picture">
        <h3 class="profile-username text-center">Nina Mcintire</h3>
        <p class="text-muted text-center">Software Engineer</p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Email</b> <a class="pull-right">email</a>
          </li>
          <li class="list-group-item">
            <b>Telepon</b> <a class="pull-right">Telepon</a>
          </li>
        </ul>
        <a href="<?= base_url();?>auth/logout" class="btn bg-purple btn-block"><b>Sign Out</b></a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!--  box edit-->
  <div class="col-md-5 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Profil</h3>
      </div>
        <!-- /.box-header -->
        <!-- form start -->
      <form role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Alamat Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Email">
          </div>
          <div class="form-group">
            <label for="exampleInputUsername">Username</label>
            <input type="text" class="form-control" id="exampleInputUsername" placeholder="Masukkan Username">
          </div>
          <div class="form-group">
            <label for="exampleInputPhone">Nomor Hp</label>
            <input type="text" class="form-control" id="exampleInputNamaBelakang" placeholder="Masukkan Nama Belakang">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password Lama</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password Lama">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword2">Password Baru</label>
            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password Baru">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Foto Profil</label>
            <input type="file" id="exampleInputFile">
            <p class="help-block">Example block-level help text here.</p>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <!--  / box edit-->

  
</div>
    