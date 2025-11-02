<?php
require "header.php";
?>

<style>
body {
  font-family: Arial, sans-serif;
  background: #f2f2f2;
  margin: 0;
  padding: 0;
}

.wrapper-main {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 80vh;
}

.section-default {
  background: #fff;
  padding: 30px 40px;
  border-radius: 12px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
  width: 350px;
}

.form-signup input {
  width: 100%;
  padding: 10px;
  margin: 8px 0;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.form-signup button {
  width: 100%;
  padding: 10px;
  border: none;
  background: #3498db;
  color: #fff;
  border-radius: 6px;
  cursor: pointer;
}

.form-signup button:hover {
  background: #2980b9;
}

.error {
  color: red;
  font-size: 0.9em;
  margin-bottom: 10px;
}

.password-wrapper {
  position: relative;
}

.password-wrapper input {
  width: 100%;
  padding-right: 35px;
}

.password-wrapper .toggle-eye {
  position: absolute;
  right: 10px;
  top: 8px;
  cursor: pointer;
}
</style>

<main>
  <div class="wrapper-main">
    <section class="section-default">
      <h2>Signup</h2>
      <form class="form-signup" action="includes/signup.inc.php" method="post">
        <input type="text" name="uid" placeholder="Username (e.g. John_Doe)">
        <input type="text" name="mail" placeholder="E-mail address">

        <div class="password-wrapper">
          <input type="password" name="pwd" id="pwd" placeholder="Password">
          <span class="toggle-eye" onclick="togglePassword('pwd', this)">👁️</span>
        </div>

        <div class="password-wrapper">
          <input type="password" name="pwd-repeat" id="pwd-repeat" placeholder="Repeat password">
          <span class="toggle-eye" onclick="togglePassword('pwd-repeat', this)">👁️</span>
        </div>

        <button type="submit" name="signup-submit">Signup</button>

        <?php if (isset($_GET['error'])): ?>
          <div class="error">
            <?php
              switch ($_GET['error']) {
                case 'emptyfields': echo "⚠️ Please fill in all fields."; break;
                case 'invalidmail': echo "📧 Invalid email address."; break;
                case 'invaliduid': echo "❌ Username can only include letters, numbers, spaces, underscores, and dots."; break;
                case 'passwordcheck': echo "🔑 Passwords do not match."; break;
                case 'usertaken': echo "🚫 Username is already taken."; break;
                default: echo "❗ An unknown error occurred."; break;
              }
            ?>
          </div>
        <?php elseif (isset($_GET['signup']) && $_GET['signup'] == 'success'): ?>
          <div style="color:green;">✅ Signup successful! You can now log in.</div>
        <?php endif; ?>
      </form>
    </section>
  </div>
</main>

<script>
function togglePassword(id, eye) {
  const field = document.getElementById(id);
  if (field.type === "password") {
    field.type = "text";
    eye.textContent = "🔒";
  } else {
    field.type = "password";
    eye.textContent = "👁️";
  }
}
</script>

<?php
require "footer.php";
?>

