  <!-- footer -->
            <footer class="footer"> © 2018 All rights reserved.<a href="#">Membership</a></footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
<link href="<?php echo $this->config->base_url(); ?>main/css/lib/html5-editor/bootstrap-wysihtml5.css" rel="stylesheet">
<script src="<?php echo $this->config->base_url(); ?>main/js/lib/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?php echo $this->config->base_url(); ?>main/js/lib/html5-editor/bootstrap-wysihtml5.js"></script>
<script src="<?php echo $this->config->base_url(); ?>main/js/lib/html5-editor/wysihtml5-init.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/bootstrap/js/bootstrap.min.js"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo $this->config->base_url(); ?>main/js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo $this->config->base_url(); ?>main/js/sidebarmenu.js"></script><script>
jQuery(document).ready(function(){
setTimeout(function(){ 
jQuery("li>a.has-arrow").removeClass("active"); 
jQuery(".sub_menus a").removeClass("active");
}, 1000);

});
</script>


    <!--stickey kit -->
    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->


    <!-- Amchart -->
     <script src="<?php echo $this->config->base_url(); ?>main/js/lib/morris-chart/raphael-min.js"></script>
    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/morris-chart/morris.js"></script>
    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/morris-chart/dashboard1-init.js"></script>


	<script src="<?php echo $this->config->base_url(); ?>main/js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/calendar-2/pignose.init.js"></script>

    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?php echo $this->config->base_url(); ?>main/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="<?php echo $this->config->base_url(); ?>main/js/scripts.js"></script>
    <!-- scripit init-->

    <script src="<?php echo $this->config->base_url(); ?>main/js/custom.min.js"></script>
 
</body>

</html>