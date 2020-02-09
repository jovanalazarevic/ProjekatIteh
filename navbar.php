<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	       <a class="navbar-brand" href="#">Utakmica</a>
	    </div>
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      <?php 
	      	if($_SESSION['admin'] ==0){
				?>
					<li class="active"><a href="index.php">Utakmice <span class="sr-only">(current)</span></a></li>
	        		<li><a href="tiket.php">Tiket</a></li>
	        		<li><a href="mojiTiketi.php">Moji tiketi</a></li>
	        		<li><a href="transferi.php">Transferi</a></li>
	      		<?php
	      	} else {
	      		?>
					<li class="active"><a href="admin.php">Panel <span class="sr-only">(current)</span></a></li>
	        		<li><a href="dodajTim.php">Dodaj Tim</a></li>
	        		<li><a href="dodajUtakmicu.php">Dodaj Utakmicu</a></li>
	        		<li><a href="odigraneUtakmice.php">Odigrane utakmice</a></li>
	      		<?php
	      	}
	       ?>
	        
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="logout.php">Logout</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>