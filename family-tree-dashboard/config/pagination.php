<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Pagination View
    |--------------------------------------------------------------------------
    |
    | This view will be used to render the pagination link output. You are
    | free to change this view to anything you wish. The built-in views
    | should provide a great starting point for using Bootstrap pagination.
    |
    */

    'default' => 'bootstrap-4',

    /*
    |--------------------------------------------------------------------------
    | Pagination View
    |--------------------------------------------------------------------------
    |
    | This view will be used to render the pagination link output. You are
    | free to change this view to anything you wish. The built-in views
    | should provide a great starting point for using Bootstrap pagination.
    |
    */

    'view' => 'pagination::bootstrap-4',

    /*
    |--------------------------------------------------------------------------
    | Pagination Presenter
    |--------------------------------------------------------------------------
    |
    | This presenter will be used to render the pagination link output. You are
    | free to change this presenter to anything you wish. The built-in views
    | should provide a great starting point for using Bootstrap pagination.
    |
    */

    'presenter' => Illuminate\Pagination\BootstrapPresenter::class,

];
