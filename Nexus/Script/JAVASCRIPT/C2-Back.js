
    document.getElementById('toggle-password').addEventListener('click', function () {
        var passwordField = document.getElementById('password');
        var passwordFieldType = passwordField.getAttribute('type');
        if (passwordFieldType === 'password') {
            passwordField.setAttribute('type', 'text');
            this.textContent = 'Hide';
            this.classList.remove('show');
            this.classList.add('hide');
        } else {
            passwordField.setAttribute('type', 'password');
            this.textContent = 'Show';
            this.classList.remove('hide');
            this.classList.add('show');
        }
    });
