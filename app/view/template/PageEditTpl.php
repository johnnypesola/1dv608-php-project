<form action="http://nya.fagerstaklatterklubb.se/page/save" method="post">
    <h1><input type="text" name="<?= $data['headerFieldName'] ?>" value="<?= $data['header'] ?>"></h1>

    <div class="content">
        <textarea name="<?= $data['contentFieldName'] ?>"><?= $data['content'] ?></textarea>
        <br>
        <input type="submit" name="<?= $data['submitFieldName'] ?>" value="Spara">

        <a class="button" href="http://nya.fagerstaklatterklubb.se/page/delete/<?= $data['pageId'] ?>">Radera sida</a>
    </div>
    <input type="hidden" name="<?= $data['pageIdFieldName'] ?>" value="<?= $data['pageId'] ?>">
</form>