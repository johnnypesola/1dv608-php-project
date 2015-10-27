<form action="http://nya.fagerstaklatterklubb.se/page/save" method="post">
    <h1><input type="text" name="<?= $data['headerFieldName'] ?>"></h1>

    <div class="content">
        <textarea name="<?= $data['contentFieldName'] ?>"></textarea>
        <br>
        <input type="submit" name="<?= $data['submitFieldName'] ?>" value="Spara">
    </div>
</form>