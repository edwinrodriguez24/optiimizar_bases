<?php
include_once '../Config/ConexionRayo.php';

$ConexionRayo = new ConexionRayo();

$gestionHora = $ConexionRayo->cantidadGestionesHora();
$empleadosGestion = $ConexionRayo->empleadosXGestiones();
$GestionHoraLinea = $ConexionRayo->gestionesHoraLinea();


print_r($GestionHoraLinea);
exit;
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">

        <title>Dashboard - Rayo CR</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="/optiimizar_bases/Public/assets/img/favicon.png" rel="icon">
        <link href="/optiimizar_bases/Public/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="/optiimizar_bases/Public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/assets/vendor/simple-datatables/style.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/fontawesome-free-6.1.1-web/css/fontawesome.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/fontawesome-free-6.1.1-web/css/solid.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/sweetalert2-11.4.19/sweetalert2.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/select2-4.1.0-rc.0/css/select2.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="/optiimizar_bases/Public/assets/css/style.css" rel="stylesheet">

        <!-- =======================================================
        * Template Name: NiceAdmin - v2.2.2
        * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
    </head>

    <body>

        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
                <a href="/optiimizar_bases/Admin/" class="logo d-flex align-items-center">
                    <img src="/optiimizar_bases/Public/assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">Rayo CR</span>
                </a>
            </div><!-- End Logo -->
            <i class="bi bi-list toggle-sidebar-btn"></i>

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link nav-icon search-bar-toggle " href="#">
                            <i class="bi bi-search"></i>
                        </a>
                    </li><!-- End Search Icon-->

                    <li class="nav-item dropdown">

                        <a class="nav-link nav-icon d-none" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="badge bg-primary badge-number">4</span>
                        </a><!-- End Notification Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <li class="dropdown-header">
                                You have 4 new notifications
                                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div>
                                    <h4>Lorem Ipsum</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>30 min. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-x-circle text-danger"></i>
                                <div>
                                    <h4>Atque rerum nesciunt</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>1 hr. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <div>
                                    <h4>Sit rerum fuga</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>2 hrs. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-info-circle text-primary"></i>
                                <div>
                                    <h4>Dicta reprehenderit</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-footer">
                                <a href="#">Show all notifications</a>
                            </li>

                        </ul><!-- End Notification Dropdown Items -->

                    </li><!-- End Notification Nav -->

                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img src="/optiimizar_bases/Public/assets/img/messages-2.jpg" alt="Profile" class="rounded-circle">
                            <span class="d-none d-md-block dropdown-toggle ps-2">M. Viviana</span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>Viviana Mendoza</h6>
                                <span>Analista de Datos</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#" onclick="alert('Llamame al 3138074600 :-*')">
                                    <i class="bi bi-question-circle"></i>
                                    <span>Necesitas Ayuda?</span>
                                </a>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header><!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="/optiimizar_bases/Admin">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-heading">Accesos</li>

                <li class="nav-item">
                    <a class="nav-link collapsed redirectjs" href="/optiimizar_bases/Admin/ProcesarArchivos.php">
                        <i class="bi bi-person"></i>
                        <span>Procesar Archivos</span>
                    </a>
                </li><!-- End Profile Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed redirectjs" href="/optiimizar_bases/Gestion/Nuevo.php">
                        <i class="bi bi-person"></i>
                        <span>Nueva Gestión</span>
                    </a>
                </li><!-- End Profile Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed redirectjs" href="/optiimizar_bases/Admin/QueryBasic.php">
                        <i class="bi bi-question-circle"></i>
                        <span>Consulta Basica</span>
                    </a>
                </li><!-- End F.A.Q Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed redirectjs" href="/optiimizar_bases/Admin/Pivote.php">
                        <i class="bi bi-envelope"></i>
                        <span>Tablas Pivot</span>
                    </a>
                </li><!-- End Contact Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/adminer" target="_blank">
                        <i class="bi bi-card-list"></i>
                        <span>Adminer SQL</span>
                    </a>
                </li><!-- End Register Page Nav -->

            </ul>

        </aside><!-- End Sidebar-->

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Bienvenida, Viviana</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/optiimizar_bases/Admin/">Inicio</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section id="seccionPrincipal" class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-8">
                        <div class="row">

                            <!-- Sales Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card sales-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Empleados <span>| Dia</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cart"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><?= $empleadosGestion[0]['agentes_gestion'] ?></h6>
                                                <span class="text-success small pt-1 fw-bold"><?= $empleadosGestion[0]['agentes_total'] ?></span> <span class="text-muted small pt-2 ps-1">en total</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Sales Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card revenue-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Gestiones <span>| Dia</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><?= $empleadosGestion[0]['gestiones'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Revenue Card -->

                            <!-- Reports -->
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                        <h5 class="card-title">Detalle Gestiones <span>/Dia</span></h5>

                                        <!-- Line Chart -->
                                        <div id="reportsChart"></div>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                                new ApexCharts(document.querySelector("#reportsChart"), {
                                                    series: <?= json_encode($GestionHoraLinea) ?>,
                                                    chart: {
                                                        height: 350,
                                                        type: 'area',
                                                        toolbar: {
                                                            show: false
                                                        },
                                                    },
                                                    markers: {
                                                        size: 4
                                                    },
                                                    colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                    fill: {
                                                        type: "gradient",
                                                        gradient: {
                                                            shadeIntensity: 1,
                                                            opacityFrom: 0.3,
                                                            opacityTo: 0.4,
                                                            stops: [0, 90, 100]
                                                        }
                                                    },
                                                    dataLabels: {
                                                        enabled: false
                                                    },
                                                    stroke: {
                                                        curve: 'smooth',
                                                        width: 2
                                                    },
                                                    xaxis: {
                                                        type: 'datetime',
                                                        categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                                    },
                                                    tooltip: {
                                                        x: {
                                                            format: 'dd/MM/yy HH:mm'
                                                        },
                                                    }
                                                }).render();
                                            });
                                        </script>
                                        <!-- End Line Chart -->

                                    </div>

                                </div>
                            </div><!-- End Reports -->

                        </div>
                    </div><!-- End Left side columns -->

                    <!-- Right side columns -->
                    <div class="col-lg-4">

                        <!-- Recent Activity -->
                        <div class="card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Gestiones del Dia <span>| <?= date('Y-m-d') ?></span></h5>

                                <div class="activity">
                                    <?php
                                    # Colores
                                    $colores = [
                                        'text-success',
                                        'text-danger',
                                        'text-primary',
                                        'text-info',
                                        'text-warning',
                                        'text-muted',
                                    ];

                                    # Rango de Horas
                                    $horaIni = 6;
                                    $horaFin = date('G');
                                    $horaFin = 13;
                                    while ($horaIni <= $horaFin):
                                        $gestion = (isset($gestionHora[$horaFin])) ? $gestionHora[$horaFin] : 0;
                                        ?>
                                        <div class="activity-item d-flex">
                                            <div class="activite-label"><?= $horaFin ?> h</div>
                                            <i class='bi bi-circle-fill activity-badge <?= $colores[rand(0, count($colores))] ?> align-self-start'></i>
                                            <div class="activity-content">
                                                Se han realizado <a href="#" class="fw-bold text-dark"><?= $gestion ?></a> gestiones
                                            </div>
                                        </div><!-- End activity item-->
                                    <?php
                                        $horaFin--;
                                    endwhile;
                                    ?>

                                </div>

                            </div>
                        </div><!-- End Recent Activity -->

                        <!-- Budget Report -->
                        <div class="card">

                            <div class="card-body pb-0">
                                <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                                <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                            legend: {
                                                data: ['Allocated Budget', 'Actual Spending']
                                            },
                                            radar: {
                                                // shape: 'circle',
                                                indicator: [{
                                                        name: 'Sales',
                                                        max: 6500
                                                    },
                                                    {
                                                        name: 'Administration',
                                                        max: 16000
                                                    },
                                                    {
                                                        name: 'Information Technology',
                                                        max: 30000
                                                    },
                                                    {
                                                        name: 'Customer Support',
                                                        max: 38000
                                                    },
                                                    {
                                                        name: 'Development',
                                                        max: 52000
                                                    },
                                                    {
                                                        name: 'Marketing',
                                                        max: 25000
                                                    }
                                                ]
                                            },
                                            series: [{
                                                    name: 'Budget vs spending',
                                                    type: 'radar',
                                                    data: [{
                                                            value: [4200, 3000, 20000, 35000, 50000, 18000],
                                                            name: 'Allocated Budget'
                                                        },
                                                        {
                                                            value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                            name: 'Actual Spending'
                                                        }
                                                    ]
                                                }]
                                        });
                                    });
                                </script>

                            </div>
                        </div><!-- End Budget Report -->

                    </div><!-- End Right side columns -->

                </div>
            </section>

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer">
            <div class="copyright">
                &copy; Copyright <strong><span>Rayo CR</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </footer><!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="/optiimizar_bases/Public/lib/jquery-3.6/jquery-3.6.0.min.js"></script>
        <script src="/optiimizar_bases/Public/lib/sweetalert2-11.4.19/sweetalert2.all.js"></script>
        <script src="/optiimizar_bases/Public/lib/select2-4.1.0-rc.0/js/select2.js"></script>
        <script src="/optiimizar_bases/Public/assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="/optiimizar_bases/Public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/optiimizar_bases/Public/assets/vendor/chart.js/chart.min.js"></script>
        <script src="/optiimizar_bases/Public/assets/vendor/echarts/echarts.min.js"></script>
        <script src="/optiimizar_bases/Public/assets/vendor/quill/quill.min.js"></script>
        <script src="/optiimizar_bases/Public/assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="/optiimizar_bases/Public/assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="/optiimizar_bases/Public/assets/vendor/php-email-form/validate.js"></script>
        <script src="/optiimizar_bases/Public/lib/sweetalert2-11.4.19/sweetalert2.all.js"></script>

        <!-- Template Main JS File -->
        <script src="/optiimizar_bases/Public/assets/js/main.js"></script>
        <script src="/optiimizar_bases/Public/js/script.js"></script>

    </body>

</html>