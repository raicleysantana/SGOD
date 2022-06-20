<?php
session_start();

?>
<style>
    header .logo {
        width: 70px;
    }

    @media only screen and (max-width: 500px) {
        header .logo {
            width: 40px;
        }
    }
</style>

<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5" style="height: 50px">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand text-center justify-content-md-center" href="./" data-redirect="true">
                <!-- Logo icon -->
                <b class="logo-icon ps-2">
                    <img class="logo light-logo" src="<?= Config::$baseUrl ?>/img/logo.png" alt="logo">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!--SGODP-->
                </b>

                <!--End Logo icon -->
                <!-- Logo text -->

                <!-- dark Logo text -->
                </span>
                <!-- Logo icon -->
                <!-- <b class="logo-icon"> -->
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <!-- <img src="../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                <!-- </b> -->
                <!--End Logo icon -->
            </a>

            <a
                    class="nav-toggler waves-effect waves-light d-block d-md-none"
                    href="javascript:void(0)"
            ><i class="ti-menu ti-close"></i
                ></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div
                class="navbar-collapse collapse"
                id="navbarSupportedContent"
                data-navbarbg="skin5"
        >
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-start me-auto">
                <li class="nav-item d-none d-lg-block">
                    <a
                            class="nav-link sidebartoggler waves-effect waves-light"
                            href="javascript:void(0)"
                            data-sidebartype="mini-sidebar"
                    ><i class="mdi mdi-menu font-24"></i
                        ></a>
                </li>
                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->

            </ul>

            <ul class="navbar-nav float-end">

                <li class="nav-item dropdown">
                    <a
                            class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                    >
                        <?= $_SESSION['usu_nome']; ?>
                    </a>
                    <ul
                            class="dropdown-menu dropdown-menu-end user-dd animated"
                            aria-labelledby="navbarDropdown"
                    >
                        <a class="dropdown-item" href="javascript:void(0)"
                        >
                            <i class="mdi mdi-account me-1 ms-1"></i> Meu Perfil
                        </a>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="mdi mdi-settings me-1 ms-1"></i>
                            Configurações de conta
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= Config::$baseUrl ?>/admin/logout.php">
                            <i class="fa fa-power-off me-1 ms-1"></i>
                            Sair
                        </a>
                        <div class="dropdown-divider"></div>
                    </ul>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>

<script>
    $(function () {
        $('a.sidebartoggler').click(function () {

            var sidebartype = $("#main-wrapper").attr('data-sidebartype');


            if (sidebartype === "full") {
                $("header .logo").css({width: 40}).parent().parent().removeClass('text-center justify-content-md-center');
            } else {
                $("header .logo").css({width: 70}).parent().parent().addClass('text-center justify-content-md-center');
            }
        });
    });
</script>