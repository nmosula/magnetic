<?php
$page_name			= "shopping_cart";
?>
<div class="header">
           
	<h1 class="page-title">Групи товарів</h1>
	<ul class="breadcrumb">
		<li><a href="index.html">Головна</a> </li>
		<li><a href="?go=<?=$page_name?>">Корзина</a> </li>
		<li class="active">Перегляд</li>
	</ul>

</div>

<div class="main-content">

<?php
for ($id=1; $id<5; $id++)
{
?>
        <a href="#" class="btn btn-default CART-good-add" data-add-id="<?=$id?>"><i class="fa fa-shopping-cart"></i> Додати в кошик <?=$id?></a>
<?php
}
?>

<div class="modal fade" id="ModalShoppingCart" tabindex="-1" role="dialog" aria-labelledby="ModalShoppingCart-Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="ModalShoppingCart-Label">Кошик</h3>
        </div>
        <div class="modal-body" id="modal-body">


        </div>
        <div class="modal-footer">
			<button class="btn btn-danger CART-clean"><i class="fa fa-trash-o"></i> Очистити кошик</button>
			<button class="btn btn-success CART-order"><i class="fa fa-dollar"></i> Оформити замовлення</button>
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><i class="fa fa-shopping-cart"></i> Продовжити купівлю</button>
        </div>
      </div>
    </div>
</div>

</div>

	<script type="text/javascript">
		$(document).ready(function(){
		
			function CART_view()
			{  
					$.ajax({
						type: "POST",
						url: "shopping_cart_view.php",
						cache: false,

						success: function(html) {
							$("#modal-body").html(html);
						},
					});
			}  
				
			$(".CART-good-add").on("click", function() {			
					var add_id = $(this).data("add-id");				
					var dataString = 'add='+ add_id;
					
					$.ajax({
						type: "POST",
						url: "shopping_cart_check.php",
						data: dataString,
						cache: false,

						beforeSend: function() {
							$("#ajaxLoading").show();  
						}, 
						success: function() {
							CART_view();
						},
						complete: function() {
							$("#ajaxLoading").hide();
							$('#ModalShoppingCart').modal("show");
						}
					});
					return false;
			});
			
			$(".CART-clean").on("click", function() {
				if (confirm('Ви дійсно бажаєте очистити кошик?')) {
					var dataString	= 'clean=true';
					
					$.ajax({
						type: "POST",
						url: "shopping_cart_check.php",
						data: dataString,
						cache: false,

						success: function() {
							CART_view();
						},
					});
					return false;
				}
			});

		});
	</script>