<?php

namespace RestfulAPI\Controllers;

use RestfulAPI\Models\UserModel;
use RestfulAPI\Utils\HttpResponseHandler;

/**
 * UserController handles HTTP requests related to user resources.
 *
 * This controller provides methods to perform CRUD operations on users, including
 * listing all users, creating a new user, retrieving a user by ID, updating a user,
 * and deleting a user. It returns JSON responses with appropriate HTTP status codes.
 */
class UserController
{
    /**
     * Retrieves and returns a list of all users.
     *
     * @return void
     */
    public function index(): void
    {
        $user = new UserModel();

        $data = $user->fetchAll();

        if (!is_array($data)) {
            HttpResponseHandler::sendResponse(500, $data);
        }

        HttpResponseHandler::sendResponse(200, $data);
    }

    /**
     * Creates a new user with the provided data.
     *
     * @return void
     */
    public function store(): void
    {
        $data = json_decode(
            file_get_contents('php://input'),
            true
        );

        $user = new UserModel();

        $action = $user->store($data);

        HttpResponseHandler::sendResponse(
            $action['success'] ? 201 : 400,
            $action['data']
        );
    }

    /**
     * Retrieves and returns a user by ID.
     *
     * @param array $id An array containing the user ID.
     *
     * @return void
     */
    public function show(array $id): void
    {
        $user = new UserModel();

        $data = $user->fetchById($id[0]);

        if (!$data) {
            HttpResponseHandler::sendResponse(500, 'An error occurred fetching by id. Please try again later.');
        }

        HttpResponseHandler::sendResponse(200, $data);
    }

    /**
     * Updates an existing user with the provided data.
     *
     * @param array $id An array containing the user ID.
     *
     * @return void
     */
    public function update(array $id): void
    {
        $data = json_decode(
            file_get_contents('php://input'),
            true
        );

        $user = new UserModel();

        $action = $user->update($id[0], $data);

        HttpResponseHandler::sendResponse(
            $action['success'] ? 200 : 400,
            $action['data']
        );
    }

    /**
     * Deletes a user by ID.
     *
     * @param array $id An array containing the user ID.
     *
     * @return void
     */
    public function destroy(array $id): void
    {
        $user = new UserModel();

        $action = $user->destroy($id[0]);

        if (!$action) {
            HttpResponseHandler::sendResponse(422, 'Cannot process request. The item might not exist.');
        }

        HttpResponseHandler::sendResponse(200, 'Deleted Successfully');
    }
}
