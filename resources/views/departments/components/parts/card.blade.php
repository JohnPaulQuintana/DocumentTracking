<div class="col-xl-3 col-md-6">
    <div class="card p-2">
        <div class="card-body">
            <div class="d-flex">
                <div class="flex-grow-1">
                    <p class="text-truncate font-size-18 mb-2 text-primary">On-Going Documents</p>
                    <h2 class="mb-2 on-card text-center" id="on-card">0</h2>
                    {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p> --}}
                </div>
                <div class="avatar-sm">
                    <span class="avatar-title bg-light text-primary rounded-3">
                        <i class="ri-shopping-cart-2-line font-size-24"></i>  
                    </span>
                </div>
            </div>                                            
        </div><!-- end cardbody -->
    </div><!-- end card -->
</div><!-- end col -->

<div class="col-xl-3 col-md-6">
    <div class="card p-2">
        <div class="card-body">
            <div class="d-flex">
                <div class="flex-grow-1">
                    <p class="text-truncate font-size-18 mb-2 text-success">Total Accomplished</p>
                    <h2 class="mb-2 accomplished text-center">0</h2>
                    {{-- <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p> --}}
                </div>
                <div class="avatar-sm">
                    <span class="avatar-title bg-light text-success rounded-3">
                        <i class="mdi mdi-currency-usd font-size-24"></i>  
                    </span>
                </div>
            </div>                                              
        </div><!-- end cardbody -->
    </div><!-- end card -->
</div><!-- end col -->

<div class="col-xl-3 col-md-6">
    <div class="card p-2">
        <div class="card-body">
            <div class="d-flex">
                <div class="flex-grow-1">
                    <p class="text-truncate font-size-18 mb-2 text-danger">Total Discontinued</p>
                    <h2 class="mb-2 rejected text-center">0</h2>
                    {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p> --}}
                </div>
                <div class="avatar-sm">
                    <span class="avatar-title bg-light text-danger rounded-3">
                        <i class="ri-user-3-line font-size-24"></i>  
                    </span>
                </div>
            </div>                                              
        </div><!-- end cardbody -->
    </div><!-- end card -->
</div><!-- end col -->

<div class="col-xl-3 col-md-6">
    <div class="card p-2">
        <div class="card-body">
            <div class="d-flex">
                <div class="flex-grow-1">
                    <p class="text-truncate font-size-18 mb-2 text-info">Assigned Document's</p>
                    <h2 class="mb-2 rejected text-center assigned">0</h2>
                    {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p> --}}
                </div>
                <div class="avatar-sm">
                    <span class="avatar-title bg-light text-info rounded-3">
                        <i class="ri-user-3-line font-size-24"></i>  
                    </span>
                </div>
            </div>                                              
        </div><!-- end cardbody -->
    </div><!-- end card -->
</div><!-- end col -->

{{-- calendar events --}}
{{-- 
<div class="row mb-4">
    <div class="col-xl-3">
        <div class="card h-100">
            <div class="card-body">
                <button type="button" class="btn font-16 btn-primary waves-effect waves-light w-100"
                    id="btn-new-event" data-bs-toggle="modal" data-bs-target="#event-modal">
                    Create New Event
                </button>

                <div id="external-events">
                    <br>
                    <p class="text-muted">Drag and drop your event or click in the calendar</p>
                    <div class="external-event fc-event bg-success" data-class="bg-success">
                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>New Event
                        Planning
                    </div>
                    <div class="external-event fc-event bg-info" data-class="bg-info">
                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Meeting
                    </div>
                    <div class="external-event fc-event bg-warning" data-class="bg-warning">
                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Generating
                        Reports
                    </div>
                    <div class="external-event fc-event bg-danger" data-class="bg-danger">
                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Create
                        New theme
                    </div>
                </div>
                
            </div>
        </div>
    </div> <!-- end col-->
    <div class="col-xl-9">
        <div class="card mb-0">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row-->
<div style='clear:both'></div>

<!-- Add New Event MODAL -->
<div class="modal fade" id="event-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-3 px-4">
                <h5 class="modal-title" id="modal-title">Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form class="needs-validation" name="event-form" id="form-event" novalidate>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Event Name</label>
                                <input class="form-control" placeholder="Insert Event Name" type="text"
                                    name="title" id="event-title" required value="">
                                <div class="invalid-feedback">Please provide a valid event name
                                </div>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category" id="event-category">
                                    <option  selected> --Select-- </option>
                                    <option value="bg-danger">Danger</option>
                                    <option value="bg-success">Success</option>
                                    <option value="bg-primary">Primary</option>
                                    <option value="bg-info">Info</option>
                                    <option value="bg-dark">Dark</option>
                                    <option value="bg-warning">Warning</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid event
                                    category</div>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                    <div class="row mt-2">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger"
                                id="btn-delete-event">Delete</button>
                        </div> <!-- end col-->
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-light me-1"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </form>
            </div>
        </div>
        <!-- end modal-content-->
    </div>
    <!-- end modal dialog-->
</div>
<!-- end modal--> --}}
