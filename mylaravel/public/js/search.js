// Lấy các phần tử
var modal = document.getElementById("search-modal");
var searchIcon = document.getElementById("search-icon");
var closeBtn = document.getElementsByClassName("close")[0];

// Khi người dùng click vào biểu tượng kính lúp, modal sẽ mở
searchIcon.onclick = function() {
  modal.style.display = "block";
}

// Khi người dùng click vào nút "x" để đóng modal
closeBtn.onclick = function() {
  modal.style.display = "none";
}

// Khi người dùng click bên ngoài modal, modal sẽ đóng lại
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

