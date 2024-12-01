   document.getElementById('loginBtn').addEventListener('click', function() {
        document.getElementById('loginForm').style.display = 'block';
        document.getElementById('registerForm').style.display = 'none';
        document.getElementById('loginBtn').classList.add('active');
        document.getElementById('registerBtn').classList.remove('active');
    });

    document.getElementById('registerBtn').addEventListener('click', function() {
        document.getElementById('registerForm').style.display = 'block';
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registerBtn').classList.add('active');
        document.getElementById('loginBtn').classList.remove('active');
    });

    // За умовчанням показуємо форму авторизації
    document.getElementById('loginForm').style.display = 'block';
    document.getElementById('registerForm').style.display = 'none';