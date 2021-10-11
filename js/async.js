import { Extenders } from "../js/Extenders";
Extenders.init();

let validation = document.querySelector("#validationMail");

let myForm = document.querySelector("#registration");

let messageErreur = "";
myForm.addEventListener("submit", (event) => {
  event.preventDefault();
  messageErreur = "";

  let inputs = document.querySelectorAll("input");

  let erreur = document.querySelector("#divError");
  let pwd1 = document.querySelector("#inputPassword1").value;
  let pwd2 = document.querySelector("#inputPassword2").value;
 
  for (let i = 0; i < inputs.length; ++i) {
    if (!inputs[i].value) {

        switch (`${inputs[i].id}`) {
            case 'txtName':

            messageErreur += `<ul><li>Veuillez renseigner le champs ${inputs[i].name = 'Nom'} </li></ul>`;
                break;
            case 'firstName':
                messageErreur += `<ul><li>Veuillez renseigner le champs ${inputs[i].name = 'Prénom'} </li></ul>`;
                break;
            case 'exampleInputEmail1':
                messageErreur += `<ul><li>Veuillez renseigner le champs ${inputs[i].name = 'mail'} </li></ul>`;
                break;
            case 'inputPassword1':
                messageErreur += `<ul><li>Veuillez renseigner le champs ${inputs[i].name = 'Mot de passe'} </li></ul>`;
                break;
            case 'inputPassword2':
                messageErreur += `<ul><li>Veuillez renseigner le champs ${inputs[i].name = 'Confirmer le mot de passe'} </li></ul>`;
                break;
           
        }
    }
    //const regex = /\d/;
    const regex = /^([^0-9]*)$/;
    if(inputs[i].id == 'firstName') 
    {
        if(!inputs[i].value.match(regex))
        {
            messageErreur += `<ul><li>Pas de chiffre dans le champs ${inputs[i].name = 'Prénom'} </li></ul>`;
        }
    }
    if(inputs[i].id == 'txtName') 
    {
        if(!inputs[i].value.match(regex))
        {
            messageErreur += `<ul><li>Pas de chiffre dans le champs ${inputs[i].name = 'Nom'} </li></ul>`;
        }
    }
  }
  if(pwd1 != pwd2 )
  {
    messageErreur += "<ul><li>Les mots de passe ne sont pas identiques</li><ul>";
  }

  if (messageErreur) {
    erreur.innerHTML = `${messageErreur}`;
    return false;
  } 
  else 
  {
    erreur.innerHTML = "";
    const form = event.currentTarget;
    
    const formData = new FormData(form);
    let jsonData = Object.fromEntries(formData);

    //send post data
    const url = "../javascript/rest/index.php";
    let options = {
      method: "post",
      body: JSON.stringify(jsonData),
    };

    fetch(url, options)
      .then((resp) => resp.text())
      .then((text) =>
      {
        // console.log(text);
        const json = JSON.tryParse(text);
        // try{
        //   json = JSON.parse(text);
        // }
        // catch{}

        // erreur.innerHTML += json;

        
        console.log(json);
        let json2 = text.tryParseToJson();
        console.log(json2);
        if(json.token)
        {
          const message = '<div>To complete your registration, look your mailbox up. </div>';
          const validationButton =
          `<a id='btnToken' class="btn btn-success btn-lg" href="../javascript/rest/index.php?t=${encodeURIComponent(json.token)}">
          Confirm registration
          </a>`;
          document.getElementById('registration').classList.add('d-none');
          validation.innerHTML += message;
          setTimeout(()=>{
          validation.innerHTML += validationButton;
          // let btnValidToken = document.querySelector("#btnToken");
          // btnValidToken.addEventListener('click', (event) =>
          // {
          //   const obj = {}
          //   obj[event.currentTarget.id] = event.currentTarget.value;
          //   console.log(`the token is ${obj}`);
          // });
          },2000);
        }


      });
      let bp;
  }
});












