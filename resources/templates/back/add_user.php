
<?php add_user(); ?>

<div class="row">
<h1 class="page-header">
   Add user <span class="glyphicon glyphicon-user"></span>
</h1>
</div>



<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Username </label>
        <input type="text" name="username" class="form-control" required="required">

    </div>

    <div class="form-group">
        <label for="product-title">Email </label>
            <input type="text" name="email" class="form-control" required="required">

        </div>

        <div class="form-group">
            <label for="product-title">Password </label>
                <input type="password" name="password" class="form-control" required="required">

            </div>


                <div class="form-group">
                    <label for="product-title">User Image</label>
                    <input type="file" name="file">

                </div>

                <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" required="required">

                    </div>

</aside><!--SIDEBAR-->



</form>
