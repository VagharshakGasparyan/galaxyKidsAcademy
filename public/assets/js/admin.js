

window.addEventListener('load', ()=>{
    //------------------------------Scroll position-begin-------------------------------------------
    let admin_content = document.querySelector('.admin-content');
    if(admin_content){
        window.addEventListener('beforeunload', function() {
            sessionStorage.setItem('admin_content_scrollTop', admin_content.scrollTop.toString());
        });
        const scrollPosition = sessionStorage.getItem('admin_content_scrollTop');
        if (scrollPosition) {
            document.querySelector('.admin-content').scrollTo(0, parseInt(scrollPosition));
            // window.scrollTo(0, parseInt(scrollPosition));
            sessionStorage.removeItem('admin_content_scrollTop');
        }
    }
    //------------------------------Scroll position-end-------------------------------------------

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
