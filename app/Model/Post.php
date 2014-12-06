<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Post extends AppModel {
    public $virtualFields = array(
    'sum' => 'Post.nbLike - Post.nbDislike'
);
}