<?php include('partials/header.php'); ?>

<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    
    $sql="SELECT * FROM tbl_order WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);

    $food=$row['food'];
    $price=$row['price'];
    $qty=$row['qty'];
    $status=$row['status'];
    $customer_name=$row['customer_name'];
    $customer_email=$row['customer_email'];
    $customer_contact=$row['customer_contact'];
    $customer_address=$row['customer_address'];
}
else
{
    header('location:'.SITEURL.'admin/manage_order.php');
}
?>



<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="tbl-30">
                <tr>
                    <td>Food:</td>
                    <td>
                        <b><?php echo $food ;?></b>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <b><?php echo "Rp ".$price ;?></b>
                    </td>
                </tr>

                <tr>
                    <td>Quantity:</td>
                    <td>
                        <input type="number" class="boks" name="qty" value="<?php echo $qty ;?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Order"){echo "selected";} ?> value="Order">Order</option>
                            <option <?php if($status=="Delivery"){echo "selected";} ?> value="Delivery">Delivery</option>
                            <option <?php if($status=="Cancel"){echo "selected";} ?> value="Cancel">Cancel</option>
                            <option <?php if($status=="Finish"){echo "selected";} ?> value="Finish">Finish</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" class="boks" name="customer_name" value="<?php echo $customer_name ;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer E-mail:</td>
                    <td>
                        <input type="email" class="boks" name="customer_email" value="<?php echo $customer_email ;?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" class="boks" name="customer_contact" value="<?php echo $customer_contact ;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address ;?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" class="btn-primary" value="Update Order">
                        <input type="hidden" name="food" value="<?php echo $food; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
            </table>            
        </form>

        <?php

            if(isset($_POST['submit']))
            {   
                $food=$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price*$qty;
                $status=$_POST['status'];
                $customer_name=$_POST['customer_name'];
                $customer_email=$_POST['customer_email'];
                $customer_contact=$_POST['customer_contact'];
                $customer_address=$_POST['customer_address'];

                $sql0 = "UPDATE tbl_order SET
                    food='$food',
                    price=$price,
                    qty=$qty,
                    total=$total,
                    status='$status',
                    customer_name='$customer_name',
                    customer_email='$customer_email',
                    customer_contact='$customer_contact',
                    customer_address='$customer_address' 
                    WHERE id=$id
                    ";
                $res0 = mysqli_query($conn,$sql0);

                if($res0==true)
                {
                    $_SESSION['update'] = "<div class='success'>Update Order Succeed.</div>";
                    header('location:'.SITEURL.'admin/manage_order.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='failed'>Update Order Failed.</div>";
                    header('location:'.SITEURL.'admin/manage_order.php');
                }

            }
        ?>



    </div>
</div>

<?php include('partials/footer.php'); ?>
