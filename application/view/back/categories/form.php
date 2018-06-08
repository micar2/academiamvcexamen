<form action="<?= $_SERVER["REQUEST_URI"]?>" method="post" class="login">
    <section>
        <?php foreach ($columns as $column){
            foreach ($column as $tipe => $item){
                if ($tipe=='Field' && $item != 'id' && $item != 'updated_at' && $item != 'remember_token' && $item != 'deleted_at'){ ?>

                    <label><?= $item ?>:</label>
                    <input type="text" name="<?= $item ?>" value="<?php if(isset($_POST[$item])) { echo $_POST[$item];} ?>">
                    <p class="error"><?php if(isset($_POST['error_'.$item])) { echo $_POST['error_'.$item]; } ?></p>
                    <br />

                <?php }}} ?>
        <label>&nbsp;</label> <input type="submit" value="Send">
    </section>
</form>