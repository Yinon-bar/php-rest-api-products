<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & connect to db
$database = new Database();
$db = $database->connect();

// Insantiate blog post object
$post = new Post($db);

// Blog post query
$result = $post->read();
// Get row count
$num = $result->rowCount();

// Check if any post returned
if ($num > 0) {
  $posts_arr = array();
  $posts_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // Push to data array
    array_push($posts_arr['data'], $row);
  }
  // Turn to json
  echo json_encode($posts_arr);
} else {
  // no posts
  echo json_encode(array('msg' => 'no post found'));
}
