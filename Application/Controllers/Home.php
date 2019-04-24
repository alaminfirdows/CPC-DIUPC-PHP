<?php
/*
*   Project:    Stage4CancerCommunity
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Home extends Controller
{
    public function index()
    {
        $post_model = $this->load_model('Post_Model');
        $data = array(
            'recent_posts' => $post_model->getAllPublishedPostsWithAllMeta(10),
            'hot_posts' => array(
                'post_1' => $post_model->getPostByIDWithAllMeta(1),
                'post_2' => $post_model->getPostByIDWithAllMeta(2),
                'post_3' => $post_model->getPostByIDWithAllMeta(3),
                'post_4' => $post_model->getPostByIDWithAllMeta(4),
                'post_5' => $post_model->getPostByIDWithAllMeta(5)
            ),
            'popular_posts' => $post_model->getPopularPostsWithAllMeta(6),
        );
        $this->view("template-part/header");
        $this->view("index", $data);
        $this->view("template-part/footer");
    }
}
?>