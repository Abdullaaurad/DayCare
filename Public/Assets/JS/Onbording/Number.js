document.addEventListener('DOMContentLoaded', function() {
    // edit the numebr of how it displayed
    const numberInput = document.querySelector('.number');

    numberInput.addEventListener('input', function (e) {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length > 3) {
            this.value = this.value.slice(0, 3) + '-' + this.value.slice(3);
        }
        if (this.value.length > 7) {
            this.value = this.value.slice(0, 7) + ' ' + this.value.slice(7);
        }
    });

});