let divAge = document.querySelector(".divAge");

function displayAge()
{
    for(let i=18; i<=99; ++i)
    {
        divAge.innerHTML += "<a class='dropdown-item' href='#'>"+i+'</a>';
    }
}