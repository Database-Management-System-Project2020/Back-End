$(document).ready(function(){ 

    // Elements
    const checkInput = document.getElementsByTagName("input")
    const navbarElements = document.querySelectorAll("nav .navbar-nav .nav-item a")
    const deleteBtn = document.getElementById("delete");
    const content = document.querySelector("section .content")
    const tables = Array.from(document.querySelectorAll(".table"));
    const addBtn = document.querySelector(".add");
    const logoutBtn = document.querySelector(".logout");
    const headertableText = document.querySelector("section .header h3");
    let shownTable  ;

    // Event Listener 
    deleteBtn.addEventListener("click", deleteElement) 
    addBtn.addEventListener("click", moveToAddPage)
    logoutBtn.addEventListener("click", logout)

    // functions 

    // navbar toggel between Elements
    navbarElements.forEach(li => {
        li.addEventListener("click", function(e){
            const linkValue = e.target.getAttribute("link")

            tables.forEach(targetTable => {
                if(targetTable.id == linkValue){
                    headertableText.innerText = `${linkValue}`
                    targetTable.classList.add("show")
                    shownTable = document.querySelector(".show")
                    shownTable.addEventListener("click", moveToeditPage)
                    content.appendChild(targetTable)
                }else{   
                    targetTable.classList.remove("show")
                }
            })
        });
    }); 
    
    // filtering recurring profiles 
    $("#filter-Input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // delete customer, supplier, product, recurring profiles
    function deleteElement(Event){
        const checkInputs = document.querySelectorAll("input[type='checkbox']");
        checkInputs.forEach(element => {
            if(element.checked){
                element.parentElement.parentElement.remove()
            }
        });
    } 

    // function to move to add Page
    function moveToAddPage(){
        const formDisplay = headertableText.innerText
        localStorage.setItem( "x",JSON.stringify(formDisplay) )
        window.location.href = 'add.php';
    }

    function moveToeditPage(e){
        // let arr = new Array()
        // let i = 0;
        if(e.target.classList[1] == "fa-edit" || e.target.classList[1] == "edit"){
            window.location.href = 'edit.php';
            // Array.from(e.target.offsetParent.parentElement.children).forEach(x => {
            //     if(x.innerText != ""){ 
            //         arr[i] = x.innerText
            //         localStorage.setItem("inputsValues", JSON.stringify(arr))
            //         i++
            //     }
            // })
        }
        const formDisplay = headertableText.innerText
        localStorage.setItem( "x",JSON.stringify(formDisplay) )
    }
    // logout
    function logout(){
        window.location.href = 'login.php';
    }
    // tabs for products type 
    $( "#Products" ).tabs({
        event: "mouseover"
    });

}); 