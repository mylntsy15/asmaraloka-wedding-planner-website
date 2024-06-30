
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js";

const firebaseConfig = {
  apiKey: "AIzaSyDb6Z_pskUUnt3QDGiEJ6cs416aijWLd0w",
  authDomain: "asmaraloka-admin.firebaseapp.com",
  projectId: "asmaraloka-admin",
  storageBucket: "asmaraloka-admin.appspot.com",
  messagingSenderId: "979622171057",
  appId: "1:979622171057:web:9e011fb238a92e13a3ad90"
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
            window.location.href = "admin_home.html";
            
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

