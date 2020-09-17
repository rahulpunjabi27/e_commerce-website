
<h1 class="page-header">
   All Products

</h1>
<h4 class="bg-success"><?php display_message(); ?></h4>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Report id</th>
           <th>product id</th>
           <th>order id</th>
           <th>Price</th>
           <th>product title</th>
           <th>product quantity</th>
      </tr>
    </thead>
    <tbody>
      <?php get_report(); ?>
    </tbody>
</table>



       