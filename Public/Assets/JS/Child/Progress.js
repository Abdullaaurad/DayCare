document.addEventListener('DOMContentLoaded', () => {
    // video players controller
    const video = document.getElementById('video');
    const playPauseButton = document.getElementById('playPause');
    const pauseButton = document.getElementById('pause');
    const currentTimeElement = document.getElementById('currentTime');
    const progressBar = document.getElementById('progressBar');
    const muteButton = document.getElementById('mute');
    const unmuteButton = document.getElementById('unmute');

    function updateMuteButtons() {
        if (video) {
            if (video.muted) {
                muteButton.style.display = 'none';
                unmuteButton.style.display = 'block';
            } else {
                muteButton.style.display = 'block';
                unmuteButton.style.display = 'none';
            }
        }
    }

    if (muteButton) {
        muteButton.addEventListener('click', () => {
            video.muted = true;
            updateMuteButtons();
        });
    }

    if (unmuteButton) {
        unmuteButton.addEventListener('click', () => {
            video.muted = false;
            updateMuteButtons();
        });
    }

    if (video) {
        video.addEventListener('volumechange', updateMuteButtons);
    }

    updatePlayPauseButtons();
    updateProgressBar();
    updateMuteButtons();

    const customOptions = document.querySelectorAll('.custom-option');
    customOptions.forEach(option => {
        option.addEventListener('click', function () {
            customSelectTrigger.innerHTML = `${this.innerText} <i class="fa fa-chevron-down"></i>`;
            customSelectContainer.classList.remove('active');
        });
    });

    function updatePlayPauseButtons() {
        if (video) {
            if (video.paused) {
                // Video is paused, so display the play icon
                playPauseButton.classList.remove('fa-pause');
                playPauseButton.classList.add('fa-play');
                playPauseButton.style.marginLeft = "0px";
            } else {
                // Video is playing, so display the pause icon
                playPauseButton.classList.remove('fa-play');
                playPauseButton.classList.add('fa-pause');
                playPauseButton.style.marginLeft = "5px";
            }
        }        
    }

    function updateProgressBar() {
        if (video) {
            const progress = (video.currentTime / video.duration) * 100;
            progressBar.value = progress;
            const minutes = Math.floor(video.currentTime / 60);
            const seconds = Math.floor(video.currentTime % 60).toString().padStart(2, '0');
            currentTimeElement.textContent = `${minutes}:${seconds}`;
        }
    }

    function setVideoTime() {
        video.currentTime = (progressBar.value / 100) * video.duration;
    }

    updatePlayPauseButtons();
    updateProgressBar();

    if (playPauseButton) {
        playPauseButton.addEventListener('click', () => {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
            updatePlayPauseButtons();
        });
    }

    if (pauseButton) {
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


        video.addEventListener('timeupdate', updateProgressBar);
        progressBar.addEventListener('input', setVideoTime);

        video.addEventListener('play', updatePlayPauseButtons);
        video.addEventListener('pause', updatePlayPauseButtons);
    }
});