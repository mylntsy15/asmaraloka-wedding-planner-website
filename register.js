
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js";

const firebaseConfig = {
    apiKey: "AIzaSyBeo2nbG68wpDsTSEErTTtGsJLahwbGpvQ",
    authDomain: "asmaraloka-1b64b.firebaseapp.com",
    projectId: "asmaraloka-1b64b",
    storageBucket: "asmaraloka-1b64b.appspot.com",
    messagingSenderId: "504684998639",
    appId: "1:504684998639:web:0dcf7393f9b928e4f0901a"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);



const submit = document.getElementById('submit');
submit.addEventListener("click", function (event) {
    event.preventDefault()

    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    
    if (!validateEmail(email)) {
        alert("Please enter a valid email address.");
        return;
    }

    if (!validatePassword(password)) {
        alert("Password must be at least 6 characters long.");
        return;
    }

    createUserWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
            
            const user = userCredential.user;
            alert("Creating account...")
            window.location.href = "index.html";
           
        })
        .catch((error) => {
            const errorCode = error.code;
            const errorMessage = error.message;
            alert(errorMessage)
        });
});


function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}


function validatePassword(password) {
    return password.length >= 6;
}


const togglePasswordRegister = document.getElementById('togglePasswordRegister');
const passwordInputRegister = document.getElementById('password');

togglePasswordRegister.addEventListener('click', function () {
    
    const type = passwordInputRegister.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInputRegister.setAttribute('type', type);

    
    this.setAttribute('name', type === 'password' ? 'eye-off-outline' : 'eye-outline');
});

