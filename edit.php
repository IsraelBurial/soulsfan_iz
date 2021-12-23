    
<?php
    $title = 'Edit Record'; 

    require_once 'includes/header.php'; 
    require_once 'includes/auth_check.php';
    require_once 'db/conn.php'; 

    $results = $crud->getGenders();

    if(!isset($_GET['id']))
    {
        //echo 'error';
        include 'includes/errormessage.php';
        header("Location: viewrecords.php");
    }
    else{
        $id = $_GET['id'];
        $attendee = $crud->getFanDetails($id);
    

    
?>

    <h1 class="text-center">Edit Record </h1>

    <form method="post" action="editpost.php">
        <input type="hidden" name="id" value="<?php echo $fan['fan_id'] ?>" />
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" value="<?php echo $fan['firstname'] ?>" id="firstname" name="firstname">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" value="<?php echo $fan['lastname'] ?>" id="lastname" name="lastname">
        </div>
        <div class="form-group">
            <label for="dob">Date Of Birth</label>
            <input type="text" class="form-control" value="<?php echo $fan['dateofbirth'] ?>" id="dob" name="dob">
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <?php while($r = $results->fetch(PDO::FETCH_ASSOC)) {?>
                   <option value="<?php echo $r['gender_id'] ?>" <?php if($r['gender_id'] == $fan['gender_id']) echo 'selected' ?>>
                        <?php echo $r['name']; ?>
                   </option>
                <?php }?>
            </select>
        </div>
        <!-- <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" value="<?php echo $fan['emailaddress'] ?>" name="email" aria-describedby="emailHelp" >
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div> -->
        <div class="form-group">
            <label for="phone">Contact Number</label>
            <input type="text" class="form-control" id="phone" value="<?php echo $fan['contactnumber'] ?>" name="phone" aria-describedby="phoneHelp" >
            <small id="phoneHelp" class="form-text text-muted">We'll never share your number with anyone else.</small>
        </div>
        
        <a href="viewrecords.php" class="btn btn-default">Back To List</a>
        <button type="submit" name="submit" class="btn btn-success">Save Changes</button>
    </form>

<?php } ?>
<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>