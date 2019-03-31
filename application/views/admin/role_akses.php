<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?> </h1>

<div class="row">

<div class = "col-md-6">


<?= $this->session->flashdata('Pesan') ;?>
<h5>Role : <?= $role['role'];?></h5>
<table class = "table table-hover table-striped">

<thead>
        <tr>
            <th>#</th>
            <th>Menu</th>
            <th>Akses</th>
        </tr>
</thead>

<tbody>

<?php
$no = 1; 
foreach ($menu as $key ) : ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $key['menu']; ?></td>
            <td>
            <div class="form-check">
            <input
             data-role = "<?= $role['id']; ?>"
             data-menu= "<?= $key['id']; ?> "
             type="checkbox" <?= akses_check($role['id'] ,  $key['id']); ?>  class="form-check-input">
            </div>
            
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



