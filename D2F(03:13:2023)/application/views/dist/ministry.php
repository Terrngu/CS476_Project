<?php $this->load->view('dist/header'); ?>

<div class="az-content az-content-app az-content-contacts pd-b-0">
    <div class="container">
        <div class="az-content-left az-content-left-contacts">

            <div class="az-content-breadcrumb lh-1 mg-b-10">
                <span>Main Menu</span>
                <span>Ministries</span>
            </div>
            <h2 class="az-content-title tx-24 mg-b-30">Ministries</h2>

            <nav class="nav az-nav-line az-nav-line-chat">
                <a href="<?php echo base_url(); ?>Ministries" class="nav-link active">All Ministries</a>
                <a href="<?php echo base_url(); ?>Members" class="nav-link">Members</a>
                
            </nav>

            <div id="azContactList" class="az-contacts-list">


             <!-- php code to print the information of the church ministries -->
             <?php
                $newLetter = ($ministries[0]->ABBREVIATION)[0];
                $previousLetter = "";
              

                foreach ($ministries as $ministry):

                    if ($previousLetter != ($ministry->ABBREVIATION)[0]) {
                        $newLetter = ($ministry->ABBREVIATION)[0];
                        $previousLetter = $newLetter;
                        echo '<div class="az-contact-label">' . $newLetter . '</div>';
                    }
                    ?>
                    <div class="az-contact-item <?php if ($selectedId == $ministry->MINISTRY_ID) echo 'selected'; ?>" onclick="location.href = '<?php echo base_url(); ?>Ministries/View/<?php echo $ministry->MINISTRY_ID ?>'">
                        <div class="az-avatar bg-gray-700 online">
                            <!--<img src="../img/faces/face20.jpg" alt="">-->
                            <?php echo $newLetter ?>
                        </div>
                        <div class="az-contact-body">
                            <h6><?php echo $ministry->ABBREVIATION ?></h6>
                            <span class="phone"><?php echo $ministry->DESCRIPTION ?></span>
                        </div><!-- az-contact-body -->
                        <a href="" class="az-contact-star active"><i class="typcn typcn-star"></i></a>
                    </div><!-- az-contact-item -->

                <?php endforeach; ?>

                <!-- end of printing --> 


            </div><!-- az-contacts-list -->

        </div><!-- az-content-left -->
        <div class="az-content-body az-content-body-contacts">

            <!-- Alert message for succesfully deleting a member -->
            <?php
            if ($message != '') {
                echo '<div class="alert alert-success" role="alert">

	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	            <strong>Done! </strong>' . $message . '
	        </div>';
            }
            ?> 

            <div class="az-contact-info-header">
                <div class="media">
                    <div class="az-avatar avatar-xxl d-none d-sm-flex online">
                        <!-- <img src="../img/faces/face20.jpg" alt=""> -->
                    
                        <!-- Ung profile pic na bilog -->
                        <?php echo ($ministries[0]->ABBREVIATION)[0];?>
                        <!--<a href=""><i class="typcn typcn-camera-outline"></i></a>-->
                    </div>
                    <div class="media-body">
                        <h4>
                            <!-- dito ung big header name -->
                            <?php echo ($ministries[0]->DESCRIPTION); ?></h4>

                            <!-- The bio for the main header -->
                         <p><?php echo ($ministries[0]->MINISTRY_DESCRIPTION); ?></p> 
                        

                        <nav class="nav">
                          <a href="<?php echo base_url(); ?>Members" class="nav-link"><i class="typcn typcn-document-add"></i> Add Member</a>
                        </nav>
                    </div><!-- media-body -->
                </div><!-- media -->

                <!-- ACTIONS -->
                <div class="az-contact-action">
                        <a href="<?php echo base_url(); ?>Ministries/Edit/<?php echo $selectedId; ?>"><i class="typcn typcn-edit"></i> Edit Ministry</a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#yesornomodal"><i class="typcn typcn-trash"></i> Delete Ministry</a>
                        
                        <a href="<?php echo base_url(); ?>Ministries/Add"><i class="typcn typcn-plus"></i> Add Ministry</a>

                        <br>

                </div><!-- az-contact-action -->
              </div><!-- az-contact-info-header -->

              <!-- BODY -->
            <div class="az-contact-info-body">

            <!-- SEPARATION -->
            <br>
                <div class="az-content-label tx-13 mg-b-25">Ministry Information</div>
                
                    <!-- TABLE CONTENTS -->
                    <?php 

                        echo '<div class="table-responsive">
                        <table class="table table-striped mg-b-0">
                            <thead>
                            <tr>
                                <th>Row</th>
                                
                                <th>Name</th>
                                
                                <th>Gender</th>
                            </tr>
                            </thead>
                        <tbody>';
                                $rowCount = 1;

                                foreach($ministryMembers as $ministryMem):
                                    echo '
                                <tr>
                                    <th scope="row">'. $rowCount . '</th>
                                    
                                    <td>'. $ministryMem->FIRST_NAME . ' ' . $ministryMem->LAST_NAME . '</td>
                                    
                                    <td>'. $ministryMem->GENDER . '</td>
                                </tr>';
                                
                                $rowCount++;
                                endforeach;

                            echo '</tbody>
                                </table>
                            </div><!-- bd -->';
                        
                        ?>
                    <div class="mg-b-20"></div>
                </div><!-- az-profile-body -->
            </div><!-- az-content-body -->
        </div>
    </div><!-- container -->
</div><!-- az-content -->

<!-- DELETE MODAL -->
<div id="yesornomodal" class="modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Alert</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the Ministry Information permanently? </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-indigo" onclick="location.href = '<?php echo base_url(); ?>Ministries/Delete/<?php echo $selectedId; ?>'">Save changes</button>
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<?php $this->load->view('dist/footer'); ?>
<script>
    $(function () {
        'use strict'

    
        new PerfectScrollbar('#azContactList', {
            suppressScrollX: true
        });

    new PerfectScrollbar('.az-contact-info-body', {
            suppressScrollX: true
        });

    });
</script>
<script>
     // Hide alert after 5 seconds
     $(".alert").delay(5000).slideUp(200, function() {
        $(this).alert('close');
        });
</script>
</body>
</html>


