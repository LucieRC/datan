<?php

class Newsletter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('newsletter_model');
        $this->load->model('votes_model');
    }

    public function edit($email){

        if (strpos($email, '@') !== false) {
          redirect('newsletter/edit/' . urlencode($email));
        }

        $data['newsletter'] = $this->newsletter_model->get_by_email(urldecode($email));
        if (!isset($data['newsletter'])) {
          show_404();
        }

        $data['lists'] = array(
          array(
            'label' => 'Newsletter principale',
            'name' => 'general',
            'mailjetId' => 25834
          ),
          array(
            'label' => 'Newsletter votes',
            'name' => 'votes',
            'mailjetId' => 47010
          )
        );

        // Meta
        $data['url'] = $this->meta_model->get_url();
        $data['title_meta'] = "Gestion des abonnements aux newsletters | Datan";
        $data['description_meta'] = "Mettez à jour vos abonnements aux différentes newsletters de Datan.";
        $data['title'] = 'Mettre à jour vos abonnements';

        if ($this->input->post()) {
          foreach ($data['lists'] as $list) {
            $data[$list['name']] = $this->input->post($list['name']);
            $data[$list['name']] = $data[$list['name']] == "on" ? 1 : 0;
            if ($data[$list['name']] != $data['newsletter'][$list['name']]) {
              $this->newsletter_model->update_list(urldecode($email), $data[$list['name']], $list['name']);
              // API
              if ($data[$list['name']] == 1) {
                sendContactList(urldecode($email), $list['mailjetId']);
              } else {
                removeContactlist(urldecode($email), $list['mailjetId']);
              }
            }
          }


          $this->load->view('templates/header', $data);
          $this->load->view('newsletter/edit_success');
          $this->load->view('templates/footer', $data);

        } else {
          $this->load->view('templates/header', $data);
          $this->load->view('newsletter/edit');
          $this->load->view('templates/footer', $data);
        }
    }

    public function update(){
      $lists = array(
        array(
          "sql" => "general",
          "mailjet" => 25834
        ),
        array(
          "sql" => "votes",
          "mailjet" => 47010
        )
      );

      foreach ($lists as $list) {
        $contactsSql = $this->newsletter_model->get_all_by_list($list['sql']);
        foreach ($contactsSql as $contact) {
          $response = getContactLists($contact['email']);
          if ($response->success()) {
            $responseLists = $response->getData();
            foreach ($responseLists as $responseList) {
              if (($responseList['ListID'] == $list['mailjet']) && ($responseList['IsUnsub'])) {
                $this->newsletter_model->update_list($contact['email'], NULL, $list['sql']);
              }
            }
          }
        }
      }
    }

    public function delete($email){
      $data['email'] = $email;
      $data['url'] = $this->meta_model->get_url();
      $data['title_meta'] = "Désinscription à la newsletter | Datan";
      $data['title'] = 'Désinscription à la newsletter';
      $response = getContactId($email);
      if ($response->success()) {
        $emailId = $response->getData()[0]["ContactID"];
        removeContactlist($emailId, 25834);
      }
      $lists = array('general', 'votes');
      $this->newsletter_model->delete(urldecode($email), $lists);
      $data['message'] = 'Vous ne recevrez plus nos newsletters, c\'est dommage mais n\'hésitez pas à revenir pour connaitre l\'activité de vos députés !';

      // Views
      $this->load->view('templates/header', $data);
      $this->load->view('newsletter/delete', $data);
      $this->load->view('templates/footer', $data);
    }

    public function votes(){
      // Do not forget to install this: https://qferrer.medium.com/rendering-mjml-in-php-982d703aa703

      // Data for the newsletter
      setlocale(LC_TIME, "fr_FR");
      $data['month'] = utf8_encode(strftime("%B"));
      $data['year'] = utf8_encode(strftime("%Y"));
      $year = date("Y");
      $month = date("m");
      $month = 7;
      $data['votesN'] = $this->votes_model->get_n_votes(legislature_current(), $year, $month);
      $data['votesNDatan'] = $this->votes_model->get_n_votes_datan(legislature_current(), 2020, 9);
      $data['votesInfos'] = $this->votes_model->get_infos_period(legislature_current(), $year, $month);
      if ($data['votesInfos']['adopted'] > $data['votesInfos']['rejected']) {
        $data['votesInfosEdited'] = "La majorité de ces votes a été adoptée : il y a eu " . $data['votesInfos']['adopted'] . " votes adoptés par les députés en " . $data['month'] . " " .  $year . ", contre seulement " . $data['votesInfos']['rejected'] . " votes rejetés.";
      } elseif ($data['votesInfos']['adopted'] < $data['votesInfos']['rejected']) {
        $data['votesInfosEdited'] = "La majorité de ces votes a été rejetée : il y a eu " . $data['votesInfos']['rejected'] . " votes rejetés par les députés en " . $data['month'] . " " .  $year . ", contre seulement " . $data['votesInfos']['adopted'] . " votes adoptés.";
      } else {
        $data['votesInfosEdited'] = NULL;
      }
      $data['votes'] = $this->votes_model->get_votes_datan(legislature_current(), 2020, 9);

      foreach ($data['votes'] as $key => $value) {
        $string = substr($value['description'], 0, strpos($value['description'], "</p>")+4);
        $string = strip_tags($string);
        $data['votes'][$key]['description'] = $string;
      }




      // Metadata
      $data['title'] = "Les votes de l'Assemblée nationale - " . $data['month'] . " " . $data['year'] . " | Newsletter Datan";

      // Create the MJML/HTML newsletter
      $header = $this->load->view('newsletterTemplates/templates/header', $data, TRUE);
      $body = $this->load->view('newsletterTemplates/votes/body', $data, TRUE);
      $footer = $this->load->view('newsletterTemplates/templates/footer', $data, TRUE);
      $mjml = $header." ".$body." ".$footer;
      $html = getMjmlHtml($mjml);
      echo $html;

      // Send emails
      $emails = $this->newsletter_model->get_emails("votes");
      foreach ($emails as $email) {
      //sendMail($email['email'], 'Bienvenue à la newsletter', $templateHtml = $html, $templateLanguage = TRUE, $templateId = NULL, $variables = NULL);
      }

    }
}
