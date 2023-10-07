const items = document.querySelectorAll("#page_nav ul li");
items.forEach(item => {
    item.addEventListener("click", () => {
        // remove selected from other elements:
        items.forEach(otherItem => {
            otherItem.classList.remove("selected");
        });
        // add selected class over clicked item:
        item.classList.add("selected");

        // access to link in <a> inside <li> element
        const link = item.querySelector("a");
        //get the url
        const url = link.getAttribute("href");
        // redirects to the correspond url
        window.location.href = url;
    })
});


// deal with password button. Show or hide the password
const passwordInput = document.querySelector("input[type=password");
const showPasswordButton = document.querySelector(".showPasswordButton");
const iconLock = document.querySelector(".iconLock");
iconLock.title= "Show password";

showPasswordButton.addEventListener("click", () => {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        iconLock.title= "Hide password";
        iconLock.innerHTML= "&#x1F512;";
    } else {
        passwordInput.type = "password";
        iconLock.innerHTML= "&#x1F513;";
        iconLock.title= "Show password";
        
    }
});