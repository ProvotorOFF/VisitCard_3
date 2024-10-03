<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $content
 * @property float $price
 * @property float $old_price
 * @property string|null $description
 * @property string|null $keywords
 * @property string $img
 * @property int $is_offer
 */
class Product extends \yii\db\ActiveRecord
{

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'content'], 'required'],
            [['category_id', 'is_offer'], 'integer'],
            [['content'], 'string'],
            [['price', 'old_price'], 'number'],
            [['title', 'description', 'keywords', 'img'], 'string', 'max' => 255],
            [['file'], 'image']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'content' => 'Content',
            'price' => 'Price',
            'old_price' => 'Old Price',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'img' => 'Img',
            'file' => 'Изображение',
            'is_offer' => 'Is Offer',
        ];
    }

    public function getCategory() {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function beforeSave($insert)
    {
        if ($file = UploadedFile::getInstance($this, 'file')) {
            $dir = "images/" . date('Y-m-d') . "/";
            if (!is_dir($dir)) mkdir($dir);
            $fileName = uniqid() . '_' . $file->baseName . '_' . time() . '.' . $file->extension;
            $this->img = "$dir$fileName";
            $file->saveAs($this->img);
        }
        return parent::beforeSave($insert);
    }
}
