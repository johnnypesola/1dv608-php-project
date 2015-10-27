<div class="content">
    <form action="auth/login" method="post">
        <label>Användarnamn</label>
        <input name="<?= $data['fieldNames']['username'] ?>" type="text">
        <br>
        <label>Lösenord</label>
        <input name="<?= $data['fieldNames']['password'] ?>" type="password">
        <br>
        <label>Kom ihåg mig</label>
        <input type="checkbox" name="<?= $data['fieldNames']['remember'] ?>" />

        <input type="submit" name="<?= $data['fieldNames']['submit'] ?>" value="Logga in">

    </form>
</div>