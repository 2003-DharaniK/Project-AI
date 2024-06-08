const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});


/*let popup=document.getElementById("popup");

function openPopup(){
   popup.classList.add("open-popup");
}
function clossPopup(){
    popup.classList.remove("open-popup");
 }*/