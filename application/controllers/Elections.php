<?php
  class Elections extends CI_Controller{
    public function __construct() {
      parent::__construct();
      $this->load->model('elections_model');
      //$this->password_model->security_password(); Former login protection
    }

    public function index(){
      // Data
      $data['elections'] = $this->elections_model->get_election_all();
      $data['electionsColor'] = $this->elections_model->get_election_color();

      // Breadcrumb
      $data['breadcrumb'] = array(
        array(
          "name" => "Datan", "url" => base_url(), "active" => FALSE
        ),
        array(
          "name" => "Élections", "url" => base_url()."elections", "active" => TRUE
        )
      );

      $data['breadcrumb_json'] = $this->breadcrumb_model->breadcrumb_json($data['breadcrumb']);
      // Meta
      $data['url'] = $this->meta_model->get_url();
      $data['title_meta'] = "Les élections en France - Candidats et résultats | Datan";
      $data['description_meta'] = "Retrouvez toutes les informations sur les différentes élections en France (présidentielle, législative, régionales). Découvrez les députés candidats et les résultats.";
      $data['title'] = "Les élections politiques en France";
      //Open Graph
      $controller = $this->router->fetch_class()."/".$this->router->fetch_method();
      $data['ogp'] = $this->meta_model->get_ogp($controller, $data['title_meta'], $data['description_meta'], $data['url'], $data);
      // Load Views
      $this->load->view('templates/header', $data);
      $this->load->view('elections/index', $data);
      $this->load->view('templates/breadcrumb', $data);
      $this->load->view('templates/footer', $data);
    }

    public function individual($slug){
      $data['election'] = $this->elections_model->get_election($slug);

      if (empty($data['election'])) {
        show_404();
      }

      // Data
      $data['deputes'] = $this->elections_model->get_all_candidate($data['election']['id'], TRUE);
      $data['districts'] = $this->elections_model->get_all_districts($data['election']['id']);
      $data['electionInfos'] = $this->elections_model->get_election_infos($data['election']['libelleAbrev']);
      $data['election']['candidatsN'] = count($data['deputes']);

      // Breadcrumb
      $data['breadcrumb'] = array(
        array(
          "name" => "Datan", "url" => base_url(), "active" => FALSE
        ),
        array(
          "name" => "Élections", "url" => base_url()."elections", "active" => FALSE
        ),
        array(
          "name" => $data['election']['libelleAbrev'] . " " . $data['election']['dateYear'], "url" => base_url()."elections/" . $data['election']['slug'], "active" => TRUE
        )
      );

      $data['breadcrumb_json'] = $this->breadcrumb_model->breadcrumb_json($data['breadcrumb']);
      // Meta
      $data['url'] = $this->meta_model->get_url();
      $data['title_meta'] = "Les " . mb_strtolower($data['election']['libelle']) . " de " . $data['election']['dateYear'] . " - Candidats et résultats | Datan";
      $data['description_meta'] = "Retrouvez toutes les informations sur les " . mb_strtolower($data['election']['libelle']) . " de " . $data['election']['dateYear'] . " en France. Découvrez les députés candidats et les résultats.";
      $data['title'] = "Les " . mb_strtolower($data['election']['libelle']) . " de " . $data['election']['dateYear'];
      //Open Graph
      $controller = $this->router->fetch_class()."/".$this->router->fetch_method();
      $data['ogp'] = $this->meta_model->get_ogp($controller, $data['title_meta'], $data['description_meta'], $data['url'], $data);
      // CSS
      $data['css_to_load']= array(
        array(
          "url" => asset_url() . "css/jquery-jvectormap-2.0.5.css",
          "async" => FALSE
        )
      );
      // JS
      $data['js_to_load_before_datan'] = array("isotope.pkgd.min");
      if (count($data['districts']) <= 25) {
        $data['js_to_load'] = array("datan/sorting");
      } else {
        $data['js_to_load'] = array("datan/sorting_select");
      }
      array_push($data['js_to_load'], "jvectormap/jquery-jvectormap-2.0.5.min", "jvectormap/jquery-jvectormap-fr_regions_2016-merc");
      // Load Views
      $this->load->view('templates/header', $data);
      $this->load->view('templates/button_up');
      $this->load->view('elections/candidats', $data);
      $this->load->view('templates/breadcrumb', $data);
      $this->load->view('templates/footer', $data);
    }
  }
?>
