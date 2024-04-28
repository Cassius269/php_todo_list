// Selectionner le bouton ajouter
let buttonAdd= document.querySelector("#botonAdd");
let ULlistTask = document.querySelector("#liste");
let formAddTask = document.querySelector(".formAddTask");
let buttonCancel =document.querySelector(".buttonCancel");

console.log(formAddTask);

console.log(ULlistTask);

// Actions d'Ajout d'une task 
buttonAdd.addEventListener("click",()=>{
    console.log("GROS bouton AJOUTER clické");

    formAddTask.animate([
        {
            transform:"translateY(0px)"
        },
        {
            transform:"translateY(-300px)"
        }
    ],
        {
            duration:1000,
            fill:"forwards",
        }
    );

    ULlistTask.animate([
        {
            opacity:1        
        },
        {
            opacity:0,        
        }
    ],
    {
        duration:1000,
        fill:"forwards",
    });

    
    buttonAdd.style.display="none";
    formAddTask.classList.toggle("cacher");

});

buttonCancel.addEventListener("click",function (){
    console.log("Boutton annulé cliqué");

    formAddTask.animate([
        {
            transform:"translateY(0px)"
        },
        {
            transform:"translateY(300px"
        }
    ],
        {
            duration:1000,
            fill:"forwards",
        }
    );

    ULlistTask.animate([
        {
            opacity:0
        },
        {
            opacity:1
        }
    ],
    {
        duration:1000,
        fill:"forwards",
    });

    
    buttonAdd.style.display="block";
    formAddTask.classList.toggle("cacher");

})


// Actions de Mise à jour d'une task
console.log(ULlistTask.childNodes)

ULlistTask.addEventListener("click",(e)=>{
    console.log(e);
    if(e.target.nodeName === "SPAN"){
        console.log("SPAN cliqué");
    }
})