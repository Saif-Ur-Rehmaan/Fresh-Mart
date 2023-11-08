<?php
include "../inc/config.php";
if ((isset($_SESSION["UserLogin"]))) { ?>
  <script>
    window.location.href = "../index.php";
    console.log("hiii");
  </script>
<?php } ?>
<?php
if (isset($_POST['SignInUser'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];
  echo "\n";
  $isUser = false;
  $d = DatabaseManager::select("clients", "Cli_Mail as Mail,Cli_Password as pass", "Cli_Mail='$email'");
  for ($i = 0; $i < count($d); $i++) {
    $PassFromDB = $d[$i]["pass"];
    $isUser = password_verify($password, $PassFromDB);

    if ($isUser) {
      $Name = DatabaseManager::select("clients", "Cli_DisplayName as Name", "Cli_Mail='$email' And Cli_Password='$PassFromDB'")[0]["Name"];
      $cliId = DatabaseManager::select("clients", "Cli_Id as Cid", "Cli_Mail='$email' And Cli_Password='$PassFromDB'")[0]["Cid"];
      $RoleFromDb = DatabaseManager::select("clients", "Cli_Role as Role", "Cli_Mail='$email' And Cli_Password='$PassFromDB'")[0]["Role"];

      $ContactNumber = DatabaseManager::select("Users", "Use_ContactNo as CN", "_Client_Id='$cliId' LIMIT 1");
      $address = DatabaseManager::select("addresses", "Add_Address as Address", "_Client_Id='$cliId' AND Add_IsDefault=1 LIMIT 1");
      $CN=(isset($ContactNumber[0]))? $ContactNumber[0]["CN"]:"";
      $Address=(isset($address[0]))? $address[0]["Address"]:"";
      switch ($RoleFromDb) {
        case '3':
          $Role = "Admin";
          break;
        case '2':
          $Role = "Seller";
          break;

        default:
          $Role = "User";
          break;
      }

      $_SESSION["UserLogin"] =
        [
          "Email" => $email,
          "Client_Id" => $cliId,
          "Full Name" => $Name,
          "ContactNumber" => $CN,
          "Address" => $Address,
          "Role" => $Role,
          "Wishlish" => [] /*productid goes here as arry val*/
        ];
      ?>
      <script>
        //alert("Sign In Succesfully");
        window.location.href = "../index.php";
      </script>
      <?php
      break;

    }

  }
  if (!$isUser) { ?>
    <script>
      //alert("Email Or Password Incorrect");
      window.location.href = "signin.php";
    </script>
  <?php }

}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from freshcart.codescandy.com/pages/signin.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 31 Mar 2023 10:10:39 GMT -->

<head>

  <title>FreshCart - eCommerce HTML Template</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta content="Codescandy" name="author">

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-M8S4MT3EYG');
  </script>

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon.ico">


  <!-- Libs CSS -->
  <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
  <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">


  <!-- Theme CSS -->
  <link rel="stylesheet" href="../assets/css/theme.min.css">


</head>

<body>

  <!-- navigation -->
  <div class="border-bottom shadow-sm">
    <nav class="navbar navbar-light py-2">
      <div class="container justify-content-center justify-content-lg-between">
        <a class="navbar-brand" href="../index.php">
          <img src="../assets/images/freshcart-logo.svg" alt="" class="d-inline-block align-text-top">
        </a>
        <span class="navbar-text">
          Already have an account? <a href="signin.php">Sign in</a>
        </span>
      </div>
    </nav>
  </div>


  <main>
    <!-- section -->
    <section class="my-lg-14 my-8">
      <div class="container">
        <!-- row -->
        <div class="row justify-content-center align-items-center">
          <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
            <!-- img -->
            <img src="../assets/images/signin-g.svg" alt="" class="img-fluid">
          </div>
          <!-- col -->
          <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
            <div class="mb-lg-9 mb-5">
              <h1 class="mb-1 h2 fw-bold">Sign in to FreshCart</h1>
              <p>Welcome back to FreshCart! Enter your email to get started.</p>
            </div>




















            <form action="signin.php" method="post">
              <div class="row g-3">
                <!-- row -->

                <div class="col-12">
                  <!-- input -->
                  <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" required>
                </div>
                <div class="col-12">
                  <!-- input -->
                  <div class="password-field position-relative">
                    <input type="password" name="password" id="fakePassword" placeholder="Enter Password"
                      class="form-control" required>
                    <span><i id="passwordToggler" class="bi bi-eye-slash"></i></span>
                  </div>

                </div>
                <div class="d-flex justify-content-between">
                  <!-- form check -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <!-- label --> <label class="form-check-label" for="flexCheckDefault">
                      Remember me
                    </label>
                  </div>
                  <div> Forgot password? <a href="forgot-password.php">Reset It</a></div>
                </div>
                <!-- btn -->
                <div class="col-12 d-grid">
                  <input type="submit" value="Sign In" class="btn btn-primary">
                  <input type="hidden" name="SignInUser">
                </div>
                <!-- link -->
                <div>Don’t have an account? <a href="signup.php"> Sign Up</a></div>
              </div>
            </form>
















          </div>
        </div>
      </div>
    </section>










  </main>




  <!-- Footer -->
  <!-- footer -->
  <footer class="footer">
    <div class="container">
      <div class="row g-4 py-4">
        <div class="col-12 col-md-12 col-lg-4">
          <h6 class="mb-4">Categories</h6>
          <div class="row">
            <div class="col-6">
              <!-- list -->
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Vegetables & Fruits</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link"> Breakfast & instant food</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link"> Bakery & Biscuits</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Atta, rice & dal</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Sauces & spreads</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Organic & gourmet</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link"> Baby care</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Cleaning essentials</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Personal care</a></li>
              </ul>
            </div>
            <div class="col-6">
              <!-- list -->
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Dairy, bread & eggs</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link"> Cold drinks & juices</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link"> Tea, coffee & drinks</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Masala, oil & more</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Chicken, meat & fish</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Paan corner</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link"> Pharma & wellness</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Home & office</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Pet care</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-8">
          <div class="row g-4">
            <div class="col-6 col-sm-6 col-md-3">
              <h6 class="mb-4">Get to know us</h6>
              <!-- list -->
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Company</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">About</a></li>
                <li class="nav-item mb-2"><a href="#1" class="nav-link">Blog</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Help Center</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Our Value</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <h6 class="mb-4">For Consumers</h6>
              <ul class="nav flex-column">
                <!-- list -->
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Payments</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Shipping</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Product Returns</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">FAQ</a></li>
                <li class="nav-item mb-2"><a href="shop-checkout.php" class="nav-link">Shop Checkout</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <h6 class="mb-4">Become a Shopper</h6>
              <ul class="nav flex-column">
                <!-- list -->
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Shopper Opportunities</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Become a Shopper</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Earnings</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Ideas & Guides</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">New Retailers</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <h6 class="mb-4">Freshcart programs</h6>
              <ul class="nav flex-column">
                <!-- list -->
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Freshcart programs</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Gift Cards</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Promos & Coupons</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Freshcart Ads</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Careers</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="border-top py-4">
        <div class="row align-items-center">
          <div class="col-lg-5 text-lg-start text-center mb-2 mb-lg-0">
            <ul class="list-inline mb-0">
              <li class="list-inline-item text-dark">Payment Partners</li>
              <li class="list-inline-item">
                <a href="#!"><img src="../assets/images/amazonpay.svg" alt=""></a>
              </li>
              <li class="list-inline-item">
                <a href="#!"><img src="../assets/images/american-express.svg" alt=""></a>
              </li>
              <li class="list-inline-item">
                <a href="#!"><img src="../assets/images/mastercard.svg" alt=""></a>
              </li>
              <li class="list-inline-item">
                <a href="#!"><img src="../assets/images/paypal.svg" alt=""></a>
              </li>
              <li class="list-inline-item">
                <a href="#!"><img src="../assets/images/visa.svg" alt=""></a>
              </li>
            </ul>
          </div>
          <div class="col-lg-7 mt-4 mt-md-0">
            <ul class="list-inline mb-0 text-lg-end text-center">
              <li class="list-inline-item mb-2 mb-md-0 text-dark">Get deliveries with FreshCart</li>
              <li class="list-inline-item ms-4">
                <a href="#!"> <img src="../assets/images/appstore-btn.svg" alt="" style="width: 140px;"></a>
              </li>
              <li class="list-inline-item">
                <a href="#!"> <img src="../assets/images/googleplay-btn.svg" alt="" style="width: 140px;"></a>
              </li>
            </ul>
          </div>
        </div>

      </div>
      <div class="border-top py-4">
        <div class="row align-items-center">
          <div class="col-md-6"><span class="small text-muted">Copyright 2023 © FreshCart eCommerce HTML Template. All
              rights reserved. Powered by <a href="https://codescandy.com/">Codescandy</a>.</span></div>
          <div class="col-md-6">
            <ul class="list-inline text-md-end mb-0 small mt-3 mt-md-0">
              <li class="list-inline-item text-muted">Follow us on</li>
              <li class="list-inline-item me-1">
                <a href="#!" class="btn btn-xs btn-social btn-icon"> <svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path
                      d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                  </svg></a>
              </li>
              <li class="list-inline-item me-1">
                <a href="#!" class="btn btn-xs btn-social btn-icon"> <svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                    <path
                      d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                  </svg></a>
              </li>
              <li class="list-inline-item">
                <a href="#!" class="btn btn-xs btn-social btn-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                    <path
                      d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                  </svg></a>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </footer>
  <!-- Javascript-->
  <!-- Libs JS -->
  <?php include "../inc/LibsJs.php" ?>



  <!-- Theme JS -->
  <script src="../assets/js/theme.min.js"></script>
  <script src="../assets/js/vendors/password.js"></script>




</body>


<!-- Mirrored from freshcart.codescandy.com/pages/signin.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 31 Mar 2023 10:10:40 GMT -->

</html>