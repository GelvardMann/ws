<?php

namespace app\models\blog;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $date
 * @property string $links
 * @property string $image
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'date', 'links', 'image'], 'required'],
            [['content', 'links'], 'string'],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'date' => 'Date',
            'links' => 'Links',
            'image' => 'Image',
        ];
    }

    public function getPosts() {

        return $this::find()->orderBy('id desc')->limit(3)->all();
    }

    public function getAllPosts() {
        $query = Blog::find();
        $data['pages'] = new Pagination(
            [
                'totalCount' => $query->count(),
                'pageSize' => 10,
                'forcePageParam' => false,
                'pageSizeParam' => false,
                ]);
        $data['posts'] = $query->offset($data['pages']->offset)
            ->limit($data['pages']->limit)
            ->all();
        return $data;



        // return $this::find()->orderBy('id desc')->all();
    }

    public function getOnePost($id) {

        return $this::find()->where(
            [
                'id' => $id
            ])
            ->all();
    }

}
