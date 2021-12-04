(function(){

    document.getElementById('btn-weird').addEventListener('click', addItem);
    document.getElementById('my-little-text').addEventListener('keyup', function(event){
        if( event.which === 13 )
        {
            addItem();
        }
    });

    var file = document.getElementById('file');
    var inputImage = document.getElementById('image');
    var defaultImageUrl = inputImage.src;
    var selectedImageDataUrl;
    var updateImage = document.getElementById('update-image');
    var imageToChange;

    function addItem(event)
    {
        event.preventDefault();
        var littleText = document.getElementById('my-little-text');
        var theList = document.getElementById('my-list');
        var li = `
            <tr> 
                <td> <a class="edit-image" href="#"><img class="avatarSmall" src="${selectedImageDataUrl}"></a> </td>
                <td> <a class="edit-text" href="#" >${littleText.value}</a> </td>
            </tr>`;

        littleText.value = "";
        var div = document.createElement('tbody');
        div.innerHTML = li;
        var aImage = div.querySelector('.edit-image');
        var aText = div.querySelector('.edit-text');

        aImage.addEventListener('click',function(){
            imageToChange = this.querySelector('img');
            updateImage.click();
        });

        aText.addEventListener('click', function(){
            var input = `<input type="text" value="${aText.innerHTML}">`;
            var parentInput = aText.parentElement;

            parentInput.removeChild(aText);
            parentInput.innerHTML = input;

            parentInput.querySelector('input').addEventListener('keyup', function(event){
                if( event.which === 27 || event.which === 13)
                {
                    parentInput.removeChild(this);
                    parentInput.appendChild(aText);
                }
                
                if( event.which === 13)
                {
                    aText.innerHTML = this.value;                    
                }
            });
        });

        theList.appendChild(div.children[0]);
        inputImage.src = defaultImageUrl;
    }

    function selectedImage(event){
        var image = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(content){
            inputImage.src = content.target.result;
            selectedImageDataUrl = content.target.result;
        };
        reader.readAsDataURL(image);
    }

    file.addEventListener('change', selectedImage);

    updateImage.addEventListener('change', function(event){
        var image = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(content){
            imageToChange.src = content.target.result;
        };
        reader.readAsDataURL(image);
    });

    inputImage.addEventListener('click', function(){
        file.click();
    });

})();