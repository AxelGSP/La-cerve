const iconMenu = document.getElementById('iconMenu');
const optionsMenu = document.getElementById('optionsMenu');

iconMenu.addEventListener('click', function() {
    if (optionsMenu.style.display === 'none' || optionsMenu.style.display === '') {
        optionsMenu.style.display = 'block';
    } else {
        optionsMenu.style.display = 'none';
    }
});

const loginOption = document.getElementById('loginOption');
const registerOption = document.getElementById('registerOption');

loginOption.addEventListener('click', function() {
    window.location.href = 'login.html';
});

registerOption.addEventListener('click', function() {
    window.location.href = 'register.html';
});
