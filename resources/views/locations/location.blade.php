{{-- show maps --}}
<div class="modal fade" id="modal-maps">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Map pinned</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group">
                        test 1
                        <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src='{{ $item->kordinasi }}'></iframe><a href="https://formatjson.org/">Format JSON</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:500px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:500px;}.gmap_iframe {height:500px!important;}</style></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="reset" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->