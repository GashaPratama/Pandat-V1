<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Aplikasi</title>
</head>
<body>
    <h1>Register</h1>

    <form id="registerForm">
        <label>Nama</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <label>Konfirmasi Password</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <button type="submit">Daftar</button>
    </form>

    <div id="result"></div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = new FormData(this);
            const data = {
                name: form.get('name'),
                email: form.get('email'),
                password: form.get('password'),
                password_confirmation: form.get('password_confirmation')
            };

            try {
                const response = await fetch('/api/auth/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    document.getElementById('result').innerText = 'Registrasi berhasil!\nToken: ' + result.token;
                } else {
                    document.getElementById('result').innerText = 'Error: ' + (result.message || 'Gagal registrasi');
                }
            } catch (error) {
                document.getElementById('result').innerText = 'Error koneksi';
            }
        });
    </script>
</body>
</html>
