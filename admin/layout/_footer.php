</div>
</div>


<script type="application/javascript"
        src="<?= Config::$baseUrl ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="application/javascript" src="<?= Config::$baseUrl ?>/assets/js/sidebarmenu.js"></script>
<script type="application/javascript"
        src="<?= Config::$baseUrl ?>/assets/vendor/jquery/jquery.validate.min.js"></script>
<script type="application/javascript"
        src="<?= Config::$baseUrl ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script type="application/javascript" src="<?= Config::$baseUrl ?>/assets/js/waves.js"></script>
<script type="application/javascript" src="<?= Config::$baseUrl ?>/assets/js/custom.min.js"></script>
<script type="application/javascript"
        src="<?= Config::$baseUrl ?>/assets/extra-libs/DataTables/datatables.min.js"></script>
<script type="application/javascript" src="<?= Config::$baseUrl ?>/assets/js/bootstrap-validation.js"></script>
<script type="application/javascript"
        src="<?= Config::$baseUrl ?>/assets/vendor/jquery-confirm/js/jquery-confirm.min.js"></script>
<script
        type="application/javascript"
        src="<?= Config::$baseUrl ?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>

<script>
    $(function () {
        $(".datatable").DataTable({
            "language": {
                "url": "<?= Config::$baseUrl ?>/assets/libs/datatables.net-bs4/pt_br.json",
                responsive: true
            },
        });
    });
</script>
</body>

</html>