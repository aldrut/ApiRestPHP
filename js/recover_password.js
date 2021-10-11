import { Extenders } from "../js/Extenders";
Extenders.init();

let myRecorverForm = document.querySelector("#recoverPassword");
let validation = document.querySelector("#recoverPasswordToken");
let validation2 = document.querySelector("#recoverPasswordClear");
let myErrorMessage = "";


myRecorverForm.addEventListener('submit',(event) =>
{
    event.preventDefault();
    myErrorMessage = "";


    let inputs = document.querySelectorAll("input");
    let divError = document.querySelector("#divError");

    for(let i=0; i <inputs.length; i++)
    {
        if(!inputs[i].value)
        {
            switch (`${inputs[i].id}`) {
                case "email":
                    myErrorMessage += `<ul><li>Le champs ${(inputs[i].id )} est oblogatoire </li></ul>`;
                  break;
            }
        }
    }
    if (myErrorMessage) {
        divError.innerHTML = `${myErrorMessage}`;
        return false;
    }
    
    else
    {
        divError.innerHTML = "";
    const form = event.currentTarget;
    
    const formData = new FormData(form);
    let jsonData = Object.fromEntries(formData);

    //send post data
    const url = "../javascript/rest/RecoverPassword.php";
  
    let options = {
      method: "post",
      body: JSON.stringify(jsonData),
      
    };

    fetch(url,options)
    .then((resp)=> resp.text())
    .then((text)=>
    {
        const json = JSON.tryParse(text);
        if(json.token)
        {  
            const message = '<div>To complete your registration, look your mailbox up. </div>';
            const validationButton =
            `<a id='btnToken' class="btn btn-success btn-lg" href="../javascript/rest/RecoverPassword.php?t=${encodeURIComponent(json.token)}">
            Confirm registration
            </a>`;
            document.getElementById('recoverPassword').classList.add('d-none');
            validation.innerHTML += message;
            setTimeout(()=>{
            validation.innerHTML += validationButton;


            const message2 = `<div class="mt-5">Mot de passe en clair : ${json.passwordClear}</div>`;
            validation2.innerHTML += message2;
          },2000);
        }
    });
}
});
