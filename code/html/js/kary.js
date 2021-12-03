(function(){

    document.getElementById('btn-weird').addEventListener('click', addItem);
    document.getElementById('my-little-text').addEventListener('keyup', function(event){
        console.log('akistoy', event);
        if( event.which === 13 )
        {
            addItem();
        }
    });

    function addItem()
    {
        var littleText = document.getElementById('my-little-text');
        var theList = document.getElementById('my-list');

        var li = document.createElement("li");
        li.innerText = littleText.value;
        littleText.value = "";

        theList.appendChild(li);
    }

    var mensaje = "Una variable de mensaje";
    (function ()
    {
        console.log(mensaje);
    })();

})();