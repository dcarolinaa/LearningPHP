<h1> Preferences List </h1>
        <a href="<?= $newURL ?>"> New preference </a>
        <table border="1">
            <tr>
                <th> Id </th>
                <th> Short Name </th>
                <th> Name </th>
                <th> Options </th>
            </tr>
            <?php foreach($preferences as $preference): ?>
                <tr>
                    <td>
                        <?= $preference['id'] ?>
                    </td>
                    <td>
                        <?= $preference['shortname'] ?>
                    </td>
                    <td>
                        <?= $preference['name'] ?>
                    </td>
                    <td>
                        <a href="preferenceEditForm.php?id=<?= $preference['id'] ?>"> Edit </a>
                        <a href="preferenceDelete.php?id=<?= $preference['id'] ?>"> Delete </a>                        
                    </td>                    
                </tr>
            <?php endforeach ?>           
        </table>