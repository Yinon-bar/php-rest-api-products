<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & connect to db
$database = new Database();
$db = $database->connect();

// Insantiate blog post object
$post = new Post($db);

// Get the post data
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;


if ($post->create_post()) {
  // Turn to json
  echo json_encode(['msg' => 'Data saved successfuly']);
} else {
  // no posts
  echo json_encode(array('msg' => 'Error saving data'));
}
