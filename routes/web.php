<?php

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/tema/{tema_id}/posts', 'HomeController@post')->name('show_posts');

Route::get('/home/tema/{tema_id}/post/{post_id}/messages', 'HomeController@message')->name('show_messages');

Route::get('/home/pesquisa/{pesquisa}', 'HomeController@indexQuery')->name('homeQuery');

Route::post('/cadastrar_tema', 'TemaController@cadastrarTema')->name('cadastrar_tema');

Route::post('/cadastrar_postagem', 'PostagemController@cadastrarPostagem')->name('cadastrar_postagem');

Route::get('/{postagem_id}/remover_postagem', 'PostagemController@removerPostagem')->name('remover_postagem');

Route::post('/{postagem_id}/comentar_postagem', 'PostagemController@comentarPostagem')->name('comentar_postagem');

Route::get('/{postagem_id}/show_editar_postagem', 'PostagemController@showEditPost')->name('show_editar_postagem');

Route::post('/{postagem_id}/editar_postagem', 'PostagemController@editPost')->name('editar_postagem');

Route::get('/home/query', 'PesquisaController@pesquisar')->name('pesquisar');
