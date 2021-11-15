<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>/DataTables/datatables.css" />
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/styles.css" />
    <title>Necs</title>
</head>

<body>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
      <div class="d-flex  flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 240px;" id="sidebar-wrapper">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
              <span class="fs-4">Necs</span>
            </a>
              <hr>
                  <ul>
                    <li>
                      <a href="<?php echo BASEURL; ?>/home">
                        Home
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo BASEURL; ?>/barang">
                        Data Barang
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo BASEURL; ?>/barang_masuk">
                        Barang Masuk
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo BASEURL; ?>/barang_keluar">
                        Barang Keluar
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo BASEURL; ?>/purchased_order">
                        Purchased Order
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo BASEURL; ?>/supplier">
                        Supplier
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo BASEURL; ?>/account">
                        Account
                      </a>
                    </li>
                  </ul>
                  <script type="text/javascript">
                    const currentLocation = location.href;
                    const menuItem = document.querySelectorAll('a');
                    const menuLength = menuItem.length
                    for (let i = 0; i<menuLength; i++){
                      if(menuItem[i].href == currentLocation){
                        menuItem[i].className = "active"
                      }
                    }
                  </script>
              <hr>
            <div class="dropdown">
              <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <strong>User</strong>
              </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?php echo BASEURL; ?>/login/logout">Sign out</a></li>
              </ul>
          </div>
      </div>
        <!-- /#sidebar-wrapper -->

        <div id="page-content-wrapper">

          <!--NAVBAR-->
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a href="<?php echo BASEURL; ?>/home">Home</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo BASEURL; ?>/barang">Data Barang</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo BASEURL; ?>/purchased_order">Purchased Order</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo BASEURL; ?>/barang_masuk">Barang Masuk</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo BASEURL; ?>/barang_keluar">Barang Keluar</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo BASEURL; ?>/supplier">Supplier</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown link
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>

            <nav class="navbar stciky-top navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                
            </nav>
