<?php

/**
 * Array of route definitions for the application.
 *
 * @var array<string, array<string, string>> $routes An associative array where keys are URL patterns
 *                                                   and values are arrays mapping HTTP methods to
 *                                                   controller actions.
 */
$router = [
    /**
     * Route for user collection operations.
     *
     * - GET: Calls the `index` method of `UserController` to list all users.
     * - POST: Calls the `store` method of `UserController` to create a new user.
     */
    '/users' => [
        'GET' => 'UserController@index',
        'POST' => 'UserController@store'
    ],

    /**
     * Route for single user operations based on user ID.
     *
     * - GET: Calls the `show` method of `UserController` to retrieve a single user.
     * - PUT: Calls the `update` method of `UserController` to update a user's information.
     * - DELETE: Calls the `destroy` method of `UserController` to delete a user.
     */
    '/users/{id}' => [
        'GET' => 'UserController@show',
        'PUT' => 'UserController@update',
        'DELETE' => 'UserController@destroy'
    ],
];
