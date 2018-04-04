     <!-- jQuery CDN -->
        <script src="assets/js/admin/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="assets/js/admin/bootstrap337.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="assets/js/admin/jquery.mCustomScrollbar.concat.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#dismiss, .overlay').on('click', function () {
                    $('#sidebar').removeClass('active');
                    $('.overlay').fadeOut();
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').addClass('active');
                    $('.overlay').fadeIn();
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>