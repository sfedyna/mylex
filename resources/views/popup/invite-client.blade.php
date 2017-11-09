<div class="modal fade" id="refer-model" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id = "form-refer-client" action="{{ URL::route('user.invite-client') }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Refer a client</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="response-msg"></div>
                        <label for="exampleInputEmail1">Email address</label>
                        <input required="required" type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp"
                               placeholder="Enter email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>