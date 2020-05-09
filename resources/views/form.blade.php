<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input required name="name" id="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Phone</label>
            <input required name="phone" id="phone" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input required name="email" id="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <input type="hidden" name="id" id="id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="modalSubmit"></button>
      </div>
      </form>
    </div>
  </div>
</div>


<!--single user details view-->
<div class="modal fade" id="singleData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" id="myModalLabel" align="center"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 
      </div>
      <div class="modal-body">
        <ul class="list-group">
		  <li class="list-group-item">ID: <span class="text-danger" id="contactId"></span></li>
		  <li class="list-group-item">Name: <span class="text-danger" id="contactName"></span> </li>
		  <li class="list-group-item">Email: <span class="text-danger" id="contactPhone"></span></li>
		  <li class="list-group-item">Phone: <span class="text-danger" id="contactEmail"></span></li>
		</ul>
    </div>
  </div>
</div>