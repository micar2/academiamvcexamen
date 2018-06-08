<?php $this->layout('back/layouts/layout');?>
<link rel="stylesheet" href="/admin/css/dataTables.bootstrap.min.css">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Categories Table</h3> <a href="<?= URL ?>categories/create">create category</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <?php foreach ($columns as $column){
                                    foreach ($column as $tipe => $item){
                                        if ($tipe=='Field'){ ?>
                                            <th><?= $item ?></th>
                                        <?php }}} ?>
                                <th>options</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category){ ?>
                                <tr>
                                    <?php  foreach ($category as $camp => $value){
                                        if($camp=='id'){$id=$value;}?>
                                            <td><?= $value ?></td>
                                        <?php } ?>
                                    <td><a href="<?= URL ?>categories/update/<?=$id?>">update</a><br><a href="<?= URL ?>categories/delete/<?=$id?>">delete</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <?php foreach ($columns as $column){
                                    foreach ($column as $tipe => $item){
                                        if ($tipe=='Field'){ ?>
                                            <th><?= $item ?></th>
                                        <?php }}} ?>
                                <th>options</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
