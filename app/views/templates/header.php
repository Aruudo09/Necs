<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/styles.css" />
    <title>Necs</title>
</head>

<body>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
      <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 230px;" id="sidebar-wrapper">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
              <span class="fs-4">Necs</span>
            </a>
              <hr>
                  <ul class="nav nav-pills flex-column mb-auto" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a href="<?php echo BASEURL; ?>/home" class="nav-link text-white active">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                        Home
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo BASEURL; ?>/barang" class="nav-link text-white" id="menuBarang">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                        Data Barang
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo BASEURL; ?>/barang_masuk" class="nav-link text-white" id="menuBarang">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                        Barang Masuk
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo BASEURL; ?>/barang_keluar" class="nav-link text-white" id="menuBarang">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                        Barang Keluar
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo BASEURL; ?>/purchased_order" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                        Purchased Order
                      </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link text-white" data-bs-toggle="pill" data-bs-target="#supplier" role="tab" aria-controls="supplier" aria-selected="false">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                        Supplier
                      </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link text-white" data-bs-toggle="pill" data-bs-target="#account" role="tab" aria-controls="account" aria-selected="false">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                        Account
                      </a>
                    </li>
                  </ul>
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
                <li><a class="dropdown-item" href="#">Sign out</a></li>
              </ul>
          </div>
      </div>
        <!-- /#sidebar-wrapper -->

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
