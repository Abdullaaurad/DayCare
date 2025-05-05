<!DOCTYPE html>
<html>

<head>
<title>Parent</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <link rel="stylesheet" href="<?= CSS ?>/Child/full-video.css?v=<?= time() ?>">
</head>

<body>
    <div class="video-container">
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
                <a href="<?= ROOT ?>/Parent/resource?MediaID=<?= $data['Media']->MediaID ?>" id="fullscreen">
                    <i class="fas fa-compress"></i>
                </a>
            </div>

        <?php elseif ($data['Media']->MediaType === 'Audio'): ?>
            <div class="audio-player" style="width: 100%;">
                <img src="<?= isset($data['Media']->Image) ? $data['Media']->Image : IMAGE . '/Audio.jpeg'  ?>" style="height: 90vh;" alt="Audio Thumbnail">
                <div class="audio-player-container" style="justify-content: center; align-items: center; display: flex;">
                    <audio id="audio" controls style="margin-top: 10px; margin-bottom: 0px; justify-content: center; align-items: center; display: flex;">
                        <source src="<?= $data['Media']->URL ?>" type="audio/mpeg"> Your browser does not support the audio element.
                    </audio>
                </div>
                <a href="<?= ROOT ?>/Parent/resource?MediaID=<?= $data['Media']->MediaID ?>" id="fullscreen">
                    <i class="fas fa-compress"></i>
                </a>
            </div>

        <?php elseif ($data['Media']->MediaType === 'Image'): ?>
            <div class="image-display">
                <img src="<?= isset($data['Media']->URL) ? $data['Media']->URL : '' ?>" class="resource-img" alt="<?= htmlspecialchars($data['Media']->Title) ?>">
            </div>
            <a href="<?= ROOT ?>/Parent/resource?MediaID=<?= $data['Media']->MediaID ?>" class="minimized" id="fullscreen" style="position: fixed; ">
                <i class="fas fa-compress"></i>
            </a>

        <?php elseif ($data['Media']->MediaType === 'Book'): ?>
            <div id="pdf-viewer" class="book-display">
                <canvas id="pdf-canvas"></canvas> <!-- Canvas for rendering PDF -->
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
            <a href="<?= ROOT ?>/Parent/resource?MediaID=<?= $data['Media']->MediaID ?>" class="minimized" id="fullscreen" style="display: block; margin-left: 30px;">
                <i class="fas fa-compress"></i>
            </a>
        <?php else: ?>
            <!-- Default fallback content if MediaType is not recognized -->
            <p>Media type not supported.</p>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Check if the video element exists before accessing video functionalities.
            const video = document.getElementById('video');
            const playPauseButton = document.getElementById('playPause');
            const pauseButton = document.getElementById('pause');
            const currentTimeElement = document.getElementById('currentTime');
            const progressBar = document.getElementById('progressBar');
            const muteButton = document.getElementById('mute');
            const unmuteButton = document.getElementById('unmute');
            const fullscreenButton = document.getElementById('fullscreen');
            const exitFullscreenButton = document.getElementById('exitFullscreen');

            const pdfUrl = "<?= $data['Media']->URL ?>"; // Get PDF URL from PHP
            const canvas = document.getElementById("pdf-canvas");

            // Check if the canvas exists
            if (canvas) {
                const ctx = canvas.getContext("2d");
                let pdfDoc = null,
                    pageNum = 1;

                function renderPage(num) {
                    if (pdfDoc) {
                        pdfDoc.getPage(num).then(page => {
                            const viewport = page.getViewport({
                                scale: 1
                            }); // Adjust scale as needed
                            canvas.width = viewport.width;
                            canvas.height = viewport.height;

                            const renderContext = {
                                canvasContext: ctx,
                                viewport: viewport
                            };
                            page.render(renderContext);
                            document.getElementById("page-num").textContent = num;
                        });
                    }
                }

                // Load the PDF document
                pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
                    pdfDoc = pdf;
                    const pageCountElement = document.getElementById("page-count");
                    if (pageCountElement) {
                        pageCountElement.textContent = pdf.numPages;
                    }
                    renderPage(pageNum);
                });

                // Prev Page Button
                const prevPageButton = document.getElementById("prev-page");
                if (prevPageButton) {
                    prevPageButton.addEventListener("click", () => {
                        if (pageNum > 1) {
                            pageNum--;
                            renderPage(pageNum);
                        }
                    });
                }

                // Next Page Button
                const nextPageButton = document.getElementById("next-page");
                if (nextPageButton) {
                    nextPageButton.addEventListener("click", () => {
                        if (pdfDoc && pageNum < pdfDoc.numPages) {
                            pageNum++;
                            renderPage(pageNum);
                        }
                    });
                }
            }

            // Update mute buttons if video exists
            function updateMuteButtons() {
                if (video) {
                    if (video.muted) {
                        if (muteButton) muteButton.style.display = 'none';
                        if (unmuteButton) unmuteButton.style.display = 'block';
                    } else {
                        if (muteButton) muteButton.style.display = 'block';
                        if (unmuteButton) unmuteButton.style.display = 'none';
                    }
                }
            }

            // Add event listeners if respective elements exist.
            if (muteButton && video) {
                muteButton.addEventListener('click', () => {
                    video.muted = true;
                    updateMuteButtons();
                });
            }

            if (unmuteButton && video) {
                unmuteButton.addEventListener('click', () => {
                    video.muted = false;
                    updateMuteButtons();
                });
            }

            if (video) {
                video.addEventListener('volumechange', updateMuteButtons);
            }

            // Update play/pause buttons if video exists
            function updatePlayPauseButtons() {
                if (video && playPauseButton && pauseButton) {
                    if (video.paused) {
                        playPauseButton.style.display = 'block';
                        pauseButton.style.display = 'none';
                    } else {
                        playPauseButton.style.display = 'none';
                        pauseButton.style.display = 'block';
                    }
                }
            }

            function updateProgressBar() {
                if (video && progressBar && currentTimeElement) {
                    const progress = (video.currentTime / video.duration) * 100;
                    progressBar.value = progress;
                    const minutes = Math.floor(video.currentTime / 60);
                    const seconds = Math.floor(video.currentTime % 60).toString().padStart(2, '0');
                    currentTimeElement.textContent = `${minutes}:${seconds}`;
                }
            }

            function setVideoTime() {
                if (video && progressBar) {
                    video.currentTime = (progressBar.value / 100) * video.duration;
                }
            }

            function toggleFullscreen() {
                if (video) {
                    if (document.fullscreenElement) {
                        document.exitFullscreen();
                    } else {
                        video.requestFullscreen();
                    }
                }
            }

            function updateFullscreenButtons() {
                if (fullscreenButton && exitFullscreenButton) {
                    if (document.fullscreenElement) {
                        fullscreenButton.style.display = 'none';
                        exitFullscreenButton.style.display = 'block';
                    } else {
                        fullscreenButton.style.display = 'block';
                        exitFullscreenButton.style.display = 'none';
                    }
                }
            }

            // Initial updates if video exists
            updatePlayPauseButtons();
            updateProgressBar();
            updateMuteButtons();
            updateFullscreenButtons();

            if (playPauseButton && video) {
                playPauseButton.addEventListener('click', () => {
                    if (video.paused) {
                        video.play();
                    } else {
                        video.pause();
                    }
                    updatePlayPauseButtons();
                });
            }

            if (pauseButton && video) {
                pauseButton.addEventListener('click', () => {
                    video.pause();
                    updatePlayPauseButtons();
                });
            }

            if (video) {
                video.addEventListener('click', () => {
                    if (video.paused) {
                        video.play();
                    } else {
                        video.pause();
                    }
                    updatePlayPauseButtons();
                });
            }

            if (video && progressBar) {
                video.addEventListener('timeupdate', updateProgressBar);
                progressBar.addEventListener('input', setVideoTime);
                video.addEventListener('play', updatePlayPauseButtons);
                video.addEventListener('pause', updatePlayPauseButtons);
            }

            if (fullscreenButton) {
                fullscreenButton.addEventListener('click', toggleFullscreen);
            }

            if (exitFullscreenButton) {
                exitFullscreenButton.addEventListener('click', toggleFullscreen);
            }

            document.addEventListener('fullscreenchange', updateFullscreenButtons);
        });
    </script>
</body>

</html>