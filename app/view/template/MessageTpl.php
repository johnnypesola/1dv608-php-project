<div class="flash_message">
    <?php foreach ($data as $d): ?>
        <p class="<?= $d['type'] ?>"><?= $d['message'] ?></p>
    <?php endforeach; ?>
</div>