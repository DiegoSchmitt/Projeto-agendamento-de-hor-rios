	<div class="conteudo">
		<div class="container">
<?php
	require 'pages/header.php';
?>
		<div id="slide" class="slide carousel">
			<ol class="carousel-indicators">
				<li data-target="#slideshowExemplo" data-slide-to="0" class="active"></li>
				<li data-target="#slideshowExemplo" data-slide-to="1"></li>
				<li data-target="#slideshowExemplo" data-slide-to="2"></li>
				<li data-target="#slideshowExemplo" data-slide-to="3"></li>
			</ol>

			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="" class="w-100"/>
				</div>
				<div class="carousel-item">
					<img src="" class="w-100"/>
				</div>	
				<div class="carousel-item">
					<img src="" class="w-100"/>
				</div>	
				<div class="carousel-item">
					<img src="" class="w-100"/>
				</div>					
			</div>
			<a class="carousel-control-prev" href="#slide" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>					
			</a>
			<a class="carousel-control-next" href="#slide" data-slide="next">
				<span class="carousel-control-next-icon"></span>					
			</a>	
		</div>
	</div>
	<?php require 'pages/footer.php';?>
</div>
</body>
</html>