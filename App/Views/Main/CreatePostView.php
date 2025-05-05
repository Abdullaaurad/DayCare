<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blog Post Form</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <!-- Fonts that we are using -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        data-tag="font" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        data-tag="font" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap"
        data-tag="font" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        data-tag="font" />
    <link rel="stylesheet" href="<?= CSS ?>/Onbording/Onbording.css?v=<?= time() ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1000px;
            display: flex;
            flex-direction: column;
        }

        .form-group {
            display: flex;
            margin-bottom: 20px;
        }

        .image-container {
            width: 350px;
            max-height: 580px;
            margin-right: 20px;
            border: 1px solid #ccc;
            border-radius: 14px 0px 0px 14px;
            padding: 10px;
            overflow-y: auto;
            -ms-overflow-style: none;
            /* Internet Explorer 10+ */
            scrollbar-width: none;
            /* Firefox */
        }

        .selected-image-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f5f5f5;

        }

        .selected-image-container img {
            height: 250px;
            max-height: 250px;
            width: auto;
            border-radius: 4px;
        }

        .selected-image-container input {
            margin-left: 10px;
        }

        .thumbnails-container {
            flex: 1;
            max-height: 160px;
            overflow-y: hidden;
            overflow-x: auto;
            /* Horizontal scroll */
            display: flex;
            gap: 10px;
            border-top: 2px solid #ccc;
            padding-top: 10px;

        }

        .thumbnails-container::-webkit-scrollbar {
            height: 10px;
        }

        .thumbnails-container::-webkit-scrollbar-thumb {
            background-color: #60a6ec;
            border-radius: 5px;
        }

        .image-wrapper {
            position: relative;
            flex-shrink: 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
            justify-content: center;
        }

        .image-wrapper img {
            width: 100px;
            height: 90px;
            object-fit: cover;
            cursor: pointer;
        }

        .image-wrapper button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .image-container::-webkit-scrollbar {
            display: none;
            /* Safari and Chrome */
        }

        .image-container .image-wrapper {
            position: relative;
            margin-bottom: 10px;
            justify-content: center;
        }

        .image-container .image-wrapper img {
            margin-top: 10px;
            width: 100px;
            height: auto;
            margin-bottom: 10px !important;
        }

        .image-container .image-wrapper button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            width: 25px;
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container .add-image {
            width: 330px;
            height: 290px;
            background-color: #e0e0e0;
            border: 2px dashed #ccc;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: #9e9e9e;
            font-size: 24px;
            margin-left: 10px;
        }

        .form-group .form-fields {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            margin-left: -20px;
        }

        .form-fields .field {
            margin-bottom: 10px;
            width: 100%;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .footer .cancel {
            background-color: #b0b0b0;
            color: #ffffff;
        }

        .footer .save {
            background-color: #10639a;
            color: #ffffff;
        }

        .footer .create-post {
            display: flex;
            align-items: center;
            font-size: 18px;
            font-weight: bold;
            color: #10639a;
        }

        .footer .create-post i {
            margin-right: 10px;
        }

        /* .selectedImage {
            width: 300px !important;
            height: 400px !important;
        } */
    </style>
</head>

<body>
    <div class="Profilecard">
        <div class="form-group" style="margin-bottom: -3px;">
            <div class="image-container" style="background-color:#60a6ec; overflow:hidden;">
                <h1 style="margin-top: 20px;">Insert Images to the Blog</h1>
                <!-- Top Section for Selected Image -->
                <div class="selected-image-container">
                    <img id="selectedImage" class="selectedImage" src="logo-light.jpeg" style="display: none;" alt="Selected image">
                </div>
                <input type="file" id="imageInput" accept="image/*" multiple onchange="handleImageUpload(event)" style="margin-top: -20px !important; margin-left: 80px;">
                <!-- Bottom Scrollable Section -->
                <div class="thumbnails-container" id="thumbnailsContainer">
                    <!-- Images will be dynamically inserted here -->
                </div>
            </div>

            <div class="form-fields ProfileContainer">
                <h1 style="color: #10639a; margin-top: 30px; margin-bottom: -35px; margin-left: 20px;"> Create Blog Post </h1>
                <div class="datacon" style="margin-left: 10px;">
                    <div class="data" style="width: 100%;">
                        <label for="blog-title">Blog Title</label>
                        <input style="width: 630px;" id="blog-title" placeholder="Enter Blog Title" type="text">
                    </div>
                </div>
                <div class="datacon" style="display: flex; flex-direction: row; margin-left: 10px; margin-top: -45px;">
                    <div class="data">
                        <label for="author">Author</label>
                        <input id="author" type="text" value="Joe Smith">
                    </div>
                    <div class="data">
                        <label for="publish-date">Publish Date</label>
                        <input id="publish-date" type="date" value="2024-02-22">
                    </div>
                </div>
                <div class="datacon" style="margin-top: -45px; margin-left: 10px; margin-bottom: -60px;">
                    <div class="data">
                        <label> Content </label>
                        <textarea style="height: 200px; width: 640px;" placeholder="Type something"></textarea>
                    </div>
                </div>
                <div class="datacon" style="display: flex; flex-direction: row; margin-left: 10px;">
                    <div class="data">
                        <button type="submit" style="font-weight: 600; width: 200px; font-size: 20px; padding: 7px; background-color:rgb(67, 99, 154) !important; color: white !important; margin-top: 30px; margin-bottom: -30px; margin-left: 455px;"> Save </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let uploadedFiles = [];


        const selectedImage = document.getElementById('selectedImage');

        function handleImageUpload(event) {
            const files = event.target.files;

            if (files && files.length > 0) {
                // Add files to the custom file list
                uploadedFiles.push(...Array.from(files));
                selectedImage.style.display = 'inline';

                // Update thumbnails for each file
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        addImageToThumbnails(e.target.result);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                selectedImage.style.display = 'none';
            }
        }

        // Add an image to the thumbnails section
        function addImageToThumbnails(imageSrc) {
            const thumbnailsContainer = document.getElementById('thumbnailsContainer');

            const imageWrapper = document.createElement('div');
            imageWrapper.className = 'image-wrapper';
            imageWrapper.innerHTML = `
                <img src="${imageSrc}" alt="Thumbnail" onclick="selectImage(this)">
                <button onclick="removeImage(this)">×</button>
            `;
            thumbnailsContainer.appendChild(imageWrapper);

            // Automatically set the first added image as the selected image
            const selectedImage = document.getElementById('selectedImage');
            selectedImage.src = imageSrc;
        }

        // Remove an image from the thumbnails
        const files = document.getElementById('imageInput');

        // Remove an image from the thumbnails and reset file input if needed
        function removeImage(button) {
            const imageWrapper = button.parentElement;
            const thumbnailsContainer = document.getElementById('thumbnailsContainer');
            const selectedImage = document.getElementById('selectedImage');
            const imageInput = document.getElementById('imageInput');

            // Get the image source of the image to be removed
            const imageSrc = button.previousElementSibling.src;

            // Remove the clicked image from the DOM
            imageWrapper.remove();

            // Remove the corresponding file from the custom file list
            uploadedFiles = uploadedFiles.filter(file => {
                const tempReader = new FileReader();
                tempReader.readAsDataURL(file);
                tempReader.onload = function() {
                    return tempReader.result !== imageSrc;
                };
            });

            // Update the selected image if the removed image was the currently selected image
            if (selectedImage.src === imageSrc) {
                if (thumbnailsContainer.firstChild) {
                    selectedImage.src = thumbnailsContainer.firstChild.querySelector('img').src;
                } else {
                    selectedImage.src = '';
                    selectedImage.style.display = 'none';
                }
            }

            // If no images are left, reset the input and the selected image
            if (!thumbnailsContainer.hasChildNodes()) {
                selectedImage.src = '';
                selectedImage.style.display = 'none';
                uploadedFiles = []; // Clear the file list
                recreateFileInput();
            }
        }

        function recreateFileInput() {
            const oldInput = document.getElementById('imageInput');
            const newInput = oldInput.cloneNode(); // Clone the input element
            oldInput.parentNode.replaceChild(newInput, oldInput); // Replace the old input
            newInput.addEventListener('change', handleImageUpload); // Add event listener to the new input
        }


        // Set a thumbnail image as the selected image
        function selectImage(thumbnail) {
            const selectedImage = document.getElementById('selectedImage');
            selectedImage.src = thumbnail.src;
        }
    </script>
</body>

</html>