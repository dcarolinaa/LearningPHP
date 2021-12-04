(function(){

    document.getElementById('btn-weird').addEventListener('click', addItem);
    document.getElementById('my-little-text').addEventListener('keyup', function(event){
        console.log('akistoy', event);
        if( event.which === 13 )
        {
            addItem();
        }
    });

    var file = document.getElementById('file');
    var inputImage = document.getElementById('image');
    var defaultImageUrl = inputImage.src;
    var selectedImageDataUrl;

    function addItem(event)
    {
        event.preventDefault();
        var littleText = document.getElementById('my-little-text');
        var theList = document.getElementById('my-list');
        var li = `
            <li> 
                <img class="avatarSmall" src="${selectedImageDataUrl}"> 
                <span>${littleText.value}</span> 
            </li>`;

        littleText.value = "";
        var div = document.createElement('div');
        div.innerHTML = li;
        console.log(div);
        theList.appendChild(div.children[0]);
        inputImage.src = defaultImageUrl;
    }

    var mensaje = "Una variable de mensaje";
    (function ()
    {
        console.log(mensaje);
    })();

    function selectedImage(event){
        console.log(event);

        var image = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(content){
            inputImage.src = content.target.result;
            selectedImageDataUrl = content.target.result;
        };
        reader.readAsDataURL(image);
    }

    file.addEventListener('change', selectedImage);

    inputImage.addEventListener('click', function(){
        file.click();
    });

})();