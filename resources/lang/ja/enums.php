<?php
// resources/lang/ja/enums.php
use App\Enums\ItemType;
use App\Enums\PublishType;
 
return [
  ItemType::class => [
    ItemType::NORMAL  =>   '標準',
    ItemType::USER_SUPPORT => 'ユーザーサポート',
  ],
  
  PublishType::class => [
    PublishType::PUBLISHED  =>   '公開',
    PublishType::DRAFT => '下書き',
  ],
];