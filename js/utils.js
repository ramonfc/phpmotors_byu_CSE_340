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
if (iconLock) {
    iconLock.title = "Show password";

    showPasswordButton.addEventListener("click", () => {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            iconLock.title = "Hide password";
            iconLock.innerHTML = "&#x1F512;";
        } else {
            passwordInput.type = "password";
            iconLock.innerHTML = "&#x1F513;";
            iconLock.title = "Show password";

        }
    });
}

// const selector = "form input";
// const inputsToValidate = document.querySelectorAll(selector);
// inputsToValidate.forEach(input => {
//     input.addEventListener('focus', function() {
//         this.setAttribute('required', 'required');
//       });
// });



// const emailInput = document.querySelectorAll("input[type=email], input[type=text], input[type=password]");
// const spanWrong = document.querySelector(".wrong");
// console.log(emailInput)


//     emailInput.forEach(item=> {
        
//         item.addEventListener("input", function() {
        
//         if (item.checkValidity()) {
//             spanWrong.classList.remove("wrong");
//             spanWrong.classList.add("valid");
//           } else {
//             spanWrong.classList.remove("valid");
//             spanWrong.classList.add("wrong");
//           }
//     });
 
// });

const displayCarDetailContainer = document.querySelector("#main_vehicle_details");
const displayThumbnailContainer = document.querySelector("#thumbnail-display");

if (displayThumbnailContainer) {
    displayCarDetailContainer.classList.remove("grid-onecols");
    displayCarDetailContainer.classList.add("grid-two-cols");
} else {
    displayCarDetailContainer.classList.add("grid-onecols");
}