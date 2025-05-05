<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Blog Post</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/variables.css?v=<?= time() ?>" />
    <link rel="stylesheet" href="<?= CSS ?>/Main/Header.css?v=<?= time() ?>" />
    <link rel="stylesheet" href="<?= CSS ?>/Main/Footer.css?v=<?= time() ?>" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 32px;
            margin-left: auto;
            margin-right: auto;
            max-width: 1200px;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .p-6 {
            padding: 24px;
        }

        .rounded-lg {
            border-radius: 8px;
        }

        .shadow-md {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .text-2xl {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .font-bold {
            font-weight: 700;
        }

        .mt-4 {
            margin-top: 16px;
        }

        .text-gray-600 {
            color: #718096;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .leading-relaxed {
            line-height: 1.625;
        }

        .text-gray-700 {
            color: #4a5568;
        }

        .mt-6 {
            margin-top: 24px;
        }

        .bg-blue-600 {
            background-color: #3182ce;
        }

        .text-white {
            color: #ffffff;
        }

        .px-4 {
            padding-left: 16px;
            padding-right: 16px;
        }

        .py-2 {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .rounded {
            border-radius: 4px;
        }

        .hover\:bg-blue-700:hover {
            background-color: #2b6cb0;
        }

        .inline-block {
            display: inline-block;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        .overflow-x-auto::-webkit-scrollbar {
            display: none;
        }

        .whitespace-nowrap {
            white-space: nowrap;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .mr-4 {
            margin-right: 16px;
        }

        .mt-2 {
            margin-top: 8px;
        }

        .space-x-4 {
            margin-right: -16px;
        }

        .flex {
            display: flex;
        }

        .items-start {
            align-items: flex-start;
        }

        .justify-between {
            justify-content: space-between;
        }

        .text-lg {
            font-size: 1.125rem;
            font-weight: 700;
        }

        .text-gray-400 {
            color: #e2e8f0;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .hidden {
            display: none;
        }

        .text-yellow-500 {
            color: #ecc94b;
        }

        .focus\:outline-none:focus {
            outline: none;
        }

        .focus\:shadow-outline:focus {
            box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.5);
        }

        .bg-gray-100 {
            background-color: #f7fafc;
        }

        .rounded-full {
            border-radius: 50%;
        }

        .text-gray-700 {
            color: #4a5568;
        }

        .text-gray-600 {
            color: #718096;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .text-center {
            text-align: center;
        }

        .comment-section {
            padding: 24px;
            margin-top: 24px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .comment-form {
            background-color: #ffffff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .comment-form textarea {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            width: 100%;
            padding: 12px;
            resize: none;
            font-size: 16px;
            color: #4a5568;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .comment-form button {
            background-color: #3182ce;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .comment-form button:hover {
            background-color: #2b6cb0;
        }

        .comment-item {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Light shadow */
            margin-bottom: 5px;
            border-radius: 10px;
        }

        .comment-item:last-child {
            border-bottom: none;
        }

        .comment-avatar {
            border-radius: 50%;
        }

        .comment-text {
            margin-top: 8px;
            font-size: 16px;
            color: #4a5568;
        }

        .comment-meta {
            font-size: 12px;
            color: #718096;
        }

        /* Star rating styles */
        .star-rating {
            font-size: 30px;
            color: #FFD700;
            cursor: pointer;
        }

        .star-rating i {
            transition: color 0.3s ease;
            margin-right: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .star-rating i.selected {
            color: #FF8C00;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #e2e8f0;
            cursor: pointer;
        }

        .star-rating input:checked~label {
            color: #ffcc00;
        }

        /* .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffcc00;
        } */

        .star-rating input:focus~label {
            outline: none;
            box-shadow: 0 0 5px 2px rgba(66, 153, 225, 0.5);
        }

        .delete{
            margin-left: 1032px; 
            color: white; 
            background-color:#60a6ec; 
            padding: 10px; 
            border-radius:0px 0px 8px 0px; 
            margin-top: -20px; 
            margin-bottom: -25px; 
            margin-right: -15px;
        }

    </style>
</head>

<body>
    <main class="container">
        <article class="bg-white p-6 rounded-lg shadow-md">
            <div class="overflow-x-auto whitespace-nowrap">
                <img alt="A detailed description of the first blog post image" class="inline-block rounded-lg mb-4 mr-4"
                    height="400"
                    src="https://storage.googleapis.com/a1aa/image/s6Jo6fIetJlOO0DIM7RwgKgveegCL1Sg3NwoUTKPt7NBxT0PB.jpg"
                    width="600" />
                <img alt="A detailed description of the second blog post image"
                    class="inline-block rounded-lg mb-4 mr-4" height="400"
                    src="https://storage.googleapis.com/a1aa/image/qw23o6iQuw6OKRLBoSNbrCybhWmevC5auUljwyj13ULGeE9TA.jpg"
                    width="600" />
                <img alt="A detailed description of the third blog post image" class="inline-block rounded-lg mb-4 mr-4"
                    height="400"
                    src="https://storage.googleapis.com/a1aa/image/8EPB7reerBu7ykiZA5ZMYDA1RS2fBVPYVGbvynvuGvwk4J6nA.jpg"
                    width="600" />
                <img alt="A detailed description of the fourth blog post image"
                    class="inline-block rounded-lg mb-4 mr-4" height="400"
                    src="https://storage.googleapis.com/a1aa/image/kE2N7Vwesc3YDaixCIBBuPnpfSPfd0fLFzkqI7TeUUr0hnofE.jpg"
                    width="600" />
            </div>
            <h2 class="text-2xl font-bold mt-4">
                Blog Post Title
            </h2>
            <p class="text-gray-600 text-sm mt-2">
                Posted on Jan 1, 2023 by Author Name
            </p>
            <div class="mt-4 text-gray-700 leading-relaxed">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed
                    cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.
                    Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget
                    nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                </p>
                <p class="mt-4">
                    Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh.
                    Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut
                    ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non,
                    massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper
                    vel, tincidunt sed, euismod in, nibh.
                </p>
                <p class="mt-4">
                    Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia
                    nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque
                    adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti.
                    Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices.
                    Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna.
                </p>
            </div>
            <div class="mt-6">
                <a class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" style="color: white !important;" href="#">
                    Edit Post
                </a>
            </div>
        </article>

        <section class="comment-section">
            <h3 class="text-xl font-bold mb-4">
                Comments
            </h3>
            <div class="comment-item">
                <div class="flex items-start space-x-4">
                    <img alt="A detailed description of the user's profile picture" class="comment-avatar" height="50"
                        src="https://storage.googleapis.com/a1aa/image/J3FGpMOF56LWL9rXSXAxZ98KsbBed6TR4BkDTC2gAvWFeE9TA.jpg"
                        width="50" />
                    <div style="margin-left: 20px;">
                        <h4 class="text-lg font-bold">User Name 1</h4>
                        <p class="comment-text" style="margin-top: 0px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.
                            Sed cursus ante dapibus diam.
                        </p>
                        <span class="comment-meta">Posted on Jan 2, 2023</span>
                        <i class="fas fa-trash delete"> </i>
                    </div>
                </div>
            </div>
            <div class="comment-item">
                <div class="flex items-start space-x-4">
                    <img alt="A detailed description of the user's profile picture" class="comment-avatar" height="50"
                        src="https://storage.googleapis.com/a1aa/image/J3FGpMOF56LWL9rXSXAxZ98KsbBed6TR4BkDTC2gAvWFeE9TA.jpg"
                        width="50" />
                    <div style="margin-left: 20px;">
                        <h4 class="text-lg font-bold">User Name 2</h4>
                        <p class="comment-text" style="margin-top: 0px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.
                            Sed cursus ante dapibus diam.
                        </p>
                        <span class="comment-meta">Posted on Feb 2, 2023</span>
                        <i class="fas fa-trash delete"> </i>
                    </div>
                </div>
            </div>
            <div class="comment-item">
                <div class="flex items-start space-x-4">
                    <img alt="A detailed description of the user's profile picture" class="comment-avatar" height="50"
                        src="https://storage.googleapis.com/a1aa/image/J3FGpMOF56LWL9rXSXAxZ98KsbBed6TR4BkDTC2gAvWFeE9TA.jpg"
                        width="50" />
                    <div style="margin-left: 20px;">
                        <h4 class="text-lg font-bold">User Name 3</h4>
                        <p class="comment-text" style="margin-top: 0px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.
                            Sed cursus ante dapibus diam.
                        </p>
                        <span class="comment-meta">Posted on Mar 2, 2023</span>
                        <i class="fas fa-trash delete"> </i>
                    </div>
                </div>
            </div>
            <!-- Repeat for each comment -->
        </section>

        <section class="comment-form" style="margin-top: 25px; margin-bottom: 30px;">
            <h3 class="text-xl font-bold mb-4">
                Add Comment
            </h3>
            <form action="#" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-m font-bold mb-2" for="comment">
                        Comment
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);" id="comment" rows="4" placeholder="Enter your comment"></textarea>
                </div>
                <div class="mb-4" style="display: flex; flex-direction: row;" >
                    <label class="block text-gray-700 text-m font-bold mb-2" for="rating">
                        Rate this post
                    </label>
                    <div class="star-rating" style="margin-top: -10px; margin-left: 20px;">
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1">★</label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2">★</label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3">★</label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4">★</label>
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5">★</label>
                    </div>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" type="submit">
                    Post Comment
                </button>
            </form>
        </section>
    </main>
</body>

</html>