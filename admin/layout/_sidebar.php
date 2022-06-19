<?php
include_once __DIR__ . "/../../config/Componentes.php";

?>
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= Config::$baseUrl ?>/admin"
                       aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Início</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="mdi mdi-receipt"></i><span class="hide-menu">Cadastros </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?= Config::$baseUrl; ?>/admin/cadastros/alunos/index.php" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Alunos </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= Config::$baseUrl; ?>/admin/cadastros/participantes/index.php"
                               class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Participantes </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= Config::$baseUrl; ?>/admin/cadastros/turmas/index.php" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Turmas </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= Config::$baseUrl; ?>/admin/cadastros/cargos/index.php" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Cargos </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= Config::$baseUrl; ?>/admin/cadastros/tipos_ocorrencia/index.php"
                               class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Tipos de Ocorrências </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="mdi mdi-receipt"></i><span class="hide-menu">Ocorrências </span>
                    </a>

                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?= Config::$baseUrl; ?>/admin/ocorrencias/criar_ocorrencia.php"
                               class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu">Criar Ocorrência </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= Config::$baseUrl; ?>/admin/ocorrencias/criar_ocorrencia_turma.php"
                               class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu">Criar Ocorrência por turma </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= Config::$baseUrl; ?>/admin/ocorrencias/listagem.php"
                               class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu">Listagem de ocorrências</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="charts.html"
                       aria-expanded="false">
                        <i class="mdi mdi-chart-bar"></i><span class="hide-menu">Ocorrências</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="tables.html"
                       aria-expanded="false"><i class="mdi mdi-border-inside"></i><span
                                class="hide-menu">Relatórios</span></a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="mdi mdi-receipt"></i><span class="hide-menu">Configurações </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="form-basic.html" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Geral </span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<div class="page-wrapper pt-2">

    <div class="">
        <?php echo Componentes::alertas(); ?>
    </div>