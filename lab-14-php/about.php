<?php
// Optional session or includes
// require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About | Prism Flux</title>

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
      background: conic-gradient(from 0deg, #ff00ff, #00ffff, #00ff88, #ffcc00, #ff0066, #ff00ff);
      animation: fluxRotate 12s linear infinite;
      filter: blur(120px);
      opacity: 0.5;
      z-index: -2;
    }

    @keyframes fluxRotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .about-container {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      backdrop-filter: blur(15px);
      padding: 40px;
      max-width: 800px;
      text-align: center;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .about-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 40px rgba(0, 255, 255, 0.4);
    }

    h1 {
      font-size: 2.8rem;
      background: linear-gradient(90deg, #00ffff, #ff00ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 20px;
      letter-spacing: 2px;
    }

    p {
      line-height: 1.8;
      font-size: 1.1rem;
      color: #e5e5e5;
      margin-bottom: 25px;
    }

    .highlight {
      color: #00ffff;
      font-weight: 600;
    }

    .button {
      display: inline-block;
      padding: 12px 30px;
      border-radius: 30px;
      background: linear-gradient(90deg, #00ffff, #ff00ff);
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px rgba(0, 255, 255, 0.6);
    }

    footer {
      margin-top: 40px;
      font-size: 0.9rem;
      color: #bbb;
    }
  </style>
</head>
<body>

  <div class="about-container">
    <h1>About <span class="highlight">Prism Flux</span></h1>
    <p>
      Welcome to <span class="highlight">Prism Flux</span> — a modern web experience blending technology and creativity. 
      We specialize in creating digital experiences that shimmer with innovation and clarity, just like light refracting through a prism.
    </p>
    <p>
      Our mission is to craft elegant, efficient, and futuristic web solutions that empower brands to stand out in the digital universe. 
      With a passion for design and performance, <span class="highlight">Prism Flux</span> pushes the boundaries of visual storytelling and technical precision.
    </p>

    <a href="contact.php" class="button">Get in Touch</a>

    <footer>
      &copy; <?php echo date("Y"); ?> Prism Flux. All Rights Reserved.
    </footer>
  </div>

</body>
</html>

<?php
// require "footer.php";
?>

