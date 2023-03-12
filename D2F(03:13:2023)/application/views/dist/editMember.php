<?php $this->load->view('dist/header'); ?>

<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        <div class="az-content-left az-content-left-contacts">

            <div class="az-content-breadcrumb lh-1 mg-b-10">
                <span>Main Menu</span>
                <span>Members</span>
                <span>Edit Member</span>
            </div> <!-- az-content-breadcrumb -->
            <h2 class="az-content-title tx-24 mg-b-30">Members</h2>

            <nav class="nav az-nav-line az-nav-line-chat">
                <a href="<?php echo base_url(); ?>Members" class="nav-link active">All Members</a>
                <a href="<?php echo base_url(); ?>Ministries" class="nav-link">Ministries</a>
            </nav>

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
                    <div class="az-contact-item <?php if ($selectedId == $member->MEMBER_ID) echo 'selected'; ?>" onclick="location.href = '<?php echo base_url(); ?>Members/View/<?php echo $member->MEMBER_ID ?>'">
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

            </div><!-- az-contacts-list -->

        </div><!-- az-content-left -->


        <div class="az-content-body pd-lg-l-40 d-flex flex-column">

            <h2 class="az-content-title">Edit Member</h2>

            <!-- FORM FOR INPUTS -->
            <form method="POST" action="<?php echo base_url(); ?>Members/save/<?php echo $selectedMember->MEMBER_ID; ?>" data-parsley-validate>

                <!-- Start of inputs -->
                <!-- Name -->
                <div class="az-content-label mg-b-5">Name <span class="tx-danger">*</span></div>

                <div class="row row-sm">
                    <div class="col-lg">
                        <input class="form-control" placeholder="Last Name" type="text" value="<?php echo $selectedMember->LAST_NAME; ?>" name="last_name" required>
                    </div><!-- col -->
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input class="form-control" placeholder="First Name" type="text" value="<?php echo $selectedMember->FIRST_NAME; ?>" name="first_name" required>
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Contact Number -->
                <div class="az-content-label mg-b-5">Contact Number</div>

                <div class="row row-sm wd-400">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input placeholder="(000) 000-0000" id="phoneMask" class="form-control" placeholder="Contact Number" type="text" value="<?php echo $selectedMember->CONTACT_NUMBER; ?>" name="contactNum">
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Email Address -->
                <div class="az-content-label mg-b-5">Email Address</div>

                <div class="row row-sm wd-400">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input class="form-control" placeholder="Email Address" type="email" value="<?php echo $selectedMember->EMAIL; ?>" name="emailAdd">
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Current Address -->
                <div class="az-content-label mg-b-5">Current Address</div>

                <div class="row row-sm mg-t-20">
                    <div class="col-lg">
                        <textarea name ="address" rows="3" class="form-control" placeholder="Current Address"><?php echo $selectedMember->ADDRESS; ?></textarea>
                    </div><!-- col-lg -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Gender -->
                <div class="az-content-label mg-b-5">Gender <span class="tx-danger">*</span></div>
                <div class="row row-sm mg-t-20 wd-300">
                    <div class="col-lg">
                        <select name="gender" class="form-control select2-no-search" required>
                            <option label="Choose one"></option>
                            <option <?php if ($selectedMember->GENDER == 'MALE') echo 'selected'; ?> value="MALE">Male</option>
                            <option <?php if ($selectedMember->GENDER == 'FEMALE') echo 'selected'; ?> value="FEMALE">Female</option>
                        </select>
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Network -->
                <div class="az-content-label mg-b-5">Network <span class="tx-danger">*</span></div>
                <div class="row row-sm mg-t-20 wd-450">
                    <div class="col-lg">
                        <select name="network" class="form-control select2-no-search" required>
                            <option label="Choose one"></option>
                            <option <?php if ($selectedMember->NETWORK == 'KIDDOS') echo 'selected'; ?> value="KIDDOS">Children (below 13 yrs. old)</option>
                            <option <?php if ($selectedMember->NETWORK == 'CYN') echo 'selected'; ?> value="CYN">CYN (13 to 22 yrs. old)</option>
                            <option <?php if ($selectedMember->NETWORK == 'YAN') echo 'selected'; ?> value="YAN">YAN (23 to 29 yrs. old)</option>
                            <option <?php if ($selectedMember->NETWORK == 'MEN') echo 'selected'; ?> value="MEN">Men (Adult Men, 30 yrs. old and above)</option>
                            <option <?php if ($selectedMember->NETWORK == 'WOMEN') echo 'selected'; ?> value="WOMEN">Women (Adult Women, 30 yrs. old and above)</option>
                        </select>
                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-30">

                <!-- Birth Date -->
                <div class="az-content-label mg-b-5">Birth Date</div>

                <div class="wd-200 mg-b-20">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                            </div> <!-- input-group-text -->
                        </div> <!-- input-group-prepend -->
                        <input name="birth_date" type="text" class="form-control fc-datepicker" placeholder="MM/DD/YYYY" value="<?php echo date("m/d/Y", strtotime($member->BIRTHDATE)); ?>">
                    </div> <!-- input-group -->
                </div><!-- wd-200 -->

                <hr class="mg-y-30">

                <!-- Display Picture -->
                <div class="az-content-label mg-b-5">Display Picture</div>
                <p class="mg-b-20">Not choosing a picture will display the initials of the member.</p>

                <div class="row row-sm">
                    <div class="col-sm-7 col-md-6 col-lg-4">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                        </div> <!-- custom-file -->
                    </div><!-- col-sm-7 -->
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


