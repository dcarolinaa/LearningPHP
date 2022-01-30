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
                <td> <a class="delete-image" href="#"><img class="avatarSmall" src="/img/icons/deleteIcon.svg"></a> </td>
            </tr>`;

        littleText.value = "";
        var div = document.createElement('tbody');
        div.innerHTML = li;
        var aImage = div.querySelector('.edit-image');
        var aText = div.querySelector('.edit-text');
        var aDelete = div.querySelector('.delete-image');

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

        aDelete.addEventListener('click', function(){
            var parentInput = aText.parentElement;
            var grandpa = parentInput.parentElement;
            var mainTable = grandpa.parentElement;

            confirm('¿Are you sure to remove it?', 
                function(){
                    mainTable.removeChild(grandpa)
                }
            );
        });
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

    function confirm(text, fnCallback){
        var body = document.querySelector('body');
        var div = `
        <div class="confirm-box">
            <div class="box-top">
                <input type="button" class="btn-close" value="X">
            </div>
            <div class="box-body">
                ${text}
            </div>
            <div class="box-buttons">
                <input type="button" class="btn btn-danger" value="Cancel">
                <input type="button" class="btn btn-primary" value="Ok">
            </div>
        </div>`;

        var divTmp = document.createElement('div');
        divTmp.className = "confirm";
        divTmp.innerHTML = div;
        body.appendChild(divTmp);

        var btnClose = divTmp.querySelector('.btn-close');

        var fnClose = function(){
            body.removeChild(divTmp);
        };

        btnClose.addEventListener('click', fnClose);

        var btnCancel = divTmp.querySelector('.btn-danger');
        
        btnCancel.addEventListener('click', fnClose);

        var btnOk = divTmp.querySelector('.btn-primary');
        btnOk.addEventListener('click', function(){ 
            fnCallback();
            fnClose();
        });

    }

})();