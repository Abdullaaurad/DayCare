document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('prescription-form').addEventListener('submit', function (e) {
      const medNameInput = document.getElementById('medication-name');
      const medNameError = document.getElementById('medication-name-error');
      const dosage = document.getElementById('dosage');
      const dosageInput = dosage.value.trim();
      const freq = document.getElementById('frequency');
      const freqInput = freq.value.trim();
      const medName = medNameInput.value.trim();
      const startDate = new Date(document.getElementById('start-date').value);
      const endDate = new Date(document.getElementById('end-date').value);
      const dosageErr = document.getElementById('dosage-name-error');
      const freqErr = document.getElementById('freq-name-error');
      const stErr = document.getElementById('start-date-error');
      const enErr = document.getElementById('end-date-error');

      const invalidChars = /[$%.*#]/;

      if (medName === '') {
        medNameError.textContent = "Medication name cannot be empty.";
        e.preventDefault();
      } else if (invalidChars.test(medName)) {
        medNameError.textContent = "Medication name cannot contain $, %, ., *, or #.";
        e.preventDefault();
      } else {
        medNameError.textContent = "";
      }

      if (dosageInput === '' || isNaN(dosageInput)) {
        dosageErr.textContent = "Dosage must be a valid number.";
        e.preventDefault();
      } else if (invalidChars.test(dosageInput)) {
        dosageErr.textContent = "Dosage  cannot contain $, %, ., *, or #.";
        e.preventDefault();
      } else if(dosageInput <=0 ){
        dosageErr.textContent = "Dosage must be greater than 0!";
        e.preventDefault();
      }else{
        dosageErr.textContent = "";
      }

      
      if (freqInput === '') {
        freqErr.textContent = "Frequencey cannot be empty.";
        e.preventDefault();
      } else if (invalidChars.test(freqInput)) {
        freqErr.textContent = "Frequencey cannot contain $, %, ., *, or #.";
        e.preventDefault();
      } else{
        freqErr.textContent = "";
      }

      if (startDate > endDate) {
        stErr.textContent= "Start date cannot be after end date!";
        e.preventDefault();
      }else if (!startDate || !endDate) {
        stErr.textContent="Please fill out both start and end dates.";
        e.preventDefault();
      }else if(startDate < new Date()){
        stErr.textContent="Start date cannot be in the past!";
        e.preventDefault();
      }
      
    });
  });