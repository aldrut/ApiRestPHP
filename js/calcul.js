let phrase = "bla bla -5 blab +4 bnbn";
let tab = new String(phrase);

for(let i=0; i <= tab.length; i++)
{
    try {
        let $p = parseFloat(tab[i]);

        if($p == true)
        {
             alert(tab[i]);
        }
    } catch (error) {
        
    }
  
       
   

}

