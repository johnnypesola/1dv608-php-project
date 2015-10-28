<h1>Användare</h1>
<div class="content">
    <table>
        <tr>
            <th>Användar Id</th>
            <th>Förnamn</th>
            <th>Efternamn</th>
            <th>Användarnamn</th>
        </tr>

        <?php foreach ($data as $d): ?>
            <tr>
                <td><?= $d['userId'] ?></td>
                <td><?= $d['firstName'] ?></td>
                <td><?= $d['surName'] ?></td>
                <td><?= $d['username'] ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>
