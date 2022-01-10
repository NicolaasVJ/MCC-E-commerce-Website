  <div class="modal" id="customerUpdateModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 p-2 px-3">
          <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body pb-2">
            <form method="POST" class="px-3" action="edit_customer.php">
                <h2 class="modal-title mb-3">Update Information</h2>
                
                <div class="form-group">
                    <label for="name">Name and Surname</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cell">Cell Number</label>
                    <input type="text" name="cell" id="cell" class="form-control" required>
                </div>
                <h6 class="modal-title mb-3 text-danger">Confirming will result in a logout</h6>
                <button type="submit" class="btn btn-info mt-4 btn-block py-2 mb-3 font-weight-bold text-uppercase" name="confirm">Confirm</button>
                </p>
            </form>
        </div>
      </div>
    </div>
  </div>