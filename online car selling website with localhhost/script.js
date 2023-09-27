//for storing registration data in local storage

//registration eventlistener
document.addEventListener('DOMContentLoaded',function(){
    const reg=document.getElementById('registration-form');
    reg.addEventListener("submit",function(event){
        event.preventDefault();
        var name = document.getElementById('name').value;
        var address = document.getElementById('address').value;
        var phone = document.getElementById('phone').value;
        var email = document.getElementById('email').value;
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
    
      const user={name,address,phone,email,username,password};
      let users=JSON.parse(localStorage.getItem('users')) || [];
      users.push([user]);
      localStorage.setItem('users',JSON.stringify(users));
      alert("Successfully registered");
      window.location.href = "login.html";


        
    })
})

//validate  login
function login(){
    
    var username=document.getElementById("username").value;
    var password=document.getElementById("password").value;

    const users=JSON.parse(localStorage.getItem('users'))|| [];
    let isITValid=false;
    let looged=null;
    for(const u of users){
        const sameUSer=u.find(user => user.username===username && user.password===password);
        if(sameUSer){
            isITValid=true ;
            break;
        }
    }
    if(isITValid){
        alert("welcome");
        window.location.href="seller.html"
        
    }else{

        alert("validation failed");
    }
   


}

//add car data
document.addEventListener("DOMContentLoaded",function(){
    const addCar=document.getElementById("add-car-form");
    addCar.addEventListener("submit",function(event){
        event.preventDefault();
        var make =document.getElementById('make').value;
        var model =document.getElementById('model').value;
        var year =document.getElementById('year').value;
        var mileage =document.getElementById('mileage').value;
        var location =document.getElementById('location').value;
        var price =document.getElementById('price').value;
    
     const detail={make,model,year,mileage,location,price};
     let details=JSON.parse(localStorage.getItem("details")) || [];
     details.push(detail);
     localStorage.setItem("details",JSON.stringify(details));
    
    
       alert("detials added successfully");
         window.location.href = "seller.html";
    })


})

document.addEventListener('DOMContentLoaded', function () {
     // your code using querySelectorAll here
 
     // input and button selection
     const formInputs = document.querySelectorAll("input");
     const buttons = document.querySelectorAll("button");
 
     // background color selection when user points inside to textfield
     formInputs.forEach((input) => {
         input.addEventListener("focus", () => {
             input.style.backgroundColor = "yellow";
         });
     });
 
     // background color selection when user leaves to textfield
     formInputs.forEach((input) => {
         input.addEventListener("blur", () => {
             input.style.backgroundColor = "white";
         });
     });
 
     // background color selection when user points the button
     buttons.forEach((button) => {
         button.addEventListener("mouseover", () => {
             button.style.backgroundColor = "lightblue";
         });
 
     // background color selection when user points to mouse textfield
     button.addEventListener("mouseout", () => {
             button.style.backgroundColor = "";
         });
     });
 });
 
 //searching 
 