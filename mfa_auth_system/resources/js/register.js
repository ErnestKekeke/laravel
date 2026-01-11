let pdnm = document.getElementById("pdnm");
pdnm.style.visibility = "hidden";



let pwd = document.getElementById("pwd");
let comPwd = document.getElementById("com-pwd");


pwd.addEventListener("keyup", () => {
    pwd.value = pwd.value.trim();
    comPwd.value = comPwd.value.trim();

    // pwd.value === comPwd.value? console.log("Passwords match") : console.log("Passwords do not match");
    if(pwd.value !== comPwd.value){
        pdnm.innerHTML = "password do not match"
        pdnm.style.cssText = "visibility: visible; color: red;";
    }else if(pwd.value.length < 6 ){
        pdnm.innerHTML = "password minimum of 6 character"
        pdnm.style.cssText = "visibility: visible; color: red;";
    }
    else{
        pdnm.innerHTML = "password match"
        pdnm.style.cssText = "visibility: visible; color: green;";
    }

    console.log(pwd.value);
});


comPwd.addEventListener("keyup", () => {
    pwd.value = pwd.value.trim();
    comPwd.value = comPwd.value.trim();

    // pwd.value === comPwd.value? console.log("Passwords match") : console.log("Passwords do not match");
    if(pwd.value !== comPwd.value){
        pdnm.innerHTML = "password do not match"
        pdnm.style.cssText = "visibility: visible; color: red;";
    }else if(pwd.value.length < 6 ){
        pdnm.innerHTML = "password minimum of 6 character"
        pdnm.style.cssText = "visibility: visible; color: red;";
    }
    else{
        pdnm.innerHTML = "password match"
        pdnm.style.cssText = "visibility: visible; color: green;";
    }

    console.log(comPwd.value);
});





let registerForm =  document.getElementById("register-form");
let chkAgree = document.getElementById("chk-agree");

registerForm.addEventListener("submit", (e)=>{
    console.log(chkAgree.checked);
    if(!chkAgree.checked){
        window.alert("You need to accept terms and agreement !");
        e.preventDefault();
    }
  
})
