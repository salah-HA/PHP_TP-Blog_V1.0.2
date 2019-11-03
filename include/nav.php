<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container nav-container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Nav
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php">Accueil</a>
            </li>
          </ul>
          
            <?php
            if(isset($_SESSION['username'])){
            ?>
              <li class="nav-item"> 
                <a class="nav-link" href="index.php?action=admin">Acces administration </a>
              </li>
              <button type="submit" class="btn btn-primary">
                <a href="index.php?action=logout">Se déconnecter</a>
              </button>
              <?php
            }
            else{
              ?>
                <li><a class="nav-link" href="index.php?action=creationUser">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" class="button-connect">Créer un compte</button>
                </a></li>
              <li class="nav-item">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" class="button-connect">Connexion</button>
            </li> 
          <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
     <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in">BLOG</div>
          <div class="intro-heading text-uppercase">"Tchiki-Tchikita, Tchiki-Tchikita, Tchiki-Tchikita" Jul</div>
      </div>
    </header>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="input-group">
          <?php include("include/login.php"); ?>
      </div>
      </div>
    </div>
  </div>
 





