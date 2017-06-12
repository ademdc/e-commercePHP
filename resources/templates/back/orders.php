
<div class="row">
<h1 class="page-header">
   All Orders
   <h4><?php displayMessage(); ?></h4>
</h1>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>id</th>
           <th>Amount</th>
           <th>Transaction</th>
           <th>Currency</th>
           <th>Status</th>
      </tr>
    </thead>
    <tbody>
        <?php display_orders(); ?>


    </tbody>
</table>
</div>
