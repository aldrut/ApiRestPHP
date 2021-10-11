// Formulaire LOGIN

/**
 * Importation de
 */
import { Extenders } from "../js/Extenders";
Extenders.init();

let myLoginForm = document.querySelector("#login");
let myErrorMessage = "";

myLoginForm.addEventListener("submit", (event) => {
  event.preventDefault();
  myErrorMessage = "";

  let inputs = document.querySelectorAll("input");
  let divError = document.querySelector("#divError");
  let login = document.querySelector("#login");
  let pwd = document.querySelector("#password");

  for (let i = 0; i < inputs.length; ++i) {
    if (!inputs[i].value) {
      switch (`${inputs[i].id}`) {
        case "email":
            myErrorMessage += `<ul><li>Veuillez renseigner le champs ${(inputs[
            i
          ].name = "Identifiant")} </li></ul>`;
          break;
        case "password":
            myErrorMessage += `<ul><li>Veuillez renseigner le champs ${(inputs[
            i
          ].name = "Mot de passe")} </li></ul>`;
          break;
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
    const url = "../javascript/rest/login.php";
  
    let options = {
      method: "post",
      body: JSON.stringify(jsonData),
      
    };
    fetch(url, options)
      .then((resp) => resp.text())
      .then((text) =>
      {
        localStorage.setItem('User',text);
        let json = text.tryParseToJson();
        let bp;
        if(json != "" )
        {
            const message = `ID = ${json.id} ~ EMAIL =  ${json.email}` ;


            divError.innerHTML = message;
       }
       else
       {
        divError.innerHTML = json.auth;
       }


      },2000);
    }

  }
console.log(localStorage.getItem('User'));

});

