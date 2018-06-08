
<?php $this->layout('layouts/layout');?>
<section>
    <div class="container">
        <h2>Register</h2>
        <form action="<?= URL ?>register/doregister" method="post" class="login">
            <section>
                <label>Name:</label> <input type="text" name="name" value="<?php if(isset($_POST['name'])) {
                    echo $_POST['name'];}
                ?>"> <p class="error"><?php if(isset($_POST['error_name'])) {
                        echo $_POST['error_name'];
                    } ?></p>
                <br />
                <label>Email:</label> <input type="text" name="email" value="<?php if(isset($_POST['email'])) {
                    echo $_POST['email'];}
                ?>"> <p class="error"><?php if(isset($_POST['error_email'])) {
                        echo $_POST['error_email'];
                    } ?></p>
                <br />
                <label>Password:</label> <input type="password" name="password" ><p class="error"><?php if(isset($_POST['error_password'])) {
                        echo $_POST['error_password'];
                    }else{
                        if (isset($_POST["feedback_negative"])){
                            echo $_POST["feedback_negative"];
                        }
                    } ?></p>
                <br />
                <label>Confirm Password:</label> <input type="password" name="confPassword" ><p class="error"><?php if(isset($_POST['error_confPassword'])) {
                        echo $_POST['error_confPassword'];
                    }else{
                        if (isset($_POST["feedback_negative"])){
                            echo $_POST["feedback_negative"];
                        }
                    } ?></p>
                <br />
                <input type="hidden" name="user_rol" value="normal" >
                <label>&nbsp;</label> <input type="submit" value="Acceder">
            </section>
        </form>
    </div>
</section>
