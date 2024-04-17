<?php 
$time_slots = ['08:10 - 09:10', '09:10 - 10:10', '10:20 - 11:20', '11:50 - 12:50', '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00',]; 
$days = ['Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag']; 


foreach ($time_slots as $time_slot) { 
    echo "<tr>"; 
    echo "<td>" . $time_slot . "</td>"; 
    foreach ($days as $day) { 
        if (isset($events[$day][$time_slot])) { 
            echo "<td>" . $events[$day][$time_slot] . "</td>"; 
        } else { 
            echo "<td></td>"; 
        } 
    } 
    echo "</tr>"; 
} 