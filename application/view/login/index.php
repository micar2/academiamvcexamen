
<?php $this->layout('layouts/layout');?>
<section>
    <div class="container">
        <h2>Login de usuarios</h2>
        <form action="<?= URL ?>login/dologin" method="post" class="login">
            <section>
                <label>Email:</label> <input type="text" name="email" value="<?php if(isset($_POST['email'])) {
                    echo $_POST['email'];}
                ?>"> <p class="errorf"><?php if(isset($_POST['error_email'])) {
                        echo $_POST['error_email'];
                    } ?></p>
                <br />
                <label>Clave:</label> <input type="password" name="password" ><p class="errorf"><?php if(isset($_POST['error_password'])) {
                        echo $_POST['error_password'];
                    }else{
                        if (isset($_POST["feedback_negative"])){
                            echo $_POST["feedback_negative"];
                        }
                    } ?></p>
                <br />
                <label>&nbsp;</label> <input type="submit" value="Acceder">
            </section>
        </form>
    </div>
</section>
