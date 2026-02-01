<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <title>Login Form</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        min-height: 100vh;
      }

      .main-container {
        display: flex;
        width: 100%;
        flex: 1;
        min-height: 100vh;
      }

      /* Left side background */
      .image-side {
        flex: 1;
        background: url("flower.jpg") no-repeat center center;
        background-size: cover;
      }

      /* Login wrapper */
      .login-wrapper {
        width: 100%;
        max-width: 40%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
      }

      /* Circle logo */
      .circle-logo {
        top: 100px;
        left: 50%;
        transform: translateX(-65%);
        background: #fff;
        border-radius: 50%;
        padding: 10px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      }

      .circle-logo img {
        width: 70px;
        border-radius: 60%;
        display: block;
        margin: 0 auto 5px;
      }

      /* Login container */
      .login-container {
        background: #fff;
        padding: 20px 20px 20px 0px;
        text-align: center;
        width: 100%;
      }

      .login-container h2 {
        margin-bottom: 20px;
        font-size: 22px;
        color: #333;
      }

      .login-container form {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }

      .login-icon {
        font-size: 60px;
        color: #023e8a;
        margin-bottom: 8px;
      }

      .login-container input,
      .submit-button {
        padding: 10px 12px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        margin-top: 10px;
      }

      .login-container input:focus {
        border-color: #007bff;
        box-shadow: 0 0 4px rgba(0, 123, 255, 0.4);
      }

      .submit-button {
        background: #023e8a;
        color: #fff;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        border: none;
      }

      .submit-button:hover {
        background: #0056b3;
      }

      .forgot-password {
        font-size: 13px;
        text-align: right;
      }

      .forgot-password a {
        color: #023e8a;
        text-decoration: none;
      }

      .forgot-password a:hover {
        text-decoration: underline;
      }

      .login-container p {
        margin-top: 15px;
        font-size: 14px;
        color: #555;
      }

      .login-container p a {
        color: #023e8a;
        text-decoration: none;
        font-weight: bold;
      }

      .login-container p a:hover {
        text-decoration: underline;
      }

      @media (max-width: 768px) {
        .main-container {
          flex-direction: column;
        }
        .image-side {
          height: 200px;
        }
        .login-wrapper {
          max-width: 100%;
        }
      }

      /* Input group wrapper */
      .input-group {
        position: relative;
        display: flex;
        align-items: center;
        margin-top: 10px;
      }

      .input-group i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-25%);
        color: #555;
        font-size: 16px;
      }

      .input-group input {
        padding-left: 40px;
        padding-right: 40px;
        width: 100%;
      }

      .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #555;
        font-size: 16px;
        padding: 13px;
        line-height: 1;
      }

      /* Custom Dropdown */
      .custom-dropdown {
        position: relative;
        width: 100%;
        text-align: left;
      }

      .dropdown-selected {
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: 0.3s;
      }

      .dropdown-selected:hover {
        border-color: #007bff;
      }

      .dropdown-list {
        display: none;
        position: absolute;
        top: 105%;
        left: 0;
        width: 100%;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        list-style: none;
        padding: 5px 0;
        margin: 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 10;
      }

      .dropdown-list li {
        padding: 10px 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: 0.2s;
        cursor: pointer;
      }

      .dropdown-list li:hover {
        background: #f1f1f1;
      }

      .dropdown-list i {
        color: #023e8a;
      }
    </style>
  </head>
  <body>
    <div class="main-container">
      <div class="image-side"></div>

      <div class="login-wrapper">
        <div class="circle-logo">
          <img src="logo.jpeg" alt="logo" />
        </div>

        <div class="login-container">
          <div class="login-icon">
            <i class="fa-regular fa-user"></i>
          </div>
          <h2>Login to Your Account</h2>

          <form id="loginForm" method="POST" action="../backend/login.php">
            <div class="custom-dropdown">
              <div class="dropdown-selected" id="selected-role" name="role">
                <span><i class="fa-solid fa-user-tag"></i> Select Role</span>
                <i class="fa-solid fa-chevron-down"></i>
              </div>
              <ul class="dropdown-list" id="role-list" aria-required="true">
                <li data-value="user"><i class="fa-solid fa-user"></i> User</li>
                <li data-value="guider">
                  <i class="fa-solid fa-map"></i> Guider
                </li>
                <li data-value="admin">
                  <i class="fa-solid fa-user-shield"></i> Admin
                </li>
              </ul>
              <input type="hidden" name="role" id="role-input" />
            </div>
            <div class="input-group">
              <i class="fa-regular fa-envelope"></i>
              <input type="email" name="email" placeholder="Email" required />
            </div>

            <div class="input-group">
              <i class="fa-solid fa-lock"></i>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="Password"
                required
              />
              <button
                type="button"
                class="toggle-password"
                aria-label="Show password"
              >
                <i class="fa-regular fa-eye-slash"></i>
              </button>
            </div>

            <div class="forgot-password">
              <a href="forgot_password.php">Forgot Password?</a>
            </div>
            <input type="submit" class="submit-button" value="Login">
          </form>

          <p>Don't have an account? <a href="signup.php">Sign Up here</a></p>
        </div>
      </div>
    </div>

    <script>
      // Email + Password validation
      document
        .getElementById("loginForm")
        .addEventListener("submit", function (e) {
          const email = document
            .querySelector("input[name='email']")
            .value.trim();
          const password = document.querySelector(
            "input[name='password']"
          ).value;
          const role = document.getElementById("role-input").value;

          let errors = [];
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(email)) errors.push("Invalid email format.");
          if (password.length < 6)
            errors.push("Password must be at least 6 characters long.");
          if (!role) errors.push("Please select your role.");

          if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join("\\n"));
          }
        });

      // Password toggle
      const toggleBtn = document.querySelector(".toggle-password");
      const passwordInput = document.getElementById("password");
      toggleBtn.addEventListener("click", function () {
        const isHidden = passwordInput.type === "password";
        passwordInput.type = isHidden ? "text" : "password";
        const icon = toggleBtn.querySelector("i");
        icon.className = isHidden
          ? "fa-regular fa-eye"
          : "fa-regular fa-eye-slash";
      });

      // Role dropdown
      const selected = document.getElementById("selected-role");
      const dropdown = document.getElementById("role-list");
      const roleInput = document.getElementById("role-input");

      selected.addEventListener("click", () => {
        dropdown.style.display =
          dropdown.style.display === "block" ? "none" : "block";
      });

      dropdown.querySelectorAll("li").forEach((item) => {
        item.addEventListener("click", () => {
          const value = item.getAttribute("data-value");
          const text = item.textContent.trim();
          selected.querySelector("span").innerHTML = item.innerHTML;
          roleInput.value = value;
          dropdown.style.display = "none";
        });
      });

      // Close dropdown if clicked outside
      document.addEventListener("click", (e) => {
        if (!selected.contains(e.target) && !dropdown.contains(e.target)) {
          dropdown.style.display = "none";
        }
      });
    </script>
  </body>
</html>