<?php
$title = "Edit Account";

include 'FunctionsCode/dbCode.php';
include 'Shared_Pages/header.php';
include 'Shared_Pages/navigation.php';


$data = getUserProfileData($_SESSION['userID']);

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Personal Info</h3>
                    </div>
                    <div class="card-body">
                        <form action="FunctionsCode/updateProfile.php" method="post">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" value="<?php echo $data['firstName']; ?>" class="form-control" maxlength="30" required />
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" id="lname" value="<?php echo $data['lastName']; ?>" class=" form-control" maxlength="30" required />
                            </div>
                            <div class="form-group">
                                <label for="uname">Username</label>
                                <input type="text" name="uname" id="uname" value="<?php echo $data['username']; ?>" class=" form-control" maxlength="20" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" value="<?php echo $data['email']; ?>" class=" form-control" maxlength="60" required />
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" value="<?php echo $data['phone']; ?>" class=" form-control" minlength="10" maxlength="10" required />
                            </div>
                            <div class="form-group">
                                <label for="dateCreated">Joined Since</label>
                                <input type="text" name="dateCreated" id="dateCreated" readonly value="<?php echo $data['joinDate']; ?>" class=" form-control" />
                            </div>
                            <div class="form-group">
                                <input type="reset" value="Reset" class="btn btn-secondary" />
                                <input type="submit" name="updateInfo" value="Update" class="btn btn-success float-right" />
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- footer -->
<?php include 'Shared_Pages/footer.php'; ?>