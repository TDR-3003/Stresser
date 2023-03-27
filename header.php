<?php
include 'includes/configuration.php'; 
include 'includes/extra.php';
$user -> last($odb);
if (($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {exit("NOT ALLOWED");}

  if (!isset($_SERVER['HTTP_REFERER'])){
    header('Location: ../404.php');
    die;
  }


  if (!($user -> LoggedIn()) || !($user -> notBanned($odb))){
    die();
  }
   
  $username = $_SESSION['username'];

  if(empty($username)){
    die();
  }
  
  if ($user -> safeString($username)){
    $errors = error('What are you trying?'); 
    session_start();
    $_SESSION['errors'] = $errors;
    header('Location: ../home.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title><?php echo $info["nom"]; ?> | <?php echo $page; ?></title>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?php echo $info["nom"]; ?> is a premium IP Stresser/Booter that features API access, Browser emulation / CAPTCHA bypass for Layer 7 & Unique Layer 4 DDoS attack methods!" name="description" />
        <meta content="top stresser, stressthem, stress them, stress denial of service, dos, stresser app,booter,ip stresser, stresser, booter, ddos tool, ddos attack, ddos attack online, layer7 ddos, layer4 ddos, api, api access, network stresser, network booter, msctf, best Booter, best stresser, strongest stresser, powerful booter, ddoser, ddos, gbooter, top booter, ipstress, booter, stresser, network stresser, network booter, #Booter, STORM, captcha bypass, drdos,ssyn, dns amplification" name="keywords">
        <meta content="<?php echo $info["nom"]; ?>" name="author" />
        <meta content="<?php echo $info["url"]; ?>" name="application-url">
        <meta content="<?php echo $info["nom"]; ?>" name="application-name">
        <meta content="index, follow" name="robots">
        <meta property="og:title" content="The most advanced IP Booter on the market.">
        <meta property="og:description" content="<?php echo $info["nom"]; ?> is a premium IP Stresser/Booter that has browser emulation technology with CAPTCHA bypass for Layer 7 and unique Layer 4 DDoS methods. We provide API access and are always online to stress them all.">
        <meta property="og:image" content="<?php echo '../'.$info["icon"].'' ?>">
        <meta property="og:url" content="<?php echo $info["nom"]; ?>">
        <meta property="og:type" content="website">
        <link rel="icon" href="<?php echo '../'.$info["icon"].'' ?>" />
        <link rel="stylesheet" type="text/css" href="/assets/libs/toastr/build/toastr.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/loader.css">
        <link href="/assets/css/bootstrap-dark.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/app-dark.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>  
<body>
<div class="loader">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <section class="main">
                <div id="layout-wrapper">
         <header id="page-topbar">
            <div class="navbar-header">
               <div class="d-flex">
                  <div class="navbar-brand-box">
                     <a href="/home" class="logo logo-light" title="home">
                     <span class="logo-sm">
                     <img src="<?php echo '../'.htmlspecialchars($info["icon"]).'' ?>" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                     <img src="<?php echo '../'.htmlspecialchars($info["icon"]).'' ?>" alt="" class="header-brand-img">
                     </span>
                     </a>
                  </div>
                  <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content" title="settings">
                  <i class="fa fa-fw fa-bars"></i>
                  </button></div>
                  <div class="d-flex">

                   




 
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<a data-bs-toggle="modal" data-bs-target="#ava"><img class="img-thumbnail rounded-circle avatar-sm" src="assets/images/

<?php
                      if($userInf['avatar'] == "0"){
                      echo "favicon.ico";
                      }else{
                      echo htmlspecialchars($userInf['avatar']);
                      }
                      ?>" alt="Header Avatar"><a/> 
                    <span class="d-none d-xl-inline-block ms-1" key="t-<?php echo $_SESSION['username']; ?>"><?php echo $_SESSION['username']; ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" style="">
                    <!-- item-->
                   

                    <a class="dropdown-item"><span class="badge bg-success float-end"><?php echo $userInf['points']; ?></span><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-balance">Balance </span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="profile"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                    <a class="dropdown-item text-danger" href="logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                </div>
            </div>
               </div>
            </div>
         </header>

         <div class="topnav">
            <div class="container-fluid">
               <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                  <div class="collapse navbar-collapse" id="topnav-menu-content" style="justify-content: center;">
                     <ul class="navbar-nav">
                        <li class="nav-item">
                           <a class="nav-link" href="/home" id="topnav-home">
                              <i class="bx bx-home-circle me-2"></i><span key="t-home">Home</span>
                           </a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="/hub" id="topnav-hub">
                              <i class="bx bxs-zap me-2"></i><span key="t-hub">Attack Hub</span>
                           </a>
                        </li>

                        

                        <li class="nav-item">
                           <a class="nav-link" href="/api" id="topnav-api">
                              <i class="bx bxs-share-alt me-2"></i><span key="t-api">API Manager</span>
                           </a>
                        </li>
  <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-shop" role="button">
                           <i class="bx bxs-cart-alt me-2"></i><span key="t-support">Shop</span> <div class="arrow-down"></div>
                           </a>
                           <div class="dropdown-menu" aria-labelledby="topnav-shop">
                              <a href="/shop" class="dropdown-item" key="t-shop">Shop</a>
                              <a href="/addons" class="dropdown-item" key="t-addons">Addons</a>
                              <a href="/deposit" class="dropdown-item" key="t-deposit">Deposit</a>

                           </div>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-support" role="button">
                           <i class="fas fa-question-circle me-2"></i><span key="t-support">Support</span> <div class="arrow-down"></div>
                           </a>
                           <div class="dropdown-menu" aria-labelledby="topnav-support">
                              <a href="/message" class="dropdown-item" key="t-view">View</a>
                              <a href="/faq" class="dropdown-item" key="t-faq">FAQ</a>
                              		<?php if ($user -> isAdmin($odb)) { ?>
		<a href="Admin/indexe" class="dropdown-item" key="t-faq">Panel Admin</a>
		<?php } ?>
                           </div>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>  
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
            <h5 class="m-0 me-2">Settings</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch">
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>
    
            <div class="mb-2">
                <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail"alt="">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css" checked>
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>
    
        


          
          

        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<div class="rightbar-overlay"></div> 
<!-- Right bar overlay-->
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>
<!-- Required datatable js -->
<script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/libs/jszip/jszip.min.js"></script>
<script src="/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="/assets/js/pages/datatables.init.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/query.min.js"></script>
<script src="/assets/js/toastr.js"></script>
<script src="/assets/js/index.js"></script>
<script src="/assets/js/session-timeout.init.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>
<script src="/assets/libs/toastr/build/toastr.min.js"></script>

<?php if(array_key_exists('errors', $_SESSION)): ?>
<script type="text/javascript">
toastr["error"]("<?php echo $_SESSION['errors']; ?>")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>
<?php unset($_SESSION['errors']); endif; ?>

<?php if(array_key_exists('actived', $_SESSION)): ?>
<script type="text/javascript">
toastr["success"]("<?php echo $_SESSION['actived']; ?>")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>
<?php unset($_SESSION['actived']); endif; ?>