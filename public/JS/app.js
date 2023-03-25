let add= document.getElementById('modal-btn');
let formCard= document.querySelector('.form-card');
let modalClose=document.querySelector('.modal-close');
add.addEventListener('click',function(){
    formCard.classList.add('bg-active');
});
modalClose.addEventListener('click',function(){
    formCard.classList.remove('bg-active');
});

/*let update= document.getElementById('update');
let formCardUpdate= document.querySelector('.form-card-update');
let modalCloseUpdate=document.querySelector('.modal-close-update');
update.addEventListener('click',function(){
    formCardUpdate.classList.add('bg-active');
});
modalCloseUpdate.addEventListener('click',function(){
    formCardUpdate.classList.remove('bg-active');
});*/



