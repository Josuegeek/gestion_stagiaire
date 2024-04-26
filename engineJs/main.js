typeSelect.addEventListener('change', (e)=>{
    let selected = e.target.value;
    let studentSection=document.getElementById("section-student");
    let allInput = studentSection.querySelectorAll("input");
    if(selected=="pro"){
      allInput.forEach(element => {
        element.disabled = true;
      });
      studentSection.style.display="none";
    }
    else{
      allInput.forEach(element => {
        element.disabled = false;
      });
      studentSection.style.display="flex";
    }
  });