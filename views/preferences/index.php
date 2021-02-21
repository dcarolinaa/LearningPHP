<h1> Preferences List </h1>
        <a href="<?= $newURL ?>"> New preference </a>
        <table border="1" class="table table-striped">
            <tr>
                <th> Id </th>
                <th> Short Name </th>
                <th> Name </th>
                <th> Options </th>
            </tr>
            <?php foreach($preferences as $preference): ?>
                <tr>
                    <td>
                        <?= $preference->getId() ?>
                    </td>
                    <td>
                        <?= $preference->getShortName() ?>
                    </td>
                    <td>
                        <?= $preference->getName() ?>
                    </td>
                    <td>
                        <a href="<?= $getURL('edit','preferences', ['id' => $preference->getId()]) ?>"> Edit </a>
                        <a href="<?= $getURL('delete','preferences', ['id' => $preference->getId()]) ?>"> Delete </a>                        
                    </td>                    
                </tr>
            <?php endforeach ?>           
        </table>