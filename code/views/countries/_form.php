<form action="<?=$urlAction ?>" method="POST">
    <input type="hidden" id="id" name="id" value="<?= $country->getId() ?>" >
    <div>
        <label for="name"> Name: </label>
        <input type="text" id="name" name="name" value="<?= $country->getName() ?>">
    </div>

    <div>
        <label for="code"> Code: </label>
        <input type="text" id="code" name="code" value="<?= $country->getCode() ?>">
    </div>

    <button type="submit" id="submit"> Send </button>
    <button type="reset"> Clear </button>
</form>