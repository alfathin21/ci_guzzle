<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>



<div class="row">
<div class="col-lg">
<?php if (validation_errors()) : ?>
<div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>'

<?php endif; ?>



<?= $this->session->flashdata('Pesan') ;?>
<a href=""  data-toggle="modal" data-target="#tambah" class="btn btn-primary mt-2 mb-2">Tambah SubMenu</a>
<table class = "table table-hover table-striped">

<thead>
        <tr>
            <th>#</th>
            <th>Nama SubMenu</th>
            <th>Menu</th>
            <th>URL</th>
            <th>Icon</th>
            <th>Aktif</th>
            <th>Aksi</th>
        </tr>
</thead>

<tbody>

<?php $no= 1 ;?>
<?php foreach ($submenu as $m ) : ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?=$m['title'] ?></td>
            <td><?=$m['menu'] ?></td>
            <td><?=$m['url'] ?></td>
            <td><?=$m['icon'] ?></td>
            <td><?=$m['is_active'] ?></td>
            <td>
                <a  href="<?= base_url() ;?>menu/update_submenu/<?= $m['id'] ?>" onclick="return confirm ('yakin data submenu diupdate') ;" class="badge badge-success">Edit</a>
                <a href="<?= base_url() ;?>menu/hapus_submenu/<?= $m['id'] ?>" onclick="return confirm ('yakin data submenu dihapus') ;" class="badge badge-danger">Hapus</a>
            </td>
        </tr>
<?php $no++; ?>
<?php endforeach;?>
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah SubMenu</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="" method="post">
        <div class="modal-body">
        
            <div class="form-group">
                <label for="">Nama SubMenu :</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
            
              <select name="menu_id" id="menu_id" class="form-control">
              <option value="">Pilih Menu</option>
             <?php foreach ($menu as $key ) : ?>
              
              <option value="<?= $key['id']; ?>"><?= $key['menu']; ?></option>
             <?php endforeach; ?>


              </select>
            </div>

            <div class="form-group">
                <label for="">URL :</label>
                <input type="text" name="url" id="url" class="form-control">
            </div>


            <div class="form-group">
                <label for="">Icon  :</label>
                <input type="text" name="icon" id="icon" class="form-control">
            </div>
            <div class="form-group">
               <div class="form-check">
               <input checked="" name="is_active" id="is_active" type="checkbox" class="form-check-input" value="1">
               <label for="is_active" class="form-check-label">Aktif ?</label>
               
               </div>
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
