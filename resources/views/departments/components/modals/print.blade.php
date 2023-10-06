
<div class="col-sm-6 col-md-4 col-xl-3">
    <div class="modal fade" id="print-barcode-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="pin-form" method="POST" id="request-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Print Barcode Document <span id="stats"></span></h5>
                        <button type="button" id="close-modal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="printable-content">
                            <h5 class="text-center">Tracking No.</h5>
                            <h5 class="text-center barcode-trk text-center">
                              <!-- Content here -->
                            </h5>
                            <div class="row">
                              <div class="text-center credentials">
                                <!-- Content here -->
                              </div>
                            </div>
                          </div>
                          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect" id="btn-print">Print Barcode</button>
                        {{-- <button type="submit" class="btn btn-danger waves-effect waves-light">Archived</button> --}}
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>