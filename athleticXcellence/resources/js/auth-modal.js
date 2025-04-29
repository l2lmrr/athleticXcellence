document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const authButton = document.querySelector('button.text-xl');
    const authModal = document.getElementById('authModal');
    const closeButton = document.getElementById('closeAuthModal');
    const loginTab = document.getElementById('loginTab');
    const registerTab = document.getElementById('registerTab');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const switchToLogin = document.getElementById('switchToLogin');

    // Open modal
    if (authButton) {
        authButton.addEventListener('click', function() {
            authModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            document.documentElement.classList.add('overflow-hidden');
        });
    }

    // Close modal
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            authModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            document.documentElement.classList.remove('overflow-hidden');
        });
    }

    // Switch between tabs
    if (loginTab && registerTab) {
        loginTab.addEventListener('click', function() {
            loginTab.classList.add('text-blue-600', 'border-blue-600');
            loginTab.classList.remove('text-gray-500');
            registerTab.classList.add('text-gray-500');
            registerTab.classList.remove('text-blue-600', 'border-blue-600');
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
        });

        registerTab.addEventListener('click', function() {
            registerTab.classList.add('text-blue-600', 'border-blue-600');
            registerTab.classList.remove('text-gray-500');
            loginTab.classList.add('text-gray-500');
            loginTab.classList.remove('text-blue-600', 'border-blue-600');
            registerForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
        });
    }

    // Switch to login from footer link
    if (switchToLogin) {
        switchToLogin.addEventListener('click', function(e) {
            e.preventDefault();
            if (loginTab && registerTab) {
                loginTab.click();
            }
        });
    }

    // Close modal when clicking outside
    authModal.addEventListener('click', function(e) {
        if (e.target === authModal) {
            closeButton.click();
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Open modal when login button is clicked
    document.querySelector('button.text-xl').addEventListener('click', function() {
        document.getElementById('authModal').classList.remove('hidden');
    });
    
    // Rest of your existing modal JavaScript...
});