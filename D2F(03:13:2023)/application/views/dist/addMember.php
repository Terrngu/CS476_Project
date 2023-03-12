<?php $this->load->view('dist/header'); ?>

<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        <div class="az-content-left az-content-left-contacts">

            <div class="az-content-breadcrumb lh-1 mg-b-10">
                <span>Main Menu</span>
                <span>Members</span>
                <span>Add Member</span>
            </div> <!-- az-content-breadcrumb -->

            <h2 class="az-content-title tx-24 mg-b-30">Members</h2>

            <nav class="nav az-nav-line az-nav-line-chat">
                <a href="<?php echo base_url(); ?>Members" class="nav-link active">All Members</a>
                <a href="<?php echo base_url(); ?>Ministries" class="nav-link">Ministries</a>
            </nav> <!-- nav az-nav-line -->

            <div id="azContactList" class="az-contacts-list">


                <!-- php code to print the information of the church members -->
                <?php
                $newLetter = ($members[0]->LAST_NAME)[0];
                $previousLetter = "";

                foreach ($members as $member):

                    if ($previousLetter != ($member->LAST_NAME)[0]) {
                        $newLetter = ($member->LAST_NAME)[0];
                        $previousLetter = $newLetter;
                        echo '<div class="az-contact-label">' . $newLetter . '</div>';
                    }
                    ?>
                    <div class="az-contact-item" onclick="location.href = '<?php echo base_url(); ?>Members/View/<?php echo $member->MEMBER_ID ?>'">
                        <div class="az-avatar bg-gray-700 online">
                            <?php echo $newLetter . ($member->FIRST_NAME)[0]; ?>
                        </div> <!-- az-avatar -->
                        <div class="az-contact-body">
                            <h6><?php echo $member->LAST_NAME . ', ' . $member->FIRST_NAME ?></h6>
                            <span class="phone"><?php echo $member->CONTACT_NUMBER; ?></span>
                        </div><!-- az-contact-body -->
                        <a href="" class="az-contact-star active"><i class="typcn typcn-star"></i></a>
                    </div><!-- az-contact-item -->

                <?php endforeach; ?>
                <!-- end of printing --> 
            </div><!-- az-contacts-list -->

        </div><!-- az-content-left -->


        <div class="az-content-body pd-lg-l-40 d-flex flex-column">

            <h2 class="az-content-title">Add Member</h2>

            <!-- START OF THE INPUTS -->

            <!-- FORM FOR INPUTS -->
            <form method="POST" action="<?php echo base_url(); ?>Members/addMember" data-parsley-validate>

                <!-- Start of inputs -->
                <div class="az-content-label mg-b-5">Name <span class="tx-danger">*</span></div>

                <!-- Last Name and First Name -->
                <div class="row row-sm">
                    <div class="col-lg">
                        <input class="form-control" placeholder="Last Name" type="text" name="last_name" required>
                    </div><!-- col -->
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input class="form-control" placeholder="First Name" type="text" name="first_name" required>
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Contact Number -->
                <div class="az-content-label mg-b-5">Contact Number</div>

                <div class="row row-sm wd-400">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input id="phoneMask" class="form-control" placeholder="(000) 000-0000" type="text" name="contactNum">
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Email Address -->
                <div class="az-content-label mg-b-5">Email Address</div>

                <div class="row row-sm wd-400">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input class="form-control" placeholder="Email Address" type="email"  name="emailAdd">
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Current Address -->
                <div class="az-content-label mg-b-5">Current Address</div>

                <div class="row row-sm mg-t-20">
                    <div class="col-lg">
                        <textarea name ="address" rows="3" class="form-control" placeholder="Current Address"></textarea>
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Gender -->
                <div class="az-content-label mg-b-5">Gender <span class="tx-danger">*</span></div>
                <div class="row row-sm mg-t-20 wd-300">
                    <div id="genderWrapper" class="parsley-select col-lg">
                        <select name="gender" class="form-control select2-no-search" data-parsley-class-handler="#genderWrapper" data-parsley-errors-container="#genderErrorContainer" required>
                            <option label="Choose one"></option>
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                        <div id="genderErrorContainer"></div>
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Network -->
                <div class="az-content-label mg-b-5">Network <span class="tx-danger">*</span></div>
                <div class="row row-sm mg-t-20 wd-450">
                    <div id="networkWrapper" class="parsley-select col-lg">
                        <select name="network" class="form-control select2-no-search" data-parsley-class-handler="#networkWrapper" data-parsley-errors-container="#networkErrorContainer" required>
                            <option label="Choose one"></option>
                            <option value="KIDDOS">Children (below 13 yrs. old)</option>
                            <option value="CYN">CYN (13 to 22 yrs. old)</option>
                            <option value="YAN">YAN (23 to 29 yrs. old)</option>
                            <option value="MEN">Men (Adult Men, 30 yrs. old and above)</option>
                            <option value="WOMEN">Women (Adult Women, 30 yrs. old and above)</option>
                        </select>
                        <div id="networkErrorContainer"></div>
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Birth Date -->
                <div class="az-content-label mg-b-5">Birth Date</div>

                <div class="row row-sm">
                    <div class="col-lg-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                           
                            </div>
                        <input id="dateMask" type="text" class="form-control" placeholder="MM/DD/YYYY">
                    </div><!-- input-group -->
                </div><!-- col-4 -->

                <hr class="mg-y-30">

                <!-- Display Picture -->
                <div class="az-content-label mg-b-5">Display Picture</div>
                <p class="mg-b-20">Not choosing a picture will display the initials of the member.</p>

                <div class="row row-sm">
                    <div class="col-sm-7 col-md-6 col-lg-4">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                        </div> <!-- custom-file -->
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- QR Code -->
                <div class="az-content-label mg-b-5">QR Code</div>
                <p class="  mg-b-20">QR Code is generated for the Member ID. You have the option to send it right away.</p>

                <div class="row row-sm mg-t-20 wd-450">
                    <div class="">
                        <label class="ckbox">
                            <input type="checkbox" name="shouldSendQR"><span>Send the QR Code to the Email Address provided.</span>
                        </label>
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <div class="col-lg-4">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button class="btn btn-az-secondary pd-x-25 active">Submit</button>
                        <a href="<?php echo base_url(); ?>Members" class="btn btn-outline-light pd-x-25">Cancel</a>
                    </div> <!-- btn-group -->
                </div><!-- col-lg-4 -->

                <div class="ht-40"></div>
            </form>
            <!-- End of form -->

    </div> <!-- container -->
</div> <!-- az-content -->
                </div>

<?php $this->load->view('dist/footer'); ?>

<script>
    // Additional code for adding placeholder in search box of select2
    (function ($) {
        var Defaults = $.fn.select2.amd.require('select2/defaults');

        $.extend(Defaults.defaults, {
            searchInputPlaceholder: ''
        });

        var SearchDropdown = $.fn.select2.amd.require('select2/dropdown/search');

        var _renderSearchDropdown = SearchDropdown.prototype.render;

        SearchDropdown.prototype.render = function (decorated) {

            // invoke parent method
            var $rendered = _renderSearchDropdown.apply(this, Array.prototype.slice.apply(arguments));

            this.$search.attr('placeholder', this.options.get('searchInputPlaceholder'));

            return $rendered;
        };

    })(window.jQuery);
</script>

<script>
    $(function () {
        'use strict'

        // Toggle Switches
        $('.az-toggle').on('click', function () {
            $(this).toggleClass('on');
        })

        // Input Masks
        $('#dateMask').mask('99/99/9999');
        $('#phoneMask').mask('(999) 999-9999');
        $('#phoneExtMask').mask('(999) 999-9999? ext 99999');
        $('#ssnMask').mask('999-99-9999');

        // Color picker
        $('#colorpicker').spectrum({
            color: '#17A2B8'
        });

        $('#showAlpha').spectrum({
            color: 'rgba(23,162,184,0.5)',
            showAlpha: true
        });

        $('#showPaletteOnly').spectrum({
            showPaletteOnly: true,
            showPalette: true,
            color: '#DC3545',
            palette: [
                ['#1D2939', '#fff', '#0866C6', '#23BF08', '#F49917'],
                ['#DC3545', '#17A2B8', '#6610F2', '#fa1e81', '#72e7a6']
            ]
        });

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

        $(document).ready(function () {
            $('.select2').select2({
                placeholder: 'Choose one',
                searchInputPlaceholder: 'Search'
            });

            $('.select2-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose one'
            });
        });

    });
</script>