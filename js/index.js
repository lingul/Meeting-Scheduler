$('#setupEvent').on("click", function() {
    $('#setupEventModal').css('display', 'block');
})

// Close the modal if the user clicks anywhere outside of the modal.
document.onclick = function(event) {
    if(event.target == document.getElementById("setupEventModal")) {
        $('#setupEventModal').css("display", "none");
    }
};
