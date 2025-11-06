function showForm(formId){
    document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
    document.getElementById(formId).classList.add("active");

}

document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('register-form');
    
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const passwordRepeat = document.getElementById('password_repetir').value;
            const errorDiv = document.getElementById('error-password');

            if (password !== passwordRepeat) {
                event.preventDefault(); 
                
                // USAR CLASES: Agregar la clase 'visible'
                errorDiv.classList.add('active'); 
                
            } else {
                // Si todo está bien, remover la clase 'visible' (para ocultarlo)
                errorDiv.classList.remove('active');
            }
        });
    }
});