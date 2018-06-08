<?php use Mini\Libs\Sesion; ?>
<?php $this->layout('layouts/layout') ?>
<section>

    <div class="container">
        <h2>Login Correcto</h2>
        <p>Bienvenido <?= Sesion::get("username") ?> <?=Sesion::get('user_id')?></p>
    </div>
</section>
