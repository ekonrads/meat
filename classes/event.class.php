<?php
class Event {
  private $_db;
  private $_mysqli;

  public function createEvent($eventName, $eventDate, $eventDesc, $authorName) {
   // Connecting to Database
   $db = $GLOBALS['gdb'];
   $mysqli = $db->getConnection();

   // prepare and bind
   $stmt = $mysqli->prepare("INSERT INTO events(title, event_date, description, author) VALUES (?, ?, ?, ?)");
   $stmt->bind_param("ssss", $eventName, $eventDate, $eventDesc, $authorName);

   $stmt->execute();

   $stmt->close();
   $mysqli->close();
   header('Location: ./includes/header.php');
  }
  public function getAllEvents() {
    // Connecting to Database
    $db = $GLOBALS['gdb'];
    $mysqli = $db->getConnection();

   	// prepare and bind
   	$stmt = $mysqli->prepare("SELECT id, title, event_date, description, author FROM events");
     $stmt->execute();
     $stmt->bind_result($eventid, $tilte, $eventDate, $description, $author);
     while ($stmt->fetch()) {

       echo '<tr>';
         echo '<th scope="row">' .$eventid. '<td>' .$tilte. '</td> <td>' . $eventDate.'</td><td>' .$description.'</td><td>' .$author.'</td><td><a class="btn btn-primary btn-sm m-r-1" href="editevent.php?edit=true&eventid='.$eventid.'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a class="btn btn-danger btn-sm" href="events.php?delete=true&eventid='.$eventid.'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
       echo '</tr>';
     }

    /**
      * Close connection
    */
    // $stmt->close();
    // $mysqli->close();

  }
 // Get all user info from user table by user_id
 public function getEventsById($eventid) {
   // Connecting to Database
   $db = $GLOBALS['gdb'];
   $mysqli = $db->getConnection();

    // prepare and bind
    $stmt = $mysqli->prepare("SELECT title, event_date, description, author FROM events	WHERE id = ?");
    $stmt->bind_param('i', $eventid);
    $stmt->execute();
    $stmt->bind_result($tilte, $eventDate, $description, $author);

    // Only returning info from 1 user so I will create an array that I can easily work with on my page
    $eventArr;
    while ($stmt->fetch()) {
      $eventArr['eventid'] = $eventid;
      $eventArr['title'] = $tilte;
      $eventArr['event_date'] = $eventDate;
      $eventArr['description'] = $description;
      $eventArr['author'] = $author;
    }

   // Close connection
   $stmt->close();
   $mysqli->close();
   return $eventArr;
 }

 public function updateEvents($eventid, $tilte, $eventDate, $description, $author) {
  // Connecting to Database
  $db = $GLOBALS['gdb'];
  $mysqli = $db->getConnection();

  // prepare and bind
  $stmt = $mysqli->prepare("UPDATE events SET title=?, event_date=?, description=?, author=? WHERE id=?");
  $stmt->bind_param("ssssi", $tilte, $eventDate, $description, $author, $eventid);
  $stmt->execute();

  // $stmt->close();
  // $mysqli->close();
  //header('Location: ./users.php?updated=true');
 }

 public function deleteEvent($eventid) {
  // Connecting to Database
  $db = $GLOBALS['gdb'];
  $mysqli = $db->getConnection();

  // prepare and bind
  $stmt = $mysqli->prepare("DELETE FROM events WHERE id=? LIMIT 1");
  $stmt->bind_param("i", $eventid);
  $stmt->execute();

  $stmt->close();
  //$mysqli->close();
  //header('Location: ./users.php?updated=true');
 }

 }

?>
