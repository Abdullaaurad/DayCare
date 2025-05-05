<!DOCTYPE html>
<html>

<head>
<title>Parent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <link rel="stylesheet" href="<?= CSS ?>/Child/video.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/videomain.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/funzone1.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar2.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Setting.js"></script>
    <script src="<?= JS ?>/Child/Progress.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Navbar.js?v=<?= time() ?>"></script>
</head>

<body>
    <div class="sidebar" id="sidebar1">
        <img src="<?= IMAGE ?>/logo_light.png" class="star" id="starImage">
        <div class="logo-div">
            <img src="<?= IMAGE ?>/logo_light.png" class="logo" id="sidebar-logo"> </img>
            <h2 id="sidebar-kiddo">KIDDO VILLE </h2>
        </div>
        <ul style="margin-top:-20px;">
            <li class="hover-effect unselected first">
                <a href="<?= ROOT ?>/Parent/Home">
                    <i class="fas fa-house"></i> <span>Home</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Parent/history">
                    <i class="fas fa-history"></i> <span>History</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Parent/report">
                    <i class="fa fa-user-shield"></i> <span>Report</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Parent/reservation">
                    <i class="fas fa-calendar-check"></i> <span>Reservation</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Parent/meal">
                    <i class="fas fa-utensils"></i> <span>Meal plan</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Parent/event">
                    <i class="fas fa-calendar-alt"></i> <span>Event</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Parent/package">
                    <i class="fas fa-box"></i> <span>Package</span>
                </a>
            </li>
            <li class="selected" style="margin-top: 40px;">
                <a href="<?= ROOT ?>/Parent/funzonehome">
                    <i class="fas fa-gamepad"></i> <span>Fun Zone</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Parent/payment">
                    <i class="fas fa-credit-card"></i> <span>Payments</span>
                </a>
            </li>
        </ul>
        <hr style="margin-top: 40px;">
        <div class="help">
            <a href="#" style="text-decoration:none"><i class="fas fa-question-circle"></i> <span>Help</span></a>
        </div>
    </div>
    <!-- navigation to choose child -->
    <div class="sidebar-2" id="sidebar2" style="display: flex; flex-direction: row;">
        <div>
            <h2 style="margin-top: 25px; margin-left: 15px !important;">Familty Ties</h2>
            <div class="family-section" style="margin-top: 10px; margin-left: 20px;">
                <ul>
                    <li class="hover-effect first"
                        onclick="removechildsession();">
                        <img src="<?php echo htmlspecialchars($data['parent']['image']); ?>"
                            style="width: 60px; height:60px; border-radius: 30px;">
                        <h2>Family</h2>
                    </li>
                </ul>
            </div>
            <div>
                <h2 style="margin-top: 25px; margin-left: 15px !important;">Little Explorers</h2>
                <p style="margin-bottom: 20px; color: white; margin-left: 15px !important;">
                    Explore your children's activities and progress!
                </p>
                <ul class="children-list">
                    <?php foreach ($data['children'] as $child): ?>
                        <li class="first
                                <?php if ($child['name'] === $data['selectedchildren']['name']) {
                                    echo "select-child";
                                } ?>
                            "
                            onclick="setChildSession('<?= isset($child['Id']) ? $child['Id'] : '' ?>','<?= isset($child['Child_Id']) ? $child['Child_Id'] : '' ?>')">
                            <img src="<?php echo htmlspecialchars($child['image']); ?>"
                                alt="Child Profile Image"
                                style="width: 60px; height: 60px; border-radius: 30px; <?php if ($child['name'] !== $data['selectedchildren']['name']) {
                                                                                            echo "margin-left: -20px !important";
                                                                                        } ?>">
                            <h2><?= isset($child['name']) ? $child['name'] : 'No name set'; ?></h2>
                        </li>
                        <hr>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- navigation for funzone -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <i class="fa fa-bars" id="minimize-btn"
                style="margin-right: -50px; cursor: pointer; font-size: 30px;"></i>
            <div class="nav-buttons" style="margin-left: 50px;">
                <div class="circle" onclick="window.location.href='<?= ROOT ?>/Parent/funzoneHistory'">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="circle" onclick="window.location.href='<?= ROOT ?>/Parent/funzoneWhishlist'">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <h2>Home</h2>
            <div class="search-bar" style="margin-left: -600px; margin-right: 200px; margin-top:0px;">
                <input type="text" placeholder="Search">
            </div>
            <i class="fas fa-cog settings"></i>
            <div class="profile-card" id="profileCard" style="margin-top: 200px;">
                <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow"
                    style="width: 24px; height: 24px; fill:#233E8D !important;" class="back" id="closeProfileCard">
                <img alt="Profile picture of Thilina Perera" height="100" src="<?= IMAGE ?>/profilePic.png"
                    width="100" class="profile" />
                <h2 class="child-name">Thilina Perera</h2>
                <p>Student    RS0110657</p>
                <button class="logout-button"
                    onclick="window.location.href = '<?= ROOT ?>/Main/Home' ">Logout
                </button>
                <div class="lock">
                    <p class="lock-p"> Parental lock</p>
                    <div class="switch">
                        <input type="checkbox" id="toggle">
                        <label for="toggle">
                            <div class="toggle-icon">
                                <i class="fa fa-unlock"></i>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="header2">
            <img src="<?= IMAGE ?>/funzone-logo.png" style="width: 40px; height: 40px; margin-left: 20px;">
            <p style="color: white; font-size: 17px;">Funzone </p>
            <a href="<?= ROOT ?>/Parent/funzonehome" class="hover-effect" style="margin-left: 170px;">Home</a>
            <a href="<?= ROOT ?>/Parent/funzonewhishlist" class="hover-effect">Whishlist</a>
            <a href="<?= ROOT ?>/Parent/funzonetasks" class="hover-effect">Task</a>
            <a href="<?= ROOT ?>/Parent/funzonehistory" class="hover-effect">History</a>
            <select id="typePicker" style="margin-left: 330px; width: 200px; padding: 5px; border-radius: 10px;">
                <option value="All"> All </option>
                <option value="video"> Videos </option>
                <option value="Book"> Books </option>
                <option value="Image"> Images </option>
                <option value="Audio"> Songs </option>
            </select>
        </div>
        <div class="grid" style="max-height: 100%; overflow-x:hidden;">
            <div class="video-container">
                <div class="video-content">
                    <?php if ($data['Media']->MediaType === 'Video'): ?>
                        <div class="video-player">
                            <video id="video" width="100%" height="100%" src="<?= isset($data['Media']->URL) ? $data['Media']->URL : '' ?>" type="video/mp4"></video>
                        </div>
                        <div class="video-controls">
                            <div class="left-controls">
                                <i class="fas fa-play" id="playPause"></i>
                                <i class="fas fa-volume-up" id="mute" style="display: block;"></i>
                                <i class="fas fa-volume-mute" id="unmute" style="display: none;"></i>
                                <span id="currentTime">0:00</span>
                            </div>
                            <div class="progress-container">
                                <input type="range" id="progressBar" min="0" max="100" value="0">
                            </div>
                        </div>
                    <?php elseif ($data['Media']->MediaType === 'Audio'): ?>
                        <div class="audio-player" style="width: 100%;">
                            <img src="<?= isset($data['Media']->Image) ? $data['Media']->Image : IMAGE . '/Audio.jpeg'  ?>" class="resource-img" alt="Audio Thumbnail">
                            <audio id="audio" controls style="margin-top: 10px; margin-bottom: 0px;">
                                <source src="<?= $data['Media']->URL ?>" type="audio/mpeg"> Your browser does not support the audio element.
                            </audio>
                        </div>
                    <?php elseif ($data['Media']->MediaType === 'Image'): ?>
                        <div class="image-display">
                            <img src="<?= isset($data['Media']->URL) ? $data['Media']->URL : '' ?>" class="resource-img" alt="<?= htmlspecialchars($data['Media']->Title) ?>">
                        </div>
                    <?php elseif ($data['Media']->MediaType === 'Book'): ?>
                        <!-- <div class="book-display">
                        <img src="<?= isset($data['Media']->Image) ? $data['Media']->Image : IMAGE . '/PDF.jpeg' ?>" class="resource-img" alt="<?= htmlspecialchars($data['Media']->Title) ?>">
                        </a>
                    </div> -->
                        <div id="pdf-viewer" class="book-display">
                            <canvas id="pdf-canvas"></canvas>
                        </div>

                        <!-- PDF Navigation Controls -->
                        <div class="Book-controls">
                            <a href="<?= $data['Media']->URL ?>" target="_blank" download class="Book-download">
                                <i class="fa fa-download"></i> Download PDF
                            </a>
                            <button id="prev-page" class="Book-button">Previous</button>
                            <span>Page: <span id="page-num">1</span> / <span id="page-count"></span></span>
                            <button id="next-page" class="Book-button">Next</button>
                        </div>

                    <?php else: ?>
                        <p>Media type not recognized.</p>
                    <?php endif; ?>
                    <div class="video-actions">
                        <div class="action-text">
                            <i class="fas fa-thumbs-up <?= (!empty($data['Media']->Liked) && $data['Media']->Liked) ? 'liked' : ''; ?>" id="thumbsUpButton"></i>
                        </div>
                        <div class="action-text">
                            <i class="fas fa-heart <?= (!empty($data['Media']->whishlist) && ($data['Media']->whishlist)) ? 'added' : ''; ?>" id="heartButton"></i><span>Add to Wishlist</span>
                        </div>
                        <div class="action-text">
                            <i class="fas fa-comment-dots" id="commentButton"></i><span>Add Comment</span>
                        </div>
                        <div class="right-controls">
                            <a href="<?= ROOT ?>/Child/fullresource?MediaID=<?= $data['Media']->MediaID ?>" id="fullscreen" style="display: block; margin-left: 30px;">
                                <i class="fas fa-expand"></i>
                            </a>
                        </div>
                    </div>

                    <div id="commentSection" style="display: none;">
                        <form method="POST" enctype="multipart/form-data" action="<?= ROOT ?>/Child/Resource/Add_Comment">
                            <input name="MediaID" value="<?= $data['Media']->MediaID ?>" style="display: none;"> </input>
                            <textarea id="commentInput" name="Comment" rows="3" placeholder="Add a comment..."></textarea>
                            <button type="submit" id="submitCommentButton">Submit</button>
                            <button id="cancelCommentButton">Cancel</button>
                        </form>
                    </div>

                    <div class="video-details">
                        <h2><?php echo isset($data['Media']->Title) ? $data['Media']->Title : redirect('Child/FunzoneHome'); ?></h2>
                        <p style="margin-top: -20px;"><?php echo isset($data['Media']->Description) ? $data['Media']->Description : redirect('Child/FunzoneHome'); ?></p>
                    </div>
                    <!-- Commenst -->
                    <div class="comments" id="comments">
                        <!-- <div class="comment">
                            <img src="<?= IMAGE ?>/face.jpeg" alt="face icon"
                                style="width: 40px; height: 40px; border-radius: 100%; border: 2px solid #1d61c4;">
                            <div class="text">Comment text goes here...</div>
                            <p class="Date-comment"> Date:18/09/2024</p>
                            <p class="Date-comment"> Time:10:00 pm</p>
                        </div>
                        <div class="comment">
                            <img src="<?= IMAGE ?>/face.jpeg" alt="face icon"
                                style="width: 40px; height: 40px; border-radius: 100%; border: 2px solid #1d61c4;">
                            <div class="text">Comment text goes here...</div>
                        </div>
                        <div class="comment">
                            <img src="<?= IMAGE ?>/face.jpeg" alt="face icon"
                                style="width: 40px; height: 40px; border-radius: 100%; border: 2px solid #1d61c4;">
                            <div class="text">Comment text goes here...</div>
                        </div>
                        <div class="comment">
                            <img src="<?= IMAGE ?>/face.jpeg" alt="face icon"
                                style="width: 40px; height: 40px; border-radius: 100%; border: 2px solid #1d61c4;">
                            <div class="text">Comment text goes here...</div>
                        </div>
                        <div class="comment">
                            <img src="<?= IMAGE ?>/face.jpeg" alt="face icon"
                                style="width: 40px; height: 40px; border-radius: 100%; border: 2px solid #1d61c4;">
                            <div class="text">Comment text goes here...</div>
                        </div>
                        <div class="comment">
                            <img src="<?= IMAGE ?>/face.jpeg" alt="face icon"
                                style="width: 40px; height: 40px; border-radius: 100%; border: 2px solid #1d61c4;">
                            <div class="text">Comment text goes here...</div>
                        </div>
                        <div class="comment">
                            <img src="<?= IMAGE ?>/face.jpeg" alt="face icon"
                                style="width: 40px; height: 40px; border-radius: 100%; border: 2px solid #1d61c4;">
                            <div class="text">Comment text goes here...</div>
                        </div>
                        <div class="comment">
                            <img src="<?= IMAGE ?>/face.jpeg" alt="face icon"
                                style="width: 40px; height: 40px; border-radius: 100%; border: 2px solid #1d61c4;">
                            <div class="text">Comment text goes here...</div>
                        </div> -->
                    </div>
                </div>

                <!-- Sidebar for Related Videos -->
                <div class="related-sidebar">
                    <?php foreach ($data['relevant'] as $item): if (isset($item->MediaType)): ?>
                            <div class="related-video" onclick="window.location.href='<?= ROOT ?>/Child/Resource?MediaID=<?= $item->MediaID ?>'">
                                <div class="thumbnail">
                                    <?php if ($item->MediaType === "Image"): ?>
                                        <img alt="<?= htmlspecialchars($item->Title) ?>" class="resource-img" height="150" src="<?= $item->URL ?>" width="150" />
                                    <?php elseif ($item->MediaType === "Video"): $videoBlob = $item->Image; ?>
                                        <div class="video-container" id="video-container-<?= $item->MediaID ?>">
                                            <img alt="Video" style="height: 130px; width: auto; object-fit: contain; margin-left: 110px;"
                                                id="img-<?= $item->MediaID ?>"
                                                src="<?= IMAGE ?>/video.png" />
                                            <video width="150" height="150" id="video-<?= $item->MediaID ?>" style="display: none;" muted preload="none">
                                                <source src="<?= $item->URL ?>" type="video/mp4">
                                                Your browser does not support video playback.
                                            </video>
                                        </div>
                                    <?php elseif ($item->MediaType === "Audio"): $audioBlob = $item->Image; ?>
                                        <img alt="Audio Thumbnail" height="150" class="resource-img" src="<?= isset($item->Image) ? IMAGE . '/Audio.jpeg' : IMAGE . '/Audio.jpeg' ?>" width="150" />
                                    <?php elseif ($item->MediaType === "Book"): $bookBlob = $item->Image; ?>
                                        <img alt="Book Thumbnail" height="150" class="resource-img" src="<?= isset($item->Image) ? IMAGE . '/PDF.jpeg' : IMAGE . '/PDF.jpeg' ?>" width="150" />
                                    <?php else: ?>
                                        <img alt="Default Placeholder" height="150" class="resource-img" src="<?= IMAGE ?>/default-placeholder.png" width="150" />
                                    <?php endif; ?>
                                </div>
                                <div class="details">
                                    <div class="title"><?= htmlspecialchars($item->Title) ?></div>
                                    <div class="description"><?= htmlspecialchars($item->Description) ?></div>
                                </div>
                            </div>
                    <?php endif;
                    endforeach; ?>

                    <!-- <div class="related-video">
                        <div class="thumbnail">
                            <i class="fas fa-play play-button"></i>
                        </div>
                        <div class="details">
                            <div class="title">Related Video Title</div>
                            <div class="description">Description...</div>
                        </div>
                    </div>

                    <div class="related-video">
                        <div class="thumbnail">
                            <i class="fas fa-play play-button"></i>
                        </div>
                        <div class="details">
                            <div class="title">Related Video Title</div>
                            <div class="description">Description...</div>
                        </div>
                    </div>

                    <div class="related-video">
                        <div class="thumbnail">
                            <i class="fas fa-play play-button"></i>
                        </div>
                        <div class="details">
                            <div class="title">Related Video Title</div>
                            <div class="description">Description...</div>
                        </div>
                    </div>

                    <div class="related-video">
                        <div class="thumbnail">
                            <i class="fas fa-play play-button"></i>
                        </div>
                        <div class="details">
                            <div class="title">Related Video Title</div>
                            <div class="description">Description...</div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <script>
        const minimizeBtn = document.getElementById('minimize-btn');
        const sidebar = document.getElementById('sidebar1');
        const starImage = document.getElementById('starImage');
        const logo = document.getElementById('sidebar-logo');
        const kiddo = document.getElementById('sidebar-kiddo');

        <?php if (!empty($_SESSION['APP']['MINIMIZE'])): ?>
            sidebar.classList.add('minimized');
            starImage.classList.add('show');
            logo.classList.add('hidden');
            kiddo.classList.add('hidden');
        <?php endif; ?>

        function renderComments(comments) {
            const commentsArray = Array.isArray(comments) ? comments : Object.values(comments);
            const commentsContainer = document.getElementById('comments');
            commentsContainer.innerHTML = '';

            commentsArray.forEach(comment => {
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('comment');

                // Profile Image
                const img = document.createElement('img');
                img.src = comment.Image || 'http://localhost/KiddoVille-UI_UX/Public/Assets/Images/face.jpeg';
                img.alt = 'face icon';
                img.style.width = '40px';
                img.style.height = '40px';
                img.style.borderRadius = '100%';
                img.style.border = '2px solid #1d61c4';
                commentDiv.appendChild(img);

                // Comment Text
                const textDiv = document.createElement('div');
                textDiv.classList.add('text');
                textDiv.textContent = comment.CommentText;
                commentDiv.appendChild(textDiv);

                // Date and Time
                const dateP = document.createElement('p');
                dateP.classList.add('Date-comment');
                dateP.textContent = 'Date: ' + (comment.Date || '');
                commentDiv.appendChild(dateP);

                const timeP = document.createElement('p');
                timeP.classList.add('Date-comment');
                timeP.textContent = 'Time: ' + (comment.Time || '');
                commentDiv.appendChild(timeP);

                // If the comment belongs to the logged-in user, add Edit & Delete icons
                if (comment.Mine) {
                    const actionsDiv = document.createElement('div');
                    actionsDiv.classList.add('comment-actions');

                    const editBtn = document.createElement('button');
                    editBtn.classList.add('edit-btn');
                    editBtn.innerHTML = '<i class="fas fa-edit"></i>'; // Font Awesome Edit Icon
                    editBtn.addEventListener('click', () => editComment(comment.CommentID, textDiv));

                    // Create Delete Button
                    const deleteBtn = document.createElement('button');
                    deleteBtn.classList.add('delete-btn');
                    deleteBtn.innerHTML = '<i class="fas fa-trash-alt"></i>'; // Font Awesome Delete Icon
                    deleteBtn.addEventListener('click', () => deleteComment(comment.CommentID, commentDiv));

                    // Append Buttons to the Comment
                    if (comment.Mine) { // Only show if the comment belongs to the user
                        commentDiv.appendChild(editBtn);
                        commentDiv.appendChild(deleteBtn);
                    }
                    commentDiv.appendChild(actionsDiv);
                }

                commentsContainer.appendChild(commentDiv);
            });
            addVideoHoverListeners(comments);
        }

        function deleteComment(commentID, commentDiv) {
            if (confirm("Are you sure you want to delete this comment?")) {
                // Remove from UI
                commentDiv.remove();

                // Send AJAX request to delete from database
                fetch('<?= ROOT ?>/Child/Resource/Delete_Comment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            CommentID: commentID
                        })
                    })
                    .then(response => response.json())
                    .then(data => console.log(data.message))
                    .catch(error => console.error('Error:', error));
            }
        }

        function editComment(commentID, textDiv) {
            // Show the comment section
            const commentSection = document.getElementById('commentSection');
            commentSection.style.display = 'block';

            // Get the textarea and set its value to the existing comment
            const commentInput = document.getElementById('commentInput');
            commentInput.value = textDiv.textContent;

            // Change form action to send to Edit_Comment
            const form = commentSection.querySelector('form');
            form.action = "<?= ROOT ?>/Child/Resource/Edit_Comment";

            // Remove old hidden input if exists
            let oldHiddenInput = document.getElementById('editCommentID');
            if (oldHiddenInput) {
                oldHiddenInput.remove();
            }

            // Create hidden input for CommentID
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'CommentID';
            hiddenInput.value = commentID;
            hiddenInput.id = 'editCommentID';

            form.appendChild(hiddenInput);
        }

        function addVideoHoverListeners(dataArray) {
            dataArray.forEach(item => {
                if (item.MediaType === "Video") {
                    const container = document.getElementById(`video-container-${item.MediaID}`);
                    const video = document.getElementById(`video-${item.MediaID}`);
                    const img = document.getElementById(`img-${item.MediaID}`);
                    let timeoutId = null;

                    if (!container || !video || !img) return; // ensure elements exist

                    container.addEventListener('mouseenter', () => {
                        console.log("Hi");
                        clearTimeout(timeoutId);
                        img.style.display = 'none';
                        video.style.display = 'block';
                        video.play();
                    });

                    container.addEventListener('mouseleave', () => {
                        timeoutId = setTimeout(() => {
                            video.pause();
                        }, 10);
                    });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {

            let Comments = (<?= $data['Comments'] ?>);
            const commentsArray = Array.isArray(Comments) ? Comments : Object.values(Comments);
            renderComments(commentsArray);

            if (<?= $data['Media']->MediaType === 'Book' ? 'true' : 'false' ?>) {
                let pdfUrl = "<?= $data['Media']->URL ?>"; // Load the PDF dynamically
                let pdfDoc = null;
                let pageNum = 1;
                let scale = 0.75; // Adjust scale to zoom out
                const canvas = document.getElementById('pdf-canvas');
                const ctx = canvas.getContext('2d');

                // Load PDF
                pdfjsLib.getDocument(pdfUrl).promise.then(doc => {
                    pdfDoc = doc;

                    // ✅ Update total page count
                    document.getElementById('page-count').textContent = pdfDoc.numPages;

                    renderPage(pageNum);
                });

                function renderPage(num) {
                    pdfDoc.getPage(num).then(page => {
                        let viewport = page.getViewport({
                            scale: scale
                        });
                        canvas.width = viewport.width;
                        canvas.height = viewport.height;

                        let renderContext = {
                            canvasContext: ctx,
                            viewport: viewport
                        };
                        page.render(renderContext);

                        // ✅ Update the current page number
                        document.getElementById('page-num').textContent = num;
                    });
                }

                document.getElementById("prev-page").addEventListener("click", () => {
                    if (pageNum <= 1) return;
                    pageNum--;
                    renderPage(pageNum);
                });

                document.getElementById("next-page").addEventListener("click", () => {
                    if (pageNum >= pdfDoc.numPages) return;
                    pageNum++;
                    renderPage(pageNum);
                });
            }

            const thumbsUpButton = document.getElementById('thumbsUpButton');
            const heartButton = document.getElementById('heartButton');
            const mediaID = <?= $data['Media']->MediaID ?>;

            thumbsUpButton.addEventListener('click', () => {
                console.log(mediaID);
                if (thumbsUpButton.classList.contains('liked')) {
                    console.log("Remove liked");
                    thumbsUpButton.classList.add('liked');
                } else {
                    console.log("Add liked");
                    thumbsUpButton.classList.remove('liked');
                }

                fetch('<?= ROOT ?>/Child/Resource/like', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            mediaID: mediaID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("Like Status changed");
                        } else {
                            console.error("Failed to set.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });

            heartButton.addEventListener('click', () => {
                console.log(mediaID);
                if (heartButton.classList.contains('added')) {
                    heartButton.classList.remove('added');
                } else {
                    heartButton.classList.add('added');
                }
                fetch('<?= ROOT ?>/Child/Resource/whishlist', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            mediaID: mediaID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("Whishlist Status changed", data.data);
                        } else {
                            console.error("Failed to set.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });

            const commentButton = document.getElementById('commentButton');
            const commentSection = document.getElementById('commentSection');
            const submitCommentButton = document.getElementById('submitCommentButton');
            const cancelCommentButton = document.getElementById('cancelCommentButton');
            const commentInput = document.getElementById('commentInput');

            commentButton.addEventListener('click', () => {
                commentSection.style.display = 'block';
            });

            submitCommentButton.addEventListener('click', () => {
                FormData.preventDefault();
                const commentText = commentInput.value.trim();
                if (commentText) {
                    const commentDiv = document.createElement('div');
                    commentDiv.className = 'comment';
                    commentDiv.innerHTML = `
                        <img src="<?php isset($data['selectedchildren']['image']) ? $data['selectedchildren']['image'] : ROOT . 'face.jpeg' ?>" alt="face icon" style="width: 40px; height: 40px; border-radius: 100%; border: 2px solid #1d61c4;">
                        <div class="text">${commentText}</div>
                    `;
                    document.querySelector('.comments').appendChild(commentDiv);
                    FormData.submit();
                    commentInput.value = '';
                    commentSection.style.display = 'none';
                }
            });

            cancelCommentButton.addEventListener('click', () => {
                commentInput.value = '';
                commentSection.style.display = 'none';
            });
        });
    </script>
</body>

</html>