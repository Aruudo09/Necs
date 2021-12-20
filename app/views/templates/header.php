<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>/fontawesome-6.0.0-web/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>/select2-4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>/DataTables/datatables.css" />
    <title>BMC</title>
</head>

<body>

          <!--NAVBAR-->
          <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
              <div class="container-fluid">
                <a class="navbar-brand" href="#">BMC</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo BASEURL; ?>/home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Barang
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>/barang/1/">Data Barang</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>/barang_masuk/1/">Barang Masuk</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>/barang_keluar/1/">Barang Keluar</a></li>
                      </ul>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pengadaan Barang
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>/surat_request/1/">Surat Request</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>/purchased_requisition/1/">Purchase Requisition</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>/purchased_order/1/">Purchase Order</a></li>
                      </ul>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo BASEURL; ?>/supplier/1/">Supplier</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        User
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>/account">Account</a></li>
                        <li><a class="dropdown-item" href="#"><?php echo $_SESSION['login']['USERNAME'] ?></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>/login/logout">Sign out</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>

            <script type="text/javascript">
              const currentLocation = location.href;
              const menuItem = document.querySelectorAll('a');
              const menuLength = menuItem.length;
              for (let i = 0; i<menuLength; i++){
                if(menuItem[i].href == currentLocation ){
                  menuItem[i].classList.add('active');
                }
              }
            </script>
