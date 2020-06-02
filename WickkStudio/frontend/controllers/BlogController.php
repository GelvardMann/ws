<?php

namespace frontend\controllers;

use app\models\blog\Blog;

class BlogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $blog = new Blog();
        $posts = $blog->getAllPosts();
        $latestPosts = $blog->getPosts();
        return $this->render('index', [
            'posts' => $posts,
            'latestPosts' => $latestPosts
        ]);
    }

    public function actionView($id)
    {
        $blog = new Blog();
        $data = $blog->getOnePost($id);
        $latestPosts = $blog->getPosts();
        return $this->render('view', [
            'data' => $data,
            'latestPosts' => $latestPosts
        ]);
    }



}
