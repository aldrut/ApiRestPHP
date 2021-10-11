
    // let v = prompt('Donnez votre prenom');

    // // alert(window.$v);
    //  alert(v);

    //  let field = document.querySelector("#prenom");

    //  field.innerHTML = v;



// let a = 2;
// let b = a++; 

// console.log('// suffixe');
// console.log(a);
// console.log(b);
// console.log('// prefixe');
// let c = 3;
// let d = ++c;
// console.log(c);
// console.log(d);

//  let lblTxt = document.querySelector("#lbl");

//  const nb = 2;
 

// // console.log(nb-1);


//  for(let i=0; i <=10; i++)
//  {
//      lblTxt.innerHTML += (i != 10) ?  i + "~" : i;
//  }

// let user = {
//     name:'Alexandre',
//     annee : '1980',
//     adresse:{
//         street:'place jeanne darc'
        
//     }
// }

// console.log(user.adresse?.cp);

// let pierre = {
//     nom:'pierre',

//     getFullName()
//     {
//         alert(this.nom)
//     }

// }

// pierre.getFullName();

// let age = prompt('Veuillez indiquer votre age ?');
// let msg =[];
//  while(isNaN(age))   {
//      age = prompt('Veuillez indiquer votre age ?');
//  }


// if(age < 6 || age >=18)
// {
//     msg.push('vous êtes hors catégorie');
// }
// else if(age>=6 && age <=7)
// {
//     msg.push('Cette année vous jouerez en catégorie Poussin ');
// }
// else if(age >=8 && age <= 9)
// {
//     msg.push('Cette année vous jouerez en catégorie Pupille ');
// }
// else if(age >=10 && age <= 11)
// {
//     msg.push('Cette année vous jouerez en catégorie Minime ');
// }
// else if(age >=12 && age <= 14)
// {
//     msg.push('Cette année vous jouerez en catégorie Cadet ');
// }
// else if(age >=15 && age <= 17)
// {
//     msg.push('Cette année vous jouerez en catégorie Junior ');
// }
// alert(msg.join());

// msg =[];
// switch (true) {
   
//     case  age >= 6 && parseInt(age) <= 7:
//         msg.push('Poussin');
//         break;
//     case  age >= 8 && age <= 9:
//         msg.push('Pupille');
//         break;
//     case  age >= 10 && age <= 11:
//         msg.push('Minime');
//         break;
//     case  age >= 12 && age <= 14:
//         msg.push('Cadet');
//         break;
//     case  age >= 15 && age <= 17:
//         msg.push('Junior');
//         break;

//     default:
//         msg.push("hors catégorie");
//         break;

// }
// console.log(typeof(age));
// alert(msg.join());



// let nb = prompt("Veuillez saisir le nombre de décalage");
// while(isNaN(nb) || nb <=0 || nb>26)
// {
//     nb = prompt("Veuillez saisir le nombre de décalage");
// }

// let txt = prompt("Veuillez saisir votre phrase d'au moins 10 caractères");

// while(txt.length < 10)
// {
//     txt = prompt("Veuillez saisir votre phrase d'au moins 10 caractères");
// }
// let newMsg = new String("");
// for(let i=0; i <= txt.length; ++i)
// {
//     let nCode = txt.charAt(i) + parseInt(nb);
//     if(nCode > String("z").charAt(0))
    
//         {nCode = nCode -26;}
// else
//         {newMsg += String.fromCharCode(nCode);}
   
// }

// console.log(newMsg);


// txt.forEach(element => {
//     console.log(element)
    
// });



// console.log(typeof(txt));


// class maVoiture
// {
//     constructor(marque, modele, annee)
//     {
//         this.marque =marque;
//         this.modele = modele;
//         this.annee = annee;
//     }

//     resultat()
//     {
//         console.log(this.marque + " " + this.modele + " " +this.annee);
//     }

// }


// let myCar = new Object();
// myCar.mark = 'CHEVROLET';
// myCar.model = 'CAMARO';
// myCar.year = 2017;

// let myCar1 = new Object();
// myCar.mark = 'CHEVROLET';
// myCar.model = 'CAMARO';
// myCar.year = 2017;

// let v1 = new maVoiture('Renault',"Kadjar",2017);
    
// console.log((Object.is(v1.annee,myCar1.year) ? 'ok' : 'pas ok'));  // false
// function isEqual(obj1,obj2)
// {
//     return obj1.year === obj2.year;
// }



// console.log(isEqual(v1,myCar1) ? 'ok' : 'pas ok'); //true

// let t  = new String("bonjour");

// for(let i=0; i <t.length; ++i)
// {
//     console.log(t[i]);
// }
    



// v1.marque = 'Renault';
// v1.modele = 'KADJAR';
// v1.annee = 2017;




//console.log(v1.marque);
//console.log((JSON.stringify(myCar) === JSON.stringify(myCar1) ? 'c ok' : 'c pas ok'));


//  v1.resultat(); // résultat : Renault KADJAR 2017

// console.log(myCar.mark + " " +myCar.model +" "+myCar.year); // résultat : CHEVROLET CAMARO 1998


// alert(myCar['mark'] + myCar['model'] + myCar['year']);

// const target = { a: 1, b: 2 };
// const source = { b: 4, c: 5 };

// const returnedTarget = Object.assign(target, source);

// console.log(target);   // résultat : Object { a: 1, b: 4, c: 5 }

// console.log(returnedTarget); // résultat: Object { a: 1, b: 4, c: 5 }


// const object1 = {
//     a: 'somestring',
//     b: 42,
//     c: false
//   };
  
//   console.log(Object.keys(object1));
//   // Résultat: Array ["a", "b", "c"]


//   const object1 = {
//     a: 'somestring',
//     b: 42,
//     c: false
//   };
  
//   console.log(Object.values(object1));
//   // expected output: Array ["somestring", 42, false]


// const animal = {pattesx4 : 'chiens', pattesx2 : 'oiseaux'  }

// const cloneAnimal_1 = { ...animal } 
// console.log(cloneAnimal_1); //résultat : {pattesx4 : 'chiens', pattesx2 : 'oiseaux'  }

// cloneAnimal_1.pattesx2 = 'dinosaures'
// console.log(cloneAnimal_1); // résultat : {pattesx4 : 'chiens', pattesx2 : 'dinosaures'  }

// const cloneAnimal_2 = Object.assign({},animal);
// console.log(cloneAnimal_2);//résultat : {pattesx4 : 'chiens', pattesx2 : 'oiseaux'  }

// const cloneAnimal_3 = JSON.parse(JSON.stringify(animal))
// console.log(cloneAnimal_3);//résultat : {pattesx4 : 'chiens', pattesx2 : 'oiseaux'  }





      
      


let listTypes =
{
    Longueur : ['Kilomètre','Mètre','Centimètre','Décimètre','Millimètre'],
    Masse : ['Tonne','Kilogramme'],
    Température : ['Degré Celcius','Degré Fahrenheit','Kelvin'],
    Vitesse : ['Mille par heure','Mètre par heure'],
    Volume : ['Litre','Mètre cube','Millilitre'],
    Fréquence : ['Hertz','kiloHertz']
}

let conversion =
{
    // Longueur : {metter:{ foot : 0. }}
}


console.log(Object.entries(listTypes));

let select = document.querySelector(".type");
let selectGauche = document.querySelector(".gauche");
let selectDroite = document.querySelector(".droite");
let inputGauche = document.querySelector(".inputGauche");
let inputDroite = document.querySelector(".inputDroite");
let divError = document.querySelector("#error");
let sd = "sd";
let sg = "sg";


function populateUnite()
{
    for (let k in listTypes)
    {
        select.innerHTML += "<option>" + k + " </option>";
    }
    if(select.value != "")
    {
        for(let v of listTypes[select.value])
        {
            selectGauche.innerHTML += "<option>"+ v +"</option>";
            selectDroite.innerHTML += "<option>"+ v +"</option>";
        }
    }

   
}
populateUnite(); 


select.addEventListener('change', (event)=>
    {
        event.preventDefault();
        selectGauche.innerHTML="";
        selectDroite.innerHTML="";

        for(let v of listTypes[event.currentTarget.value])
        {
            selectGauche.innerHTML += "<option>"+ v +"</option>";
            selectDroite.innerHTML += "<option>"+ v +"</option>";
        }
        
    });

    inputGauche.addEventListener('keyup',(event)=>
    { event.preventDefault();
        inputDroite.value = calculate(null,selectGauche.value,event.currentTarget.value, selectDroite.value, sg);

    });
    
    inputDroite.addEventListener('keyup',(event)=>
    { event.preventDefault();
        //inputGauche.value = event.currentTarget.value;

        inputGauche.value = calculate(null,selectGauche.value,event.currentTarget.value, selectDroite.value, sd);



    });

    selectGauche.addEventListener('change',(event)=>{
        event.preventDefault();

      //inputDroite.value = calculate(inputGauche.value, event.currentTarget.value, selectDroite. )
      alert(selectDroite.currentTarget.value);

    });

    selectDroite.addEventListener('change',(event)=>{
        event.preventDefault();
       
        inputGauche.value = calculate(null,selectGauche.value,event.currentTarget.value, selectDroite.value, sd);
       
       
    });


    function calculate(txtGauche,selectG,txtDroite,selectD, selector)  
    {
        let rst = 0

        if(selector == "sd")
        {
            if(selectD == "Kilomètre" && selectG == "Kilomètre")
            {
                rst = txtDroite;
            }
            else
            {
                rst = txtDroite / 1000;
            }
            if(selectD == "Kilomètre" && selectG == "Centimètre")
            {
                rst = txtDroite /100;
            }
           
        }
        else
        {

        }

      

        return rst;
    }
  
function multipleBy(value, nbZero)
{
    
    return value * 10;
}

alert(1e-2);


let t  = "//"

window.open('c:\\');

let x = 5;
let y = 10;

alert(`${ x + y}`);
