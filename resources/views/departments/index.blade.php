<!doctype html>
<html lang="en">

    <head>
        
       {{-- @include('departments.components.header.links') --}}
        @yield('head')
    </head>

    <body data-topbar="dark">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                @include('departments.components.header.header')
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                @include('departments.components.sidebar.sidebar')
            </div>
            <!-- Left Sidebar End -->

            
            <!-- Start right Content here -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                    
                        
                            @yield('content')
                        
                    </div>
                    
                </div>
                <!-- End Page-content -->
               
                {{-- modals --}}
                @include('departments.components.modals.modal')

                <footer class="footer">
                    @include('departments.components.footer.footer')
                </footer>
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
            
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        {{-- @include('departments.components.footer.scripts') --}}
        @yield('script')


        
        {{-- custom script --}}

        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('60b56d1ff7cab3fbbbee', {
            cluster: 'ap1'
            });

            var channel = pusher.subscribe('update-dashboard');
            channel.bind('initialize-dashboard', function(data) {
            alert(JSON.stringify(data));
            });
        </script>

        <script>
            $(document).ready(function(){
                $('#send-documents-btn').on('click',function(){
                    $('#send-documents').modal('show')

                    // Dropzone.options.myDocuments = {
                    //     paramName: "file",
                    //     maxFilesize: 2, // Max file size in MB
                    //     acceptedFiles: ".jpg, .jpeg, .png, .gif",
                    //     addRemoveLinks: true,
                    //     autoProcessQueue: false, // Set autoProcessQueue to false

                    //     init: function () {
                    //         var myDropzone = this;

                    //         // Add a click event handler to the "Upload" button using jQuery
                    //         $('#uploadButton').click(function (e) {
                    //             e.preventDefault();
                    //             e.stopPropagation();
                    //             // Process and upload the queued files when the button is clicked
                    //             myDropzone.processQueue();
                    //         });

                    //         this.on('success', function (file, response) {
                    //             console.log('File uploaded successfully');
                    //             // Display uploaded file
                    //             $('#filePreviews').append('<p>' + file.name + '</p>');
                    //         });

                    //         this.on('error', function (file, response) {
                    //             console.error('File upload error');
                    //         });
                    //     }
                    // };

                })
            })
        </script>
    </body>

</html>