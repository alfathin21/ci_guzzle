<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?> </h1>

<div class="row">

<div class = "col-md-6">

<?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>') ;?>


<?= $this->session->flashdata('Pesan') ;?>

<a href=""  data-toggle="modal" data-target="#tambah" class="btn btn-primary mt-2 mb-2">Tambah Role</a>
<table class = "table table-hover table-striped">

<thead>
        <tr>
            <th>#</th>
            <th>Nama Role</th>
            <th>Aksi</th>
        </tr>
</thead>

<tbody>

<?php
$no = 1; 
foreach ($role as $key ) : ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $key['role']; ?></td>
            <td>
                <a href="<?= base_url('admin/role_akses/');?><?= $key['id'] ?>"  class="badge badge-warning">Akses</a>
                <a href="<?= base_url('admin/update_menu/');?><?= $key['id'] ?>" onclick="return confirm ('yakin data menu diupdate') ;" class="badge badge-success">Edit</a>
                <a href="<?= base_url('admin/delete_menu/');?><?= $key['id'] ?>" onclick="return confirm ('yakin data menu dihapus') ;" class="badge badge-danger">Hapus</a>
            </td>
        </tr>

<?php 
$no++;
endforeach; ?>
</tbody>


</table>

</div>
</div>


</div>


</div>



<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="" method="post">
        <div class="modal-body">
        
            <div class="form-group">
                <label for="">Nama Role :</label>
                <input type="text" name="role" class="form-control">
            </div>
        </div>

        
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" name="simpan" class="btn btn-primary" >Simpan</a>
        </div>
      </form>
      </div>
    </div>
  </div>
