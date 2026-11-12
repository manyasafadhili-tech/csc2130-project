<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Request a secure password reset link for your account.">
    <title>Forgot Password | Fadhili Software Engineering Project</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f4f8fb; color: #243b53; font-family: Arial, Helvetica, sans-serif; line-height: 1.6; }
        header, footer { background: #102a43; color: #fff; }
        .container { width: min(1100px, calc(100% - 40px)); margin: 0 auto; }
        .header-inner { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 18px; padding: 16px 0; }
        .brand { display: flex; align-items: center; gap: 12px; color: inherit; font-weight: 700; text-decoration: none; }
        .brand img { width: 76px; height: 48px; object-fit: contain; }
        nav { display: flex; flex-wrap: wrap; gap: 6px; }
        nav a { border-radius: 6px; color: inherit; padding: 8px 10px; text-decoration: none; }
        nav a:hover, nav a:focus-visible { background: #ffffff24; }
        main { padding: 48px 0 64px; }
        .card { width: min(520px, 100%); margin: 0 auto; padding: 30px; border-radius: 14px; background: #fff; box-shadow: 0 8px 24px #102a4310; }
        h1 { margin-top: 0; color: #102a43; }
        label { display: block; margin: 18px 0 6px; font-weight: 700; }
        input { width: 100%; padding: 12px; border: 1px solid #9fb3c8; border-radius: 6px; font: inherit; }
        button { margin-top: 20px; padding: 11px 16px; border: 0; border-radius: 7px; background: #176b87; color: #fff; font: inherit; cursor: pointer; }
        button:focus-visible, input:focus-visible { outline: 3px solid #176b8766; outline-offset: 2px; }
        footer { padding: 20px 0; }
        footer p { margin: 0; }
        @media (max-width: 700px) { .container { width: min(calc(100% - 28px), 1100px); } main { padding: 30px 0 42px; } .card { padding: 22px; } }
    </style>
</head>

<body>
    <header>
        <div class="container header-inner">
            <a class="brand" href="index.html">
                <img src="logo.svg" alt="">
                <span>Fadhili Software Engineering</span>
            </a>
            <nav aria-label="Main navigation">
                <a href="index.html">Home</a>
                <a href="about.html">About</a>
                <a href="contact.html">Contact</a>
                <a href="data.html">Data</a>
                <a href="gallery.html">Gallery</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="card" aria-labelledby="page-title">
            <h1 id="page-title">Forgot your password?</h1>
            <p>Enter the email address for your account. If it exists, we’ll send you a secure link to choose a new password.</p>
            <form action="auth/request-password-reset.php" method="post">
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" maxlength="254" required>
                <button type="submit">Send reset link</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2026 Fadhili Manyasa. <a href="index.html" style="color: inherit;">Home</a></p>
        </div>
    </footer>
</body>

</html>
