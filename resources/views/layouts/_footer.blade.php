<footer class="main-footer text-sm">
    @superAdmin
    <div class="float-right d-none d-sm-block">
        <span class="footer-link mx-2">
            <a href="https://www.php.net/">
                <b>PHP</b>
            </a> {{ PHP_VERSION }}
        </span>
        <span class="footer-link-separator"></span>
        <span class="footer-link mx-2">
            <a href="https://laravel.com/">
                <b>Laravel</b>
            </a> {{ app()->version() }}
        </span>
        <span class="footer-link-separator"></span>
        <span class="footer-link mx-2">
            <a href="https://adminlte.io">
                <b>AdminLTE</b>
            </a> 3.2.0
        </span>
    </div>
    @endsuperAdmin

    <strong>
        &copy; 2021-{{ date('Y') }}
        {{-- <a href="mailto:AE-PL-Swiebodzin-IT@adient.com">Adient</a> --}}
    </strong>
</footer>
