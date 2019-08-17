<!-- Default box -->
<div class="row">
  <div class="col-md-3 col-xs-12">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <?php if($user->foto == ''){?>

        <img class="profile-user-img img-responsive img-circle" src="<?= base_url();?>assets/dist/img/avatar5.png" alt="User profile picture">
        <?php }else{?>
        <img class="profile-user-img img-responsive img-circle" src="data:image/jpeg;base64,<?php echo $user->foto; ?>" alt="Avatar" title="Change the avatar">
        <?php }?>
        <h3 class="profile-username text-center"> <?= $user->first_name; ?>&nbsp;<?= $user->last_name; ?></h3>
        <p class="text-muted text-center"><?= $user->company;?></p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>First Name</b> <a class="pull-right"><?= $user->first_name;?></a>
          </li>
          <li class="list-group-item">
            <b>Last Name</b> <a class="pull-right"><?= $user->last_name;?></a>
          </li>
          <li class="list-group-item">
            <b>Email</b> <a class="pull-right"><?= $user->email;?></a>
          </li>
          <li class="list-group-item">
            <b>Telepon</b> <a class="pull-right"><?= $user->phone;?></a>
          </li>
          <li class="list-group-item">
            <b>Status Akun</b> <a class="pull-right"><?php
             if($user->active==1)
              {echo "aktif";} else{ echo "tidak aktif";}?></a>
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
      <?php echo form_open_multipart(uri_string());?>
        <div class="box-body">
                    <div class="form-group">
                          <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
                          <?php echo form_input($first_name);?>
                    </div>

                    <div class="form-group">
                          <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
                          <?php echo form_input($last_name);?>
                    </div>

                    <div class="form-group" style="display:none">
                          <?php echo lang('edit_user_company_label', 'company');?> <br />
                          <?php echo form_input($company);?>
                    </div>

                    <div class="form-group">
                          <?php echo lang('edit_user_phone_label', 'phone');?> <br />
                          <?php echo form_input($phone);?>
                    </div>

                    <div class="form-group">
                          <?php echo lang('edit_user_password_label', 'password');?> <br />
                          <?php echo form_input($password);?>
                    </div>

                    <div class="form-group">
                          <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?> <br />
                          <?php echo form_input($password_confirm);?>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-7 col-xs-12">User Image</label>
                        <div class="form-group">

                          <input id="middle-name" class="form-control col-md-7 col-xs-12" type="file" name="userfile" ">
                        </div>
                      </div> 
                   </div>
                  

                    <div class="box-footer">
                      <div class="col-md-12" style="margin-top:10px;">
                      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn bg-purple clearfix" style="clear:both"');?></p>
                      </div>
                    </div>
                <?php echo form_close();?>
      <!-- <form role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">First Name</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan first name">
          </div>
          <div class="form-group">
            <label for="exampleInputUsername">Last Name</label>
            <input type="text" class="form-control" id="exampleInputUsername" placeholder="Masukkan last name">
          </div>
          <div class="form-group">
            <label for="exampleInputPhone">Nomor Hp</label>
            <input type="text" class="form-control" id="exampleInputNamaBelakang" placeholder="Masukkan nomor telepon">
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
        
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form> -->
    </div>
  </div>
  <!--  / box edit-->

  
</div>
    