        <div id="menu">
            <?php foreach ($data as $d): ?>
                <a href="http://nya.fagerstaklatterklubb.se/<?= $d['href'] ?>" class="active"><?= $d['name'] ?></a>
            <?php endforeach; ?>
        </div>