document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector("form[action*='login.submit']");
    const registerForm = document.querySelector(
        "form[action*='register.submit']"
    );
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            const email = loginForm.querySelector("input[name='correoLogin']");
            const password = loginForm.querySelector(
                "input[name='passwordLogin']"
            );
            let valid = true;

            clearErrors(loginForm);

            // Validar correo electrónico
            if (!validateEmail(email.value)) {
                valid = false;
                showError(
                    email,
                    "Por favor, introduce un correo electrónico válido."
                );
            }

            // Validar contraseña
            if (password.value.trim().length === 0) {
                valid = false;
                showError(password, "La contraseña es obligatoria.");
            }

            if (!valid) e.preventDefault();
        });
    }

    if (registerForm) {
        registerForm.addEventListener("submit", function (e) {
            const dni = registerForm.querySelector("input[name='dni']");
            const nombre = registerForm.querySelector("input[name='nombre']");
            const apellido = registerForm.querySelector(
                "input[name='apellido']"
            );
            const email = registerForm.querySelector("input[name='correo']");
            const password = registerForm.querySelector(
                "input[name='password']"
            );
            const confirmPassword = registerForm.querySelector(
                "input[name='password_confirmation']"
            );
            let valid = true;

            clearErrors(registerForm);

            // Validar DNI
            if (!/^\d{8,9}$/.test(dni.value)) {
                valid = false;
                showError(dni, "El DNI debe ser un número de 8 o 9 dígitos.");
            }

            // Validar nombre
            if (
                nombre.value.trim().length === 0 ||
                nombre.value.trim().length > 50
            ) {
                valid = false;
                showError(
                    nombre,
                    "El nombre es obligatorio y no debe superar los 50 caracteres."
                );
            }

            // Validar apellido
            if (
                apellido.value.trim().length === 0 ||
                apellido.value.trim().length > 50
            ) {
                valid = false;
                showError(
                    apellido,
                    "El apellido es obligatorio y no debe superar los 50 caracteres."
                );
            }

            // Validar correo electrónico
            if (!validateEmail(email.value)) {
                valid = false;
                showError(
                    email,
                    "Por favor, introduce un correo electrónico válido."
                );
            }

            // Validar contraseña
            if (password.value.trim().length < 8) {
                valid = false;
                showError(
                    password,
                    "La contraseña debe tener al menos 8 caracteres."
                );
            }

            // Validar confirmación de contraseña
            if (password.value !== confirmPassword.value) {
                valid = false;
                showError(confirmPassword, "Las contraseñas no coinciden.");
            }

            if (!valid) e.preventDefault();
        });
    }

    function showError(input, message) {
        const errorDiv = document.createElement("div");
        errorDiv.classList.add("text-danger", "mt-1");
        errorDiv.textContent = message;
        input.parentElement.appendChild(errorDiv);
    }

    function clearErrors(form) {
        form.querySelectorAll(".text-danger").forEach((el) => el.remove());
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
});
