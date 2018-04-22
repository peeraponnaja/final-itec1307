function validate(userForm) {
    div=document.getElementById("emailmsg"); // #1
    div.style.color="red"; // #2
    if(div.hasChildNodes()) // #3
    {
        div.removeChild(div.firstChild); // #4
    }
    regex=/(^\w+\@\w+\.\w+)/; // #5 ความหมาย regular expletion / format string / w คือ word ความหมายคือพยัญชนะกี่ตัวก็ได้
    match=regex.exec(userForm.emailaddress.value);
    if(!match)
    {
        div.appendChild(document.createTextNode("Invalid Email")); // #6
        userForm.emailaddress.focus(); // #7
        return false; // #8
    }

    return true;
}