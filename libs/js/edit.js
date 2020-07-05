$(document).ready(function(){ 
    //Elements
    const logoutBtn = document.querySelector(".logout");
    const forms = Array.from(document.querySelectorAll("form"));
    const content = document.querySelector("section .content")
    const headerForm = document.querySelector("section .header h3");
    let inputs ;
    let counter = 0

    //Event Listener
    logoutBtn.addEventListener("click", logout)

    //Functions
    function logout(){
        window.location.href = 'login.php';
    }
    
    window.onload = function () {
        const x = JSON.parse(localStorage.getItem('x'))
        forms.forEach(targetform => {
            if(targetform.id == x){
                headerForm.innerText = `${x}`
                targetform.classList.add("show")
                content.appendChild(targetform)
                // inputs = document.querySelectorAll(".show input")
                // inputs.forEach(input =>{
                //     if(input.type == "text" || input.type == "number" || input.type == "date" || input.type == "email"){
                //         input.value = JSON.parse(localStorage.getItem("inputsValues"))[counter]
                //         counter++;
                //     }
                // })
            }else{
                targetform.classList.remove("show")
            }
        })
    }()
})