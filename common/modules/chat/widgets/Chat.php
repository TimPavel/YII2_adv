<?php
    namespace common\modules\chat\widgets;
    
    use common\modules\chat\assets\ChatAsset;
    use yii\web\AssetBundle;

    class Chat extends \yii\bootstrap\Widget
    {
        public $port = 8080;
        
        public function init()
        {
        
        }
        
        public function run()
        {
//            $this->view->registerJsFile('/js/chat.js');
            ChatAsset::register($this->view);
            $this->view->registerJsVar('wsPort', $this->port);
            return $this->render('chat');
        }
    }