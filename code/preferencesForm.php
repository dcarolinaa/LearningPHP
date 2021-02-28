<html>
    <head>
    </head>
    <body>
        <h1> Preferences </h1>
        <div>
            <form action="addPreference.php" method="POST">
                <div>
                    <label for="shortName"> Short Name: </label>
                    <input type="text" id="shortName" name="shortName">
                </div>

                <div>
                    <label for="name"> Name: </label>
                    <input type="text" id="name" name="name">
                </div>

                <button type="submit"> Send </button>
                <button type="reset"> Clear </button>
            </form>
        </div>
    </body>
</html>

