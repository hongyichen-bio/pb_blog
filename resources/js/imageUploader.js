
const imageUploader = (className, filenameUrl) => {
    const containers = document.querySelectorAll(`.${className}`);
    for(const container of containers){
        let input = container.querySelector('input[type=file]');
        let img = document.querySelector('img');

        input.addEventListener('change',function(e){
            readURL(e.target, img)
        })
    }
}

function readURL(input, img) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            img.setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }else{
        img.setAttribute('src', 'https://www.lifewire.com/thmb/P856-0hi4lmA2xinYWyaEpRIckw=/1920x1326/filters:no_upscale():max_bytes(150000):strip_icc()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg');
    }
}

export default imageUploader