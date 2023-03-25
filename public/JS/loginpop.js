function pop(){
    document.getElementById('card-container1').style.display="block";
}

let modalClose=document.querySelector('.modal-close');
modalClose.addEventListener('click',function(){
    formCard.classList.remove('bg-active');
});