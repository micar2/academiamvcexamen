<?php $this->layout('back/layouts/layout');?>

<section class="content-header">
    <h1>
     Bienvenido a la administración
    </h1>

</section>


<section class="content container-fluid">

   <?= implode(',',\Mini\Libs\Sesion::get('tables')) ?>

</section>