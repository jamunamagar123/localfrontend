<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup Form</title>
    <style>
      body {
        font-family: Arial;
        margin: 0;
        padding: 0;
        display: flex;
        min-height: 100vh;
      }
      .main-container {
        display: flex;
        width: 100%;
        min-height: 100vh;
      }
      .image-side {
        flex: 1;
        background: url("flower.jpg") no-repeat center center;
        background-size: cover;
      }
      .signup-wrapper {
        width: 100%;
        max-width: 50%;
        margin-top: 0px;
      }
      .circle-logo {
        position: absolute;
        top: 300px;
        left: 50%;
        transform: translateX(-50%);
        background: #fff;
        border-radius: 50%;
        padding: 15px;
        text-align:right;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      }
      .circle-logo img {
        width: 70px;
        display: block;
        margin: 0 auto;
      }
      .signup-container {
        background: #fff;
        padding: 0 60px 40px;
        text-align: center;
        margin-top: 2px;
      }
      .signup-container h2 {
        margin-bottom: 20px;
        font-size: 22px;
        color: #333;
      }
      .signup-container form {
        display: flex;
        flex-direction: column;
        gap: 15px;
      }
      input,
      select,
      button {
        padding: 10px 12px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
      }
      input:focus,
      select:focus {
        border-color: #007bff;
        box-shadow: 0 0 4px rgba(0, 123, 255, 0.4);
      }
      .row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
      }
      .row > * {
        flex: 1;
      }
      .phone-gender {
        display: flex;
        gap: 10px;
        align-items: center;
      }
      .phone-gender input {
        flex: 2;
      }
      .phone-gender .gender-field {
        flex: 1;
        display: flex;
        gap: 10px;
      }
      .preference-address {
        display: flex;
        gap: 10px;
      }
      .preference-address select {
        flex: 1;
      }
      .preference-address input {
        flex: 1;
      }
      .file-preview {
        display: flex;
        gap: 10px;
        margin-top: 10px;
      }
      .file-preview img {
        max-width: 100px;
        border-radius: 8px;
      }
      button {
        background: #023e8a;
        color: #fff;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        border: none;
        transition: 0.3s;
      }
      button:hover {
        background: #0056b3;
      }
      p {
        margin-top: 15px;
        font-size: 14px;
        color: #555;
        text-align: center;
      }
      p a {
        color: #023e8a;
        text-decoration: none;
        font-weight: bold;
      }
      p a:hover {
        text-decoration: underline;
      }
      @media (max-width: 768px) {
        .row,
        .phone-gender,
        .preference-address {
          flex-direction: column;
        }
      }
    </style>
  </head>
  <body>
    <div class="main-container">
  <div class="image-side"></div>
  <div class="signup-wrapper">
    <div class="circle-logo">
      <img src="logo.jpeg" alt="logo" />
    </div>

    <div class="signup-container">
      <h2>Join Local Tour Guide</h2>

      <form id="signupForm" method="POST" action="../backend/signconnection.php" enctype="multipart/form-data">

        <label for="role">I am:</label>
        <select id="role" name="role" required>
          <option value="user">User</option>
          <option value="guide">Guide</option>
        </select>

        <div class="row">
          <input type="text" name="first_name" placeholder="First Name" required />
          <input type="text" name="last_name" placeholder="Last Name" required />
        </div>

        <input type="email" name="email" placeholder="Email" required />

        <input type="password" name="password" placeholder="Password" required />
        <input type="password" name="confirm_password" placeholder="Confirm Password" required />

        <div class="row">
          <input type="date" name="dob" id="dob" required />

          <select name="nationality" required>
            <option value="">Select Nationality</option>
            <option value="nepali">Nepali</option>
            <option value="indian">Indian</option>
            <option value="chinese">Chinese</option>
            <option value="american">American</option>
            <option value="other">Other</option>
          </select>

          <select name="language" required>
            <option value="">Select Language</option>
            <option value="english">English</option>
            <option value="nepali">Nepali</option>
            <option value="hindi">Hindi</option>
            <option value="chinese">Chinese</option>
            <option value="other">Other</option>
          </select>
        </div>

        <div class="phone-gender">
          <input type="text" name="phone" placeholder="Phone (e.g. +9779876543210)" required />

          <div class="gender-field">
            <label><input type="radio" name="gender" value="male" required /> Male</label>
            <label><input type="radio" name="gender" value="female" required /> Female</label>
          </div>
        </div>

        <div class="preference-address">
          <select name="preference" required>
            <option value="">Select Preference</option>
            <option value="adventure">Adventure</option>
            <option value="cultural">Cultural</option>
            <option value="nature">Nature</option>
            <option value="historical">Historical</option>
          </select>

          <input type="text" name="address" placeholder="Address" required />
        </div>

        <!-- GUIDE FIELDS -->
        <div class="guide-fields" style="display:none; flex-direction:column; margin-top:15px; padding:15px; border:1px solid #ddd; border-radius:10px;">

          <input type="text" name="citizenship" placeholder="Citizenship Number" />

          <label>Upload Citizenship Photo:</label>
          <input type="file" name="citizenship_photo" accept="image/*" />

          <label>Upload Profile Photo:</label>
          <input type="file" name="guide_photo" accept="image/*" />

          <div style="display:flex; gap:10px; margin-top:10px">
            <img id="citizenshipPreview" style="display:none; max-width:100px;" />
            <img id="profilePreview" style="display:none; max-width:100px;" />
          </div>
        </div>

        <button type="submit">Sign Up</button>
      </form>
    </div>
  </div>
</div>

<!-- ================= JAVASCRIPT ================= -->
<script>
/* ===== DOB LIMIT (10 YEARS OLD) ===== */
const dobInput = document.getElementById("dob");
const today = new Date();
today.setFullYear(today.getFullYear() - 10);
dobInput.max = today.toISOString().split("T")[0];

/* ===== ROLE TOGGLE ===== */
const roleSelect = document.getElementById("role");
const guideFields = document.querySelector(".guide-fields");

roleSelect.addEventListener("change", () => {
  const isGuide = roleSelect.value === "guide";
  guideFields.style.display = isGuide ? "flex" : "none";
  guideFields.querySelectorAll("input").forEach(i => i.required = isGuide);
});

/* ===== IMAGE VALIDATION ===== */
const MAX_SIZE = 200 * 1024;

function imageCheck(input, preview) {
  const file = input.files[0];
  if (!file) return;

  if (file.size > MAX_SIZE) {
    alert("File size must be less than 200 KB");
    input.value = "";
    preview.style.display = "none";
    return;
  }

  const reader = new FileReader();
  reader.onload = e => {
    preview.src = e.target.result;
    preview.style.display = "block";
  };
  reader.readAsDataURL(file);
}

document.querySelector('input[name="citizenship_photo"]')
  .addEventListener("change", e =>
    imageCheck(e.target, document.getElementById("citizenshipPreview"))
  );

document.querySelector('input[name="guide_photo"]')
  .addEventListener("change", e =>
    imageCheck(e.target, document.getElementById("profilePreview"))
  );

/* ===== FORM VALIDATION ===== */
document.getElementById("signupForm").addEventListener("submit", function (e) {

  const email = this.email.value.trim();
  const password = this.password.value;
  const confirmPassword = this.confirm_password.value;
  const dob = new Date(this.dob.value);
  const phone = this.phone.value.trim();
  const nationality = this.nationality.value;
  const citizenship = this.citizenship.value.trim();

  /* EMAIL */
  const emailRegex = /^[A-Za-z]+[0-9]+@gmail\.com$/;
  if (!emailRegex.test(email)) {
    alert("Email must be like sita23456@gmail.com");
    e.preventDefault();
    return;
  }

  /* PASSWORD */
  const passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8}$/;
  if (!passRegex.test(password)) {
    alert("Password must be 8 characters with upper, lower, number & special.");
    e.preventDefault();
    return;
  }

  if (password !== confirmPassword) {
    alert("Passwords do not match");
    e.preventDefault();
    return;
  }

  /* AGE CHECK */
  const ageLimit = new Date();
  ageLimit.setFullYear(ageLimit.getFullYear() - 10);
  if (dob > ageLimit) {
    alert("You must be at least 10 years old.");
    e.preventDefault();
    return;
  }

  /* PHONE */
  if (!/^\+\d{6,15}$/.test(phone)) {
    alert("Invalid phone number format");
    e.preventDefault();
    return;
  }

  /* GUIDE CITIZENSHIP */
  if (roleSelect.value === "guide") {
    let pattern;
    if (nationality === "nepali") pattern = /^[0-9]{2}-[0-9]{2}-[0-9]{5}$/;
    else if (nationality === "indian") pattern = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
    else pattern = /^[A-Za-z0-9]{6,20}$/;

    if (!pattern.test(citizenship)) {
      alert("Invalid citizenship number format");
      e.preventDefault();
    }
  }
});
</script>

  </body>
</html>


