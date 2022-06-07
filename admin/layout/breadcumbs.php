<?php


function breadcumbs($titulo = "false")
{

    $html = <<< HTML
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Tables</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        $titulo
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
    HTML;

    echo $html;
}