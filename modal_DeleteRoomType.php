<?php include "functions/db.php"; ?>
<?php deleteRoomType(); ?>
<!-- Modal -->
<div id="confirmDelete" class="modal" role="dialog">
  <div class="modal-dialog">
    <form method="post">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Room Type</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this item?</p>
      </div>
    <!-- 
       <input type="text" name="delete_id" value="<?php $id = $_GET['id']; echo $id?>"> -->
       <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-default" name="delete">Delete</a>
        </form>
        
      </div>
    </div>

  </div>
</div>
