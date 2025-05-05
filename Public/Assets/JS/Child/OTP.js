document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp');

    otpInputs.forEach(function(otpInput) {
        otpInput.addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, ''); // Only allow digits
        });
    });
});
