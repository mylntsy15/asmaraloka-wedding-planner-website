
 import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
 import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js";

const firebaseConfig = {
    apiKey: "AIzaSyDb6Z_pskUUnt3QDGiEJ6cs416aijWLd0w",
    authDomain: "asmaraloka-admin.firebaseapp.com",
    projectId: "asmaraloka-admin",
    storageBucket: "asmaraloka-admin.appspot.com",
    messagingSenderId: "979622171057",
    appId: "1:979622171057:web:9e011fb238a92e13a3ad90"
  };
  

 const app = initializeApp(firebaseConfig);
 const auth = getAuth(app);
 console.log("Firebase has been initialized successfully.");
 
 const submit = document.getElementById('login');
 submit.addEventListener("click", function (event) {
     event.preventDefault()
     const email = document.getElementById('login_email').value;
     const password = document.getElementById('login_password').value;
 
     // Client-side validation
     if (!validateEmail(email)) {
         alert("Please enter a valid email address.");
         return;
     }
 
     if (!validatePassword(password)) {
         alert("Password must be at least 6 characters long.");
         return;
     }
 
     signInWithEmailAndPassword(auth, email, password)
         .then((userCredential) => {
             // Signed up 
             const user = userCredential.user;
             alert("Logging in...")
             window.location.href = "server_list_req2.php";
         })
         .catch((error) => {
             const errorCode = error.code;
             const errorMessage = error.message;
             alert(errorMessage)
         });
 });
 
 // Email validation function
 function validateEmail(email) {
     const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
     return re.test(String(email).toLowerCase());
 }
 
 // Password validation function
 function validatePassword(password) {
     return password.length >= 6;
 }
 
 // Password visibility toggle
 const togglePassword = document.getElementById('togglePassword');
 const passwordInput = document.getElementById('login_password');
 
 togglePassword.addEventListener('click', function () {
     const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
     passwordInput.setAttribute('type', type);
 
     // Toggle the icon
     this.setAttribute('name', type === 'password' ? 'eye-off-outline' : 'eye-outline');
 });
 
 // Logout functionality
 document.getElementById('logout-button').addEventListener('click', function () {
     auth.signOut().then(() => {
       // Sign-out successful.
       alert('You have been logged out.');
       window.location.href = 'admin_home.html';
     }).catch((error) => {
       alert('Error logging out: ' + error.message);
     });
   });