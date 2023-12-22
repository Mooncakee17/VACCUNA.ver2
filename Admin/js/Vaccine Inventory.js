function openModal(modal) {
    var modal = document.getElementById(modal + 'Modal');
    modal.style.display = "block";
}
  
function closeModal(modal) {
    var modal = document.getElementById(modal + 'Modal');
    modal.style.display = "none";
}

// Close modals when clicking outside the modal content
  window.onclick = function(event) {
    if (event.target.className === 'modal') {
      event.target.style.display = 'none';
    }
  }
  