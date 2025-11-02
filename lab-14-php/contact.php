<?php
// Optional includes
// require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact | Prism Flux</title>

  <style>
    /* Reset and base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      overflow: hidden;
    }

    /* PRISM FLUX animated background */
    body::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: conic-gradient(from 0deg, #00ffff, #ff00ff, #00ff88, #ffcc00, #ff0066, #00ffff);
      animation: fluxRotate 12s linear infinite;
      filter: blur(120px);
      opacity: 0.5;
      z-index: -2;
    }

    @keyframes fluxRotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .contact-container {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      backdrop-filter: blur(15px);
      padding: 40px;
      max-width: 850px;
      width: 100%;
      text-align: center;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.25);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 40px rgba(0, 255, 255, 0.4);
    }

    h1 {
      font-size: 2.6rem;
      background: linear-gradient(90deg, #00ffff, #ff00ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 10px;
      letter-spacing: 2px;
    }

    h2 {
      font-size: 1.2rem;
      color: #ccc;
      margin-bottom: 30px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 20px;
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
    }

    input, textarea {
      width: 100%;
      padding: 14px 18px;
      border-radius: 10px;
      border: none;
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
      font-size: 1rem;
      outline: none;
      resize: none;
      transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus, textarea:focus {
      background: rgba(255, 255, 255, 0.25);
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.4);
    }

    button {
      padding: 14px 30px;
      border: none;
      border-radius: 30px;
      background: linear-gradient(90deg, #00ffff, #ff00ff);
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px rgba(0, 255, 255, 0.6);
    }

    .info {
      margin-top: 30px;
      font-size: 1rem;
      color: #e5e5e5;
    }

    .highlight {
      color: #00ffff;
      font-weight: 600;
    }

    footer {
      margin-top: 30px;
      font-size: 0.9rem;
      color: #bbb;
    }
  </style>
</head>
<body>

  <div class="contact-container">
    <h1>Contact Me</h1>
    <h2>Hi, I'm <span class="highlight">Anuj Rewar</span> — a CSE student pursuing B.Tech at <span class="highlight">IIIT Manipur</span>.</h2>

    <form action="#" method="POST">
      <input type="text" name="name" placeholder="Name..." required />
      <input type="email" name="email" placeholder="email..." required />
      <textarea name="message" rows="5" placeholder="Doubt..." required></textarea>
      <button type="submit">Send Message</button>
    </form>

    <div class="info">
      <p>📍 Based in: IIIT Manipur, India</p>
      <p>📧 Email: <a href="mailto:anujrewar@example.com" class="highlight">anujrewar12345@gmail.com</a></p>
      <p>💼 GitHub: <a href="#" class="highlight">github.com/anujrewar</a></p>
    </div>

    <footer>
      &copy; <?php echo date("Y"); ?> Anuj Rewar | Prism Flux Design
    </footer>
  </div>

</body>
</html>

<?php
// require "footer.php";
?>

