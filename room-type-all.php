<?php
$currentPage ='all_Room_Type';
include "functions/db.php";
include "functions/functions.php";
include "includes/header.php";
//for retrieving all room .. for view all room
function readAllRoomTypes(){
global $connection;
global $room_Type_ID;

    $query = "SELECT * FROM room_Type";

    $result = mysqli_query($connection, $query);

    if(!$result){
        die('Query failed.' . mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($result)){

        $room_Type_ID = $row['room_Type_ID'];

        echo "<tr>";
        echo "<td>" .$row['room_Type_ID'];
        echo "<td>" .$row['room_Type_Name'];
        echo '<td><a href="room-type-edit.php?id='."{$room_Type_ID}".'"><i class="fa fa-eye" aria-hidden="true"></i></a>';
        echo "<td><a href='#confirmDelete?id=$room_Type_ID'><i  class='fa fa-trash-o' aria-hidden='true' data-toggle='modal' data-target='#confirmDelete'></i></a>";
        echo "</tr>";
    }
}

//for deleting room
function deleteRoomType(){
global $connection;

if(isset($_POST['delete'])){
$id = $_GET['id'];

$query = "SELECT * FROM room_type WHERE room_Type_ID='$id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$type= $row['room_Type_Name'];


$sel = mysqli_query($connection,"select * from room where room_Type = '$type' ") or die(mysqli_error());
$sel = mysqli_num_rows($sel);

if ($sel >= 1){
    
    echo "<script>alert('Error 404: Cannot Delete Entry! Room type still used in other table/s.'); window.location='room-type-all.php';</script>";
    

}else{
    $result = mysqli_query($connection, "DELETE FROM room_Type WHERE room_Type_ID = '$id'");
    if(!$result){
        die('Query failed.' . mysqli_error($connection));
    }else{
        session_start();
        $_SESSION['status'] = "Room type successfully deleted!";
        echo'<script>window.location="room-type-all.php";</script>';
    }
}
}
}
?>

                <div class="sb2-2-3">
                    <div class="row">
                        <!--== MAIN CONTAINER ==-->
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>View All Room Types</h4>
                                    <a class='dropdown-button drop-down-meta' href='#' data-activates='dropdown1'><i class="material-icons">more_vert</i></a>
                                    <!-- Dropdown Structure -->
                                    <ul id='dropdown1' class='dropdown-content'>
                                        <li><a href="room-add.php">Add New</a>
                                        </li>
                                    </ul>
                                </div> 
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi"><strong>
                                     <div class="row col s12">
                                    <?php if(isset($_SESSION['status'])){?>
                                        <div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong><?php echo $_SESSION['status']; ?></a></div>
                                    <?php unset($_SESSION['status']);}?>
                                    </div>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Room Type ID</th>
                                                    <th>Room Type Name</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php readAllRoomTypes();?>
                                            </tbody>
                                        </table>
                                        
<?php include "includes/modal_DeleteRoomType.php"; ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    </div>

<?php include "includes/footer.php"; ?>