function vali(){
    var title = document.getElementById('title');
    var ajuda = document.getElementById('ajuda');
    if(title.value.length > 3 && title.value.length < 50){
        title.style.outline = "none";
    } else {
        title.style.outline = "2px solid red";
        return false;
    }
    if(ajuda.value.length > 3 && ajuda.value.length < 300){
        ajuda.style.outline = "none";
    } else {
        ajuda.style.outline = "2px solid red";
        return false;
    }
}