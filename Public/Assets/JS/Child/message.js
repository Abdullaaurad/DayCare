document.addEventListener('DOMContentLoaded', function () {
    const persons = document.querySelectorAll('.chat-item');
    const refresh = document.getElementById('refresh');
    const section = document.getElementById('refresh-section');
    const sidebar = document.getElementById('sidebar');
    const chatwindow = document.getElementById('chat-window');
    const chat = document.querySelectorAll('.chat-window .messages .message');
    const oldtext = document.getElementById('oldtext');
    const newtext = document.getElementById('newtext');
    const start = document.getElementById('start');
    const inputbar = document.getElementById('input-bar');
    const sendbtn = document.getElementById('send-btn');
    const messagevalue = document.getElementById('message-value');
    const anchor = document.getElementById('scroll-anchor');
    let lol = 0;

    refresh.addEventListener('click', function () {
        section.classList.toggle('hidden');
        sidebar.classList.toggle('blur');
        chatwindow.classList.toggle('blur');

        setTimeout(function () {
            section.classList.toggle('hidden');
            sidebar.classList.toggle('blur');
            chatwindow.classList.toggle('blur');
        }, 5000);
    })
});