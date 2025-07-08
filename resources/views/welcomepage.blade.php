<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome | ToDo App</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #f9a8d4, #60a5fa);
      background-size: 200% 200%;
      animation: gradientShift 8s ease infinite;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 40px;
      text-align: center;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      max-width: 400px;
      color: white;
    }

    .card h1 {
      font-size: 2.2rem;
      margin-bottom: 15px;
    }

    .card p {
      font-size: 1rem;
      margin-bottom: 30px;
      color: #f3f4f6;
    }

    .start-btn {
      background: linear-gradient(135deg, #ec4899, #3b82f6);
      color: white;
      border: none;
      padding: 14px 28px;
      border-radius: 50px;
      cursor: pointer;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .start-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 24px rgba(0,0,0,0.2);
    }

    .start-btn:active {
      transform: scale(0.97);
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>Welcome to ToDoApp</h1>
    <p>Organize your day, stay productive, and never miss a task. Let’s get started with your personal task manager.</p>
    <button class="start-btn" href='home.php'>Let’s Start</button>
  </div>

 
</body>
</html>
