<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $productName; ?></title>
    
  <link rel="stylesheet" href="../assets/css/headerfooter.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/responsivenavbar.css">
  <link rel="stylesheet" href="../assets/css/product-page.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="header" style="width: 100%;"></div>

  <main class="container">
    <div class="row details-row">
    <div class="col-md-6 left-column col-sm-12"><img src="<?php echo $productImage; ?>" alt="<?php echo $productImage; ?>" width="500px"></div>
    <div class="col-md-6 right-column col-sm-12">
      <h1 class="heading" style="margin-bottom: 0;"><?php echo $productName; ?></h1>
      <p class="paragraph" style="margin-bottom: 0;"><?php echo $productDescription; ?></p>
      <div class="line"></div>
      <a href="../contact.html" class="simple-button">Contact Us</a>
    </div>
  </div>
  <br><br><br><br>
  <div class="dimention-drawing">
    <h1 class="heading" style="font-size: 40px; ">Dimension Drawing</h1>
    <img src="<?php echo $productDrawing; ?>" alt="<?php echo $productDrawing; ?>" width="100%">
  </div>
  </main>
  <br><br>
  
  <div id="footer" style="width: 100%;"></div>

<script>
    // Load the header and footer content
    fetch("header.html")
      .then(response => response.text())
      .then(data => {
        document.getElementById("header").innerHTML = data;

        // Initialize hamburger menu event listener after header is loaded
        const menuIcon = document.querySelector('.menu-icon');
        const navLinks = document.querySelector('.nav-links');

        menuIcon.addEventListener('click', () => {
          navLinks.classList.toggle('active');
        });
      });

    fetch("footer.html")
      .then(response => response.text())
      .then(data => {
        document.getElementById("footer").innerHTML = data;
      });
  </script>
  <script src="disable.js"></script>

</body>
</html>