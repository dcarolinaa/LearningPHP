<html>
    <head> 
    </head>
    <body> 

        <h1> Countries </h1>
        <div>
            <form action="addcountry.php" method="POST" >
                <div>
                    <label for="name"> Name:</label>
                    <input type="text" id="name" name="name">
                </div>
                <div>
                    <label for="code"> Code:</label>
                    <input type="text" id="code" name="code">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Send</button>
                <button type="reset" class="btn btn-primary mb-2">Clear</button>
            </form>
        </div>
    </body>
</html>