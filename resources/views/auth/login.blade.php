<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi</title>
</head>
<body>
    <h1>Login</h1>

    <form id="loginForm">
        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <div id="result"></div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = new FormData(this);
            const data = {
                email: form.get('email'),
                password: form.get('password')
            };

            try {
                const response = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    document.getElementById('result').innerText = 'Login berhasil!\nToken: ' + result.token;
                } else {
                    document.getElementById('result').innerText = 'Error: ' + (result.message || 'Gagal login');
                }
            } catch (error) {
                document.getElementById('result').innerText = 'Error koneksi';
            }
        });
    </script>
</body>
</html>
