document.addEventListener('DOMContentLoaded', function() {
    // Basculer la visibilité du mot de passe
    const togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    }

    // Gestion de la soumission du formulaire de connexion
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulation de connexion
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Validation simple
            if (username && password) {
                // Afficher un message de succès
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success mt-3 fade-in';
                alertDiv.textContent = 'Connexion réussie ! Redirection en cours...';
                loginForm.parentNode.insertBefore(alertDiv, loginForm.nextSibling);
                
                // Redirection après 2 secondes
                setTimeout(() => {
                    window.location.href = 'admin/dashboard.html';
                }, 2000);
            } else {
                // Afficher un message d'erreur
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger mt-3 fade-in';
                alertDiv.textContent = 'Veuillez remplir tous les champs requis.';
                loginForm.parentNode.insertBefore(alertDiv, loginForm.nextSibling);
            }
        });
    }

    // Initialiser les tooltips Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Gestion des événements
    const eventCheckboxes = document.querySelectorAll('.event-program .form-check-input');
    if (eventCheckboxes) {
        eventCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const listItem = this.closest('li');
                if (this.checked) {
                    listItem.classList.add('list-group-item-success');
                } else {
                    listItem.classList.remove('list-group-item-success');
                }
            });
        });
    }

    // Animation au défilement
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.card, .feature-card');
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.2;
            
            if (elementPosition < screenPosition) {
                element.classList.add('fade-in');
            }
        });
    };

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Exécuter une fois au chargement
});