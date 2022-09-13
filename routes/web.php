<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ItemsController@index');

Route::get('items/feed', 'ItemsController@feed')->name('items.feed');

Route::resource('items', 'ItemsController');

Route::get('items/{item}/messages/feed', 'ItemMessagesController@feed')->name('items.messages.feed');
Route::resource('items.messages', 'ItemMessagesController');


Route::get('feeds/{feed}.xml', 'FeedsController@feed')->name('feeds.feed');

Route::resource('feeds', 'FeedsController');

Route::post('feeds/{feed}/attach_item', 'FeedsController@attach_item')->name('feeds.attach_item');
Route::delete('feeds/{feed}/detach_item/{item}', 'FeedsController@detach_item')->name('feeds.detach_item');

Route::get('user_supports.xml', 'UserSupportsController@feed')->name('user_supports.feed');
Route::get('user_supports_rss.xml', 'UserSupportsController@rssfeed')->name('user_supports.rssfeed');
Route::get('user_supports/ping', 'UserSupportsController@ping')->name('user_supports.ping');
Route::resource('user_supports', 'UserSupportsController');

// channel+feed形式のAOKよさこい通信
Route::get('channels/yosakoi', 'ChannelsController@yosakoi')->name('channels.yosakoi');
Route::get('channels/feed', 'ChannelsController@feed')->name('channels.feed');
Route::get('channels/{channel}/posts/feed', 'ChannelPostsController@feed')->name('channels.posts.feed');

Route::resource('channels', 'ChannelsController');
Route::get('channels/{channel}/publish', 'ChannelsController@publish')->name('channels.publish');
Route::resource('channels.posts', 'ChannelPostsController');

Route::resource('channels.comments', 'ChannelCommentsController');