function vali(){
    const file = document.querySelector('#photo')
    if(file.files.length === 0){
        document.getElementById('label').style.outline = "2px solid red";
        return false;
    } else {
        document.getElementById('label').style.outline = "none";
    }
}
document.addEventListener('DOMContentLoaded', function(){
    const fileInput = document.querySelector('#photo')
    const imagePreview = document.getElementById('img')

    fileInput.addEventListener('change', function() {
        imagePreview.style.display = "flex";
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(event) {
                imagePreview.src = event.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
})