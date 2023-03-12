<div class="az-footer ht-40">
  <div class="container ht-100p pd-t-0-f">
    <span>Dev2Friend &copy; 2023</span>
  </div><!-- container -->
</div><!-- az-footer -->

<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery/jquery-ui/ui/widgets/datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap/js/bootstrap.bundle.min.js"></script>
<script nomodule="" src="<?php echo base_url(); ?>assets/js/ionicons/ionicons.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery/jquery.maskedinput/jquery.maskedinput.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery/spectrum-colorpicker/spectrum.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery/jquery-simple-datetimepicker/jquery.simple-dtpicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pickerjs/picker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery/datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ion.rangeSlider.js"></script>
<script src="<?php echo base_url(); ?>assets/js/amazeui.datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery/jquery.simple-dtpicker.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery/jquery-steps/jquery.steps.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/picker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pickerjs/picker.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/azia.js"></script>

<script>
    $(function () {
        'use strict'

        new PerfectScrollbar('#azContactList', {
            suppressScrollX: true
        });

        new PerfectScrollbar('.az-contact-info-body', {
            suppressScrollX: true
        });
        
        new PerfectScrollbar('#azInvoiceList', {
          suppressScrollX: true
        });

        $('.az-contact-item').on('click touch', function () {
            $(this).addClass('selected');
            $(this).siblings().removeClass('selected');

            $('body').addClass('az-content-body-show');
        });
	
	$('#azInvoiceList .media').on('click', function(e){
          $(this).addClass('selected');
          $(this).siblings().removeClass('selected');

          $('body').addClass('az-content-body-show');
        });

      /** AREA CHART **/
      var ctx = document.getElementById('chartArea').getContext('2d');

      var gradient = ctx.createLinearGradient(0, 240, 0, 0);
      gradient.addColorStop(0, 'rgba(0,123,255,0)');
      gradient.addColorStop(1, 'rgba(0,123,255,.3)');

      new Chart(ctx, {
          type: 'line',
          data: {
          labels: ['Feb 1', 'Feb 2', 'Feb 3', 'Feb 4', 'Feb 5', 'Feb 6', 'Feb 7', 'Feb 8', 'Feb 9', 'Feb 10'],
          datasets: [{
              data: [12, 15, 18, 40, 35, 38, 32, 20, 25],
              borderColor: '#007bff',
              borderWidth: 1,
              backgroundColor: gradient
          }]
          },
          options: {
          maintainAspectRatio: false,
          legend: {
              display: false,
              labels: {
                  display: false
              }
          },
          scales: {
              yAxes: [{
              display: false,
              ticks: {
                  beginAtZero:true,
                  fontSize: 10,
                  max: 80
              }
              }],
              xAxes: [{
              ticks: {
                  beginAtZero:true,
                  fontSize: 11,
                  fontFamily: 'Arial'
              }
              }]
          }
          }
      });
    });
</script>
<script>
      // Additional code for adding placeholder in search box of select2
      (function($) {
        var Defaults = $.fn.select2.amd.require('select2/defaults');

        $.extend(Defaults.defaults, {
          searchInputPlaceholder: ''
        });

        var SearchDropdown = $.fn.select2.amd.require('select2/dropdown/search');

        var _renderSearchDropdown = SearchDropdown.prototype.render;

        SearchDropdown.prototype.render = function(decorated) {

          // invoke parent method
          var $rendered = _renderSearchDropdown.apply(this, Array.prototype.slice.apply(arguments));

          this.$search.attr('placeholder', this.options.get('searchInputPlaceholder'));

          return $rendered;
        };

      })(window.jQuery);
    </script>

<script>
      $(function(){
        // 'use strict'

        // Toggle Switches
        // $('.az-toggle').on('click', function(){
        //   $(this).toggleClass('on');
        // })

        // Input Masks
        // $('#dateMask').mask('99/99/9999');
        // $('#phoneMask').mask('(999) 999-9999');
        // $('#phoneExtMask').mask('(999) 999-9999? ext 99999');
        // $('#ssnMask').mask('999-99-9999');

        // Color picker
        // $('#colorpicker').spectrum({
        //   color: '#17A2B8'
        // });

        // $('#showAlpha').spectrum({
        //   color: 'rgba(23,162,184,0.5)',
        //   showAlpha: true
        // });

        // $('#showPaletteOnly').spectrum({
        //     showPaletteOnly: true,
        //     showPalette:true,
        //     color: '#DC3545',
        //     palette: [
        //         ['#1D2939', '#fff', '#0866C6','#23BF08', '#F49917'],
        //         ['#DC3545', '#17A2B8', '#6610F2', '#fa1e81', '#72e7a6']
        //     ]
        // });

        // Datepicker
        $('.fc-datepicker').datepicker({
          showOtherMonths: true,
          selectOtherMonths: true
        });

        $('#datepickerNoOfMonths').datepicker({
          showOtherMonths: true,
          selectOtherMonths: true,
          numberOfMonths: 2
        });

        // AmazeUI Datetimepicker
        $('#datetimepicker').datetimepicker({
          format: 'yyyy-mm-dd hh:ii',
          autoclose: true
        });

        // jQuery Simple DateTimePicker
        // $('#datetimepicker2').appendDtpicker({
        //   closeOnSelected: true,
        //   onInit: function(handler) {
        //     var picker = handler.getPicker();
        //     $(picker).addClass('az-datetimepicker');
        //   }
        // });

        $(document).ready(function(){
          $('.select2').select2({
            placeholder: 'Choose one',
            searchInputPlaceholder: 'Search',
            dropdownParent: $('#addtoministrymodal')
          });

          // $('.select2-no-search').select2({
          //   minimumResultsForSearch: Infinity,
          //   placeholder: 'Choose one'
          // });
        });

      });
    </script>
</body>
</html>
