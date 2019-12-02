<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jere Leskinen, Matleena Laitila, Samuli Reinikka, Marika Piuva">
    <title>Recibo - reseptikirja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/tyylit.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
   </head>
  <body class="bg" style="background-image: url('css/salad.jpg');">
  <h1>
    Recibo <small>Reseptejä joka hetkeen</small>
  </h1>
  <div class="container-fluid">
    <div class="row">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php">Etusivu<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="random.php">Arvo resepti</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="save.php">Lisää resepti</a>
                  </li>
                </ul>
              </div>
            </nav>
      </div>
    </div>

    <div class="s009">
      <form>
        <div class="inner-form indexform">
          <div class="basic-search">
            
          </div>
          <div class="advance-search">
            <h2 class="desc">Etsi reseptejä</h2>
            <div class="row">
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Ruokavalio</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Reseptiryhmä</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Ainesosa</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row third">
              <div class="input-field">
              <div class="result-count"></div>
                <div class="group-btn">
                  <button class="btn-delete" id="delete">Tyhjennä</button>
                  <button class="btn-search">Etsi</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <script src="js/extention/choices.js"></script>
    <script>
      const customSelects = document.querySelectorAll("select");
      const deleteBtn = document.getElementById('delete')
      const choices = new Choices('select',
      {
        searchEnabled: false,
        itemSelectText: '',
        removeItemButton: true,
      });
      deleteBtn.addEventListener("click", function(e)
      {
        e.preventDefault()
        const deleteAll = document.querySelectorAll('.choices__button')
        for (let i = 0; i < deleteAll.length; i++)
        {
          deleteAll[i].click();
        }
      });

    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>