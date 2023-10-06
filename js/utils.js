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
        const link = item.querySelector('a');
        //get the url
        const url = link.getAttribute('href');
        // redirects to the correspond url
        window.location.href = url;
    })
})