

<h1 class="page-header">
   All Products

</h1>
<table class="table table-hover">

<h3 class="bg-success"><?php displayMessage(); ?></h3>
    <thead>

      <tr>
           <th>Id</th>
           <th>Title</th>
           <th>Category</th>
           <th>Price</th>
           <th>Quanity</th>
      </tr>
    </thead>
    <tbody>

      <?php get_products_in_admin(); ?>



  </tbody>
</table>
