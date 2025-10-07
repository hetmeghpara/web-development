<?php
// API endpoint to manage events data
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];
$json_file = 'events.json';

// Read existing events
function getEvents() {
    global $json_file;
    if (file_exists($json_file)) {
        $content = file_get_contents($json_file);
        return json_decode($content, true) ?: [];
    }
    return [];
}

// Save events to JSON
function saveEvents($events) {
    global $json_file;
    return file_put_contents($json_file, json_encode($events, JSON_PRETTY_PRINT));
}

switch ($method) {
    case 'GET':
        // Get all events or specific event by ID
        $events = getEvents();
        
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $event = array_filter($events, function($e) use ($id) {
                return $e['id'] == $id;
            });
            echo json_encode(array_values($event));
        } else {
            echo json_encode($events);
        }
        break;
        
    case 'POST':
        // Add new event
        $input = json_decode(file_get_contents('php://input'), true);
        $events = getEvents();
        
        // Generate new ID
        $max_id = 0;
        foreach ($events as $event) {
            if ($event['id'] > $max_id) {
                $max_id = $event['id'];
            }
        }
        
        $input['id'] = $max_id + 1;
        $events[] = $input;
        
        if (saveEvents($events)) {
            echo json_encode(['status' => 'success', 'message' => 'Event added', 'event' => $input]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save event']);
        }
        break;
        
    case 'PUT':
        // Update existing event
        $input = json_decode(file_get_contents('php://input'), true);
        $events = getEvents();
        
        if (isset($input['id'])) {
            for ($i = 0; $i < count($events); $i++) {
                if ($events[$i]['id'] == $input['id']) {
                    $events[$i] = $input;
                    break;
                }
            }
            
            if (saveEvents($events)) {
                echo json_encode(['status' => 'success', 'message' => 'Event updated']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update event']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Event ID required']);
        }
        break;
        
    case 'DELETE':
        // Delete event
        $input = json_decode(file_get_contents('php://input'), true);
        $events = getEvents();
        
        if (isset($input['id'])) {
            $events = array_filter($events, function($e) use ($input) {
                return $e['id'] != $input['id'];
            });
            $events = array_values($events); // Reindex array
            
            if (saveEvents($events)) {
                echo json_encode(['status' => 'success', 'message' => 'Event deleted']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete event']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Event ID required']);
        }
        break;
        
    default:
        echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        break;
}
?>