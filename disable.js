
//  document.addEventListener('contextmenu', function(event) {
//      event.preventDefault();
// });

// document.addEventListener('keydown', function(event) {
//      // Block Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U, and F12
//      if (
//          (event.ctrlKey && event.shiftKey && (event.key === 'I' || event.key === 'J')) || 
//         (event.ctrlKey && event.key === 'U') || 
//          event.key === 'F12'
//      ) {
//      event.preventDefault();
//      }
// });

// // Block the context menu in case some browsers trigger the page source shortcut on right-click
//  document.addEventListener('keydown', function(event) {
//     // Block Ctrl + U
//      if (event.ctrlKey && event.key === 'U') {
//         event.preventDefault();
//     }
//  });


// Fetch and insert the header
fetch("header.html")
  .then((response) => response.text())
  .then((data) => {
    document.getElementById("header").innerHTML = data;

    // Add event listeners after the header is loaded
    const menuIcon = document.querySelector(".menu-icon");
    const navLinks = document.querySelector(".nav-links");

    menuIcon.addEventListener("click", () => {
      navLinks.classList.toggle("active");
    });

    document.addEventListener("click", (event) => {
      if (!navLinks.contains(event.target) && !menuIcon.contains(event.target)) {
        navLinks.classList.remove("active");
      }
    });

    const plusbtn = document.querySelector(".fa-circle-plus")
    const dropdownMenu = document.getElementById('dropdownMenu')

    plusbtn.addEventListener("click", () => {
      if (dropdownMenu.style.opacity === '1') {
        dropdownMenu.style.opacity = '0'
      }
      else {
        dropdownMenu.style.opacity = '1'
      }

      if (plusbtn.classList.contains('fa-circle-plus')) {
        plusbtn.classList.replace('fa-circle-plus', 'fa-circle-minus');
      } else {
        plusbtn.classList.replace('fa-circle-minus', 'fa-circle-plus');
      }



    });



  });

// Fetch and insert the footer
fetch("footer.html")
  .then((response) => response.text())
  .then((data) => {
    document.getElementById("footer").innerHTML = data;
  });