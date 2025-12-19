# Nishanth-projects
This project is a web-based login page created using HTML, CSS, and JavaScript. The project allows users to enter a username containing only alphabetic letters and a password containing only numbers. Real-time validation ensures that invalid characters are automatically restricted. 
[index.html](https://github.com/user-attachments/files/24255933/index.html)
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gradient Login</title>
<style>
body {
  height: 100vh;
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  background: linear-gradient(to right, #1e3c72, #43a3b4);
}

.container {
  width: 300px;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  color: white;
  background: linear-gradient(45deg, #dd2476);
}

input {
  width: 90%;
  padding: 8px;
  margin: 5px 0;
  border-radius: 5px;
  border: none;
  font-weight: 700;
}

button {
  padding: 10px 20px;
  margin-top: 10px;
  cursor: pointer;
  border-radius: 5px;
  border: none;
  background-color: white;
  color: #ff512f;
  font-weight: bold;
}

p {
  margin-top: 10px;
  color: yellow;
  font-weight: bold;
}
</style>
</head>
<body>

<div class="container">
  <h2>Login Page</h2>
  <input type="text" id="username" placeholder="Enter username"><br>
  <input type="password" id="password" placeholder="Enter password"><br>
  <button onclick="login()">Login</button>
  <p id="result"></p>
</div>

<script>
function login() {
    let user = document.getElementById("username").value;
    let pass = document.getElementById("password").value;

    if (user === "admin" && pass === "1234") {
        document.getElementById("result").innerHTML = "Login Successful ✅";
    } else {
        document.getElementById("result").innerHTML = "Invalid username or password ❌";
    }
}
</script>

</body>
</html>
