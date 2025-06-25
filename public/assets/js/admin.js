

window.addEventListener('load', ()=>{
   document.querySelectorAll('.input-eye').forEach((el)=>{
        let inp = el.parentElement.querySelector('input');
        if(inp){
            el.addEventListener('click', ()=>{
                const type = inp.getAttribute("type") === "password" ? "text" : "password";
                inp.setAttribute("type", type);
                el.classList.toggle('fa-eye');
                el.classList.toggle('fa-eye-slash');
            });
        }
   });
    document.querySelectorAll('.input-close').forEach((el)=>{
        let inp = el.parentElement.querySelector('input');
        if(inp){
            el.addEventListener('click', ()=>{
                // inp.value = null;
            });
        }
    });

});
