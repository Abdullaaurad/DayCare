const bars =  document.querySelectorAll('.bar');

bars.forEach( bar => {
    const precent = Math.trunc( Math.random() * 100)
    bar.style.height = precent + "%";
});