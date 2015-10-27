<form action="page/save/<?= $data['slug'] ?>" method="post">
    <h1><input type="text" name="<?= $data['headerFieldName'] ?>" value="<?= $data['header'] ?>"></h1>

    <div class="content">
        <textarea name="<?= $data['contentFieldName'] ?>"><?= $data['content'] ?></textarea>
        <br>
        <input type="submit" name="<?= $data['submitFieldName'] ?>" value="Spara">
    </div>
    <input type="hidden" name="<?= $data['pageIdFieldName'] ?>" value="<?= $data['pageId'] ?>">
</form>