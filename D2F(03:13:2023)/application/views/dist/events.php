<?php $this->load->view('dist/header'); ?>

<!-- Left panel -->

<div class="az-content az-content-app pd-b-0">
    <div class="container">
        <div class="az-content-left az-content-left-invoice">
            <div class="az-content-breadcrumb lh-1 mg-b-10">
                <span>Reporting</span>
                <span>Events</span>
            </div> <!-- az-content-breadcrumb -->
            <h2 class="az-content-title tx-24 mg-b-20">Events</h2>

            <div id="azInvoiceList" class="az-invoice-list">
                
                <!-- php code to print through events -->
                
                <?php
                    $rowNum = 0;
                    foreach($events as $event):
                        $description = $event->DESCRIPTION;
                        if (strlen($event->DESCRIPTION) > 27) {
                            $description = substr($description, 0, 24) . '...';
                        }
                        
                        echo '<div style="cursor:pointer" class="media" onclick="location.href = \'' . base_url() . 'Events/View/' . $event->EVENT_ID .'\'">';
                        
                        echo '<div class="media-body">
                                <h6>
                            <span>' . $description . '</span>
                        </h6>
                        <div>
                            <p><span>Date:</span>' . date('m/d/Y', strtotime($event->EVENT_DTTM)) . '</p>
                            <p><span>&nbsp;&nbsp;&nbsp;Attendees:</span> ' . ($event->member_attendee_count + $event->non_member_attendee_count) . '</p>
                        </div>
                    </div><!-- media-body -->
                </div><!-- media -->';
                        
                        
                    $rowNum++;
                    endforeach;
                    ?>        
            </div><!-- az-invoice-list -->
            
        </div><!-- az-content-left -->

        <!-- Body Contents -->
        <div class="az-content-body az-content-body-invoice">
            <div class="card card-invoice">
                <div class="card-body" style="margin-left: -7%">
                    <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                        <div class="az-content-label mg-b-10">Church Events and Activities</div>
                            <p class="mg-b-20">This Page is used to record the attendance of our members.</p>

                            <div id="wizard2">
                                <!-- First tab -->
                                <h3>General Information</h3>
                                <section>
                                    <!-- Form for Event Inputs -->
                                    <form method="POST" action="form-validation.html">
                                        <p class="mg-b-20">Please fill out the form completely.</p>
                                        <input id="event_id" class="form-control" name="event_id" type="hidden">

                                        <!-- Event Description -->
                                        <div class="row row-sm mg-b-10">
                                            <div class="col-md-12">
                                                <label class="form-control-label">Event Description: <span class="tx-danger">*</span></label>
                                                <input id="description" class="form-control" name="description" placeholder="Event Description" type="text"
                                                    value="" required>
                                            </div> <!-- col -->
                                        </div><!-- row -->

                                        <!-- Detailed Description -->
                                        <div class="row row-sm mg-b-10">
                                            <div class="col-md-12">
                                                <label class="form-control-label">Detailed Description: <span class="tx-danger">*</span></label>
                                                <textarea id="long_desc" name="long_desc" style="min-height: 5em" class="form-control" placeholder="Detailed Description" required></textarea>
                                            </div> <!-- col -->
                                        </div><!-- row -->

                                        <!-- Date & Time -->
                                        <div class="row row-sm mg-b-10">
                                            <div class="col-md-5">
                                                <label class="form-control-label">Date & Time: <span class="tx-danger">*</span></label>
                                                <input name="event_dttm" type="text" id="event_dttm" class="form-control fc-datepicker2" placeholder="YYYY-MM-DD HH:MI:SS" required>
                                            </div> <!-- col-md-5 -->
                                        </div><!-- row -->

                                        <!-- Status -->
                                        <div class="row row-sm mg-b-10">
                                            <div id="statusWrapper" class="parsley-select col-md-5">
                                                <label class="form-control-label">Status <span class="tx-danger">*</span></label>
                                                <select id="status" name="status" class="form-control select2-no-search" data-parsley-class-handler="#statusWrapper" data-parsley-errors-container="#statusErrorContainer" required>
                                                    <option label="Choose one"></option>
                                                    <option value="OPEN" selected>Open</option>
                                                    <option value="CLOSED">Closed</option>
                                                </select>
                                                <div id="statusErrorContainer"></div>
                                            </div> <!-- parsley-select -->
                                        </div><!-- row -->
                                    </form>
                                    <!-- End of form -->
                                </section>

                                <!-- Second tab -->
                                <h3>Membership Attendance</h3>
                                <section>
                                    <!--<p>Scan the QR Code.</p>-->
                                
                                    <div class="form-group wd-xs-400">
                                        
                                        <label class="form-control-label">Attendee QR Code <span class="tx-danger">*</span></label>
                                        <input id="QRCode" class="form-control" name="QRCode" placeholder="Scan the QR Code" type="text">
                                        <br>
                                        
                                        <ul id="QRCodeName" class="mb-40px"></ul>
                                        

                                        <!-- Non-member button -->
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-primary btn-with-icon btn-block collapsed" data-bs-toggle="collapse" data-bs-target="#nonmembercollapse" id="non-member-button"><i class="typcn typcn-user-add"></i> Non-Member</button>
                                            
                                        </div> <!-- btn-group -->
                                    </div><!-- form-group -->
                                <br>
                                    <!-- Non-Member Collapse Button -->
                                <div class="collapse mg-t-5" id="nonmembercollapse" aria-expanded>

                                    <!-- Body of the Collapse Button of Non-mem button -->
                                    <div class="card card-body">
                                    <br>
                                
                                        <!-- Start of inputs -->
                                        <label class="form-label">Name: <span class="tx-danger">*</span></label>

                                        <!-- First name and Last name -->
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <input id="last_name" class="form-control" placeholder="Last Name" type="text" name="last_name" required>
                                            </div><!-- col -->
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <input id="first_name" class="form-control" placeholder="First Name" type="text" name="first_name" required>
                                            </div><!-- col -->
                                        </div><!-- row -->

                                        <br>

                                        <!-- Contact Number and Address -->
                                        <div class="row row-sm">
                                            <!-- Contact Number -->
                                            <label class="form-label">Contact Number: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current Address:</label>
                                            <div class="col-lg">
                                                <input id="contactNum" class="form-control" placeholder="(000) 000-0000" type="text" name="contactNum">
                                            </div><!-- col -->

                                        <br>
                                            <!-- Address -->
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <textarea id="address" name ="address" rows="3" class="form-control" placeholder="Current Address"></textarea>
                                            </div><!-- col -->
                                        </div><!-- row -->

                                        <br>

                                        <!-- Isa pa -->

                                        <!-- Gender and Network -->
                                        <div class="row row-sm">
                                        <!-- Gender -->
                                        <label class="form-label">Gender: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Network:</label>

                                            <div class="col-lg">
                                                
                                                <select id="gender" name="gender" class="form-control select2-no-search" data-parsley-class-handler="#genderWrapper" data-parsley-errors-container="#genderErrorContainer" style="width: 300px;">
                                                        <option label="Choose one"></option>
                                                        <option value="MALE">Male</option>
                                                        <option value="FEMALE">Female</option>
                                                </select>
                                            </div><!-- col -->

                                        <br>
                                            <!-- Address -->
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <select id="network" name="network" class="form-control select2-no-search" data-parsley-class-handler="#networkWrapper" data-parsley-errors-container="#networkErrorContainer" style="width: 296px;">
                                                        <option label="Choose one"></option>
                                                        <option value="KIDDOS">Children (below 13 yrs. old)</option>
                                                        <option value="CYN">CYN (13 to 22 yrs. old)</option>
                                                        <option value="YAN">YAN (23 to 29 yrs. old)</option>
                                                        <option value="MEN">Men (Adult Men, 30 yrs. old and above)</option>
                                                        <option value="WOMEN">Women (Adult Women, 30 yrs. old and above)</option>
                                                    </select>
                                            </div><!-- col -->
                                        </div><!-- row -->
                                
                                        <br>

                                        <!-- First Timer -->
                                        <div class="row row-sm">
                                        <label class="form-label">First Timer: </label>
                                        
                                            <div class="col-lg">
                                                <select id="first_timer_flg" name="first_timer_flg" class="form-control select2-no-search" data-parsley-class-handler="#first_timer_flgkWrapper" data-parsley-errors-container="#first_timer_flgErrorContainer" style="width: 80px;">
                                                            <option label="Choose one"></option>
                                                            <option value="YES">YES</option>
                                                            <option value="NO" selected>NO</option>      
                                                </select>
                                            </div><!-- col -->
                                        </div> <!-- row -->
                                        <br>
                                        
                                        <!-- End of Non-member Inputs -->
                                        <br>
                                        <div> 
                                            <button id="non-member-save" type="button" class="btn btn-indigo">Save</button>
                                            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
                                    </div> <!-- card-body -->
                                </div> <!-- collapse -->    
                                </section> <!-- End of 2nd tab -->


                                <!-- Third tab -->
                                <!-- TO DO: Print the list of attendees in the event -->
                                <h3>Attendees</h3>
                                <section>
                                <!-- TABLE CONTENTS -->
                                <?php 

                                    echo '<div class="table-responsive">
                                    <table class="table table-striped mg-b-0" id="memberAttendeesTbl">
                                        <thead>
                                            <tr>
                                            <th>Row</th>
                                            
                                            <th>Name</th>
                                            
                                            <th>Network</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                                // $rowCount = 1;

                                                // foreach($eventAttendees as $eventAttendee):
                                                // echo '
                                                // <tr>
                                                // <th scope="row">'. $rowCount . '</th>
                                                
                                                // <td>'. $eventAttendee->LAST_NAME . ', ' . $eventAttendee->FIRST_NAME . '</td>
                                                
                                                // <td>'. $eventAttendee->NETWORK . '</td>
                                                // </tr>';
                                                
                                                // $rowCount++;
                                                // endforeach;

                                        echo '</tbody>
                                        </table>
                                        </div><!-- bd -->';

                                        ?>


                                    <br>
                                    <br>

                                    <h5><strong>Non-Member Attendees</strong></h5>
                                    <!-- TABLE CONTENTS -->
                                    <?php 

                                            echo '<div class="table-responsive">
                                            <table class="table table-striped mg-b-0" id="nonMemberAttendeesTbl">
                                            <thead>
                                                <tr>
                                                <th>Row</th>
                                                
                                                <th>Name</th>
                                                
                                                <th>Network</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                                    // $rowCount = 1;

                                                    // foreach($nonMemberAttendees as $nonMemberAttendee):
                                                    // echo '
                                                    // <tr>
                                                    // <th scope="row">'. $rowCount . '</th>
                                                    
                                                    // <td>'. $nonMemberAttendee->LAST_NAME . ', ' . $nonMemberAttendee->FIRST_NAME . '</td>
                                                    
                                                    // <td>'. $nonMemberAttendee->NETWORK . '</td>
                                                    // </tr>';
                                                    
                                                    // $rowCount++;
                                                    // endforeach;

                                                echo '</tbody>
                                                </table>
                                                </div><!-- bd -->';
                                    ?>
                                </section>
                            
                            </div> <!-- End of wizard2 -->
                    </div> <!-- az-content-body -->
                </div> <!-- card-body -->
            </div> <!-- card-invoice-->
        </div><!-- az-content-body -->
    </div> <!-- container -->
</div><!-- az-content -->

<?php $this->load->view('dist/footer'); ?>

<script>
      $(function(){
        'use strict'

        new PerfectScrollbar('#azInvoiceList', {
          suppressScrollX: true
        });

        new PerfectScrollbar('.az-content-body', {
          suppressScrollX: true
        });

        $('#azInvoiceList .media').on('click', function(e){
          $(this).addClass('selected');
          $(this).siblings().removeClass('selected');

          $('body').addClass('az-content-body-show');
        });

      });
</script>

<script>
  $(function(){
    'use strict';

    $('#wizard2').steps({
      headerTag: 'h3',
      bodyTag: 'section',
      autoFocus: true,
      titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
      onStepChanging: function (event, currentIndex, newIndex) {
        if(currentIndex < newIndex) {
            // Step 1 form validation
            if(currentIndex === 0) {
                var description = $('#description').parsley();
                var long_desc = $('#long_desc').parsley();
                var event_dttm = $('#event_dttm').parsley();
                var status = $('#status').parsley();

                if(description.isValid() && long_desc.isValid() && event_dttm.isValid() && status.isValid()) {
                    var values = "event_id=" + $('#event_id').val()+ "&description=" + $('#description').val() + "&long_desc=" + $('#long_desc').val() 
                               + "&event_dttm=" + $('#event_dttm').val() + "&status=" + $('#status').val();
                       
                    // Save the Event Details without loading the page
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url();?>Events/saveEvent",
                        data: values,
                        cache: false,
                        error: function(ts){
                          alert(ts.responseText);  
                        },
                        success: function(eventId){
                            // Populate the Event ID input so that it can be updated without loading the page
                            $('#event_id').val(eventId);
                            
                            // Format Date
                            var date = new Date($('#event_dttm').val());
                            
                            // Add the Event on the Left Panel
                            $('#azInvoiceList').prepend('<div style="cursor:pointer" id="selectedMedia" class="media selected" onclick="location.href = \'<?php echo base_url(); ?>Events/View/' + eventId + '\'"><div class="media-body"><h6><span>' + $('#description').val() +  '</span></h6><div><p><span>Date:</span>' + date.toLocaleDateString() + '</p><p><span>&nbsp;&nbsp;&nbsp;Attendees:</span> 0</p></div></div></div>');

                           
                            // Set the cursor focus to the QR Code Text Input
                            $('#QRCode').focus();
                        }
                    });

                    // removes duplication of printing when creating a new event.
                    $('#selectedMedia').remove();
                    
                    return true;
                } 
                else {
                    description.validate();
                    long_desc.validate();
                    event_dttm.validate();
                    status.validate();
            }
        }

            // Step 2 form validation
            if(currentIndex === 1) {
                var QRCode = $('#QRCode').parsley();
                if(QRCode.isValid()) {
                    return true;
                } else { QRCode.validate(); }
            }

            // Always allow step back to the previous step even if the current step is not valid.
            } 
            else { 
                return true; 
            }

            // // Step 3(Finish of form validation)
            // if(currentIndex === 2) {
                
            // window.location = "<?php  echo site_url('dist/events'); ?>";
            // return true;
            // }
        }
    });


    // Do not allow removal of focus to the QR Code field
    $("#QRCode").blur(function() {
        var isCollapsed = $('#non-member-button').hasClass('collapsed');
        
        // Do not allow focus out if non-member is expanded
        if (isCollapsed) {
            $('#QRCode').focus();
        }
    });

    // Non-member-button click event listener
    $("#non-member-button").click(function() {
    var isCollapsed = $('#non-member-button').hasClass('collapsed');

    // If non-member form is expanded, default focus to Last Name
    if (!isCollapsed) {
        $('#last_name').focus();
    }
    // If non-member form is collapsed, return focus to the QR Code
    else {
        $('#QRCode').focus();
        }
    });

    // Non-member-save Button click event listener
    $('#non-member-save').click(function(){
        // Retrieve values of the non-member input
        // Getters
        var eventId = $('#event_id').parsley();
        var lastName = $('#last_name').parsley();
        var firstName = $('#first_name').parsley();
        var contactNum = $('#contactNum').parsley();
        var address = $('#address').parsley();
        var gender = $('#gender').parsley();
        var network = $('#network').parsley();
        var firstTimerFlag = $('#first_timer_flg').parsley();
        
        if( eventId.isValid() && lastName.isValid() && firstName.isValid() && contactNum.isValid() && address.isValid() && gender.isValid() && network.isValid() && firstTimerFlag.isValid() ) {

            var values = "event_id=" + $('#event_id').val()+ "&lastName=" + $('#last_name').val() + "&firstName=" + $('#first_name').val() 
                        + "&contactNum=" + $('#contactNum').val() + "&address=" + $('#address').val() + "&gender=" + $('#gender').val() + "&network=" + $('#network').val() + "&firstTimerFlag=" + $('#first_timer_flg').val();
            
            // AJAX Call to automatically save Non-Member
            $.ajax({
                type: "POST",
                url: "<?= base_url();?>Events/addEventNonMember",
                data: values,
                cache: false,
                error: function(ts){
                alert(ts.responseText);  
                },
                success: function(message){
                    // Add the member to the table Non-Member Table in the 3rd Section
                    // Add Member to the Member Attendees Table in Section 3
                    var rowCount = $('#nonMemberAttendeesTbl tbody tr').length;
                    
                    if (rowCount == 0) {
                        $('#nonMemberAttendeesTbl tbody').append('<tr><th scope="row">' + (rowCount + 1) + '</th><td>' + $('#last_name').val() + ', ' + $('#last_name').val() + '</td><td>' + $('#network').val() + '</td></tr>');
                    }
                    else {
                        $('#nonMemberAttendeesTbl tbody tr:last').after('<tr><th scope="row">' + (rowCount + 1) + '</th><td>' + $('#last_name').val() + ', ' + $('#last_name').val() + '</td><td>' + $('#network').val() + '</td></tr>');
                    }

                    // Clear Non-member Form    
                    $('#last_name').val('');
                    $('#first_name').val('');
                    $('#contactNum').val('');
                    $('#address').val('');
                    $('#gender').empty();
                    $('#network').empty();
                    $('#first_timer_flg').val('NO').change();
                    $('#non-member-button').click();

                    // <!-- Alert message for succesfully adding a non-member -->
                    $('#alertHeader').prepend('<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> <strong>Done! </strong> Successfully added the non-member. </div>');

                    // Hide alert after 5 seconds
                    $(".alert").delay(5000).slideUp(200, function() {
                        $(this).alert('close');
                        });                  
                }
            });

            return true;
        } else {
                    lastName.validate();
                    firstName.validate();
                    contactNum.validate();
                    address.validate();
                    gender.validate();
                    network.validate();
                    firstTimerFlag.validate();
            }
    });
    
    // When enter is pressed (Scanner is used)
    $('#QRCode').on('keypress', function (e) {
        // Enter Key is 13
        if(e.which === 13){
            var values = "event_id=" + $('#event_id').val()+ "&QRCode=" + $('#QRCode').val();
            
            // Save the Event Details without loading the page
            $.ajax({
                type: "POST",
                url: "<?= base_url();?>Events/addEventAttendee",
                data: values,
                cache: false,
                error: function(ts){
                  alert(ts.responseText);  
                },
                success: function(message){
                    // Message is success
                    if (message !== 'Invalid QR Code. No member found.') {
                        var parsedJSON = jQuery.parseJSON(message);
                        $('#QRCodeName').addClass("list-arrow");
                        $('#QRCodeName').removeClass("typcn icon typcn-delete-outline text-danger");
                        $('#QRCodeName').html("<li><strong>" + parsedJSON.LAST_NAME + ", " + parsedJSON.FIRST_NAME + "</strong> successfully scanned.</li>");
                        $('#QRCode').val('');

                        // Add Member to the Member Attendees Table in Section 3    
                        // Check if the record already exists on the table, if so, don't duplicate printing   
                        // if(parsedJSON.SUCCESS_FLG == 'true') {
                        //     var rowCount = $('#memberAttendeesTbl tr').length;
                        //     $('#memberAttendeesTbl tr:last').after('<tr><th scope="row">' + rowCount + '</th><td>' + parsedJSON.LAST_NAME + ', ' + parsedJSON.FIRST_NAME + '</td><td>' + parsedJSON.NETWORK + '</td></tr>');
                        // }

                        if(parsedJSON.SUCCESS_FLG == 'true') {
                            // Retrieve how many rows are already displayed in the report table
                            var rowCount = $('#memberAttendeesTbl tbody tr').length;
                            
                            // Create the first row if there are still no rows displayed
                            if (rowCount == 0) {
                                $("#memberAttendeesTbl tbody").append('<tr><th scope="row">1</th><td>' + parsedJSON.LAST_NAME + ', ' + parsedJSON.FIRST_NAME + '</td><td>' + parsedJSON.NETWORK + '</td></tr>');
                            }
                            else {
                                $('#memberAttendeesTbl tbody tr:last').after('<tr><th scope="row">' + (rowCount + 1) + '</th><td>' + parsedJSON.LAST_NAME + ', ' + parsedJSON.FIRST_NAME + '</td><td>' + parsedJSON.NETWORK + '</td></tr>');
                            }
                        }
                    }
                    else {
                        $('#QRCodeName').addClass("typcn icon typcn-delete-outline text-danger");
                        $('#QRCodeName').html("<strong>Invalid QR Code. No member found.</strong>");
                        $('#QRCode').val('');
                    }
                }
            });
        }
    });
    
    // jQuery Simple DateTimePicker
    $('#event_dttm').appendDtpicker({
        closeOnSelected: true,
        onInit: function(handler) {
            var picker = handler.getPicker();
            $(picker).addClass('az-datetimepicker');
        }
    });

    // Hide alert after 5 seconds
    $(".alert").delay(5000).slideUp(200, function() {
        $(this).alert('close');
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

