<?php

?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Alunos</h4>

            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="alunos/index.php">Alunos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cadastrar alunos
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <form class="form-horizontal">
                <div class="form-group mt-3">
                    <label>Nome</label>
                    <input
                            type="text"
                            class="form-control date-inputmask"
                            id="date-mask"
                            placeholder="Entre com seu nome"
                    />
                </div>
                <div class="form-group">
                    <label>
                        Contato <small class="text-muted">(999) 999-9999</small>
                    </label>
                    <input
                            type="text"
                            class="form-control phone-inputmask"
                            id="phone-mask"
                            placeholder="Entre com o número de celular"
                    />
                </div>
                <div class="form-group">
                    <label>
                        CPF <span class="text-muted">999.999.999-99</span>
                    </label>
                    <input
                            type="text"
                            class="form-control international-inputmask"
                            id="international-mask"
                            placeholder="Entre com o CPF"
                    />
                </div>
                <div class="form-group">
                    <label>
                        Email
                    </label>
                    <input
                            type="text"
                            class="form-control xphone-inputmask"
                            id="xphone-mask"
                            placeholder="Entre com o E-Mail"
                    />
                </div>
                <div class="form-group">
                    <label
                    >Nome do Responsavel
                    </label>
                    <input
                            type="text"
                            class="form-control purchase-inputmask"
                            id="purchase-mask"
                            placeholder="Entre com o nome do responsavel"
                    />
                </div>

                <div class="border-top d-flex flex-row justify-content-between pt-4">
                    <a href="alunos/index.php">
                        <button type="button" class="btn btn-secondary">
                            Voltar
                        </button>
                    </a>
                    <button type="button" class="btn btn-primary">
                        Salvar
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>


