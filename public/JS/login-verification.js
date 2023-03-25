let admin={
    Email:'nsimplice0@gmail.com',
    Password:'Ingram@CCMS'
};

function checking(){
let email=document.getElementById('email').value;
let password=document.getElementById('password').value;
if(admin.Email===email && admin.Password===password){
 window.location.href="Dashboard/Dashboard-Manager.html";
}
}