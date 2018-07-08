<div class="page-header">
    <h1>Daftar Pasangan Calon Kepala Negara</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="pencalon" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group <?=($_SESSION['akses']=='admin') ? '' : 'hidden'?>">
                <a class="btn btn-primary" href="?m=pencalon_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Kode Paslon</th>
            <th>Foto Paslon</th>
            <th class="nw">Nama Paslon</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT c.*, COUNT(p.ID) AS total FROM tb_pencalon c LEFT JOIN tb_pilih p ON p.id_pencalon=c.id_pencalon
        WHERE c.kode_pencalon LIKE '%$q%' 
            OR c.nama_pencalon LIKE '%$q%'
        GROUP BY c.id_pencalon
        ORDER BY c.kode_pencalon");
    foreach($rows as $row):?>
    <tr>
        <td><?=$row->kode_pencalon?></td>
        <td><img src="gambar/<?=$row->gambar?>" style="height: 100px;" /></td>
        <td><?=$row->nama_pencalon?></td>
        <td><?=$row->keterangan?></td>
    </tr>
    <?php endforeach;
    ?>
    </table>
</div>