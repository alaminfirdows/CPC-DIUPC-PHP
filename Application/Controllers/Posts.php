<?php
/*
*   Project:    CPC DIU PC
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Posts extends Controller
{

    public function index()
    {
        header('Location: ' . base_url());
        exit();
    }

    public function details($id)
    {
        if (!isset($id) || empty($id)) {
            header('Location: ' . base_url());
            exit();
        }
        $post_model = $this->load_model('Post_Model');
        $user_model = $this->load_model('User_Model');
        $subscriber_model = $this->load_model('Subscriber_Model');

        $post_author = $user_model->getUserByPostId($id);
        $post = $post_model->getPostByID($id);
        if ($post->status != 1) {
            header('Location: ' . base_url());
            exit();
        }

        $status = 0;
        $authorId = NULL;
        $subscriberId = NULL;

        if (isset($_POST['submit-comment']) || isset($_POST['submit-comment'])) {
            if (isset($_POST['authorId']) && !empty($_POST['authorId'])) {
                $authorId = $this->secure_input($_POST['authorId']);
                $status = 1;
            } else {
                $subscriber_data = array(
                    'name' => $this->secure_input($_POST['name']),
                    'email' => $this->secure_input($_POST['email']),
                    'ip' => $this->secure_input($_POST['ip'])
                );
                $subscriberId = $subscriber_model->insertSubscriberForComment($subscriber_data)['subscriberId'];
                $status = 0;
            }

            $comment_data = array(
                'postId' => $id,
                'authorId' => $authorId,
                'subscriberId' => $subscriberId,
                'body' => $this->secure_input($_POST['body']),
                'status' => $status
            );

            $add_comment = $post_model->insertComment($comment_data);

            if ($add_comment) {
                if ($subscriberId != NULL) {
                    set_flush_data('comment_responce', 'Your Comment is Added! It will be publish by our Moderator.');
                } else if ($authorId != NULL) {
                    set_flush_data('comment_responce', 'Your Comment is Added!');
                } else {
                    set_flush_data('comment_responce', 'Something Wrong!');
                }
            } else {
                set_flush_data('comment_responce', 'Something Wrong!');
            }
        }
        $data = array(
            'post_data' => $post,
            'post_author' => $post_author->firstName . ' ' . $post_author->lastName,
            'post_cat' => $post_model->getCategoryByID($post->category)->name,
            'related_posts' => $post_model->getRelatedPostByPostID($id),
            'comnents' => $post_model->getCommentsByPostID($id),
            'popular_posts' => $post_model->getPopularPostsWithAllMeta(6),
        );

        $this->view("template-part/header");
        $this->view("single", $data);
        $this->view("template-part/footer");
    }
}