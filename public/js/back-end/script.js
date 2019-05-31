$(".alert").delay(1500).slideUp(300, function () {
  $(this).alert('close');
});

(function () {
  "use strict";
  var treeviewMenu = $('.app-menu');
  // Toggle Sidebar
  $('[data-toggle="sidebar"]').click(function (event) {
    event.preventDefault();
    $('.app').toggleClass('sidenav-toggled');
  });
  // Activate sidebar treeview toggle
  $("[data-toggle='treeview']").click(function (event) {
    event.preventDefault();
    if (!$(this).parent().hasClass('is-expanded')) {
      treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
    }
    $(this).parent().toggleClass('is-expanded');
  });
  // Set initial active toggle
  $("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');
  //Activate bootstrip tooltips
  $("[data-toggle='tooltip']").tooltip();
})();

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
      $('#imagePreview').hide();
      $('#imagePreview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#imageUpload").change(function () {
  readURL(this);
});


new WOW().init();