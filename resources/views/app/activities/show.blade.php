<?php
/**
 * Created by PhpStorm.
 * User: impact
 * Date: 2019-04-04
 * Time: 21:56
 */


?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <p>
        {{ $activity->id }}
    </p>
    <p>{{ $activity->title }}</p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div>



