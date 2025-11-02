<?php
// Optional include
// require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio | Anuj Rewar</title>

  <style>
    /* Base and background */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding: 60px 20px;
      overflow-x: hidden;
    }

    /* PRISM FLUX rotating background */
    body::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: conic-gradient(from 0deg, #00ffff, #ff00ff, #00ff88, #ffcc00, #ff0066, #00ffff);
      animation: fluxRotate 15s linear infinite;
      filter: blur(120px);
      opacity: 0.4;
      z-index: -2;
    }

    @keyframes fluxRotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Header */
    h1 {
      font-size: 2.8rem;
      background: linear-gradient(90deg, #00ffff, #ff00ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 10px;
      letter-spacing: 2px;
    }

    p.subtitle {
      color: #ccc;
      font-size: 1.2rem;
      margin-bottom: 40px;
      text-align: center;
    }

    /* Portfolio grid */
    .portfolio-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      width: 100%;
      max-width: 1000px;
    }

    .card {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 25px;
      text-align: center;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.25);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.5);
    }

    .card img {
      width: 100%;
      height: 180px;
      border-radius: 15px;
      object-fit: cover;
      margin-bottom: 15px;
    }

    .card h3 {
      font-size: 1.4rem;
      color: #00ffff;
      margin-bottom: 10px;
    }

    .card p {
      color: #ddd;
      font-size: 0.95rem;
      margin-bottom: 15px;
      line-height: 1.5;
    }

    .button {
      display: inline-block;
      padding: 10px 25px;
      border-radius: 25px;
      background: linear-gradient(90deg, #00ffff, #ff00ff);
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.6);
    }

    footer {
      margin-top: 50px;
      font-size: 0.9rem;
      color: #bbb;
    }
  </style>
</head>
<body>

  <h1>My Portfolio</h1>
  <p class="subtitle">Hi, I'm <span style="color:#00ffff;">Anuj Rewar</span> — a B.Tech CSE student at IIIT Manipur.<br>Here are some of my projects and works.</p>

  <div class="portfolio-grid">
    <!-- Project 1 -->
    <div class="card">
      <img src="images/p2.png" alt="Project 1">
      <h3>Personal Blog Website</h3>
      <p>A responsive Bloging website with backend in Django </p>
      <a href="#" class="button">View Project</a>
    </div>

    <!-- Project 2 -->
    <div class="card">
      <img src="images/p1.png" alt="Project 2">
      <h3>Hand Gesture Detection</h3>
      <p>Hand gesture with connection in slide for controlling slide with your hand using open cv</p>
      <a href="#" class="button">View Project</a>
    </div>

  </div>

  <footer>
    &copy; <?php echo date("Y"); ?> Anuj Rewar | Prism Flux Design
  </footer>

</body>
</html>

<?php
// require "footer.php";
?>

