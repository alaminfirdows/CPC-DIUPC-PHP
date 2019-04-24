<?php
/*
*   Project:    Stage4CancerCommunity
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Category extends Controller {

  public function index() {
    header('Location: ' . base_url(''));
      exit();
  }
  public function posts($id='') {
    if (!$id == '') {
      $post_model = $this->load_model('Post_Model');
      $data = array(
        'category_posts' => $post_model->getCategoryPosts($id)
      );
      $this->view("template-part/header");
      $this->view("category", $data);
      $this->view("template-part/footer");
    } else {
      header('Location: ' . base_url(''));
      exit();
    }
  }
}
?>