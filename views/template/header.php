<?php 
	const BASE_URL = "http://localhost/digiturno/";
	require_once('../../models/sessiones.php');
 ?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= BASE_URL ?>assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Sistema de Turnos</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>assets/img/favicon/favicon.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/demo.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/sweetalert2.min.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/datatables.min.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/datatable_responsive.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/libs/select2/select2.css " />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />


    <script src="<?= BASE_URL ?>assets/vendor/js/helpers.js"></script>

    <script src="<?= BASE_URL ?>assets/js/config.js"></script>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <!-- <span class="app-brand-logo demo"> -->
                <img src="../../assets/img/favicon/logo.png" class="d-block rounded mb-2" height="50" width="150">
              <!-- </span> -->
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="<?= BASE_URL ?>views/inicio/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Inicio</div>
              </a>
            </li>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Administracion</span>
            </li>
            <li class="menu-item">
                  <a href="<?= BASE_URL ?>views/clientes/" class="menu-link">
                  <i class='menu-icon tf-icons bx bxs-user'></i>
                    <div data-i18n="Clientes">Clientes</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= BASE_URL ?>views/usuarios/" class="menu-link">
                  <i class='menu-icon tf-icons bx bxs-user-rectangle' ></i>
                    <div data-i18n="Usuarios">Usuarios</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= BASE_URL ?>views/servicios/" class="menu-link">
                  <i class='menu-icon tf-icons bx bxs-category-alt' ></i>
                    <div data-i18n="Servicios">Servicios</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= BASE_URL ?>views/modulos/" class="menu-link">
                  <i class='menu-icon tf-icons bx bxs-cabinet' ></i>
                    <div data-i18n="Modulos">Modulos</div>
                  </a>
                </li>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Gestion Turnos</span>
            </li>
            <li class="menu-item">
                  <a href="<?= BASE_URL ?>views/generarturno/" class="menu-link">
                  <i class='menu-icon tf-icons bx bx-time-five'></i>
                    <div data-i18n="generar_turno">Generar Turno</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?= BASE_URL ?>views/gestionarturno/" class="menu-link">
                  <i class='menu-icon tf-icons bx bx-volume-full'></i>
                    <div data-i18n="atender_turno">Atender Turnos</div>
                  </a>
                </li>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Reportes</span>
            </li>
            <li class="menu-item">
              <a href="<?= BASE_URL ?>views/reportes/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt"></i>
                <div data-i18n="Reportes">Reportes</div>
              </a>
            </li>
          </ul>
        </aside>

        <div class="layout-page">
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                </div>
              </div>
              <p style="padding-left: 78%;padding-top: 22px;"><?php echo $_SESSION['nombre']; ?></p>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?= BASE_URL ?>assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?= BASE_URL ?>assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo $_SESSION['nombre']; ?></span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../../index.php?cerrar_sesion=true" onclick="Logout()">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <div class="content-wrapper">