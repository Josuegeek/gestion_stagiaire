// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li"),
    typeSelect = document.getElementById("type"),
    topbar = document.querySelector(".topbar");


/*
function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}
*/

//list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");
let menu = document.querySelector("#menu-toggle");

//console.log(document.getElementById('closer'))

//function for close and open menu
function menuManaging(){
  //console.log("menu")
  navigation.classList.toggle("active");
  main.classList.toggle("active");
  topbar.classList.toggle("active");
  //console.log(document.querySelector(".ti-menu"), );
  
  //console.log(menu.classList.contains("ti-menu"));
  
  /*if(menu.classList.contains("ti-menu")){
    menu.classList.remove("ti-menu");
    menu.classList.add("ti-close");
    toggle.classList.add("toggle-close");
  }
  else{
    menu.classList.remove("ti-close");
    menu.classList.add("ti-menu");
    toggle.classList.remove("toggle-close");
  }*/
}

if(document.getElementById("closer"))
document.getElementById("closer").addEventListener("click", (e)=>{
  menuManaging();
});

if(toggle)
toggle.addEventListener("click", (ev)=>{
   menuManaging();
});

let drop = document.getElementById("dropdown-check");

if(drop)
document.addEventListener("click", (e)=>{
  let check = e.target;
  
  //console.log(, );
  if((check != drop)){
    document.getElementById("dropdown-check").checked=false;
  }
});

setTimeout(function() {
  document.getElementById("alert").style.display="none";
  console.log("Showing");
}, 10000);
document.getElementById("alert").addEventListener('click', (e)=>{
  document.getElementById("alert").style.display="none";
});

