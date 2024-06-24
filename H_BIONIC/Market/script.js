let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

// manige the number on the navebar  next to the card
menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
};

// when the item is removed from the card the number on the card decrese
window.onscroll = () =>{
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
};


