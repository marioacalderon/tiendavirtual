            <?php if ($this->router->fetch_class() != 'login'): ?>
                <footer class="main-footer">
                    <div class="footer-left">
                        <a href="templateshub.net">Templateshub</a></a>
                    </div>
                    <div class="footer-right">
                    </div>
                </footer>
            <?php endif; ?>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?php echo base_url('assets/js/app.min.js') ?>"></script>

    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="<?php echo base_url('assets/js/scripts.js') ?>"></script>

    <?php if (isset($scripts)): ?>
        <!-- Template Scripts Dinamicos -->
        <?php foreach ($scripts as $script): ?>
            <script src="<?php echo base_url('assets/'.$script); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Custom JS File -->
    <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>

    <script>
        $('.delete').on("click", function(e) {
            event.preventDefault();

            var choice = confirm($(this).attr('data-confirm'));

            if (choice) {
                window.location.href = $(this).attr('href');
            }
        });
    </script>
</body>


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->

</html>