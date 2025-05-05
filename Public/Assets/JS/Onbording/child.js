document.addEventListener('DOMContentLoaded', function () {
    // To input childs image
    const imageicon = document.getElementById('image-icon');
    const image = document.getElementById('image');
    const imagebg = document.getElementById('image-bg');

    imageicon.addEventListener('click', function(){
        image.click();
    })

    image.addEventListener('input',function(event){
        const file= event.target.files[0];
        if(file){   
            redstar5.classList.add('hidden');
            const imageUrl = URL.createObjectURL(file);
            imagebg.style.backgroundImage = `url('${imageUrl}')`;
        }
        else{
            redstar5.classList.remove('hidden');
        }
    })

    // redstars to represent required inputs
    const redstar = document.getElementById('red-star');
    const redstar2 = document.getElementById('red-star2');
    const redstar3 = document.getElementById('red-star3');
    const redstar4 = document.getElementById('red-star4');
    const redstar5 = document.getElementById('red-star5');

    const firstnameError = document.getElementById('firstname-error');
    const nickname = document.getElementById('nickname');
    const lastname = document.getElementById('lastname');
    const lastnameError = document.getElementById('lastname-error');
    const relation = document.getElementById('relation');
    const relationError = document.getElementById('relation-error');
    const firstname = document.getElementById('firstname');

    firstname.addEventListener('input',function(){
        if (!firstname.value) {
            redstar.classList.remove('hidden');
        } else {
            redstar.classList.add('hidden');
        }
        firstnameError.textContent = '';
    })

    lastname.addEventListener('input',function(){
        if (!lastname.value) {
            redstar2.classList.remove('hidden');
        } else {
            redstar2.classList.add('hidden');
        }
        lastnameError.style.display = 'none';
    })

    nickname.addEventListener('input',function(){
        if (!nickname.value) {
            redstar3.classList.remove('hidden');
        } else {
            redstar3.classList.add('hidden');
        }
    })

    relation.addEventListener('input',function(){
        if (!relation.value) {
            redstar4.classList.remove('hidden');
        } else {
            redstar4.classList.add('hidden');
        }
        relationError.style.display = 'none';
    })

    const dob = document.getElementById('dob');
    const dobError = document.getElementById('dob-error');

    dob.addEventListener('input', function() {
        dobError.style.display = 'none';
    });

    //prescription doscuments input 
    // to input image on doctores prescriptions
    const prescriptions = document.getElementById('prescriptions');
    const prescriptionsModal = document.getElementById('prescriptionModal');
    const left = document.getElementById('left');
    const right = document.getElementById('right');
    const prescriptionimg = document.getElementById('prescription-img');
    const backforprescription = document.getElementById('backforprescription');
    const imginput = document.getElementById('image-input');


    const documents = document.getElementById('documents');
    const documnetModal = document.getElementById('documentModal');
    const backfordocument = document.getElementById('backfordocument');
    const Profilecard = document.querySelector('.Profilecard');

    documents.addEventListener('click', function () {
        documnetModal.style.display = 'block';
        Profilecard.style.filter = "blur(10px)";
    })

    backfordocument.addEventListener('click', function () {
        documnetModal.style.display = 'none';
        Profilecard.style.filter = "blur(0px)";
    })

    backforprescription.addEventListener('click', function () {
        prescriptionsModal.style.display = 'none';
        Profilecard.style.filter = "blur(0px)";
    })

    prescriptions.addEventListener('click', function () {
        prescriptionsModal.style.display = 'flex';
        Profilecard.style.filter = "blur(10px)";
    });

    const images = [
        "http://localhost/MVC/Public/Assets/Images/addprescription.png"
    ];
    const fileArray = [];
    let currentIndex = 0;

    const deleteImageBtn = document.getElementById('delete-image-btn');

    updateImage();

    prescriptionimg.addEventListener('click', function () {
        if (currentIndex == images.length - 1) {
            imginput.click();
        }
    })

    imginput.addEventListener('change', function () {
        if (imginput.files) {
            for (const file of imginput.files) {
                fileArray.push(file); // Store each selected file in `fileArray`
                const newImageURL = URL.createObjectURL(file);
                images.splice(images.length - 1, 0, newImageURL); // Insert new image before last image placeholder
            }
            currentIndex = images.length - 2; // Move to the last new image
            updateImage();
        }
    });

    function updateImage() {
        prescriptionimg.src = images[currentIndex];
    }

    left.addEventListener('click', function () {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateImage();
    });

    right.addEventListener('click', function () {
        currentIndex = (currentIndex + 1) % images.length;
        updateImage();
    });

    function toggleDeleteButton() {
        // If we're on the first image or on the last placeholder image, hide the delete button
        if (currentIndex === images.length - 1 || currentIndex === 0) {
            deleteImageBtn.style.display = "none";
        } else {
            deleteImageBtn.style.display = "block";
        }
    }

    deleteImageBtn.addEventListener('click', function () {
        if (currentIndex >= 0 && currentIndex < images.length - 1) {
            // Remove image from images array
            images.splice(currentIndex, 1);
    
            // Remove the file from the fileArray (so it won't be submitted)
            fileArray.splice(currentIndex, 1);
    
            // Update the image index
            if (currentIndex >= images.length) {
                currentIndex = images.length - 1; // Go to the last image if we've deleted the last one
            }
            
            updateImage();
            
            updateFileInput();
        }
    });

    function updateFileInput() {
        const dataTransfer = new DataTransfer();  // Creates a new DataTransfer object
    
        // Add remaining files to the dataTransfer object
        fileArray.forEach(file => {
            dataTransfer.items.add(file);
        });
    
        // Update fileInput.files with the new files
        imginput.files = dataTransfer.files;
    }

    updateImage();

    const files = [];

    const fileListContainer = document.getElementById('fileListContainer');
    const fileInput = document.getElementById('file-input');
    const fileBtn = document.getElementById('file-btn'); // Correct capitalization
    
    function renderFiles() {
        fileListContainer.innerHTML = ''; // Clear current list
    
        files.forEach((file, index) => {
            const fileDiv = document.createElement('div');
            fileDiv.className = "file-entry";
    
            const viewLink = document.createElement('a');
            viewLink.href = URL.createObjectURL(file);
            viewLink.target = "_blank";
            viewLink.textContent = file.name;
            viewLink.className = "view-link";
    
            const deleteButton = document.createElement('button');
            deleteButton.textContent = "Delete";
            deleteButton.className = "delete-button";
            deleteButton.onclick = function () {
                deleteFile(index);
            };
    
            fileDiv.appendChild(viewLink);
            fileDiv.appendChild(deleteButton);
            fileListContainer.appendChild(fileDiv);
        });
    }
    
    // Open file input when the add files button is clicked
    fileBtn.addEventListener('click', function() {
        fileInput.click();
    });
    
    // Handle new document file selections
    fileInput.addEventListener('change', function() {
        for (const file of fileInput.files) {
            files.push(file); // Add each selected document to the files array
        }
        renderFiles(); // Update displayed list of files
    });
    
    // Delete a file from the files array
    function deleteFile(index) {
        files.splice(index, 1); // Remove the file from the files array
        renderFiles(); // Re-render the file list
    }
    
    // Ensure all files (images and documents) are sent on form submission
    document.querySelector('form').addEventListener('submit', function (event) {
        const dataTransferImages = new DataTransfer();
        const dataTransferDocuments = new DataTransfer();
    
        // Add all image files to dataTransferImages
        images.forEach(file => dataTransferImages.items.add(file));
        // Set imginput.files to contain all images
        document.getElementById('image-input').files = dataTransferImages.files;
    
        // Add all document files to dataTransferDocuments
        files.forEach(file => dataTransferDocuments.items.add(file));
        // Set fileInput.files to contain all documents
        fileInput.files = dataTransferDocuments.files;
    
        // Uncomment during testing to prevent form reset on submit
        event.preventDefault();

    });

});