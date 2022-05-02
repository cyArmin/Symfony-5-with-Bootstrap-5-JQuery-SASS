<?php 
    include 'quality.php';   
    
    //initialise default variable and then dynamic for frontend
    $selected = 'Bild auswählen';
    if($_REQUEST['image']) $selected = $_REQUEST['image'];
    
    $backgroundColor = 'D1C200';
    if($_REQUEST['background']) $backgroundColor = $_REQUEST['background'];
    
    $textColor = '000066';
    if($_REQUEST['font']) $textColor = $_REQUEST['font'];
    
    $canvasColor = '6EF761';
    if($_REQUEST['canvas']) $canvasColor = $_REQUEST['canvas'];
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Screensaver</title>
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <script src="../../js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- NAVBAR STARTS HERE -->
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
              <div class="container-fluid">
                <span class="navbar-brand">Armin's Test Area</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="../own_modal">Modal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="../CSS_Grid">CSS Grid</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="">Screensaver</a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
        
        <!-- NAVBAR ENDS HERE -->
        
        <!-- CONTENT STARTS HERE -->
        <div class="container" style="margin-top: 8%;">
            <div class="container-md"><!--margin einbinden-->
                <h2 class="text-muted">Dynamische Bilderstellung mit PHP</h2>
                    <?php 
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($imagedata).'" width="960" height="540" style="box-shadow: 0 6px 8px 0 gray;"/>';
                    ?>
                <br><br>
                <a href="/armin/testArea/screensaver" class="link-info">Reset</a>
                <hr>
                <form action="" method="post">
                    <select name="image" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected><?= $selected ?></option>
                        <option value="matrixBild.jpg">Matrixbild</option>
                        <option value="world.png">Weltbild</option>
                    </select>
                    <br>
                    <label for="text">Stufe:</label>
                    <input name="text" id="to" placeholder="<?php echo $str_text; ?>">
                    <br><br>
                    <!-- Farbanpassung START-->
                    <label>Farbanpassung:</label>                    
                    
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Hintergrundfarbe
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <input name="background" id="to" placeholder="<?php echo $backgroundColor; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Textfarbe
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <input name="font" id="to" placeholder="<?php echo $textColor; ?>">
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Canvasfarbe
                              </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                <input name="canvas" id="to" placeholder="<?php echo $canvasColor; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Farbanpassung END-->
                    <br>
                    <div class="form-floating">
                          <textarea name="description" class="form-control"></textarea>
                          <label for="floatingTextarea">Beschreibungstext</label>
                        </div>
                    <br><br>
                    <input class="btn btn-secondary" type="submit" value="Bild laden">
                </form>
            </div>
        </div>
        
        <!-- CONTENT ENDS HERE -->
    </body>
</html>