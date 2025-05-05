// Select all rows with the class 'approve'
document.addEventListener('DOMContentLoaded', () => {
    const approvals = document.querySelectorAll('.approve');

approvals.forEach((approveElement) => {
    const label = approveElement.textContent;

    if (label === 'Approved') {
        approveElement.style.backgroundColor = 'rgba(0,128,0,0.15)';
        approveElement.style.color = '#008000';
    } else if (label === 'Pending') {
        approveElement.style.backgroundColor = 'rgba(255,165,0,0.15)';
        approveElement.style.color = '#FFA500';
    } else if (label === 'Rejected') {
        approveElement.style.backgroundColor = 'rgba(255,0,0,0.15)';
        approveElement.style.color = '#FF0000';
    }
});



});

//
