
$(document).ready(function() {
  $('.dropdown_toggle').click(function() {
    var $dropdown = $(this).next('.dropdown_btn');
    $('.dropdown_btn').not($dropdown).hide(); // Hide other dropdowns
    $dropdown.toggle(); // Toggle the clicked dropdown
  });

  $(document).click(function(e) {
    if (!$(e.target).closest('.dropdown').length) {
      $('.dropdown_btn').hide(); // Hide dropdowns when clicking outside
    }
  });
});
