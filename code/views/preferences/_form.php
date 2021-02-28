<form action="<?=$urlAction ?>" method="POST">
    <input type="hidden" id="id" name="id" value="<?= $preference->getId() ?>" >
    <div>
        <label for="shortName"> Short Name: </label>
        <input type="text" id="shortName" name="shortname" value="<?= $preference->getShortName() ?>">
    </div>

    <div>
        <label for="name"> Name: </label>
        <input type="text" id="name" name="name" value="<?= $preference->getName() ?>">
    </div>

    <button type="submit"> Send </button>
    <button type="reset"> Clear </button>
</form>