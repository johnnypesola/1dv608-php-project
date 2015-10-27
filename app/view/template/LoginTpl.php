
<form action="login/attempt" method="post">
    <label>Användarnamn</label>
    <input name="<?= $data['fieldNames']['username'] ?>" type="text">
    <label>Lösenord</label>
    <input name="<?= $data['fieldNames']['password'] ?>" type="password">

    <input type="submit" name="<?= $data['fieldNames']['submit'] ?>" value="Logga in">

</form>