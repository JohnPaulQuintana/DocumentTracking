@extends('admin.index')

@section('head')
    <meta charset="utf-8" />
    <title>Administrator Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    {{-- toast css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}">

    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/twitter-bootstrap-wizard/prettify.css') }}">
    
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">

    <!-- jquery.vectormap css -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />  

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <style>
        /* modal */
        #departments-card{
            max-height: 260px;
            margin-bottom: 10px;
            /* border: 1px solid red; */
            overflow-x: auto;
        }
        #departments-card::-webkit-scrollbar{
            width: 0;
        }
        #departments-card-items{
            height: 65px;
            /* border: 1px solid red; */
        }
    </style>
@endsection

@section('content')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Document Tracking</a></li>
                    <li class="breadcrumb-item active">Request's</li>
                </ol>
            </div>

        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a id="new-request" href="javascript:void(0);" class="dropdown-item text-success">New Request</a>
                        </div>
                    </div>

                    <h4 class="card-title mb-4">
                        Request List
                        <a href="#" class="text-white font-size-13 btn btn-warning p-1"  data-bs-toggle="tooltip" data-bs-placement="top" title="On-going Document">On-going</a>
                        <a href="#" class="text-white font-size-13 btn btn-danger p-1"  data-bs-toggle="tooltip" data-bs-placement="top" title="Archieved Document">Archived</a>
                    </h4>
                    {{-- {{ $logs }} --}}
                    <div class="table-responsive">
                        <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Tracking No.</th>
                                    <th>Document</th>
                                    <th>Purpose</th>
                                    <th>Office (Requestor)</th>
                                    {{-- <th>Received Offices</th> --}}
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead><!-- end thead -->
                            <tbody>
                                {{-- {{ $officeNames }} --}}
                                {{-- @php
                                     $badges = []
                                @endphp --}}
                                @foreach ($documents as $document)
                                    {{-- {{ $document }} --}}
                                    <tr>
                                        <td>
                                            @switch($document['trk_id'])
                                                @case(null)
                                                    <h6 class="mb-0"><i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>{{ __('Pending') }}</h6>
                                                    @break
                                        
                                                @default
                                                    <h6 class="mb-0"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>{{ $document['trk_id'] }}</h6>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <i class="far fa-file-alt fa-3x"></i> <!-- Larger document icon -->
                                        </td>
                                        {{-- for now id muna --}}
                                        {{-- <td>{{ $document['requestor'] }}</td> --}}
                                        <td>{{ $document['purpose'] }}</td>
                                        <td>
                                            {{ $document['corporate_office']['office_name'] }}
                                            <span class="badge bg-info p-1"><b>{{ $document['corporate_office']['office_abbrev'] }}</b></span>
                                            {{-- @php
                                                // $badges = ['BGA', 'BGB', 'BGX', 'BGC', 'BGI', 'BGK']; // Replace this with your data
                                                
                                                $badges[] = $document['corporate_office']['office_abbrev'];
                                                $maxBadgesToShow = 3;
                                                $remainingBadges = count($badges) - $maxBadgesToShow;
                                                $uniqueId = uniqid(); // Generate a unique ID for the badge container
                                            @endphp
                                            <div id="{{ $uniqueId }}">
                                                @for ($i = 0; $i < min($maxBadgesToShow, count($badges)); $i++)
                                                    <span class="badge bg-info p-1"><b>{{ $badges[$i] }}</b></span>
                                                @endfor
    
                                                @if ($remainingBadges > 0)
                                                    <a href="#" class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" title="+{{ $remainingBadges }} more...">
                                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><b>+{{ $remainingBadges }}</b></span>
                                                    </a>
                                                @endif
                                            </div> --}}
                                        </td>
                                        <td><span class="badge bg-warning p-2"><b>{{ $document['status'] }}</b></span></td>
                                        <td><b>{{ $document['created_at'] }}</b></td>
                                        <td width="50px">
                                            <span class="">
                                                <a href="#" id="view-document-btn" class="ri-eye-line text-white font-size-18 btn btn-info p-2 view-document-btn" data-id="{{ $document['document_id'] }} }}" data-document-id="{{ $document['documents'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View Document"></a>
                                                <a href="#" id="scan-document-btn" class="ri-camera-line text-white font-size-18 btn btn-success p-2" data-office-id="2" data-bs-toggle="tooltip" data-bs-placement="top" title="Scan Document"></a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody><!-- end tbody -->
                        </table> <!-- end table -->
                    </div>
                </div><!-- end card -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>

    {{-- new request modal --}}
    {{-- @include('departments.components.modals.requestDocument') --}}
    {{-- open document modal --}}
    @include('admin.components.modals.openDocument')
@endsection

@section('script')
    <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>


        <!-- jquery.vectormap map -->
        <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        
        <!-- Responsive examples -->
        <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>

        <!-- toastr plugin -->
        <script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
        <!-- toastr init -->
        <script src="{{ asset('assets/js/pages/toastr.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

        {{-- custom js --}}
        <script>
            $(document).ready(function(){
                // new request
                // $('#new-request').on('click',function(){
                //      // Prevent modal from closing when clicking outside
                //     $('#new-request-modal').modal({
                //         backdrop: 'static',
                //         keyboard: false
                //     });

                //     $('#new-request-modal').modal('show')
                //     var departmentJson = {!! json_encode($departments)!!};
                //     console.log(departmentJson)
                //     var html = ''
                //     departmentJson.forEach(department => {
                //         html += `<option value="${department.office_name}">${department.office_name}</option>`
                //     });

                //     // var trkId = $(this).data("trk-id");
                //     $('#department-select').html(html)

                //     // Reset the form when clicking the "x" button
                //     $('#close-modal').on('click', function () {
                //         $('#request-form')[0].reset();
                //         $("#image").val(""); // Clear the file input
                //         $("#image-preview").hide(); // Hide the image preview container
                //     });
                // })

                // documents open
                $('.view-document-btn').on('click', function(){
                    $('#open-document-modal').modal({
                        backdrop: 'static',
                        keyboard: false
                    })

                    $('#open-document-modal').modal('show')
                        const baseUrls = `${window.location.protocol}//${window.location.hostname}:${window.location.port}`;
                        var docPath = $(this).data("document-id");
                        var id = parseInt($(this).data("id"));
                         // Construct the full URL to the document
                        var fullDocUrl = `${baseUrls}/storage/documents/` + docPath;
                        // Set the src attribute of the iframe in the modal
                        $('#preview-doc').attr('src', fullDocUrl);
                        $('#doc-id').val(id)
                })
                // When the file input changes
                $("#image").change(function () {
                    readTimestamp(this);
                });

                // Function to read and display the timestamp
                function readTimestamp(input) {
                    if (input.files && input.files[0]) {
                        var timestamp = new Date().toLocaleString(); // Generate a timestamp
                        $("#timestamp-placeholder").text(timestamp); // Display the timestamp
                        $("#image-preview").show(); // Display the image preview container
                    }
                }

                // Handle the "Cancel" button click
                $("#cancel-preview").click(function () {
                    // Clear the file input and reset the image preview
                    $("#image").val(""); // Clear the file input
                    $("#image-preview").hide(); // Hide the image preview container
                });
            })
        </script>
        {{-- // notification --}}
    @if (session()->has('notification'))
        <script>
            $(document).ready(function() {
                // Set Toastr options
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": 300,
                    "hideDuration": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                var notificationJson = {!! json_encode(session('notification')) !!};
                var notification = JSON.parse(notificationJson);
                console.log(notification)
                toastr[notification.status](notification.message);
            });
        </script>
    @endif
@endsection
