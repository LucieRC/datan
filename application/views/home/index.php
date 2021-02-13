    <!-- BLOC SEARCHING FOR A MP BLOC-HEMYCICLE-HOME -->
    <div class="container-fluid bloc-hemycicle-home pg-home d-flex flex-column justify-content-around py-4 async_home" data-src="<?= asset_url() ?>imgs/cover/hemicycle-from-back.jpg" data-tablet="<?= asset_url() ?>imgs/cover/hemicycle-from-back-768.jpg" data-mobile="<?= asset_url() ?>imgs/cover/hemicycle-from-back-375.jpg">
      <div class="d-flex flex-column align-items-center">
        <h1 class="text-center">L'Assemblée nationale, enfin <span>compréhensible</span></h1>
      </div>
      <div class="row bloc-search-deputes mt-4">
        <div class="col-xl-6 col-lg-8 col-md-10 offset-xl-3 offset-lg-2 offset-md-1">
          <div class="card">
            <div class="card-header d-flex flex-row justify-content-center pt-4 pb-1">
              <h2>JE TROUVE MON DÉPUTÉ</h2>
            </div>
            <div class="card-header row pb-4">
              <div class="col-md-6 px-4">
                <div class="input-name pt-1">
                  <form autocomplete="off">
                    <div class="autocomplete">
                      <label class="pl-2" for="deputesNames">Son nom ?</label>
                      <input id="deputesNames" type="text" name="depute" placeholder='Exemple : <?= $depute_random['nameFirst'] .' ' . $depute_random['nameLast'] ?>'>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-6 px-4 mt-2 mt-md-0">
                <div class="input-commune pt-1">
                  <form autocomplete="off">
                    <div class="autocomplete" id="autocomplete">
                      <label class="pl-2" for="cities">Ma commune ?</label>
                      <input id="cities" type="text" name="cities" placeholder="Exemple : <?= $commune_random['commune_nom'] ?>">
                      <div id="citiesNamesautocomplete-list" class="autocomplete-items*">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-4 d-flex flex-column align-items-center">
        <a href="<?= base_url();?>deputes" class="no-decoration">
          <button type="button" class="btn btn-outline-light">Tous les députés</button>
        </a>
      </div>
    </div>
    <!-- END SEARCHING FOR MP -->
    <div class="container-fluid pg-home" id="container-always-fluid*">
      <!-- BLOC CONSTATS -->
      <div class="row bloc-constats py-4">
        <div class="container p-md-0">
          <div class="row py-4">
            <div class="col-12">
              <h2 class="text-center pb-4">Datan : un site de <b>vulgarisation parlementaire</b></h2>
              <div class="row pt-4">
                <!-- Constat -->
                <div class="d-flex align-items-start justify-content-center col-xl-5 col-md-6 col-12">
                  <div>
                    <h3 class="mb-3">Constat</h3>
                    <p>Il est difficile de <b>suivre l'activité</b> des députés <br>et de <b>savoir ce qu'ils votent</b></p>
                  </div>
                </div>
                <!-- Solution -->
                <div class="d-flex align-items-start justify-content-center col-md-6 col-xl-5 offset-xl-2 col-12">
                  <div>
                    <h3 class="mb-3">Solution</h3>
                    <p>Datan <b>explique les votes</b> <br>des députés et groupes politiques.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- VOTES CARDS -->
      <div class="row bloc-votes" id="pattern_background">
        <div class="container p-md-0">
          <div class="row py-4">
            <div class="col-12">
              <h2 class="text-center my-4">Derniers votes décryptés par Datan</h2>
            </div>
          </div>
          <div class="row bloc-carousel-votes-flickity"> <!-- CARDS -->
            <div class="col-12 carousel-cards">
              <?php foreach ($votes as $vote): ?>
                <div class="card card-vote">
                  <div class="thumb d-flex align-items-center <?= $vote['sortCode'] ?>">
                    <div class="d-flex align-items-center">
                      <span><?= mb_strtoupper($vote['sortCode']) ?></span>
                    </div>
                  </div>
                  <div class="card-header d-flex flex-row justify-content-between">
                    <span class="date"><?= $vote['dateScrutinFRAbbrev'] ?></span>
                  </div>
                  <div class="card-body d-flex align-items-center">
                    <span class="title">
                      <a href="<?= base_url() ?>votes/vote_<?= $vote['voteNumero'] ?>" class="stretched-link no-decoration"><?= $vote['voteTitre'] ?></a>
                    </span>
                  </div>
                  <div class="card-footer">
                    <span class="field badge badge-primary py-1 px-2"><?= $vote['category_libelle'] ?></span>
                  </div>
                </div>
              <?php endforeach; ?>
              <div class="card card-vote see-all">
                <div class="card-body d-flex align-items-center justify-content-center">
                  <a href="<?= base_url() ?>votes/decryptes" class="stretched-link no-decoration">VOIR TOUS</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4 mb-5"> <!-- BUTTONS BELOW -->
            <div class="col-12 d-flex justify-content-center">
              <div class="bloc-carousel-votes">
                <div class="carousel-buttons">
                  <button type="button" class="btn prev mr-2 button--previous" aria-label="précédent">
                    <?php echo file_get_contents(asset_url()."imgs/icons/arrow_left.svg") ?>
                  </button aria-label="tous">
                  <a class="btn all mx-2" href="<?= base_url() ?>votes/decryptes">
                    <span>VOIR TOUS</span>
                  </a>
                  <button type="button" class="btn next ml-2 button--next" aria-label="suivant">
                    <?php echo file_get_contents(asset_url()."imgs/icons/arrow_right.svg") ?>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- BLOC-HASARD -->
      <div class="row bloc-hasard">
        <div class="container pt-0">
          <div class="row py-5">
            <!-- DEPUTE AU HASARD CARD -->
            <div class="col-md-6 py-4">
              <h2>DÉPUTÉ<?= mb_strtoupper($depute_random['e']) ?> AU HASARD</h2>
              <div class="card card-depute">
                <div class="liseret" style="background-color: <?= $depute_random["couleurAssociee"] ?>"></div>
                <div class="card-avatar">
                  <img class="img-lazy" src="<?= asset_url() ?>imgs/placeholder/placeholder-face.png" data-src="<?= base_url(); ?>assets/imgs/deputes/depute_<?= substr($depute_random["mpId"], 2) ?>.png" alt="<?= $depute_random['nameFirst'].' '.$depute_random['nameLast'] ?>">
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                  <div>
                    <span class="d-block card-title my-2">
                      <a href="<?php echo base_url(); ?>deputes/<?php echo $depute_random['dptSlug'].'/depute_'.$depute_random['nameUrl'] ?>" class="stretched-link no-decoration"><?php echo $depute_random['nameFirst'] .' ' . $depute_random['nameLast'] ?></a>
                    </span>
                    <span class="d-block"><?= $depute_random["departementNom"] ?> (<?= $depute_random["departementCode"] ?>)</span>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-center align-items-center">
                  <span><?= $depute_random["libelle"] ?> (<?= $depute_random["libelleAbrev"] ?>)</span>
                </div>
              </div>
            </div>
            <!-- GROUPE AU HASARD CARD -->
            <div class="col-md-6 py-4">
              <h2>GROUPE AU HASARD</h2>
              <div class="card card-groupe">
                <div class="liseret" style="background-color: <?= $groupe_random["couleurAssociee"] ?>"></div>
                <div class="card-avatar group">
                  <img src="<?= asset_url() ?>imgs/groupes/<?= $groupe_random['libelleAbrev'] ?>.png" alt="<?= $groupe_random['libelle'] ?>">
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                  <span class="d-block card-title my-2">
                    <a href="<?= base_url(); ?>groupes/<?php echo mb_strtolower($groupe_random['libelleAbrev']) ?>" class="stretched-link no-decoration"><?php echo $groupe_random['libelle'] ?></a>
                  </span>
                  <span><?= $groupe_random["libelleAbrev"] ?></span>
                </div>
                <div class="card-footer d-flex justify-content-center align-items-center">
                  <span><?= $groupe_random["effectif"] ?> membres</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- BLOC STATS -->
      <div class="row bloc-statistiques">
        <div class="container py-3">
          <div class="row pt-5 pb-4">
            <div class="col-12">
              <h2 class="text-center">Ces 12 derniers mois</h2>
            </div>
          </div>
          <div class="row pb-5">
            <!-- VOTE LE PLUS -->
            <div class="col-xl-3 col-md-6 py-4">
              <h3>VOTE LE <span class="plus">PLUS</span></h3>
              <div class="card card-depute">
                <div class="liseret" style="background-color: <?= $depute_vote_plus["couleurAssociee"] ?>"></div>
                <div class="card-avatar">
                  <img class="img-lazy" src="<?= asset_url() ?>imgs/placeholder/placeholder-face.png" data-src="<?= base_url(); ?>assets/imgs/deputes/depute_<?= substr($depute_vote_plus["mpId"], 2) ?>.png" alt="<?= $depute_vote_plus['nameFirst'].' '.$depute_vote_plus['nameLast'] ?>">
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                  <div>
                    <span class="d-block card-title">
                      <a href="<?php echo base_url(); ?>deputes/<?php echo $depute_vote_plus['dptSlug'].'/depute_'.$depute_vote_plus['nameUrl'] ?>" class="stretched-link no-decoration"><?php echo $depute_vote_plus['nameFirst'] .' ' . $depute_vote_plus['nameLast'] ?></a>
                    </span>
                    <span class="d-block"><?= $depute_vote_plus["electionDepartement"] ?> (<?= $depute_vote_plus["electionDepartementNumero"] ?>)</span>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-center align-items-center">
                  <span><?= $depute_vote_plus["libelle"] ?> (<?= $depute_vote_plus["libelleAbrev"] ?>)</span>
                </div>
              </div>
            </div>
            <!-- VOTE LE MOINS -->
            <div class="col-xl-3 col-md-6 py-4">
              <h3>VOTE LE <span class="minus">MOINS</span></h3>
              <div class="card card-depute">
                <div class="liseret" style="background-color: <?= $depute_vote_moins["couleurAssociee"] ?>"></div>
                <div class="card-avatar">
                  <img class="img-lazy" src="<?= asset_url() ?>imgs/placeholder/placeholder-face.png" data-src="<?= base_url(); ?>assets/imgs/deputes/depute_<?= substr($depute_vote_moins["mpId"], 2) ?>.png" alt="<?= $depute_vote_moins['nameFirst'].' '.$depute_vote_moins['nameLast'] ?>">
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                  <div>
                    <span class="d-block card-title">
                      <a href="<?php echo base_url(); ?>deputes/<?php echo $depute_vote_moins['dptSlug'].'/depute_'.$depute_vote_moins['nameUrl'] ?>" class="stretched-link no-decoration"><?php echo $depute_vote_moins['nameFirst'] .' ' . $depute_vote_moins['nameLast'] ?></a>
                    </span>
                    <span class="d-block"><?= $depute_vote_moins["electionDepartement"] ?> (<?= $depute_vote_moins["electionDepartementNumero"] ?>)</span>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-center align-items-center">
                  <span><?= $depute_vote_moins["libelle"] ?> (<?= $depute_vote_moins["libelleAbrev"] ?>)</span>
                </div>
              </div>
            </div>
            <!-- PLUS LOYAL -->
            <div class="col-xl-3 col-md-6 py-4">
              <h3><?= mb_strtoupper($depute_loyal_plus['le']) ?> <span class="plus">PLUS</span> LOYAL<?= mb_strtoupper($depute_loyal_plus['e']) ?></h3>
              <div class="card card-depute">
                <div class="liseret" style="background-color: <?= $depute_loyal_plus["couleurAssociee"] ?>"></div>
                <div class="card-avatar">
                  <img class="img-lazy" src="<?= asset_url() ?>imgs/placeholder/placeholder-face.png" data-src="<?= base_url(); ?>assets/imgs/deputes/depute_<?= substr($depute_loyal_plus["mpId"], 2) ?>.png" alt="<?= $depute_loyal_plus['nameFirst'].' '.$depute_loyal_plus['nameLast'] ?>">
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                  <div>
                    <span class="d-block card-title">
                      <a href="<?php echo base_url(); ?>deputes/<?php echo $depute_loyal_plus['dptSlug'].'/depute_'.$depute_loyal_plus['nameUrl'] ?>" class="stretched-link no-decoration"><?php echo $depute_loyal_plus['nameFirst'] .' ' . $depute_loyal_plus['nameLast'] ?></a>
                    </span>
                    <span class="d-block"><?= $depute_loyal_plus["electionDepartement"] ?> (<?= $depute_loyal_plus["electionDepartementNumero"] ?>)</span>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-center align-items-center">
                  <span><?= $depute_loyal_plus["libelle"] ?> (<?= $depute_loyal_plus["libelleAbrev"] ?>)</span>
                </div>
              </div>
            </div>
            <!-- MOINS LOYAL -->
            <div class="col-xl-3 col-md-6 py-4">
              <h3><?= mb_strtoupper($depute_loyal_moins['le']) ?> <span class="minus">MOINS</span> LOYAL<?= mb_strtoupper($depute_loyal_moins['e']) ?></h3>
              <div class="card card-depute">
                <div class="liseret" style="background-color: <?= $depute_loyal_moins["couleurAssociee"] ?>"></div>
                <div class="card-avatar">
                  <img class="img-lazy" src="<?= asset_url() ?>imgs/placeholder/placeholder-face.png" data-src="<?= base_url(); ?>assets/imgs/deputes/depute_<?= substr($depute_loyal_moins["mpId"], 2) ?>.png" alt="<?= $depute_loyal_moins['nameFirst'].' '.$depute_loyal_moins['nameLast'] ?>">
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                  <div>
                    <span class="d-block card-title">
                      <a href="<?php echo base_url(); ?>deputes/<?php echo $depute_loyal_moins['dptSlug'].'/depute_'.$depute_loyal_moins['nameUrl'] ?>" class="stretched-link no-decoration"><?php echo $depute_loyal_moins['nameFirst'] .' ' . $depute_loyal_moins['nameLast'] ?></a>
                    </span>
                    <span class="d-block"><?= $depute_loyal_moins["electionDepartement"] ?> (<?= $depute_loyal_moins["electionDepartementNumero"] ?>)</span>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-center align-items-center">
                  <span><?= $depute_loyal_moins["libelle"] ?> (<?= $depute_loyal_moins["libelleAbrev"] ?>)</span>
                </div>
              </div>
            </div>
          </div>
          <div class="pb-5 d-flex justify-content-center">
            <a href="<?= base_url();?>statistiques" class="no-decoration">
              <button type="button" class="btn btn-outline-primary">Découvrez toutes nos statistiques</button>
            </a>
          </div>
        </div>
      </div> <!-- // END BLOC STATS -->
      <div class="row bloc-pie" id="pattern_background">
        <div class="container py-3">
          <div class="row pt-5">
            <div class="col-12">
              <h2 class="text-center">Composition de l'Assemblée nationale</h2>
            </div>
          </div>
          <div class="row pt-3">
            <div class="col-12">
              <p class="text-center">Découvrez le nombre de députés par groupe parlementaire.</p>
            </div>
          </div>
          <div class="row mt-5 mb-5">
            <div class="col-lg-7 d-flex justify-content-center align-items-center">
              <canvas id="chartHemycicle"></canvas>
            </div>
            <div class="col-lg-5 d-flex justify-content-center mt-5 mt-lg-0">
              <table class="tableGroupes">
                <tbody>
                  <?php foreach ($groupes as $groupe): ?>
                    <tr>
                      <td>
                        <div class="square" style="background-color: <?= $groupe['couleurAssociee'] ?>">
                        </div>
                      </td>
                      <td id="table<?= $groupe['libelleAbrev'] ?>">
                        <a href="<?= base_url() ?>groupes/<?= $groupe['libelleAbrev'] ?>" class="no-decoration underline"><?= $groupe['libelle'] ?></a>
                      </td>
                      <td class="effectif"><?= $groupe['effectif'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- BLOC POSTS -->
      <div class="row">
        <div class="container p-md-0">
          <div class="row py-5">
            <div class="col-lg-12 bloc-posts">
              <h2 class="text-center">L'actualité du Parlement</h2>
              <div class="row pt-4">
                <?php foreach ($posts as $post): ?>
                  <div class="col-12 col-md-6 offset-md-3 col-lg-12 offset-lg-0">
                    <div class="card card-post my-3">
                      <div class="row no-gutters">
                        <div class="col-auto img-wrap d-none d-lg-block">
                          <img class="img-lazy" src="<?= asset_url() ?>imgs/placeholder/placeholder.png" data-src="<?= asset_url() ?>imgs/posts/img_post_<?= $post['id'] ?>.png" alt="Image post <?= $post['id'] ?>">
                        </div>
                        <div class="col">
                          <div class="card-block p-3">
                            <span class="category mr-2"><?= mb_strtoupper($post['category_name']) ?></span>
                            <span class="date mr-2">Créé le <?= $post['created_at_fr'] ?></span>
                            <h2 class="card-title">
                              <a href="<?= base_url() ?>blog/<?= $post['category_slug'] ?>/<?= $post['slug'] ?>" class="stretched-link no-decoration"><?= $post['title'] ?></a>
                            </h2>
                            <p class="card-text"><?= word_limiter(Strip_tags($post['body']), 35) ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- // END BLOC POSTS -->
      <!-- FRANCE MAP -->
      <div class="row" id="pattern_background">
        <div class="container p-md-0">
          <div class="row py-5">
            <div class="col-lg-6 col-12 bloc-map mt-4 mt-lg-0 offset-lg-3">
              <h2 class="text-center pb-5">Explorer les députés par département</h2>
              <div class="map map_france mt-3">
                <?php echo file_get_contents(asset_url()."imgs/france_map/map.svg"); ?>
              </div>
              <div class="map map_outre_mer">
                <?php echo file_get_contents(asset_url()."imgs/france_map/outre-mer.svg"); ?>
              </div>
              <div class="mt-5 d-flex flex-column align-items-center">
                <a href="<?= base_url();?>index_departements" class="no-decoration">
                  <button type="button" class="btn btn-outline-primary">Liste de tous les départements</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function(){

      Chart.plugins.unregister(ChartDataLabels);
      var libelles = [
        <?php
        foreach ($groupesSorted as $groupe) {
          echo '"'.$groupe["libelleAbrev"].'",';
        }
         ?>
      ];

      var data = {
          labels: [
            <?php
            foreach ($groupesSorted as $groupe) {
              echo '"'.$groupe["libelle"].' ('.$groupe['libelleAbrev'].')",';
            }
             ?>
          ],
          datasets: [
              {
                  data: [
                    <?php
                    foreach ($groupesSorted as $groupe) {
                      echo $groupe["effectif"].",";
                    }
                     ?>
                  ],
                  backgroundColor: [
                    <?php
                    foreach ($groupesSorted as $groupe) {
                      echo '"'.$groupe["couleurAssociee"].'",';
                    }
                     ?>
                  ],
                  hoverBackgroundColor: [
                    <?php
                    foreach ($groupesSorted as $groupe) {
                      echo '"'.$groupe["couleurAssociee"].'",';
                    }
                     ?>
                  ]
              }]
      };

      var ctx = document.getElementById("chartHemycicle");

      // And for a doughnut chart
      var chartOptions = {
        responsive: true,
        maintainAspectRatio: true,
        rotation: 1 * Math.PI,
        circumference: 1 * Math.PI,
        legend: false,
        layout: {
          padding: 10
        },
        plugins: {
          datalabels: {
            anchor: "end",
            backgroundColor: function(context){
              return context.dataset.backgroundColor;
            },
            borderColor: "white",
            borderRadius: 25,
            borderWidth: 1,
            color: "white",
            font: {
              size: 10
            }
          }
        },
        onClick: function(e){
          if (screen.width >= 960) {
            var element = this.getElementsAtEvent(e);
            var idx = element[0]['_index'];
            var group = libelles[idx];
            location.href = 'https://datan.fr/groupes/' + group;
          }
        },
        hover: {
          onHover: function(x, y){
            const section = y[0];
            const currentStyle = x.target.style;
            currentStyle.cursor = section ? 'pointer' : 'default';
          }
        }
      }

      // Init the chart
      var pieChart = new Chart(ctx, {
        plugins: [
          ChartDataLabels,
          {
            beforeLayout: function(chart) {
              var showLabels = (chart.width) > 500 ? true : false;
              chart.options.plugins.datalabels.display = showLabels;
            }
          },
          {
            onresize: function(chart) {
              var showLabels = (chart.width) > 500 ? true : false;
              chart.options.plugins.datalabels.display = showLabels;
            }
          }
        ],
        type: 'doughnut',
        data: data,
        options: chartOptions,
      });

    });

    </script>